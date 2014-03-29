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
                                    <th rowspan="2">id</th>
                                    <th rowspan="2">ISO-3166 Code</th>
                                    <th rowspan="2">Country Name</th>
                                    <th rowspan="2">Flag</th>
                                    <th colspan="2" class="shrink"><i18n>ui_actions</i18n></th>
                                </tr>
                                <tr>
                                    <th class="shrink" style="display: none;"></th>
                                    <th class="shrink" style="display: none;"></th>
                                </tr>

                            </thead>

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
