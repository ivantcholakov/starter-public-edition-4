<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Nav extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    public function data() {

        $nav = array();

        $nav['dashboard'] = array('label' => 'Dashboard', 'icon' => 'dashboard icon', 'location' => site_url());

        //----------------------------------------------------------------------
        
        $nav['payments'] = array('label' => 'Payments', 'icon' => 'credit card icon', 'location' => site_url('payments'));
        
        $nav['customers'] = array('label' => 'Customers', 'icon' => 'user outline icon', 'location' => site_url('customers');
        
        $nav['transfers'] = array('label' => 'Transfers', 'icon' => 'rocketchat icon', 'location' => site_url('transfers'));
        
        $nav['plans'] = array('label' => 'Plans', 'icon' => 'envelope square icon', 'location' => site_url('plans');

        $nav['coupons'] = array('label' => 'Coupons', 'icon' => 'bell outline icon', 'location' => site_url('coupons');
        
        $nav['invoices'] = array('label' => 'Invoices', 'icon' => 'file pdf icon', 'location' => site_url('invoices');
        
        $nav['products'] = array('label' => 'Products', 'icon' => 'plus cart icon', 'location' => site_url('products');

        $nav['categories'] = array('label' => 'Categories', 'icon' => $this->registry->get('nav') == 'categoriess' ? 'folder open outline icon' : 'folder outline icon', 'location' => 'integrations');
        
        $nav['slideshow'] = array('label' => 'Hosted pages', 'icon' => 'film icon', 'location' => 'hosted-pages');

        $nav['integrations'] = array('label' => 'Integrations', 'icon' => 'archive icon', 'location' => 'integrations');
       
        $nav['galleries'] = array('label' => 'Analytics', 'icon' => 'picture outline icon', 'location' => 'reports');


        //----------------------------------------------------------------------

        $nav['nomenclatures/social_networks'] = array('label' => 'Social Networks', 'icon' => 'thumbs up outline icon', 'location' => '#', 'parent_id' => 'nomenclatures');

        //----------------------------------------------------------------------

        $nav['account/settings'] = array('label' => $this->lang->line('ui_settings'), 'icon' => 'wrench icon', 'location' => '#');
        $nav['account/settings/languages'] = array('label' => $this->lang->line('ui_languages'), 'icon' => 'translate icon', 'location' => '#', 'parent_id' => 'account/settings');
        $nav['account/settings/api'] = array('label' => 'API', 'icon' => 'shield icon', 'location' => 'account/settings/api', 'parent_id' => 'account/settings');
        $nav['account/settings/gateway'] = array('label' => 'Gateway', 'icon' => 'google icon', 'location' => 'account/settings/gateway', 'parent_id' => 'account/settings');
        $nav['account/settings/email_settings'] = array('label' => 'Email Settings', 'icon' => 'mail outline icon',  'location' => 'account/settings/emails', 'parent_id' => 'account/settings');

        if ($this->settings->get('mailer_enabled')) {
            $nav['settings/email_test'] = array('label' => 'Email Test', 'icon' => 'mail outline icon', 'location' => '#', 'parent_id' => 'account/settings');
        }

        $nav['account/settings/contact_page'] = array('label' => 'Contact Page', 'icon' => 'phone icon', 'location' => '#', 'parent_id' => 'account/settings');
        
        if (function_exists('phpinfo') && $this->config->item('phpinfo_allow')) {
            $nav['account/settings/phpinfo'] = array('label' => 'phpinfo()', 'icon' => 'info circle icon', 'location' => site_url('phpinfo'), 'parent_id' => 'account/settings');
        }

        //----------------------------------------------------------------------

        $nav['logout'] = array('label' => $this->lang->line('ui_logout'), 'icon' => 'sign out icon', 'location' => site_url('logout'));

        //----------------------------------------------------------------------

        return $nav;
    }

}
