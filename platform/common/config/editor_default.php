<?php defined('BASEPATH') OR exit('No direct script access allowed.');

$config['basePath'] = DEFAULT_BASE_URL.'assets/js/ckeditor/';
$config['config']['baseHref'] = http_build_url(DEFAULT_BASE_URL.'../');
$config['config']['fullPage'] = false;
$config['config']['language'] = language_ckeditor();
$config['config']['defaultLanguage'] = 'en';
$config['config']['contentsLanguage'] = language_ckeditor();
$config['config']['contentsLangDirection'] = get_instance()->lang->direction();

$config['config']['contentsCss'] = array();
$config['config']['contentsCss'][] = DEFAULT_BASE_URL.'assets/css/lib/open-sans/open-sans.min.css?v='.WEB_ASSET_CACHE_BUST_NUMBER;
$config['config']['contentsCss'][] = DEFAULT_BASE_URL.'assets/css/lib/open-sans-condensed/open-sans-condensed.min.css?v='.WEB_ASSET_CACHE_BUST_NUMBER;
$config['config']['contentsCss'][] = DEFAULT_BASE_URL.'assets/css/lib/semantic-icons-default/icons.css?v='.WEB_ASSET_CACHE_BUST_NUMBER;
$config['config']['contentsCss'][] = DEFAULT_BASE_URL.'assets/css/lib/editor/editor.min.css?v='.WEB_ASSET_CACHE_BUST_NUMBER;

$config['config']['width'] = '';
$config['config']['height'] = '100';
$config['config']['resize_enabled'] = false;
$config['textareaAttributes'] = array('rows' => 8, 'cols' => 60);

$config['config']['entities_latin'] = false;
$config['config']['entities_greek'] = false;

$config['config']['forcePasteAsPlainText'] = true;
$config['config']['toolbarCanCollapse'] = false;

$config['config']['allowedContent'] = true;

$config['config']['extraPlugins'] = 'showprotected';
$config['config']['removePlugins'] = 'easyimage, cloudservices, exportpdf';

$config['config']['cloudServices_tokenUrl'] = 'https://example.com/cs-token-endpoint';
$config['config']['cloudServices_uploadUrl'] = 'https://your-organization-id.cke-cs.com/easyimage/upload/';
