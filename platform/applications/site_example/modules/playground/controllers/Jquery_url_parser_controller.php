<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

class Jquery_url_parser_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->title('jQuery URL Parser Test')
        ;

        $this->registry->set('nav', 'playground');
    }

    public function index() {

        $this->template
            ->set('test_script', $this->_get_test_script())
        ;

        $this->template
            ->set_partial('scripts', 'jquery_url_parser_scripts')
            ->build('jquery_url_parser');
    }

    protected function _get_test_script() {

        ob_start();

?><script type="text/javascript">
//<![CDATA[

$(function () {

    var url = $.url('http://test.com:8080/directory1/directory2/page.php?sky=blue&grass=green#about-us');
    var source = url.attr('source');
    var protocol = url.attr('protocol');
    var host = url.attr('host');
    var port = url.attr('port');
    var relative = url.attr('relative');
    var path = url.attr('path');
    var directory = url.attr('directory');
    var file = url.attr('file');
    var query = url.attr('query');
    var fragment = url.attr('fragment');
    var anchor = url.attr('anchor');

    var param = url.param();
    var sky = url.param('sky');
    var grass = url.param('grass');

    var segment = url.segment();
    var segment1 = url.segment(1);
    var segment2 = url.segment(-2);
    var segment3 = url.segment(3);

    url = $.url('http://test.com/#sky=blue&grass=green');
    var source1 = url.attr('source');
    var fparam = url.fparam();
    var sky1 = url.fparam('sky');
    var grass1 = url.fparam('grass');

    url = $.url('http://test.com/#/about/us/');
    var source2 = url.attr('source');
    var fsegment = url.fsegment();
    var about = url.fsegment(1);
    var us = url.fsegment(-1);

    $('#source').html(source);
    $('#protocol').html(protocol);
    $('#host').html(host);
    $('#port').html(port);
    $('#relative').html(relative);
    $('#path').html(path);
    $('#directory').html(directory);
    $('#file').html(file);
    $('#query').html(query);
    $('#fragment').html(fragment);

    $('#param').html($.JSON.encode(param));
    $('#sky').html(sky);
    $('#grass').html(grass);

    $('#segment').html($.JSON.encode(segment));
    $('#segment1').html(segment1);
    $('#segment2').html(segment2);
    $('#segment3').html(segment3);

    $('#source1').html(source1);
    $('#fparam').html($.JSON.encode(fparam));
    $('#sky1').html(sky1);
    $('#grass1').html(grass1);

    $('#source2').html(source2);
    $('#fsegment').html($.JSON.encode(fsegment));
    $('#about').html(about);
    $('#us').html(us);

});

//]]>
</script>
<?php

        $script = ob_get_contents();

        ob_end_clean();
        return $script;
    }

}
