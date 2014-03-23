<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Captcha_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->library('kcaptcha', null, 'captcha')
            ->language('captcha')
        ;

        $this->template
            ->title('Captcha Test')
        ;

        $this->registry->set('nav', 'playground/captcha');
    }

    public function index() {

        $this->template
            ->set_partial('scripts', 'captcha_scripts')
            ->build('captcha');
    }

    public function test_captcha() {

        if (!IS_AJAX_REQUEST) {
            show_404();
        }

        $valid_user_input = $this->captcha->get_keystring();
        $invalid_user_input = $this->captcha->generate_keystring();

        ob_start();
?>

                User input <?php echo $valid_user_input; ?> : <strong><?php echo $this->captcha->valid($valid_user_input) ? 'valid' : 'invalid'; ?></strong>
                <br />
                User input <?php echo $invalid_user_input; ?> : <strong><?php echo $this->captcha->valid($invalid_user_input) ? 'valid' : 'invalid'; ?></strong>

<?php
        $output = ob_get_contents();
        ob_end_clean();

        $this->output->set_header('Content-type: text/html; charset=utf-8');
        $this->output->set_output($output);
    }

}
