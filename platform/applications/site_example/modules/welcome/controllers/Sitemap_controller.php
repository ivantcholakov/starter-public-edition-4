<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap_controller extends Base_Controller {

    public function xml() {

        $doc = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" />');

        $langs = $this->lang->enabled();

        foreach ($langs as $lang) {

            $node = $doc->addChild('url');

            $loc = $this->lang->site_url(null, null, $lang);

            $node->addChild('loc', $loc);

            foreach ($langs as $lang_alt) {

                if ($lang == $lang_alt) {
                    continue;
                }

                $link = $node->addChild('xmlns:xhtml:link');

                $link->addAttribute('rel', 'alternate');
                $link->addAttribute('hreflang', $this->lang->code($lang_alt));
                $link->addAttribute('href', $this->lang->site_url(null, null, $lang_alt));
            }

        }

        $this->output->set_content_type('application/xml')->set_output($doc->asXML());
    }

}
