<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2013
 * @license The MIT License, http://opensource.org/licenses/MIT for my modifications.
 */

class Core_Config extends MX_Config {

    /**
     * Class constructor
     *
     * Sets the $config data from the primary config.php file as a class variable.
     *
     * @return    void
     */
    public function __construct()
    {
        $this->config =& get_config();

        // Added by Ivan Tcholakov, 20-JAN-2014.
        // Load additional configuration data for languages.

        $c = array();
        $config = array();

        if (file_exists(COMMONPATH.'config/lang.php')) {

            require COMMONPATH.'config/lang.php';
            $c = array_replace_recursive($c, $config);
            $config = array();
        }

        if (file_exists(COMMONPATH.'config/'.ENVIRONMENT.'/lang.php')) {

            require COMMONPATH.'config/'.ENVIRONMENT.'/lang.php';
            $c = array_replace_recursive($c, $config);
            $config = array();
        }

        if (file_exists(APPPATH.'config/lang.php')) {

            require APPPATH.'config/lang.php';
            $c = array_replace_recursive($c, $config);
            $config = array();
        }

        if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/lang.php')) {

            require APPPATH.'config/'.ENVIRONMENT.'/lang.php';
            $c = array_replace_recursive($c, $config);
            $config = array();
        }

        $c['hide_default_uri_segment'] = !empty($c['hide_default_uri_segment']);

        $languages = isset($c['languages']) && is_array($c['languages']) ? $c['languages'] : array();

        foreach ($languages as $key => $value) {

            if (!isset($value['direction'])) {
                $languages[$key]['direction'] = 'ltr';
            }

            if (!isset($value['uri_segment'])) {
                $languages[$key]['uri_segment'] = $value['code'];
            }
        }

        $c['languages'] = $languages;

        $c['default_language'] = $this->config['language'];

        if (!isset($c['enabled_languages']) && !is_array($c['enabled_languages'])) {
            $c['enabled_languages'] = array($c['default_language']);
        }

        if (!in_array($c['default_language'], $c['enabled_languages'])) {
            $c['enabled_languages'][] = $c['default_language'];
        }

        $this->config = array_replace_recursive($this->config, $c);
        //

        global $DETECT_URL;

        // Set the base_url automatically if none was provided
        if (empty($this->config['base_url']))
        {
            $this->set_item('base_url', $DETECT_URL['base_url']);
        }
        // For hard-coded configuration setting 'base_url'
        // replace the protocol and the port with the actual detected values.
        else
        {
            $this->set_item('base_url', http_build_url($this->config['base_url'], array('scheme' => $DETECT_URL['server_protocol'], 'port' => $DETECT_URL['port'])));
        }

        if (!defined('BASE_URL')) {
            define('BASE_URL', $this->add_slash($this->base_url()));
        }

        if (!defined('BASE_URI')) {
            define('BASE_URI', $DETECT_URL['base_uri']);
        }

        if (!defined('SERVER_URL')) {
            define('SERVER_URL', $this->add_slash(substr(BASE_URL, 0, strlen(BASE_URL) - strlen(BASE_URI))));
        }

        if (!defined('SITE_URL')) {
            define('SITE_URL', $this->add_slash($this->site_url()));
        }

        if (!defined('SITE_URI')) {
            define('SITE_URI', '/'.str_replace(SERVER_URL, '', SITE_URL));
        }

        if (!defined('CURRENT_URI')) {
            define('CURRENT_URI', $DETECT_URL['current_uri']);
        }

        if (!defined('CURRENT_URL')) {
            define('CURRENT_URL', rtrim(SERVER_URL, '/').CURRENT_URI);
        }

        if (!defined('CURRENT_URL_IS_HTTPS')) {
            define('CURRENT_URL_IS_HTTPS', $DETECT_URL['is_https']);
        }

        if (!defined('CURRENT_URL_PROTOCOL')) {
            define('CURRENT_URL_PROTOCOL', $DETECT_URL['server_protocol']);
        }

        if (!defined('CURRENT_URL_HOST')) {
            define('CURRENT_URL_HOST', $DETECT_URL['server_name']);
        }

        if (!defined('CURRENT_URL_PORT')) {
            define('CURRENT_URL_PORT', $DETECT_URL['port']);
        }

        if (!defined('CURRENT_URI_STRING')) {
            define('CURRENT_URI_STRING', $DETECT_URL['current_uri_string']);
        }

        if (!defined('CURRENT_QUERY_STRING')) {
            define('CURRENT_QUERY_STRING', $DETECT_URL['current_query_string']);
        }

        // Added by Ivan Tcholakov, 13-JAN-2014.
        if (!defined('DEFAULT_BASE_URL')) {

            if (APPSEGMENT != '') {
                define('DEFAULT_BASE_URL', preg_replace('/'. preg_quote($this->add_slash(APPSEGMENT), '/') . '$/', '', BASE_URL));
            } else {
                define('DEFAULT_BASE_URL', BASE_URL);
            }
        }
        //

        // Added by Ivan Tcholakov, 13-JAN-2014.
        if (!defined('DEFAULT_BASE_URI')) {

            if (APPSEGMENT != '') {
                define('DEFAULT_BASE_URI', preg_replace('/'. preg_quote($this->add_slash(APPSEGMENT), '/') . '$/', '', BASE_URI));
            } else {
                define('DEFAULT_BASE_URI', BASE_URI);
            }
        }
        //

        // Added by Ivan Tcholakov, 26-DEC-2013.
        // See https://github.com/EllisLab/CodeIgniter/issues/2792
        if (!defined('IS_UTF8_CHARSET')) {
            define('IS_UTF8_CHARSET', strtolower($this->config['charset']) === 'utf-8');
        }
        //

        // Added by Ivan Tcholakov, 02-JAN-2016.
        HTML_Common2::setOption('charset', $this->config['charset']);
        //

        // Common Purpose File System Repositories

        $public_upload_path = $this->add_slash(
            isset($this->config['public_upload_path']) && $this->config['public_upload_path'] != ''
                ? $this->config['public_upload_path']
                : DEFAULTFCPATH.'upload/'
        );

        $this->set_item('public_upload_path', $public_upload_path);

        if (!defined('PUBLIC_UPLOAD_PATH')) {
            define('PUBLIC_UPLOAD_PATH', $public_upload_path);
        }

        $public_upload_url = $this->add_slash(
            isset($this->config['public_upload_url']) && $this->config['public_upload_url'] != ''
                ? str_replace(array('{default_base_url}', '{base_url}'), array(DEFAULT_BASE_URL, BASE_URL), $this->config['public_upload_url'])
                : DEFAULT_BASE_URL.'upload/'
        );

        $this->set_item('public_upload_url', $public_upload_url);

        if (!defined('PUBLIC_UPLOAD_URL')) {
            define('PUBLIC_UPLOAD_URL', $public_upload_url);
        }

        $platform_upload_path = $this->add_slash(
            isset($this->config['platform_upload_path']) && $this->config['platform_upload_path'] != ''
                ? $this->config['platform_upload_path']
                : PLATFORMPATH.'upload/'
        );

        $this->set_item('platform_upload_path', $platform_upload_path);

        if (!defined('PLATFORM_UPLOAD_PATH')) {
            define('PLATFORM_UPLOAD_PATH', $platform_upload_path);
        }

        // Assets

        $c = array();
        $config = array();

        if (file_exists(COMMONPATH.'config/asset.php')) {

            require COMMONPATH.'config/asset.php';
            $c = array_replace_recursive($c, $config);
            $config = array();
        }

        if (file_exists(COMMONPATH.'config/'.ENVIRONMENT.'/asset.php')) {

            require COMMONPATH.'config/'.ENVIRONMENT.'/asset.php';
            $c = array_replace_recursive($c, $config);
            $config = array();
        }

        if (file_exists(APPPATH.'config/asset.php')) {

            require APPPATH.'config/asset.php';
            $c = array_replace_recursive($c, $config);
            $config = array();
        }

        if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/asset.php')) {

            require APPPATH.'config/'.ENVIRONMENT.'/asset.php';
            $c = array_replace_recursive($c, $config);
            $config = array();
        }

        if (!defined('ASSET_URL')) {
            define('ASSET_URL', $this->add_slash($c['asset_url']));
        }

        if (!defined('ASSET_URI')) {
            define('ASSET_URI', $this->add_slash($c['asset_dir']));
        }

        if (!defined('THEME_ASSET_URL')) {
            define('THEME_ASSET_URL', $this->add_slash($c['theme_asset_url']));
        }

        if (!defined('THEME_ASSET_URI')) {
            define('THEME_ASSET_URI', $this->add_slash($c['theme_asset_dir']));
        }

        if (!defined('ASSET_IMG_URL')) {
            define('ASSET_IMG_URL', ASSET_URL.$this->add_slash($c['asset_img_dir']));
        }

        if (!defined('ASSET_IMG_URI')) {
            define('ASSET_IMG_URI', ASSET_URI.$this->add_slash($c['asset_img_dir']));
        }

        if (!defined('ASSET_JS_URL')) {
            define('ASSET_JS_URL', ASSET_URL.$this->add_slash($c['asset_js_dir']));
        }

        if (!defined('ASSET_JS_URI')) {
            define('ASSET_JS_URI', ASSET_URI.$this->add_slash($c['asset_js_dir']));
        }

        if (!defined('ASSET_CSS_URL')) {
            define('ASSET_CSS_URL', ASSET_URL.$this->add_slash($c['asset_css_dir']));
        }

        if (!defined('ASSET_CSS_URI')) {
            define('ASSET_CSS_URI', ASSET_URI.$this->add_slash($c['asset_css_dir']));
        }

        if (!defined('THEME_IMG_URL')) {
            define('THEME_IMG_URL', THEME_ASSET_URL.$this->add_slash($c['asset_img_dir']));
        }

        if (!defined('THEME_IMG_URI')) {
            define('THEME_IMG_URI', THEME_ASSET_URI.$this->add_slash($c['asset_img_dir']));
        }

        if (!defined('THEME_JS_URL')) {
            define('THEME_JS_URL', THEME_ASSET_URL.$this->add_slash($c['asset_js_dir']));
        }

        if (!defined('THEME_JS_URI')) {
            define('THEME_JS_URI', THEME_ASSET_URI.$this->add_slash($c['asset_js_dir']));
        }

        if (!defined('THEME_CSS_URL')) {
            define('THEME_CSS_URL', THEME_ASSET_URL.$this->add_slash($c['asset_css_dir']));
        }

        if (!defined('THEME_CSS_URI')) {
            define('THEME_CSS_URI', THEME_ASSET_URI.$this->add_slash($c['asset_css_dir']));
        }

        log_message('info', 'Config Class Initialized');
    }

    // --------------------------------------------------------------------

    /**
     * Base URL
     *
     * Returns base_url [. uri_string]
     *
     * @uses        CI_Config::_uri_string()
     *
     * @param       string|string[]    $uri    URI string or an array of segments
     * @param       string    $protocol
     * @return      string
     */
    public function base_url($uri = '', $protocol = NULL)
    {
        // Added by Ivan Tcholakov, 09-NOV-2013.
        if (is_array($uri)) {
            $uri = implode('/', $uri);
        }
        //

        $base_url = $this->slash_item('base_url');

        if (isset($protocol))
        {
            // For protocol-relative links
            if ($protocol === '')
            {
                $base_url = substr($base_url, strpos($base_url, '//'));
            }
            else
            {
                $base_url = $protocol.substr($base_url, strpos($base_url, '://'));
            }
        }

        return $base_url.ltrim($this->_uri_string($uri), '/');
    }

    // --------------------------------------------------------------------

    /**
     * Site URL
     *
     * Returns base_url . index_page [. uri_string]
     *
     * @uses        CI_Config::_uri_string()
     *
     * @param       string|string[]     $uri         URI string or an array of segments
     * @param       string              $protocol
     * @param       string              $language
     * @return      string
     */
    // Cloned/modified by Ivan Tcholakov, 16-MAR-2014.
    public function site_url($uri = '', $protocol = NULL, $language = NULL)
    {
        if (is_array($uri))
        {
            $uri = implode('/', $uri);
        }

        if ($language == '') {
            $language = $this->current_language();
        }

        $base_url = $this->slash_item('base_url');

        if (isset($protocol))
        {
            // For protocol-relative links
            if ($protocol === '')
            {
                $base_url = substr($base_url, strpos($base_url, '//'));
            }
            else
            {
                $base_url = $protocol.substr($base_url, strpos($base_url, '://'));
            }
        }

        if ($uri == '')
        {
            if ($this->hide_default_language_uri_segment() && $language == $this->default_language()) {
                return $base_url.$this->item('index_page');
            } else {
                return $base_url.($this->item('index_page') != '' ? $this->item('index_page').'/' : '').$this->language_uri_segment($language).'/';
            }
        }

        $uri = $this->localized($uri, $language);

        $uri = $this->_uri_string($uri);

        if ($this->item('enable_query_strings') === FALSE)
        {
            $suffix = isset($this->config['url_suffix']) ? $this->config['url_suffix'] : '';

            if ($suffix !== '')
            {
                if (($offset = strpos($uri, '?')) !== FALSE)
                {
                    $uri = substr($uri, 0, $offset).$suffix.substr($uri, $offset);
                }
                else
                {
                    $uri .= $suffix;
                }
            }

            return $base_url.$this->slash_item('index_page').$uri;
        }
        elseif (strpos($uri, '?') === FALSE)
        {
            $uri = '?'.$uri;
        }

        return $base_url.$this->item('index_page').$uri;
    }

    // --------------------------------------------------------------------

    // Added by Ivan Tcholakov, 12-OCT-2013.
    protected function add_slash($string) {

        $string = (string) $string;

        if ($string != '') {
            $string = rtrim($string, '/').'/';
        }

        return $string;
    }

    // --------------------------------------------------------------------

    // Added by Ivan Tcholakov, 09-NOV-2013.
    public function base_uri($uri = '') {

        if (is_array($uri)) {
            $uri = implode('/', $uri);
        }

        return BASE_URI.ltrim($this->_uri_string($uri), '/');
    }

    // Added by Ivan Tcholakov, 09-NOV-2013.
    public function site_uri($uri = '', $language = NULL) {

        if (is_array($uri)) {
            $uri = implode('/', $uri);
        }

        if ($language == '') {
            $language = $this->current_language();
        }

        if ($uri == '')
        {
            if ($this->hide_default_language_uri_segment() && $language == $this->default_language()) {
                return SITE_URI.$this->item('index_page');
            } else {
                return SITE_URI.($this->item('index_page') != '' ? $this->item('index_page').'/' : '').$this->language_uri_segment($language).'/';
            }
        }

        $uri = $this->localized($uri, $language);

        $uri = $this->_uri_string($uri);

        if ($this->item('enable_query_strings') === FALSE)
        {
            $suffix = isset($this->config['url_suffix']) ? $this->config['url_suffix'] : '';

            if ($suffix !== '')
            {
                if (($offset = strpos($uri, '?')) !== FALSE)
                {
                    $uri = substr($uri, 0, $offset).$suffix.substr($uri, $offset);
                }
                else
                {
                    $uri .= $suffix;
                }
            }

            return BASE_URI.$this->slash_item('index_page').$uri;
        }
        elseif (strpos($uri, '?') === FALSE)
        {
            $uri = '?'.$uri;
        }

        return BASE_URI.$this->item('index_page').$uri;
    }

    // Added by Ivan Tcholakov, 13-JAN-2014.
    public function default_base_url($uri = '', $protocol = NULL)
    {
        if (is_array($uri)) {
            $uri = implode('/', $uri);
        }

        $base_url = DEFAULT_BASE_URL;

        if (isset($protocol))
        {
            $base_url = $protocol.substr($base_url, strpos($base_url, '://'));
        }

        return $base_url.ltrim($this->_uri_string($uri), '/');
    }

    // Added by Ivan Tcholakov, 13-JAN-2014.
    public function default_base_uri($uri = '') {

        if (is_array($uri)) {
            $uri = implode('/', $uri);
        }

        return DEFAULT_BASE_URI.ltrim($this->_uri_string($uri), '/');
    }

    // Internationalization
    //--------------------------------------------------------------------------

    // Added by Ivan Tcholakov, 22-JAN-2014.
    function localized($uri, $language = NULL) {

        if ($language == '') {
            $language = $this->current_language();
        }

        if ($uri != '') {

            if (!($this->hide_default_language_uri_segment() && $language == $this->default_language())) {

                if (!$this->get_uri_lang($uri)) {

                    if (!preg_match('/(.+)\.(([a-zA-Z0-9]{2,4})|([a-zA-Z0-9]{2}[\-_]{1}[a-zA-Z0-9]{2,3}))$/', $uri)) {
                        $uri = $this->language_uri_segment($language).'/'.$uri;
                    }
                }
            }
        }

        return $uri;
    }

    // Added by Ivan Tcholakov, 22-JAN-2014.
    // Checks whether the language exists within URI.
    // When true - returns an array with language segment + rest.
    public function get_uri_lang($uri = '') {

        if ($uri != '') {

            $result = array();

            $uri = ltrim($uri);

            $uri_expl = explode('/', $uri, 2);

            $result['lang'] = NULL;
            $result['parts'] = $uri_expl;

            if ($this->valid_language_uri_segment($uri_expl[0])) {

                $result['lang'] = $uri_expl[0];

            } else {

                return false;
            }

            return $result;
        }

        return false;
    }

    // Added by Ivan Tcholakov, 21-JAN-2014.
    public function multilingual_site() {

        return count($this->enabled_languages()) > 1;
    }

    // Added by Ivan Tcholakov, 22-JAN-2014.
    public function hide_default_language_uri_segment() {

        return $this->config['hide_default_uri_segment'];
    }

    // Added by Ivan Tcholakov, 23-JAN-2014.
    public function get_language($language) {

        $result = null;

        if (array_key_exists($language, $this->config['languages'])) {

            $result = array_merge(array('language' => $language), $this->config['languages'][$language]);
        }

        return $result;
    }

    // Added by Ivan Tcholakov, 22-JAN-2014.
    public function set_current_language($language) {

        if ($this->valid_language($language)) {
            $this->set_item('language', $language);
        } else {
            $this->set_item('language', $this->default_language());
        }
    }

    // Added by Ivan Tcholakov, 22-JAN-2014.
    public function current_language() {

        return $this->config['language'];
    }

    // Added by Ivan Tcholakov, 26-APR-2014.
    public function current_language_code() {

        return $this->language_code($this->current_language());
    }

    // Added by Ivan Tcholakov, 26-APR-2014.
    public function english_language() {

        return 'english';
    }

    // Added by Ivan Tcholakov, 26-APR-2014.
    public function english_language_code() {

        return 'en';
    }

    // Added by Ivan Tcholakov, 20-JAN-2014.
    public function default_language() {

        return $this->config['default_language'];
    }

    // Added by Ivan Tcholakov, 20-JAN-2014.
    public function default_language_code() {

        return $this->language_code($this->default_language());
    }

    // Added by Ivan Tcholakov, 20-JAN-2014.
    public function default_language_uri_segment() {

        return $this->language_uri_segment($this->default_language());
    }

    // Added by Ivan Tcholakov, 20-JAN-2014.
    public function enabled_languages() {

        return $this->config['enabled_languages'];
    }

    // Added by Ivan Tcholakov, 20-JAN-2014.
    public function enabled_languages_codes() {

        $result = array();

        foreach ($this->enabled_languages() as $language) {
            $result[] = $this->language_code($language);
        }

        return $result;
    }

    // Added by Ivan Tcholakov, 20-JAN-2014.
    public function enabled_languages_uri_segments() {

        $result = array();

        foreach ($this->enabled_languages() as $language) {
            $result[] = $this->language_uri_segment($language);
        }

        return $result;
    }

    // Added by Ivan Tcholakov, 20-JAN-2014.
    public function valid_language($language) {

        return in_array($language, $this->enabled_languages());
    }

    // Added by Ivan Tcholakov, 20-JAN-2014.
    public function valid_language_code($code) {

        return $this->valid_language($this->language_by_code($code));
    }

    // Added by Ivan Tcholakov, 20-JAN-2014.
    public function valid_language_uri_segment($uri_segment) {

        return $this->valid_language($this->language_by_uri_segment($uri_segment));
    }

    // Added by Ivan Tcholakov, 20-JAN-2014.
    public function language_by_code($code) {

        foreach ($this->config['languages'] as $key => $value) {

            if ($value['code'] == $code) {
                return $key;
            }
        }

        return null;
    }

    // Added by Ivan Tcholakov, 20-JAN-2014.
    public function language_by_uri_segment($uri_segment) {

        foreach ($this->config['languages'] as $key => $value) {

            if ($value['uri_segment'] == $uri_segment) {
                return $key;
            }
        }

        return null;
    }

    // Added by Ivan Tcholakov, 20-JAN-2014.
    public function language_code($language = null) {

        if ($language == '') {
            $language = $this->current_language();
        }

        if (array_key_exists($language, $this->config['languages'])) {
            return $this->config['languages'][$language]['code'];
        }

        return null;
    }

    /**
     * Retrieves a custom language code that exist within the configuration data under the specified key.
     * This is for serving addins that identify languages with their own sets of codes.
     *
     * Example: $phpmailer_lang = $this->config->language_custom_code('phpmailer', 'bulgarian);
     * For this example there must be 'phpmailer' configuration item (non-mandatory) for the corredponding language
     * within the configuration file lang.php:
     *
     * ...
     * 'bulgarian' => array(
     *     'code' => 'bg',              // CLDR language code.
     *     'direction' => 'ltr',        // This is the value by default, you may omit it.
     *     'uri_segment' => 'bg',       // If this value == value[code], you may omit it.
     *     'name' => 'Български',       // Native name.
     *     'name_en' => 'Bulgarian',    // Name in English.
     *     'flag' => 'BG',              // Flag (country code).
     *     'phpmailer' => 'bg',         // Language code used by PHPMailer, in this specific language it can be omited.
     * ),
     * ...
     *
     * @param string        $key        The key for accessing the custom code.
     * @param string/null   $language   The language.
     * @return string/null              Returns the custom code or if not found - the conventional (CLDR) language code.
     */
    public function language_custom_code($key, $language = null) {

        $key = (string) $key;

        if ($language == '') {
            $language = $this->current_language();
        }

        if (array_key_exists($language, $this->config['languages'])) {

            if (array_key_exists($key, $this->config['languages'][$language])) {
                return $this->config['languages'][$language][$key];
            }

            return $this->config['languages'][$language]['code'];
        }

        return null;
    }

    // Added by Ivan Tcholakov, 20-JAN-2014.
    public function language_uri_segment($language = null) {

        if ($language == '') {
            $language = $this->current_language();
        }

        if (array_key_exists($language, $this->config['languages'])) {
            return $this->config['languages'][$language]['uri_segment'];
        }

        return null;
    }

    // Added by Ivan Tcholakov, 20-JAN-2014.
    public function language_direction($language = null) {

        if ($language == '') {
            $language = $this->current_language();
        }

        if (array_key_exists($language, $this->config['languages'])) {
            return $this->config['languages'][$language]['direction'];
        }

        return null;
    }

    // Added by Ivan Tcholakov, 18-APR-2014.
    public function language_name($language = null) {

        if ($language == '') {
            $language = $this->current_language();
        }

        if (array_key_exists($language, $this->config['languages'])) {
            return $this->config['languages'][$language]['name'];
        }

        return null;
    }

    // Added by Ivan Tcholakov, 18-APR-2014.
    public function language_name_en($language = null) {

        if ($language == '') {
            $language = $this->current_language();
        }

        if (array_key_exists($language, $this->config['languages'])) {
            return $this->config['languages'][$language]['name_en'];
        }

        return null;
    }

    // Added by Ivan Tcholakov, 31-MAY-2014.
    public function language_flag($language = null) {

        if ($language == '') {
            $language = $this->current_language();
        }

        if (array_key_exists($language, $this->config['languages'])) {
            return $this->config['languages'][$language]['flag'];
        }

        return null;
    }

}
