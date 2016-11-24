<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2016
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Php_http_client_controller extends Playground_Base_Controller {

    public function __construct() {

        parent::__construct();

        $title = 'Accessing the REST Server Using a PHP-HTTP Client';

        $this->template
            ->append_title($title)
            ->set_breadcrumb('RESTful Service Test', site_url('playground/rest/server'))
            ->set_breadcrumb($title, site_url('playground/rest/php-http-client'))
        ;

        $this->template
            ->set_partial('subnavbar', 'rest/subnavbar')
            ->set('subnavbar_item_active', 'php_http_client')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $php_required = '5.5';
        $this->load->helper('url');

        $result = null;
        $status_code = null;
        $content_type = null;

        $code_example = <<<EOT

        \$user_id = 1;

        \$this->load->helper('url');

        \$messageFactory = Http\\Discovery\\MessageFactoryDiscovery::find();
        \$request = \$messageFactory->createRequest(
            'GET',
            site_url('playground/rest/server-api-example/users/id/'.\$user_id.'/format/json')
        );

        \$authentication = new Http\\Message\\Authentication\\BasicAuth('admin', '1234');
        \$authenticationPlugin = new Http\\Client\\Common\\Plugin\\AuthenticationPlugin(\$authentication);

        \$pluginClient = new Http\\Client\\Common\\PluginClient(
            Http\\Discovery\\HttpClientDiscovery::find(),
            [\$authenticationPlugin]
        );

        \$res = \$pluginClient->sendRequest(\$request);

        \$result = (string) \$res->getBody();
        \$status_code = \$res->getStatusCode();

        \$content_type = \$res->getHeader('content-type');
        \$content_type = is_array(\$content_type) ? \$content_type[0] : \$content_type;

EOT;

        if (is_php($php_required))
        {
            eval($code_example);
        }

        $this->template
            ->set(compact('php_required', 'code_example', 'result', 'status_code', 'content_type'))
            ->build('rest/php_http_client');
    }

}
