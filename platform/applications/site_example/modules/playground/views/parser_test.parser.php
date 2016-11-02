<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

            <div class="ui grid">

                <div class="sixteen wide mobile eight wide tablet four wide computer column">

                    <h3>Test 1</h3>

                    <table class="ui celled striped compact table">
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
                                <td><img src="{BASE_URI}assets/img/lib/flags-iso/flat/32/{code}.png" /></td>
                            </tr>{/data}
                        </tbody>
                    </table>

                </div>

                <div class="sixteen wide mobile eight wide tablet four wide computer column">

                    <h3>Test 2</h3>

                    {parsed_result_2}

                </div>

                <div class="sixteen wide mobile eight wide tablet four wide computer column">

                    <h3>Test 3</h3>

                    {parsed_result_3}

                </div>

                <div class="sixteen wide mobile eight wide tablet four wide computer column">

                    <h3>Test 4</h3>

                    {parsed_result_4}

                </div>

            </div>
