<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!$driver_ok) {
    return;
}

echo js('lib/dataTables/jquery.dataTables.min.js');
echo js('lib/dataTables/dataTables.bootstrap.js');
echo js('lib/dataTables/datatables.responsive.js');

?>

    <script type="text/javascript">
    //<![CDATA[

    $(function() {

        var responsiveHelper;
        var breakpointDefinition = {
            tablet: 1024,
            phone : 480
        };
        var tableElement = $('#dataTables-example');
        var tableContainer = $('#dataTables-container-example');

        tableElement.dataTable({
            'pagingType': 'simple_numbers',
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'ajax': {
                'url': '<?php echo site_url('playground/datatables/datatables-ajax'); ?>',
                'type': 'post'
            },
            'columns': [
                {
                    'data': 'id'
                },
                {
                    'data': 'code'
                },
                {
                    'data': 'name'
                },
                {
                    'data': 'flag',
                    'orderable': false
                },
                {
                    'data': 'action_edit',
                    'class': 'table-actions'
                },
                {
                    'data': 'action_delete',
                    'class': 'table-actions'
                }
            ],
            'language': <?php echo $this->lang->datatables(); ?>,
            // Making the table responsive for SSP case.
            'autoWidth': false,
            'preDrawCallback': function () {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper) {
                    responsiveHelper = new ResponsiveDatatablesHelper(tableElement, breakpointDefinition);
                }
            },
            'rowCallback': function (nRow) {
                responsiveHelper.createExpandIcon(nRow);
            },
            'drawCallback': function (oSettings) {
                responsiveHelper.respond();
            }
        });

    });

    //]]>
    </script>
