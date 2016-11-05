/* 
 * test.js
 */

$(function() {

    $('#sidebar_toggle').on('click', function(e) {

        var body = $('body');
        var state = '';

        if (body.hasClass('sidebar-collapse')) {
            state = 'sidebar-collapse';
        }

        $.ajax({
            type: 'post',
            mode: 'queue',
            url: '/main-sidebar/toggle-ajax', // Adjust the URL here..
            data: {
                state: state
            },
            success: function(data) {

            }
        });
    });

});
