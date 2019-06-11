<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['num_links']            = 3;        // number of links before and after current page
$config['page_query_string']    = TRUE;     // using query string instead of URI segments
$config['query_string_segment'] = "offset"; // change default 'per_page' query string to 'offset'

$config['full_tag_open']        = '<ul class="pagination">';
$config['full_tag_close']       = '</ul>';

$config['first_link']           = '<i class="icon-arrow-left icons"></i>';
$config['first_tag_open']       = '<li>';
$config['first_tag_close']      = '</li>';

$config['last_link']            = '<i class="icon-arrow-right icons"></i>';
$config['last_tag_open']        = '<li>';
$config['last_tag_close']       = '</li>';

$config['prev_link']            = '<i class="icon-arrow-left icons"></i>';
$config['prev_tag_open']        = '<li>';
$config['prev_tag_close']       = '</li>';

$config['next_link']            = '<i class="icon-arrow-right icons"></i>';
$config['next_tag_open']        = '<li>';
$config['next_tag_close']       = '</li>';

$config['cur_tag_open']         = '<li class="active"><span>';
$config['cur_tag_close']        = '</span></li>';

$config['num_tag_open']         = '<li>';
$config['num_tag_close']        = '</li>';