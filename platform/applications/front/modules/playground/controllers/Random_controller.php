<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014-2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Random_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Random Values Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, site_url('playground/random'));
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

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

        $this->template
            ->set(compact(
                'my_random_boolean',
                'result_true',
                'result_false',
                'my_random_bytes',
                'my_random_float',
                'my_random_integer',
                'my_random_integer_2',
                'my_random_string',
                'my_random_string_2'
            ))
            ->build('random');
    }

}
