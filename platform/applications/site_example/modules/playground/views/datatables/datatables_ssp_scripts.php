<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (!$driver_ok) {
    return;
}

echo js('lib/dataTables/jquery.dataTables.min.js');
echo js('lib/dataTables/plug-ins/api/sortNeutral.js');
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
            'dom': '<"top"<"pull-left"l><"pull-right"f><"clearfix"><"pull-left"i><"pull-right"p><"clearfix">>rt<"bottom"<"pull-left"i><"pull-right"p><"clearix">>',
            'orderCellsTop': true,
            'pagingType': 'simple_numbers',
            'stateSave': true,
            //'processing': true,   // Needs to be fixed visually first.
            'processing': false,
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
                    'data': 'action_map',
                    'searchable': false,
                    'orderable': false,
                    'class': 'table-actions'
                },
                {
                    'data': 'action_info',
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
                        switch (i) {
                            case 0:
                                $('#search_id').val(value);
                                break;
                            case 1:
                                $('#search_iso_code').val(value);
                                break;
                            case 2:
                                $('#search_country_name').val(value);
                                break;
                        }
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

        // "Clear search" and "Clear sort" buttons.

        $('#datatable_filter input').after(' <button id="clear_search" class="btn btn-default" title="<?php echo $this->lang->line('ui_clear_search'); ?>"><i class="fa fa-search-minus fa-fw"></i></button> <button id="clear_sort" class="btn btn-default" title="<?php echo $this->lang->line('ui_clear_sort'); ?>"><i class="fa fa-sort fa-fw"></i></button>');

        // Clear sort.
        $('#clear_sort').on('click', function() {

            table.sortNeutral();
        });

        // Clear search.
        $('#clear_search').on('click', function() {

            table.column(0).search('');
            $('#search_id').val('');

            table.column(1).search('');
            $('#search_iso_code').val('');

            table.column(2).search('');
            $('#search_country_name').val('');

            table.search('');
            $('#datatable_filter input').val('');

            table.draw();
        });

    });

    //]]>
    </script>
