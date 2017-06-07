<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Core_URI extends CI_URI {

    public function ruri_string()
    {
        return ltrim(load_class('Router', 'core')->rdir, '/').implode('/', $this->rsegments);
    }

    public function language_segment()
    {
        return load_class('Router', 'core')->language_uri_segment;
    }
}
