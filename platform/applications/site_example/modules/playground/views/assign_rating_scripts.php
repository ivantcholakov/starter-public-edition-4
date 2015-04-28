<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan tcholakov, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

echo js('lib/bootstrap-star-rating/star-rating.min.js');
//echo js('lib/bootstrap3-dialog/bootstrap-dialog.min.js');
echo js('lib/bootstrap3-dialog/bootstrap-dialog.js');   // For testing purposes, non-minified version here.

?>

    <script type="text/javascript">
    //<![CDATA[

    // I18N
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_DEFAULT] = <?php echo json_encode($this->lang->line('ui_information')); ?>;
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_INFO] = <?php echo json_encode($this->lang->line('ui_information')); ?>;
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_PRIMARY] = <?php echo json_encode($this->lang->line('ui_information')); ?>;
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_SUCCESS] = <?php echo json_encode($this->lang->line('ui_success')); ?>;
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_WARNING] = <?php echo json_encode($this->lang->line('ui_warning')); ?>;
    BootstrapDialog.DEFAULT_TEXTS[BootstrapDialog.TYPE_DANGER] = <?php echo json_encode($this->lang->line('ui_danger')); ?>;
    BootstrapDialog.DEFAULT_TEXTS['OK'] = <?php echo json_encode($this->lang->line('ui_ok')); ?>;
    BootstrapDialog.DEFAULT_TEXTS['CANCEL'] = <?php echo json_encode($this->lang->line('ui_cancel')); ?>;
    BootstrapDialog.DEFAULT_TEXTS['CONFIRM'] = <?php echo json_encode($this->lang->line('ui_confirm')); ?>;

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

        $('#save_ratings').on('click', function (e) {
            save_ratings();
        });

        $('#delete_ratings').on('click', function (e) {

            BootstrapDialog.show({
                title: <?php echo json_encode($this->lang->line('ui_confirm')); ?>,
                message: <?php echo json_encode($this->lang->line('ui_confirm_rating_deletion')); ?>,
                type: BootstrapDialog.TYPE_DANGER,
                size: BootstrapDialog.SIZE_SMALL,
                closable: true,
                draggable: true,
                buttons: [{
                    label: <?php echo json_encode($this->lang->line('ui_yes')); ?>,
                    icon: 'fa fa-trash fa-fw',
                    cssClass: 'btn-danger',
                    action: function(dialog) {
                        delete_ratings();
                        dialog.close();
                    }
                }, {
                    label: <?php echo json_encode($this->lang->line('ui_no')); ?>,
                    icon: 'fa fa-ban fa-fw',
                    action: function(dialog) {
                        dialog.close();
                    }
                }]
            });
        });
    });

    //]]>
    </script>
