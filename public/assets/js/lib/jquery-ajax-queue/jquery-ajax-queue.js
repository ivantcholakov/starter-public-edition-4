/**
 * Ajax Queue Plugin
 * 
 * Homepage: http://jquery.com/plugins/project/ajaxqueue
 * Documentation: http://docs.jquery.com/AjaxQueue
 * http://www.onemoretake.com/2009/10/11/ajaxqueue-and-jquery-1-3/
 * Patched version from: http://luke.dashjr.org/programs/bitcoin/w/Bitcoin-Poker-Room.git/blob_plain/HEAD:/root/static/js/jquery.ajaxQueue.js
 */

/**

<script>
$(function(){
    jQuery.ajax({
        url: "test.php",
        mode: 'queue',
        success: function(html){ jQuery("ul").append(html); }
    });
    jQuery.ajax({
        url: "test.php",
        mode: 'queue',
        success: function(html){ jQuery("ul").append(html); }
    });
    jQuery.ajax({
        url: "test.php",
        mode: 'sync',
        success: function(html){ jQuery("ul").append("<b>"+html+"</b>"); }
    });
    jQuery.ajax({
        url: "test.php",
        mode: 'sync',
        success: function(html){ jQuery("ul").append("<b>"+html+"</b>"); }
    });
});
</script>
<ul style="position: absolute; top: 5px; right: 5px;"></ul>

*/

/*
 * Queued Ajax requests.
 * A new Ajax request won't be started until the previous queued 
 * request has finished.
 */

/*
 * Synced Ajax requests.
 * The Ajax request will happen as soon as you call this method, but
 * the callbacks (success/error/complete) won't fire until all previous
 * synced requests have been completed.
 */


jQuery.extend({
    queue_next: function( elem, type, data ) {
        type = (type || "fx") + "queue";
        var q = jQuery.data( elem, type, undefined, true );
        // Speed up dequeue by getting out quickly if this is just a lookup
        if ( data ) {
            if ( !q || jQuery.isArray(data) ) {
                q = jQuery.data( elem, type, jQuery.makeArray(data), true );
            } else {
                q.unshift( data );
            }
        }
        return q || [];
    }
});

jQuery.fn.extend({
    queue_next: function( type, data ) {
        if ( typeof type !== "string" ) {
            data = type;
            type = "fx";
        }

        if ( data === undefined ) {
            return jQuery.queue_next( this[0], type );
        }
        return this.each(function() {
            var queue = jQuery.queue_next( this, type, data );

            if ( type === "fx" && queue[0] !== "inprogress" ) {
                jQuery.dequeue( this, type );
            }
        });
    }
});

(function($) {

    $.ajax_queue = $.ajax;
    pendingRequests = {},
    synced = [],
    syncedData = [],
    ajaxRunning = [];

    $.ajax = function(settings) {
        // create settings for compatibility with ajaxSetup
        settings = jQuery.extend(settings, jQuery.extend({}, jQuery.ajaxSettings, settings));

        var port = settings.port;

        settings.retry = 1;
    
        switch (settings.mode) {
            case "abort":
                if (pendingRequests[port]) {
                    pendingRequests[port].abort();
                }
                return pendingRequests[port] = $.ajax_queue.apply(this, arguments);
                
            case "direct":
                $.ajax_queue(settings);
                return;
                
            case "next":
            case "queue":
                var _old = settings.complete;

                settings.complete = function() {

                    if (_old) {
                        _old.apply(this, arguments);
                    }

                    if (jQuery([$.ajax_queue]).queue("ajax" + port).length == 0) {
                      ajaxRunning[port] = false;
                    }
                    else {
                      settings.queue_next();
                    }
                };

                var operation = function(next) {
                  settings.queue_next = next;
                  $.ajax_queue(settings);
                }

                if (settings.mode == 'next') {
                  jQuery([$.ajax_queue]).queue_next("ajax" + port, operation);
                }
                else {
                  jQuery([$.ajax_queue]).queue("ajax" + port, operation);
                }

                if (jQuery([$.ajax_queue]).queue("ajax" + port).length == 1 && !ajaxRunning[port]) {
                  ajaxRunning[port] = true;
                  jQuery([$.ajax_queue]).dequeue("ajax" + port);
                }

                return;
            case "sync":
                var pos = synced.length;

                synced[pos] = {
                    error: settings.error,
                    success: settings.success,
                    complete: settings.complete,
                    done: false
                };

                syncedData[pos] = {
                    error: [],
                    success: [],
                    complete: []
                };

                settings.error = function() { syncedData[pos].error = arguments; };
                settings.success = function() { syncedData[pos].success = arguments; };
                settings.complete = function() {
                    syncedData[pos].complete = arguments;
                    synced[pos].done = true;

                    if (pos == 0 || !synced[pos - 1])
                        for (var i = pos; i < synced.length && synced[i].done; i++) {
                        if (synced[i].error) synced[i].error.apply(jQuery, syncedData[i].error);
                        if (synced[i].success) synced[i].success.apply(jQuery, syncedData[i].success);
                        if (synced[i].complete) synced[i].complete.apply(jQuery, syncedData[i].complete);

                        synced[i] = null;
                        syncedData[i] = null;
                    }
                };
        }
        return $.ajax_queue.apply(this, arguments);
    };

})(jQuery);