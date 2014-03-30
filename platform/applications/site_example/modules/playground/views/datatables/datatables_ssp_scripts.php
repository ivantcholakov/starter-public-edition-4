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

        var tableElement = $('#datatable');

        var table = tableElement.DataTable({
            'orderCellsTop': true,
            'pagingType': 'simple_numbers',
            'stateSave': true,
            'processing': true,
            'serverSide': true,
            'ajax': {
                'url': '<?php echo site_url('playground/datatables/datatables-ssp-ajax'); ?>',
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
                    'searchable': false,
                    'orderable': false
                },
                {
                    'data': 'action_edit',
                    'searchable': false,
                    'orderable': false,
                    'class': 'table-actions'
                },
                {
                    'data': 'action_delete',
                    'searchable': false,
                    'orderable': false,
                    'class': 'table-actions'
                }
            ],
            'language': <?php echo $this->lang->datatables(); ?>,
            // Making the table responsive.
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
            },
            // See http://odoepner.wordpress.com/2011/12/12/jquery-datatables-column-filters-state-saving/
            'initComplete': function(oSettings, json) {
                var cols = oSettings.aoPreSearchCols;
                for (var i = 0; i < cols.length; i++) {
                    var value = cols[i].sSearch;
                    if (value.length > 0) {
                        $("thead input[type=text]")[i].value = value;
                    }
                }
            }
        });

        // Individual text-input filters.
        $("#datatable thead input[type=text]").on('keyup change', function () {
            table
                .column($(this).parent().index() + ':visible')
                .search(this.value)
                .draw();
        });

    });

    //]]>
    </script>
