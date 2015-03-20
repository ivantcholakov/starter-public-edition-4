<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

?>

        <section>

            <div class="container">

                <div class="page-header">
                    <h1>AES (256, 192, 128) Symmetric Encryption, Compatible with OpenSSL</h1>
                </div>

                <div class="row">

                    <div class="col-md-6">

                        <h3>JavaScript Implementation</h3>

                        <p><a href="https://github.com/mdp/gibberish-aes" target="_blank">https://github.com/mdp/gibberish-aes</a></p>

                        <pre><?php echo htmlspecialchars('var pass = \''.$pass.'\';
var secret_string = \''.$secret_string.'\';
GibberishAES.size(256);    // Also 192, 128
var encrypted_secret_string = GibberishAES.enc(secret_string, pass);
var decrypted_secret_string = GibberishAES.dec(encrypted_secret_string, pass);
GibberishAES.size(256);  // Restore the default key size.', ENT_QUOTES, 'UTF-8') ?></pre>

                        <table class="table table-bordered table-striped" style="table-layout: fixed; word-wrap: break-word;">
                            <thead>
                                <tr>
                                    <th colspan="2" style="width: 100%;">Results:</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td colspan="2"><strong>256-bit key:</strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">encrypted_secret_string</td>
                                    <td><span id="encrypted_secret_string_256">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>decrypted_secret_string</td>
                                    <td><span id="decrypted_secret_string_256">&nbsp;</span></td>
                                </tr>

                                <tr>
                                    <td colspan="2"><strong>192-bit key:</strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">encrypted_secret_string</td>
                                    <td><span id="encrypted_secret_string_192">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>decrypted_secret_string</td>
                                    <td><span id="decrypted_secret_string_192">&nbsp;</span></td>
                                </tr>

                                <tr>
                                    <td colspan="2"><strong>128-bit key:</strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">encrypted_secret_string</td>
                                    <td><span id="encrypted_secret_string_128">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>decrypted_secret_string</td>
                                    <td><span id="decrypted_secret_string_128">&nbsp;</span></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>

                    <div class="col-md-6">

                        <h3>PHP Implementation</h3>

                        <p><a href="https://github.com/ivantcholakov/gibberish-aes-php" target="_blank">https://github.com/ivantcholakov/gibberish-aes-php</a></p>

                        <pre><?php echo htmlspecialchars('$pass = \''.$pass.'\';
$secret_string = \''.$secret_string.'\';
$old_key_size = GibberishAES::size();
GibberishAES::size(256);    // Also 192, 128
$encrypted_secret_string = GibberishAES::enc($secret_string, $pass);
$decrypted_secret_string = GibberishAES::dec($encrypted_secret_string, $pass);
GibberishAES::size($old_key_size);  // Restore the old key size.', ENT_QUOTES, 'UTF-8') ?></pre>

                        <table class="table table-bordered table-striped" style="table-layout: fixed; word-wrap: break-word;">
                            <thead>
                                <tr>
                                    <th colspan="2" style="width: 100%;">Results:</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td colspan="2"><strong>256-bit key:</strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">$encrypted_secret_string</td>
                                    <td><?php echo $encrypted_secret_string_256; ?></td>
                                </tr>
                                <tr>
                                    <td>$decrypted_secret_string</td>
                                    <td><?php echo $decrypted_secret_string_256; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="2"><strong>192-bit key:</strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">$encrypted_secret_string</td>
                                    <td><?php echo $encrypted_secret_string_192; ?></td>
                                </tr>
                                <tr>
                                    <td>$decrypted_secret_string</td>
                                    <td><?php echo $decrypted_secret_string_192; ?></td>
                                </tr>

                                <tr>
                                    <td colspan="2"><strong>128-bit key:</strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">$encrypted_secret_string</td>
                                    <td><?php echo $encrypted_secret_string_128; ?></td>
                                </tr>
                                <tr>
                                    <td>$decrypted_secret_string</td>
                                    <td><?php echo $decrypted_secret_string_128; ?></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <h3>Implementation Compatibility Test</h3>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <h4>Encryption on PHP, Decryption on JavaScript</h4>

                        <table class="table table-bordered table-striped" style="table-layout: fixed; word-wrap: break-word;">
                            <thead>
                                <tr>
                                    <th colspan="2" style="width: 100%;">Results:</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td colspan="2"><strong>256-bit key:</strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">$encrypted_secret_string</td>
                                    <td><?php echo $encrypted_secret_string_256; ?></span></td>
                                </tr>
                                <tr>
                                    <td>decrypted_secret_string</td>
                                    <td><span id="decrypted_secret_string_256_js">&nbsp;</span></td>
                                </tr>

                                <tr>
                                    <td colspan="2"><strong>192-bit key:</strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">$encrypted_secret_string</td>
                                    <td><?php echo $encrypted_secret_string_192; ?></span></td>
                                </tr>
                                <tr>
                                    <td>decrypted_secret_string</td>
                                    <td><span id="decrypted_secret_string_192_js">&nbsp;</span></td>
                                </tr>

                                <tr>
                                    <td colspan="2"><strong>128-bit key:</strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">$encrypted_secret_string</td>
                                    <td><?php echo $encrypted_secret_string_128; ?></span></td>
                                </tr>
                                <tr>
                                    <td>decrypted_secret_string</td>
                                    <td><span id="decrypted_secret_string_128_js">&nbsp;</span></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>

                    <div class="col-md-6">

                        <h4>Encryption on JavaScript, Decryption on PHP</h4>

                        <table class="table table-bordered table-striped" style="table-layout: fixed; word-wrap: break-word;">
                            <thead>
                                <tr>
                                    <th colspan="2" style="width: 100%;">Results:</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td colspan="2"><strong>256-bit key:</strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">encrypted_secret_string</td>
                                    <td><span id="encrypted_secret_string_256_js">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>$decrypted_secret_string</td>
                                    <td><span id="decrypted_secret_string_256_php">&nbsp;</span></td>
                                </tr>

                                <tr>
                                    <td colspan="2"><strong>192-bit key:</strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">encrypted_secret_string</td>
                                    <td><span id="encrypted_secret_string_192_js">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>$decrypted_secret_string</td>
                                    <td><span id="decrypted_secret_string_192_php">&nbsp;</span></td>
                                </tr>

                                <tr>
                                    <td colspan="2"><strong>128-bit key:</strong></td>
                                </tr>
                                <tr>
                                    <td style="width: 50%;">encrypted_secret_string</td>
                                    <td><span id="encrypted_secret_string_128_js">&nbsp;</span></td>
                                </tr>
                                <tr>
                                    <td>$decrypted_secret_string</td>
                                    <td><span id="decrypted_secret_string_128_php">&nbsp;</span></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </section>
