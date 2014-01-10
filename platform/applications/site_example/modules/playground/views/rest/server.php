<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1>REST Server Test</h1>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <p>
                            See the article
                            <a href="http://net.tutsplus.com/tutorials/php/working-with-restful-services-in-codeigniter-2/" target="_blank">
                                http://net.tutsplus.com/tutorials/php/working-with-restful-services-in-codeigniter-2/
                            </a>
                        </p>

                        <ul>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users'); ?>">Users</a> - defaulting to XML</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/users/format/csv'); ?>">Users</a> - get it in CSV</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/user/id/1'); ?>">User #1</a> - defaulting to XML</li>
                            <li><a href="<?php echo site_url('playground/rest/server-api-example/user/id/1/format/json'); ?>">User #1</a> - get it in JSON</li>
                            <li><a id="ajax" href="<?php echo site_url('playground/rest/server-api-example/users/format/json'); ?>">Users</a> - get it in JSON (AJAX request)</li>
                        </ul>

                    </div>

                </div>

            </div>

        </section>

        <script type="text/javascript">
        //<![CDATA[

            $(function() {

                $("#ajax").on("click", function(evt) {

                    evt.preventDefault();

                    $.ajax({

                        url: $(this).attr("href"), // URL from the link that was clicked on.

                        success: function(data, textStatus, jqXHR) {

                            // The 'data' parameter is an array of objects that can be looped over.
                            alert($.JSON.encode(data));
                        },

                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Oh no! A problem with the AJAX request!');
                        }
                    });
                });
            });

        //]]>
        </script>
