$(document).ready(function() {

    /**
     * Set message as read when opened
     */
    $('.modal').on('shown.bs.modal', function(e) {
        var id = $(e.target).attr('data-id');
        var ref = $(e.relatedTarget).attr('data-read');
        if (ref == "false") {
            $.ajax({
                url     : "/admin/contact/read/" + id,
                success : function(data) {
                    if (config.logging) console.log(data);
                    if (data.error == undefined) {
                        $(e.relatedTarget).attr('data-read', "true").removeClass('btn-primary').addClass('btn-default');
                    }
                },
                error   : function(error) {
                    if (config.logging) console.log(error);
                }
            });
        }
    });

});
