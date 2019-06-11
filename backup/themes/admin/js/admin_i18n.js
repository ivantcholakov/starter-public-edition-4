/**
 * Global admin functions
 */
$(document).ready(function() {

    /**
     * Enable tooltips
     */
    if ($('.tooltips').length) {
        $('.tooltips').tooltip();
    }


    /**
     * Activate any date pickers
     */
    if ($(".input-group.date").length) {
        $(".input-group.date").datepicker({
            autoclose      : true,
            todayHighlight : true
        });
    }


    /**
     * Detect items per page change on all list pages and send users back to page 1 of the list
     */
    $('select#limit').change(function() {
        var limit = $(this).val();
        var currentUrl = document.URL.split('?');
        var uriParams = "";
        var separator;

        if (currentUrl[1] != undefined) {
            var parts = currentUrl[1].split('&');

            for (var i = 0; i < parts.length; i++) {
                if (i == 0) {
                    separator = "?";
                } else {
                    separator = "&";
                }

                var param = parts[i].split('=');

                if (param[0] == 'limit') {
                    uriParams += separator + param[0] + "=" + limit;
                } else if (param[0] == 'offset') {
                    uriParams += separator + param[0] + "=0";
                } else {
                    uriParams += separator + param[0] + "=" + param[1];
                }
            }
        } else {
            uriParams = "?limit=" + limit;
        }

        // reload page
        window.location.href = currentUrl[0] + uriParams;
    });


    /**
     * Enable Summernote WYSIWYG editor on any textareas with the 'editor' class
     */
    if ($('textarea.editor').length) {
        $('textarea.editor').each(function() {
            var id = $(this).attr('id');
            $('#' + id).summernote({
                height: 300
            });
        });
    }

});
