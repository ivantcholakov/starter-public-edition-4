/**
 *  jQuery.keepalive plugin -- keep a PHP session alive
 *  Copyright (c) 2010 Wayne Walls - wfwalls(at)gmail(dot)com
 *  License: MIT License or GNU General Public License (GPL) Version 2
 *  Date: 26 August 2010
 *  @author Wayne Walls
 *  @version 1.0
 *
 */


// TODO: create private functions to replace all anonymous functions
// TODO: describe keepalive styles and stylesheet in the documentation
// TODO: add list of supported browsers to documentation


/*jslint browser: true, devel: true, onevar: true, undef: true, nomen: true, eqeqeq: true, bitwise: true, regexp: true, newcap: true, immed: true */
/*global window, jQuery */


/**
 * The following anonymous function creates a closure that defines
 * the jquery.keepalive plugin.
 *
 * Inside this function you will find, in order, the following sections:
 * --PRIVATE VARIABLES
 * --PRIVATE FUNCTIONS
 * --PLUGIN NAMESPACE ** PUBLIC PROPERTIES AND METHODS
 * --INITIALIZATIONS THAT CAN BE DONE IMMEDIATELY
 * --INITIALIZATIONS THAT HAVE TO WAIT UNTIL THE DOM IS READY
 *
 */
( function(window, document, $) {


    var
        //
        // --PRIVATE VARIABLES
        //

        // used with setInterval()
        kaIntervalID,

        // boolean that tracks whether keepalive is enabled
        kaIsRunning = false,

        // boolean that tracks whether the keepalive data display is enabled 
        kaShowingData = false,
    
        // the number of keepalive request sent
        kaSendCount = 0,

        // the number of requests returned successfully
        kaRcvdCount = 0,

        // the round trip duration for the most recent request
        kaRequestTime = 0,

        // the sum of all round trip durations
        kaTotalTime = 0,

        // the average round trip duration
        kaAverageTime = 0,


        //
        // --PRIVATE FUNCTIONS
        //

        /**
         * PRIVATE FUNCTION
         * kaGetData() build the keepalive data display string
         *
         */
        kaGetData = function() {

            var options = $.keepalive.options;

            return ("Keep-alive: status: " + ((kaIsRunning) ? "running" : "stopped") +
                ", sent: " + kaSendCount +
                ", rcvd: " + kaRcvdCount +
                ", average round-trip: " + kaAverageTime + "ms" + "<br>" +
                "interval: " + options.interval + "ms" +
                ", timeout: " + options.timeout + "ms" +
                ", id: " + options.dataObject.id +
                ", URL: " + options.url);
        },

        /**
         * PRIVATE FUNCTION
         * contactServer() contacts the server to keep the session alive
         *
         */
        contactServer = function() {

            var options = $.keepalive.options;

            //increment the send counter
            kaSendCount += 1;

            // grab the time that the server request was made
            kaRequestTime = new Date().getTime();

            // send off the request to the server
            $.ajax(
            {
                url      : options.url,
                type     : "POST",
                data     : options.dataObject,
                datatype : "text",
                timeout  : options.timeout,

                error    : function()
                {
                    // DO NOT update the kaRcvdCount counter

                    if (kaShowingData) {

                        // update the keep alive status display
                        jQuery("#ww-keepalive-status").html(kaGetData());

                    }

                    // invoke the errorCallback function
                    if ($.keepalive.options.errorCallback) {

                        if ($.isFunction($.keepalive.options.errorCallback)) {
                            $.keepalive.options.errorCallback.call(null);
                        }
                    }
                },

                success  : function()
                {
                    // increment the rcvd counter
                    kaRcvdCount += 1;

                    //calculate the average round-trip interval so far
                    kaTotalTime += (new Date().getTime() - kaRequestTime);
                    kaAverageTime = (kaTotalTime/kaRcvdCount);
                    kaAverageTime = Math.round(kaAverageTime);

                    if (kaShowingData) {

                        // update the keep alive status display
                        jQuery("#ww-keepalive-status").html(kaGetData());

                    }

                    // invoke the successCallback function
                    if ($.keepalive.options.successCallback) {

                        if ($.isFunction($.keepalive.options.successCallback)) {
                            $.keepalive.options.successCallback.call(null);
                        }
                    }
                }
            });
        };


    //
    // END OF var STATEMENT
    //


    //
    // --PLUGIN NAMESPACE ** PUBLIC PROPERTIES AND METHODS
    //
    $.keepalive = {

        // PUBLIC PROPERTY -- keepalive default option settings
        options : {

            // url that the request will be sent to
            url : "php/keepalive.php",

            // data to be submitted to the server
            dataObject : { id : "keepalive"},

            // how often should keepalive contact the server in milliseconds
            // default is five minutes -- this would allow two connection
            // failures and still maintain a 20 minute contact interval
            interval : 300000,

            // timeout value for ajax request in milliseconds
            timeout : 20000,

            // callback for page specific processing in error()
            errorCallback : null,

            // callback for page specific processing in success()
            successCallback : null

        },

        /**
         * PUBLIC METHOD
         * configure() is called to set keepalive options that will act as
         * default values for all subsequent requests.
         *
         * @param   {Object} config contains the option properties and their
         * values to be changed
         *
         */
        configure : function(config) {

            // get the user submitted configuration options for this call
            config = config || {};
            this.options = $.extend(this.options, config);

            if (kaIsRunning) {

                // restart keepalive to instantiate the new options

                this.stop();

                this.start();

            }

            if (kaShowingData) {

                // update the keep alive status display
                jQuery("#ww-keepalive-status").html(kaGetData());

            }

        },

        /**
         * PUBLIC METHOD
         * start() starts the keepalive interval
         *
         * @param   {Object} config contains the option properties and their
         * values to be changed
         *
         */
        start : function(config) {

            // get the user submitted configuration options
            config = config || {};
            this.options = $.extend(this.options, config);

            kaIntervalID = setInterval(contactServer, this.options.interval);

            kaIsRunning = true;

            if (kaShowingData) {

                // update the keep alive status display
                jQuery("#ww-keepalive-status").html(kaGetData());

            }

        },

        /**
         * PUBLIC METHOD
         * stop() stops the keepalive interval
         *
         */
        stop : function() {

            clearInterval(kaIntervalID);

            kaIsRunning = false;

            if (kaShowingData) {

                // update the keep alive status display
                jQuery("#ww-keepalive-status").html(kaGetData());

            }

        },

        /**
         * PUBLIC METHOD
         * toggleDisplay() toggles the keepalive data display
         */
        toggleDisplay : function() {

            if (kaShowingData) {

                $("#ww-keepalive-status").remove();

                kaShowingData = false;
            }
            else {

                $("<div />", {
                    id   : "ww-keepalive-status",
                    html : kaGetData()
                }).appendTo(document.body);

                kaShowingData = true;

            }
        }

    };


    //
    // --INITIALIZATIONS THAT CAN BE DONE IMMEDIATELY
    //
    $.keepalive.start();


    //
    // --INITIALIZATIONS THAT HAVE TO WAIT UNTIL THE DOM IS READY
    //
    // -- none so far

    
}(window, document, jQuery) );


