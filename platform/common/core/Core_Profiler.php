<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @link http://dragffy.com/blog/posts/making-codeigniters-profiler-ajax-compatible
 */

class Core_Profiler extends CI_Profiler {

    public function __construct() {

        parent::__construct();
    }

    public function run() {

        $output = <<<ENDJS
<script type="text/javascript">
// < ![CDATA[
    $(document).ready(function() {
        var html = $('#codeigniter_profiler').clone();
        $('#codeigniter_profiler').remove();
        $('#debug').hide().empty().append(html).fadeIn('slow');
    });
// ]]>
</script>
ENDJS;
        $output .= "<div id='codeigniter_profiler' style='clear:both;background-color:#fff;padding:10px;'>";
        $fields_displayed = 0;

        foreach ($this->_available_sections as $section) {
            if ($this->_compile_{$section} !== FALSE) {
                $func = "_compile_{$section}";
                $output .= $this->{$func}();
                $fields_displayed++;
            }
        }

        if ($fields_displayed == 0) {
            $output .= '<p style="border:1px solid #5a0099;padding:10px;margin:20px 0;background-color:#eee">'.$this->CI->lang->line('profiler_no_profiles').'</p>';
        }

        $output .= '</div>';

        return $output;
    }

}
