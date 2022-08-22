<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Twig_parser_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->load
            ->language('welcome')
            //->library('curl')
        ;

        $title = 'Twig Parser Test';

        $this->template
            ->append_title($title)
            ->set_breadcrumb($title, http_build_url(site_url('playground/twig-parser'), array('query' => http_build_query(array('q_1' => 'query_param_1', 'q_2' => 'query_param_2')))));
        ;

        $this->registry->set('nav', 'playground/twig');
    }

    public function index() {

        $countries = $this->_get_country_data();
        $countries_10 = array_slice($countries, 0, 10);

        try {

            $twig_template_inheritance_test = (string) (new GuzzleHttp\Client())
                ->get(site_url('playground/twig-template-inheritance-test'), ['verify' => false])
                ->getBody();
        } catch (\GuzzleHttp\Exception\ServerException $e) {

            $twig_template_inheritance_test = $e->getMessage();
        }

        // Miscellaneous Tests
        $twig_test_name = 'test.html.twig';
        $twig_test_path = $this->load->path($twig_test_name);
        $twig_test_source = @ (string) file_get_contents($twig_test_path);
        $twig_test_1 = $this->parser->parse_string($twig_test_source, array(), true, array('twig' => array('debug' => true)));
        $twig_test_2 = $this->load->view($twig_test_name, array(), true);

        $this->template
            ->set('br', '<br />')
            ->set('hr', '<hr />')
            ->set('name', 'John')
            ->set('array_1', array('one', 'two', 'three'))
            ->set('array_2', array('one', 'two', 'three', array('four', 'five')))
            ->set('string_123', 'one, two, three')
            ->set('string_empty', '')
            ->set('json_123', json_encode(array('one', 'two', 'three')))
            ->set('very_long_text', 'Very long text. Very long text. Very long text. Very long text.')
            ->set('value_0', 0)
            ->set('value_1', 1)
            ->set('value_2', 2)
            ->set('value_3', 3)
            ->set('boolean_true', true)
            ->set('value_null', null)
            ->set('string_10', '10')
            ->set('object_123', (object) array('one', 'two', 'three'))
            ->set('float_value', 250.5)
            ->set('dog', "I'll \"walk\" the <b>dog</b> now.")
            ->set('dog_entities', htmlentities("I'll \"walk\" the <b>dog</b> now.", ENT_QUOTES, 'UTF-8'))
            ->set('countries', $countries)
            ->set('countries_10', $countries_10)
            ->set('with_a_new_line', "a new\nline")
            ->set('my_image', image_url('playground.jpg'))
            ->set('string_markdown', 'Formatted **text**')
            ->set('string_textile', 'Formatted _text_')
            ->set('dangerous_value', 'A dangerous value <script>alert("Hi, I am dangerous.")</script>')
            ->set('my_blog', array('posts' => array(array('title' => 'Blog Post One'), array('title' => 'Blog Post Two'))))
            ->set('twig_test_name', $twig_test_name)
            ->set('twig_test_source', $twig_test_source)
            ->set('twig_test_1', $twig_test_1)
            ->set('twig_test_2', $twig_test_2)
            ->set('twig_template_inheritance_test', $twig_template_inheritance_test)
            ->set_partial('twig_partial', 'twig_partial')
            ->set_metadata('description', 'Twig parser testing page')
            ->set_metadata('keywords', 'CodeIgniter Twig Template Parser')
            ->enable_parser_body(array('twig' => array('debug' => true)))
            ->build('twig_parser');
    }

    protected function _get_country_data() {

        $csv = (string) @ file_get_contents(APPPATH.'demo_data/countries.csv');

        $items = preg_split('/\r\n|\r|\n/m', $csv, -1, PREG_SPLIT_NO_EMPTY);

        foreach ($items as & $item) {

            $values = explode(';', $item);
            $item = (array('code' => $values[0], 'name' => $values[1]));
        }

        return $items;
    }

}
