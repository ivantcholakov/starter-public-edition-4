/**
 * Configurations
 */
var config = {
    logging : true,
    baseURL : "<<base_url>>"
};


/**
 * Bootstrap IE10 viewport bug workaround
 */
if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
    var msViewportStyle = document.createElement('style')
    msViewportStyle.appendChild(
        document.createTextNode(
            '@-ms-viewport{width:auto!important}'
        )
    )
    document.querySelector('head').appendChild(msViewportStyle)
}


/**
 * Execute an AJAX call
 */
function executeAjax(url, data, callback) {
    $.ajax({
        type     : 'POST',
        url      : url,
        data     : data,
        dataType : 'json',
        async    : true,
        success  : function(results) {
            callback(results);
        },
        error    : function(error) {
            alert("Error " + error.status + ": " + error.statusText);
        }
    });
    // prevent default action
    return false;
}


/**
 * Global core functions
 */
$(document).ready(function() {

    /**
     * Session language selected
     */
    $('#session-language-dropdown a').click(function(e) {
        // prevent default behavior
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            e.returnValue = false;
        }

        // set up post data
        var postData = {
            language : $(this).attr('rel')
        };

        // define callback function to handle AJAX call result
        var ajaxResults = function(results) {
            if (results.success) {
                location.reload();
            } else {
                alert("{{core error session_language}}");
            }
        };

        // perform AJAX call
        executeAjax(config.baseURL + 'ajax/set_session_language', postData, ajaxResults);
    });

});
