<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

        <section>

<?php

template_partial('subnavbar');

?>

            <div class="page-header">
                <h1>DataTables with Server-Side Processing</h1>
            </div>

<?php

if (!$driver_ok) {

?>

            <div class="alert alert-warning text-center">pdo_sqlite database driver is needed for this demo to work.</div>
<?php
}

?>

            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-valign-middle" id="datatable">

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

                                    </td>
                                    <td class="table-actions">

                                    </td>
                                </tr>

                            </thead>

                            <tfoot>

                                <tr>
                                    <th class="col-sm-1">id</th>
                                    <th class="col-sm-3">ISO-3166 Code</th>
                                    <th class="col-sm-5">Country Name</th>
                                    <th data-hide="phone">Flag</th>
                                    <th colspan="2" class="shrink"><i18n>ui_actions</i18n></th>
                                </tr>

                            </tfoot>

                            <tbody>
                                <tr>
                                    <td colspan="6" class="dataTables_empty"><i18n>ui_loading_data_from_server</i18n></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>

                </div>

            </div>

        </section>
