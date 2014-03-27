<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

        <section>

            <div class="page-header">
                <h1>DataTables with Server-Side Processing</h1>
            </div>

            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="table-responsive" id="dataTables-container-example">
                        <table class="table table-striped table-bordered table-hover table-valign-middle" id="dataTables-example">

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
                <p>Integration for Bootstrap: <a target="_blank" href="https://github.com/DataTables/Plugins/tree/master/integration/bootstrap">https://github.com/DataTables/Plugins/tree/master/integration/bootstrap</a></p>
                <p>Visual responsiveness support for tables with server-side processing: <a target="_blank" href="https://github.com/Comanche/datatables-responsive">https://github.com/Comanche/datatables-responsive</a></p>
            </div>

        </section>
