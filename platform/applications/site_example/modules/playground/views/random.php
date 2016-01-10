<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1><?php echo $template['page_title']; ?></h1>
                </div>

                <div class="row">

                    <div class="col-sm-12">

                        <h4>PHP Implementation Tests</h4>
<?php

$my_random_boolean = Random::boolean() ? 1 : 0;

$result_true = 0;
$result_false = 0;
for ($i = 1; $i <= 100; $i++) {
    if (Random::boolean()) {
        $result_true++;
    } else {
        $result_false++;
    }
}

$my_random_bytes = bin2hex(Random::bytes(10));
$my_random_float = Random::float();
$my_random_integer = Random::int(0, PHP_INT_MAX);
$my_random_integer_2 = Random::int(1, 100);
$my_random_string = Random::string(20);
$my_random_string_2 = Random::string(20, "!\"#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~");

?>
                        <table class="table table-bordered" style="table-layout: fixed; word-wrap: break-word;">
                            <tbody>
                                <tr>
                                    <td style="width: 50%;"><pre><code>$my_random_boolean = Random::boolean() ? 1 : 0;</code></pre></td>
                                    <td><?php echo $my_random_boolean; ?></td>
                                </tr>
                                <tr>
                                    <td><pre><code>$result_true = 0;
$result_false = 0;
for ($i = 1; $i <= 100; $i++) {
    if (Random::boolean()) {
        $result_true++;
    } else {
        $result_false++;
    }
}
</code></pre></td>
                                    <td><?php echo 'result_true: '.$result_true.'; result_false: '.$result_false; ?></td>
                                </tr>
                                <tr>
                                    <td><pre><code>$my_random_bytes = bin2hex(Random::bytes(10));</code></pre></td>
                                    <td><?php echo $my_random_bytes; ?></td>
                                </tr>
                                <tr>
                                    <td><pre><code>$my_random_float = Random::float();</code></pre></td>
                                    <td><?php echo $my_random_float; ?></td>
                                </tr>
                                <tr>
                                    <td><pre><code>$my_random_integer = Random::int(0, PHP_INT_MAX);</code></pre></td>
                                    <td><?php echo $my_random_integer; ?></td>
                                </tr>
                                <tr>
                                    <td><pre><code>$my_random_integer_2 = Random::int(1, 100);</code></pre></td>
                                    <td><?php echo $my_random_integer_2; ?></td>
                                </tr>
                                <tr>
                                    <td><pre><code>$my_random_string = Random::string(20);</code></pre></td>
                                    <td><?php echo html_escape($my_random_string); ?></td>
                                </tr>
                                <tr>
                                    <td><pre><code>$my_random_string_2 = Random::string(20, "!\"#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz{|}~");</code></pre></td>
                                    <td><?php echo html_escape($my_random_string_2); ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </section>
