<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Nav extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    public function data() {

        $nav = array();

        $nav['home'] = array('label' => $this->lang->line('ui_home'), 'icon' => 'dashboard icon', 'location' => site_url());

        //----------------------------------------------------------------------
        
        $nav['payments'] = array('label' => 'Payments', 'icon' => 'credit card icon', 'location' => 'payments');
        
        $nav['customers'] = array('label' => 'Customers', 'icon' => 'user outline icon', 'location' => 'customers');
        
        $nav['transfers'] = array('label' => 'Transfers', 'icon' => 'rocketchat icon', 'location' => 'transfers');
        
        $nav['plans'] = array('label' => 'Plans', 'icon' => 'envelope square icon', 'location' => 'plans');

        $nav['invoices'] = array('label' => 'Invoices', 'icon' => 'file pdf icon', 'location' => 'invoices');
        
        $nav['products'] = array('label' => 'Products', 'icon' => 'plus cart icon', 'location' => 'products');

        $nav['news'] = array('label' => 'Coupons', 'icon' => 'bell outline icon', 'location' => 'coupons');

        $nav['galleries'] = array('label' => 'Analytics', 'icon' => 'picture outline icon', 'location' => 'reports');

        $nav['slideshow'] = array('label' => 'Hosted pages', 'icon' => 'film icon', 'location' => 'hosted-pages');

        $nav['categories'] = array('label' => 'Integrations', 'icon' => $this->registry->get('nav') == 'integrations' ? 'folder open outline icon' : 'folder outline icon', 'location' => 'integrations');
     


        //----------------------------------------------------------------------

        $nav['nomenclatures'] = array('label' => 'Integrations', 'icon' => 'archive icon', 'location' => 'integrations');

        $nav['nomenclatures/social_networks'] = array('label' => 'Social Networks', 'icon' => 'thumbs up outline icon', 'location' => '#', 'parent_id' => 'nomenclatures');

        //----------------------------------------------------------------------

        $nav['settings'] = array('label' => $this->lang->line('ui_settings'), 'icon' => 'wrench icon', 'location' => '#');

        $nav['settings/languages'] = array('label' => $this->lang->line('ui_languages'), 'icon' => 'translate icon', 'location' => '#', 'parent_id' => 'settings');

        $nav['settings/account'] = array('label' => $this->lang->line('ui_site'), 'icon' => 'home icon', 'location' => 'settings/account', 'parent_id' => 'settings');
        $nav['settings/api'] = array('label' => 'API', 'icon' => 'shield icon', 'location' => 'settings/api', 'parent_id' => 'settings');
        $nav['settings/metadata'] = array('label' => $this->lang->line('ui_metadata'), 'icon' => 'tag icon', 'location' => '#', 'parent_id' => 'settings');
        $nav['settings/gateway'] = array('label' => 'Gateway', 'icon' => 'google icon', 'location' => 'settings/gateway', 'parent_id' => 'settings');
        $nav['settings/email_settings'] = array('label' => 'Email Settings', 'icon' => 'mail outline icon',  'location' => 'settings/emails', 'parent_id' => 'settings');

        if ($this->settings->get('mailer_enabled')) {
            $nav['settings/email_test'] = array('label' => 'Email Test', 'icon' => 'mail outline icon', 'location' => '#', 'parent_id' => 'settings');
        }

        $nav['settings/contact_page'] = array('label' => 'Contact Page', 'icon' => 'phone icon', 'location' => '#', 'parent_id' => 'settings');
        $nav['settings/modules'] = array('label' => 'Modules and Components', 'icon' => 'cubes icon', 'location' => '#', 'parent_id' => 'settings');

        if (function_exists('phpinfo') && $this->config->item('phpinfo_allow')) {
            $nav['settings/phpinfo'] = array('label' => 'phpinfo()', 'icon' => 'info circle icon', 'location' => site_url('phpinfo'), 'parent_id' => 'settings');
        }

        //----------------------------------------------------------------------

        $nav['logout'] = array('label' => $this->lang->line('ui_logout'), 'icon' => 'sign out icon', 'location' => site_url('logout'));

        //----------------------------------------------------------------------

        return $nav;
    }

}
