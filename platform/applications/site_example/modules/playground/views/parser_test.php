<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1><?php echo $template['page_title']; ?></h1>
                </div>

                <div class="row">

                    <div class="col-md-6">

                        <h3>Test 1</h3>

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Flag</th>
                                </tr>
                            </thead>
                            <tbody>
                                {data}<tr>
                                    <td>{code}</td>
                                    <td>{name}</td>
                                    <td><img class="thumbnail" src="{BASE_URI}assets/img/lib/flags-iso/flat/32/{code}.png" /></td>
                                </tr>{/data}
                            </tbody>
                        </table>

                    </div>

                    <div class="col-md-6">

                        <h3>Test 2</h3>

                        {parsed_result_2}

                    </div>

                </div>

            </div>

        </section>
