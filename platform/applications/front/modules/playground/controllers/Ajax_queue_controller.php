<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Ajax_queue_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'AJAX Queue Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/ajax-queue'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->set_partial('scripts', 'ajax_queue_scripts')
            ->set('test_script_1', $this->get_test_script_1())
            ->set('test_script_2', $this->get_test_script_2())
            ->build('ajax_queue');
    }

    public function test() {

        $i = (int) $this->input->get('i');
        @ usleep(1000 - $i * 250);
        $this->output->set_header('Content-type: text/html; charset=utf-8', true);
        $this->output->set_output('result '.$i);
    }

    private function get_test_script_1() {

        ob_start();

?><script type="text/javascript">
//<![CDATA[
$(function () {
    for (var i = 1; i <= 4; i++) {
        $.ajax({
            url: '<?php echo site_uri('playground/ajax-queue/test'); ?>',
            type: 'GET',
            cache: false,
            mode: 'queue',
            data: {
                i: i
            },
            success: function(html) {
                $('#queued_ajax_segment .loader').removeClass('active');
                $('#queued_ajax').append('<li>' + html + '</li>');
            }
        });
    }
});
//]]>
</script><?php

        $script = ob_get_contents();

        ob_end_clean();
        return $script;
    }

    private function get_test_script_2() {

        ob_start();

?><script type="text/javascript">
//<![CDATA[
$(function () {
    for (var i = 1; i <= 4; i++) {
        $.ajax({
            url: '<?php echo site_uri('playground/ajax-queue/test'); ?>',
            type: 'GET',
            cache: false,

            data: {
                i: i
            },
            success: function(html) {
                $('#ordinary_ajax_segment .loader').removeClass('active');
                $('#ordinary_ajax').append('<li>' + html + '</li>');
            }
        });
    }
});
//]]>
</script><?php

        $script = ob_get_contents();

        ob_end_clean();
        return $script;
    }

}
