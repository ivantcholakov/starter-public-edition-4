<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Gibberish_aes_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->encryption_key = 'my secret key (таен ключ)';
        $this->secret_string = 'my secret message (тайно съобщение)';

        $this->template
            ->title('GibberishAES Test')
        ;
    }

    public function index() {

        $key = $this->encryption_key;
        $secret_string = $this->secret_string;

        $old_key_size = GibberishAES::size();
        GibberishAES::size(256);
        $encrypted_secret_string_256 = GibberishAES::enc($secret_string, $key);
        $decrypted_secret_string_256 = GibberishAES::dec($encrypted_secret_string_256, $key);
        GibberishAES::size(192);
        $encrypted_secret_string_192 = GibberishAES::enc($secret_string, $key);
        $decrypted_secret_string_192 = GibberishAES::dec($encrypted_secret_string_192, $key);
        GibberishAES::size(128);
        $encrypted_secret_string_128 = GibberishAES::enc($secret_string, $key);
        $decrypted_secret_string_128 = GibberishAES::dec($encrypted_secret_string_128, $key);
        GibberishAES::size($old_key_size);

        $this->template
            ->set(compact(
                'key',
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

        $key = $this->encryption_key;

        $encrypted_secret_string_256 = $this->input->post('encrypted_secret_string_256');
        $encrypted_secret_string_192 = $this->input->post('encrypted_secret_string_192');
        $encrypted_secret_string_128 = $this->input->post('encrypted_secret_string_128');

        $old_key_size = GibberishAES::size();
        GibberishAES::size(256);
        $decrypted_secret_string_256 = GibberishAES::dec($encrypted_secret_string_256, $key);
        GibberishAES::size(192);
        $decrypted_secret_string_192 = GibberishAES::dec($encrypted_secret_string_192, $key);
        GibberishAES::size(128);
        $decrypted_secret_string_128 = GibberishAES::dec($encrypted_secret_string_128, $key);
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
