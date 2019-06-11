$(document).ready(function() {

    /**
     * Delete a user
     */
    $('.btn-delete-user').click(function() {
        window.location.href = "/admin/users/delete/" + $(this).attr('data-id');
    });

});
