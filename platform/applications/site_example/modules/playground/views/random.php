<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1>Random Values Test</h1>
                </div>

                <div class="row">

                    <div class="col-md-6">

                        <h4>JavaScript Implementation Tests</h4>

                        <table class="table table-bordered" style="table-layout: fixed; word-wrap: break-word;">
                            <tbody>
                                <tr>
                                    <td style="width: 50%;"><pre><code>var my_random_number = $.random.get();</code></pre></td>
                                    <td><span id="my_random_number">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td><pre><code>var my_random_integer_number = $.random.integer(10);</code></pre></td>
                                    <td><span id="my_random_integer_number">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td><pre><code>var my_random_integer_number_2 = $.random.integer_between(10, 19);</code></pre></td>
                                    <td><span id="my_random_integer_number_2">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td><pre><code>var my_unique_id = $.random.uuid();</code></pre></td>
                                    <td><span id="my_unique_id">&nbsp;</span></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                    <div class="col-md-6">

                        <h4>PHP Implementation Tests</h4>
<?php

$my_random_number = Random::get();
$my_random_integer_number = Random::integer(10);
$my_random_integer_number_2 = Random::integer_between(10, 19);
$my_unique_id = Random::uuid();

?>
                        <table class="table table-bordered" style="table-layout: fixed; word-wrap: break-word;">
                            <tbody>
                                <tr>
                                    <td style="width: 50%;"><pre><code>$my_random_number = Random::get();</code></pre></td>
                                    <td><?php echo $my_random_number; ?></td>
                                </tr>
                                <tr>
                                    <td><pre><code>$my_random_integer_number = Random::integer(10);</code></pre></td>
                                    <td><?php echo $my_random_integer_number; ?></td>
                                </tr>
                                <tr>
                                    <td><pre><code>$my_random_integer_number_2 = Random::integer_between(10, 19);</code></pre></td>
                                    <td><?php echo $my_random_integer_number_2; ?></td>
                                </tr>
                                <tr>
                                    <td><pre><code>$my_unique_id = Random::uuid();</code></pre></td>
                                    <td><?php echo $my_unique_id; ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </section>
