<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Sitemap module public controller
 * 
 * Renders a human-readable sitemap with all public pages and blog categories
 * Also renders a machine-readable sitemap for search engines
 * 
 * @author      Barnabas Kendall <barnabas@bkendall.biz>
 * @author      2014, modifications by Ivan Tcholakov <ivantcholakov@gmail.com>
 * @license     Apache License v2.0
 * @version     1.1
 * @package     PyroCMS\Core\Modules\Sitemap\Controllers
 */

class Xml_controller extends Base_Controller {

    /**
     * XML method - output sitemap in XML format for search engines
     * 
     * @return void
     */
    public function index()
    {
        $this->load->helper('directory');
        $this->load->helper('file');

        $module_dirs = array();
        $dir_map = directory_map(APPPATH.'modules', 1);

        foreach ($dir_map as $key => $name)
        {
            if (strpos($name, '.') !== false)
            {
                continue;   // Skip files.
            }

            $module_dirs[] = rtrim($name, DIRECTORY_SEPARATOR);
        }

        @ sort($module_dirs);

        $doc = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');

        foreach ($module_dirs as $module_name)
        {
            if ($module_name == 'sitemap')
            {
                continue;
            }

            if (
                !file_exists(APPPATH.'modules/'.$module_name.'/controllers/Sitemap_controller.php')
                &&
                !file_exists(APPPATH.'modules/'.$module_name.'/controllers/Sitemap.php')
                &&
                !file_exists(APPPATH.'modules/'.$module_name.'/controllers/sitemap_controller.php')
                &&
                !file_exists(APPPATH.'modules/'.$module_name.'/controllers/sitemap.php')
            )
            {
                continue;
            }

            $doc->addChild('sitemap')->addChild('loc', site_url($module_name.'/sitemap/xml'));
        }
        
        $this->output->set_content_type('application/xml')->set_output($doc->asXML());
    }

}
