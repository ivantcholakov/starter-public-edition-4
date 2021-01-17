<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Nav extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    public function data() {

        $nav = array();

        $nav['home'] = array('label' => $this->lang->line('ui_home'), 'icon' => 'dashboard icon', 'location' => site_url());

        //----------------------------------------------------------------------

        $nav['pages'] = array('label' => 'Pages', 'icon' => 'file outline icon', 'location' => '#');

        $nav['news'] = array('label' => 'News', 'icon' => 'bell outline icon', 'location' => '#');

        $nav['galleries'] = array('label' => 'Galleries', 'icon' => 'picture outline icon', 'location' => '#');

        $nav['slideshow'] = array('label' => 'Slideshow', 'icon' => 'film icon', 'location' => '#');

        $nav['categories'] = array('label' => 'Product Categories', 'icon' => $this->registry->get('nav') == 'categories' ? 'folder open outline icon' : 'folder outline icon', 'location' => '#');
        $nav['products'] = array('label' => 'Products', 'icon' => 'gift icon', 'location' => '#');


        //----------------------------------------------------------------------

        $nav['nomenclatures'] = array('label' => 'Nomenclatures', 'icon' => 'archive icon', 'location' => '#');

        $nav['nomenclatures/social_networks'] = array('label' => 'Social Networks', 'icon' => 'thumbs up outline icon', 'location' => '#', 'parent_id' => 'nomenclatures');

        //----------------------------------------------------------------------

        $nav['settings'] = array('label' => $this->lang->line('ui_settings'), 'icon' => 'wrench icon', 'location' => '#');

        $nav['settings/languages'] = array('label' => $this->lang->line('ui_languages'), 'icon' => 'translate icon', 'location' => '#', 'parent_id' => 'settings');

        $nav['settings/site'] = array('label' => $this->lang->line('ui_site'), 'icon' => 'home icon', 'location' => '#', 'parent_id' => 'settings');
        $nav['settings/logos'] = array('label' => 'Brand', 'icon' => 'shield icon', 'location' => '#', 'parent_id' => 'settings');
        $nav['settings/metadata'] = array('label' => $this->lang->line('ui_metadata'), 'icon' => 'tag icon', 'location' => '#', 'parent_id' => 'settings');
        $nav['settings/google_analytics'] = array('label' => 'Google Analytics', 'icon' => 'google icon', 'location' => '#', 'parent_id' => 'settings');
        $nav['settings/email_settings'] = array('label' => 'Email Settings', 'icon' => 'mail outline icon',  'location' => '#', 'parent_id' => 'settings');

        if ($this->settings->get('mailer_enabled')) {
            $nav['settings/email_test'] = array('label' => 'Email Test', 'icon' => 'mail outline icon', 'location' => '#', 'parent_id' => 'settings');
        }

        $nav['settings/contact_page'] = array('label' => 'Contact Page', 'icon' => 'phone icon', 'location' => '#', 'parent_id' => 'settings');
        $nav['settings/modules'] = array('label' => 'Modules and Components', 'icon' => 'cubes icon', 'location' => '#', 'parent_id' => 'settings');

        if (function_exists('phpinfo') && $this->config->item('phpinfo_allow')) {
            $nav['settings/phpinfo'] = array('label' => 'phpinfo()', 'icon' => 'info circle icon', 'location' => site_url('phpinfo'), 'parent_id' => 'settings');
        }

        $nav['twig'] = array('label' => 'Twig', 'icon' => 'file code outline icon',  'location' => site_url('twig'), 'parent_id' => 'settings');
        $nav['error_logs'] = array('label' => 'Error Logs', 'icon' => 'exclamation triangle icon',  'location' => site_url('error-logs'), 'parent_id' => 'settings');

        //----------------------------------------------------------------------

        $nav['logout'] = array('label' => $this->lang->line('ui_logout'), 'icon' => 'sign out alternate icon', 'location' => site_url('logout'));

        //----------------------------------------------------------------------

        return $nav;
    }

}
