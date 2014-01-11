<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1>jQuery URL Parser Test</h1>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <pre><code><?php echo htmlspecialchars($test_script, ENT_QUOTES, 'UTF-8'); ?></code></pre>

                        <table class="table table-bordered table-striped" style="table-layout: fixed; word-wrap: break-word;">
                            <thead>
                                <tr>
                                    <th colspan="2">Results:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 200px; background-color: lightgrey;">source</td>
                                    <td style="background-color: lightgrey;"><span id="source">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>protocol</td>
                                    <td><span id="protocol">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>host</td>
                                    <td><span id="host">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>port</td>
                                    <td><span id="port">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>relative</td>
                                    <td><span id="relative">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>path</td>
                                    <td><span id="path">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>directory</td>
                                    <td><span id="directory">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>file</td>
                                    <td><span id="file">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>query</td>
                                    <td><span id="query">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>fragment (alias: anchor)</td>
                                    <td><span id="fragment">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>param</td>
                                    <td><span id="param">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>sky</td>
                                    <td><span id="sky">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>grass</td>
                                    <td><span id="grass">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>segment</td>
                                    <td><span id="segment">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>segment1</td>
                                    <td><span id="segment1">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>segment2</td>
                                    <td><span id="segment2">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>segment3</td>
                                    <td><span id="segment3">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td style="background-color: lightgrey;">source1</td>
                                    <td style="background-color: lightgrey;"><span id="source1">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>fparam</td>
                                    <td><span id="fparam">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>sky1</td>
                                    <td><span id="sky1">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>grass1</td>
                                    <td><span id="grass1">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td style="background-color: lightgrey;">source2</td>
                                    <td style="background-color: lightgrey;"><span id="source2">&nbsp;</span></td>
                                </tr>
                                    <td>fsegment</td>
                                    <td><span id="fsegment">&nbsp;</span></td>
                                </tr>
                                </tr>
                                    <td>about</td>
                                    <td><span id="about">&nbsp;</span></td>
                                </tr>
                                </tr>
                                    <td>us</td>
                                    <td><span id="us">&nbsp;</span></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </section>
