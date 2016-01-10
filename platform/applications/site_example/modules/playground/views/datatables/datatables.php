<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

        <section>

<?php

template_partial('subnavbar');

?>

            <div class="page-header">
                <h1><?php echo $template['page_title']; ?></h1>
            </div>

            <div class="panel panel-default">

                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-condensed table-valign-middle" id="datatable">

                            <thead>

                                <tr>
                                    <th rowspan="2" class="col-sm-1">id</th>
                                    <th rowspan="2" class="col-sm-3">ISO-3166 Code</th>
                                    <th rowspan="2" class="col-sm-5">Country Name</th>
                                    <th rowspan="2" data-hide="phone">Flag</th>
                                    <th colspan="2" class="shrink"><i18n>ui_actions</i18n></th>
                                </tr>
                                <tr>
                                    <th class="shrink" style="display: none;"></th>
                                    <th class="shrink" style="display: none;"></th>
                                </tr>

                                <tr>
                                    <td><input id="search_id" type="text" i18n:placeholder="ui_search" class="form-control" style="width: 100%;" /></td>
                                    <td><input id="search_iso_code" type="text" i18n:placeholder="ui_search" class="form-control" style="width: 100%;" /></td>
                                    <td><input id="search_country_name" type="text" i18n:placeholder="ui_search" class="form-control" style="width: 100%;" /></td>
                                    <td></td>
                                    <td class="table-actions">
                                       <a href="javascript://" class="btn btn-success" i18n:title="ui_add"><i class="fa fa-plus-circle fa-fw"></i></a>
                                    </td>
                                    <td class="table-actions">

                                    </td>
                                </tr>

                            </thead>

                            <tfoot>

                                <tr>
                                    <th>id</th>
                                    <th>ISO-3166 Code</th>
                                    <th>Country Name</th>
                                    <th>Flag</th>
                                    <th colspan="2" class="shrink"><i18n>ui_actions</i18n></th>
                                </tr>

                            </tfoot>

                            <tbody>
<?php

if (!empty($items)) {

    foreach ($items as $item) {

?>

                                <tr>
                                    <td><?php echo $item['id']; ?></td>
                                    <td><span class="loud"><?php echo $item['code']; ?></span></td>
                                    <td><?php echo $item['name']; ?></td>
                                    <td><?php echo '<img src="'.BASE_URI.'assets/img/lib/flags-iso/shiny/32/'.$item['code'].'.png" />'; ?></td>
                                    <td class="table-actions"><?php echo '<a href="javascript://" class="btn btn-info" title="'.$this->lang->line('ui_edit').'"><i class="fa fa-pencil fa-fw"></i></a>'; ?></td>
                                    <td class="table-actions"><?php echo '<a id="delete_action_'.$item['id'].'" href="javascript://" class="btn btn-danger delete_action" title="'.$this->lang->line('ui_delete').'"><i class="fa fa-trash-o fa-fw"></i></a>'; ?></td>
                                </tr>
<?php

    }
}

?>

                            </tbody>

                        </table>
                    </div>

                </div>

            </div>

            <div class="well">
                <p>DataTables documentation: <a target="_blank" href="http://datatables.net">http://datatables.net</a></p>
                <p>Integration for Bootstrap 3: <a target="_blank" href="https://github.com/DataTables/Plugins/tree/master/integration/bootstrap/3">https://github.com/DataTables/Plugins/tree/master/integration/bootstrap/3</a></p>
                <p>Visual responsiveness support: <a target="_blank" href="https://github.com/Comanche/datatables-responsive">https://github.com/Comanche/datatables-responsive</a></p>
            </div>

        </section>
