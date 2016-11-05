<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Gibberish_aes_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'GibberishAES Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/gibberish-aes'));
        ;

        $this->registry->set('nav', 'playground');

        $this->pass = 'my secret long pass-phrase (тайна парола) qiYV3xmL5uW1bUeGe6gZH1aaaA4HFgwkwux2uKSKcSmCW6XprmNmkEKdma76Zr1';
        $this->secret_string = 'my secret message (тайно съобщение)';
    }

    public function index() {

        $pass = $this->pass;
        $secret_string = $this->secret_string;

        $old_key_size = GibberishAES::size();
        GibberishAES::size(256);
        $encrypted_secret_string_256 = GibberishAES::enc($secret_string, $pass);
        $decrypted_secret_string_256 = GibberishAES::dec($encrypted_secret_string_256, $pass);
        GibberishAES::size(192);
        $encrypted_secret_string_192 = GibberishAES::enc($secret_string, $pass);
        $decrypted_secret_string_192 = GibberishAES::dec($encrypted_secret_string_192, $pass);
        GibberishAES::size(128);
        $encrypted_secret_string_128 = GibberishAES::enc($secret_string, $pass);
        $decrypted_secret_string_128 = GibberishAES::dec($encrypted_secret_string_128, $pass);
        GibberishAES::size($old_key_size);

        $this->template
            ->set(compact(
                'pass',
                'secret_string',
                'encrypted_secret_string_256',
                'decrypted_secret_string_256',
                'encrypted_secret_string_192',
                'decrypted_secret_string_192',
                'encrypted_secret_string_128',
                'decrypted_secret_string_128'
            ))
        ;

        $this->template
            ->set_partial('scripts', 'gibberish_aes_scripts')
            ->build('gibberish_aes');
    }

    public function ajax_decryption_test() {

        $this->output->set_header('Content-Type: application/json; charset=utf-8', true);

        $pass = $this->pass;

        $encrypted_secret_string_256 = $this->input->post('encrypted_secret_string_256');
        $encrypted_secret_string_192 = $this->input->post('encrypted_secret_string_192');
        $encrypted_secret_string_128 = $this->input->post('encrypted_secret_string_128');

        $old_key_size = GibberishAES::size();
        GibberishAES::size(256);
        $decrypted_secret_string_256 = GibberishAES::dec($encrypted_secret_string_256, $pass);
        GibberishAES::size(192);
        $decrypted_secret_string_192 = GibberishAES::dec($encrypted_secret_string_192, $pass);
        GibberishAES::size(128);
        $decrypted_secret_string_128 = GibberishAES::dec($encrypted_secret_string_128, $pass);
        GibberishAES::size($old_key_size);

        $this->output->set_output(
            json_encode(
                compact(
                    'decrypted_secret_string_256',
                    'decrypted_secret_string_192',
                    'decrypted_secret_string_128'
                )
            )
        );
    }

}
