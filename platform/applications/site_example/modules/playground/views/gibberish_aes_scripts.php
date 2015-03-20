<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

echo js('lib/gibberish-aes/gibberish-aes.min.js');

?>

    <script type="text/javascript">
    //<![CDATA[

    $(function () {

        var pass = <?php echo json_encode($pass); ?>; // Unsafe in browser environment, of course. Invent your own way for masking the secret pass-phrase (theoretically it would be unsafe too, sorry).
        var secret_string = <?php echo json_encode($secret_string); ?>;

        GibberishAES.size(256);
        var encrypted_secret_string_256 = GibberishAES.enc(secret_string, pass);
        var decrypted_secret_string_256 = GibberishAES.dec(encrypted_secret_string_256, pass);
        GibberishAES.size(192);
        var encrypted_secret_string_192 = GibberishAES.enc(secret_string, pass);
        var decrypted_secret_string_192 = GibberishAES.dec(encrypted_secret_string_192, pass);
        GibberishAES.size(128);
        var encrypted_secret_string_128 = GibberishAES.enc(secret_string, pass);
        var decrypted_secret_string_128 = GibberishAES.dec(encrypted_secret_string_128, pass);
        GibberishAES.size(256); // Restore the default key size.

        $('#encrypted_secret_string_256').html(encrypted_secret_string_256);
        $('#decrypted_secret_string_256').html(decrypted_secret_string_256);
        $('#encrypted_secret_string_192').html(encrypted_secret_string_192);
        $('#decrypted_secret_string_192').html(decrypted_secret_string_192);
        $('#encrypted_secret_string_128').html(encrypted_secret_string_128);
        $('#decrypted_secret_string_128').html(decrypted_secret_string_128);

        GibberishAES.size(256);
        var encrypted_secret_string_256_php = <?php echo json_encode($encrypted_secret_string_256); ?>;
        var decrypted_secret_string_256_js = GibberishAES.dec(encrypted_secret_string_256_php, pass);
        GibberishAES.size(192);
        var encrypted_secret_string_192_php = <?php echo json_encode($encrypted_secret_string_192); ?>;
        var decrypted_secret_string_192_js = GibberishAES.dec(encrypted_secret_string_192_php, pass);
        GibberishAES.size(128);
        var encrypted_secret_string_128_php = <?php echo json_encode($encrypted_secret_string_128); ?>;
        var decrypted_secret_string_128_js = GibberishAES.dec(encrypted_secret_string_128_php, pass);
        GibberishAES.size(256); // Restore the default key size.

        $('#decrypted_secret_string_256_js').html(decrypted_secret_string_256_js);
        $('#decrypted_secret_string_192_js').html(decrypted_secret_string_192_js);
        $('#decrypted_secret_string_128_js').html(decrypted_secret_string_128_js);

        $('#encrypted_secret_string_256_js').html(encrypted_secret_string_256);
        $('#encrypted_secret_string_192_js').html(encrypted_secret_string_192);
        $('#encrypted_secret_string_128_js').html(encrypted_secret_string_128);

        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('playground/gibberish-aes/ajax-decryption-test'); ?>',
            data: {
                encrypted_secret_string_256: encrypted_secret_string_256,
                encrypted_secret_string_192: encrypted_secret_string_192,
                encrypted_secret_string_128: encrypted_secret_string_128
            },
            success: function(data) {
                $('#decrypted_secret_string_256_php').html(data.decrypted_secret_string_256);
                $('#decrypted_secret_string_192_php').html(data.decrypted_secret_string_192);
                $('#decrypted_secret_string_128_php').html(data.decrypted_secret_string_128);
            }
        });
    });

    //]]>
    </script>
