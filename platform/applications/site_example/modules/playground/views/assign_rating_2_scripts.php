<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan tcholakov, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

echo js('lib/bootstrap-star-rating/star-rating.min.js');

?>

    <script type="text/javascript">
    //<![CDATA[

    var rating_storage = {};    // Use AJAXimplementation of storage in a real application.

    function render_rating_entries() {

        $(".rating-entry").rating({
            stars: 10,
            glyphicon: false,
            symbol: '',
            ratingClass: 'rating-fa',
            min: 0,
            max: 10,
            step: 1,
            starCaptions: function (val) {
                return val;
            },
            starCaptionClasses: function (val) {

                if (val <= 0) {
                    return 'label label-default';
                }

                if (val <= 2) {
                    return 'label label-danger';
                }

                if (val <= 4) {
                    return 'label label-warning';
                }

                if (val <= 6) {
                    return 'label label-info';
                }

                if (val <= 8) {
                    return 'label label-primary';
                }

                return 'label label-success';
            },
            hoverOnClear: false,
            clearCaption: <?php echo json_encode($this->lang->line('ui_not_rated')); ?>,
            clearButtonTitle: <?php echo json_encode($this->lang->line('ui_clear')); ?>
        });
    }

    function read_ratings() {

        render_rating_entries();

        $('#input-r1').rating('update', typeof rating_storage.r1 != 'undefined' && rating_storage.r1 !== null ? rating_storage.r1 : 0);
        $('#input-r1').rating('update', typeof rating_storage.r1 != 'undefined' && rating_storage.r1 !== null ? rating_storage.r1 : 0);
        $('#input-r1').rating('update', typeof rating_storage.r1 != 'undefined' && rating_storage.r1 !== null ? rating_storage.r1 : 0);
    }

    function save_ratings() {

        rating_storage.r1 = $('#input-r1').val();
        rating_storage.r2 = $('#input-r2').val();
        rating_storage.r3 = $('#input-r3').val();

        $('#ratings_modal').modal('hide');
    }

    function delete_ratings() {

        $('#input-r1').rating('update', 0);
        $('#input-r2').rating('update', 0);
        $('#input-r3').rating('update', 0);

        save_ratings();
    }

    $(function () {

        $('#ratings_modal').on('show.bs.modal', function (e) {
            read_ratings();
        });

        $('#ratings_modal').on('hidden.bs.modal', function (e) {
            $('#confirm_deletion_alert').addClass('hide').hide();
        });

        $('#save_ratings').on('click', function (e) {
            save_ratings();
        });

        $('#delete_ratings').on('click', function (e) {
            $('#confirm_deletion_alert').removeClass('hide').hide().fadeIn('slow');
        });

        $('#delete_ratings_ok').on('click', function (e) {
            delete_ratings();
            $('#ratings_modal').modal('hide');
        });

        $('#delete_ratings_cancel').on('click', function (e) {
            $('#confirm_deletion_alert').fadeOut('slow', function() {
                $('#confirm_deletion_alert').addClass('hide');
            });
        });
    });

    //]]>
    </script>
