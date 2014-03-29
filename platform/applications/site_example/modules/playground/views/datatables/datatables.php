<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

        <section>

            <div class="page-header">
                <h1>DataTables with Server-Side Processing</h1>
            </div>

<?php

if (!$driver_ok) {

?>

            <div class="alert alert-warning text-center">PDO+sqlite database driver is needed for this demo to work.</div>
<?php
}

?>

            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover table-valign-middle" id="datatable">

                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>ISO-3166 Code</th>
                                    <th>Country Name</th>
                                    <th>Flag</th>
                                    <th colspan="2" class="shrink"><i18n>ui_actions</i18n></th>
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

            <div class="well">
                <p>DataTables documentation: <a target="_blank" href="http://datatables.net">http://datatables.net</a></p>
                <p>Integration for Bootstrap 3: <a target="_blank" href="https://github.com/DataTables/Plugins/tree/master/integration/bootstrap/3">https://github.com/DataTables/Plugins/tree/master/integration/bootstrap/3</a></p>
                <p>Visual responsiveness support for tables with server-side processing: <a target="_blank" href="https://github.com/Comanche/datatables-responsive">https://github.com/Comanche/datatables-responsive</a></p>
            </div>

        </section>
