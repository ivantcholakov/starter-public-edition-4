<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * Gravatar Library for CodeIgniter
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015 - 2016
 * @author Ryan Marshall <ryan@irealms.co.uk>, 2011 - 2015, @link http://irealms.co.uk
 *
 * Code repository: @link https://github.com/ivantcholakov/Codeigniter-Gravatar
 *
 * @version 1.1.1
 *
 * @license The MIT License (MIT)
 * @link http://opensource.org/licenses/MIT
 */

// Gravatar pofile error results.
defined('GRAVATAR_NO_ERROR') OR define('GRAVATAR_NO_ERROR', 0);
defined('GRAVATAR_CANT_CONNECT') OR define('GRAVATAR_CANT_CONNECT', 1);
defined('GRAVATAR_INVALID_EMAIL') OR define('GRAVATAR_INVALID_EMAIL', 2);
defined('GRAVATAR_PROFILE_DOES_NOT_EXIST') OR define('GRAVATAR_PROFILE_DOES_NOT_EXIST', 3);
defined('GRAVATAR_INCORRECT_FORMAT') OR define('GRAVATAR_INCORRECT_FORMAT', 4);

class Gravatar {

    protected $defaults;

    protected $gravatar_base_url;
    protected $gravatar_secure_base_url;
    protected $gravatar_image_extension;
    protected $gravatar_image_size;
    protected $gravatar_default_image;
    protected $gravatar_force_default_image;
    protected $gravatar_rating ;
    protected $gravatar_useragent;

    protected $last_error = GRAVATAR_NO_ERROR;

    protected $is_https;
    protected $curl_exists;
    protected $allow_url_fopen;

    public function __construct($config = array()) {

        // Added by Ivan Tcholakov, 09-JAN-2015.
        get_instance()->load->helper('email');
        //

        $this->defaults = array(
            'gravatar_base_url' => 'http://www.gravatar.com/',
            'gravatar_secure_base_url' => 'https://secure.gravatar.com/',
            'gravatar_image_extension' => '.png',
            'gravatar_image_size' => 80,
            'gravatar_default_image' => '',
            'gravatar_force_default_image' => false,
            'gravatar_rating' => '',
            'gravatar_useragent' => 'PHP Gravatar Library',
        );

        $this->is_https = $this->is_https();
        $this->curl_exists = function_exists('curl_init');
        $allow_url_fopen = @ini_get('allow_url_fopen');
        $allow_url_fopen = $allow_url_fopen === false || in_array(strtolower($allow_url_fopen), array('on', 'true', '1'));
        $this->allow_url_fopen = $allow_url_fopen;

        if (!is_array($config)) {
            $config = array();
        }

        $this->defaults = array_merge($this->defaults, $config);
        $this->initialize($this->defaults);
    }

    public function initialize($config = array()) {

        if (!is_array($config)) {
            $config = array();
        }

        foreach ($config as $key => $value) {
            $this->{$key} = $value;
        }

        $this->gravatar_base_url = (string) $this->gravatar_base_url;
        $this->gravatar_secure_base_url = (string) $this->gravatar_secure_base_url;
        $this->gravatar_image_extension = (string) $this->gravatar_image_extension;

        $this->gravatar_image_size = (int) $this->gravatar_image_size;

        if ($this->gravatar_image_size <= 0) {
            $this->gravatar_image_size = 80;
        }

        $this->gravatar_default_image = (string) $this->gravatar_default_image;
        $this->gravatar_force_default_image = !empty($this->gravatar_force_default_image);
        $this->gravatar_rating = (string) $this->gravatar_rating;
        $this->gravatar_useragent = (string) $this->gravatar_useragent;

        return $this;
    }

    public function reset() {

        $this->initialize($this->defaults);

        return $this;
    }

    public function get_defaults() {

        return $this->defaults;
    }

    /**
     * Creates a URL for requesting a Gravatar image.
     * @link http://en.gravatar.com/site/implement/images/
     *
     * @param   string      $email                  A registered email.
     * @param   int         $size                   The requested size of the avarar in pixels (a square image).
     * @param   string      $default_image          The fallback image option: '', '404', 'mm', 'identicon', 'monsterid', 'wavatar', 'retro', 'blank'.
     * @param   bool        $force_default_image    Enforces the fallback image to be shown.
     * @param   string      $rating                 The level of allowed self-rate of the avatar: '', 'g' (default), 'pg', 'r', 'x'.
     * @return  string                              Returns the URL of the avatar to be requested.
     *
     * When optional parameters are not set, their default values are taken
     * from the configuration file application/config/gravatar.php
     */
    public function get($email, $size = null, $default_image = null, $force_default_image = null, $rating = null) {

        $url = ($this->is_https ? $this->gravatar_secure_base_url : $this->gravatar_base_url).'avatar/'.$this->create_hash($email).$this->gravatar_image_extension;

        $query = array();

        $size = (int) $size;

        if ($size <= 0) {
            $size = $this->gravatar_image_size;
        }

        if ($size > 0) {
            $query['s'] = $size;
        }

        if (isset($default_image)) {
            $default_image = (string) $default_image;
        } else {
            $default_image = $this->gravatar_default_image;
        }

        if ($default_image != '') {
            $query['d'] = $default_image;
        }

        if (isset($force_default_image)) {
            $force_default_image = !empty($force_default_image);
        } else {
            $force_default_image = $this->gravatar_force_default_image;
        }

        if ($force_default_image) {
            $query['f'] = 'y';
        }

        if (isset($rating)) {
            $rating = (string) $rating;
        } else {
            $rating = $this->gravatar_rating;
        }

        if ($rating != '') {
            $query['r'] = $rating;
        }

        if (!empty($query)) {
            $url = $url.'?'.http_build_query($query);
        }

        return $url;
    }

    /**
     * Executes a request for Gravatar profile data and returns it as a multidimensional array.
     * @link https://en.gravatar.com/site/implement/profiles/
     *
     * @param   string      $email          A registered email.
     * @return  array/null                  Received profile data.
     */
    public function get_profile_data($email) {

        $result = $this->execute_profile_request($email, 'php');

        if ($this->last_error != GRAVATAR_NO_ERROR) {
            return null;
        }

        $result = @ unserialize($result);

        if ($result === false) {

            $this->last_error = GRAVATAR_INCORRECT_FORMAT;
            return null;
        }

        if (!is_array($result)) {

            $this->last_error = GRAVATAR_PROFILE_DOES_NOT_EXIST;
            return null;
        }

        if (!isset($result['entry']) || !isset($result['entry'][0])) {

            $this->last_error = GRAVATAR_INCORRECT_FORMAT;
            return null;
        }

        return $result['entry'][0];
    }

    /**
     * Executes a request for Gravatar profile data and returns raw received response.
     * @link https://en.gravatar.com/site/implement/profiles/
     *
     * @param   string      $email      A registered email.
     * @param   string      $format     '', 'json', 'xml', 'php', 'vcf', 'qr'.
     * @return  string/null             Received profile raw data.
     */
    public function execute_profile_request($email, $format = null) {

        $this->last_error = GRAVATAR_NO_ERROR;

        if (function_exists('valid_email')) {

            if (!valid_email($email)) {

                $this->last_error = GRAVATAR_INVALID_EMAIL;
                return null;
            }

        } else {

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                $this->last_error = GRAVATAR_INVALID_EMAIL;
                return null;
            }
        }

        $format = trim($format);

        if ($format != '') {
            $format = '.'.ltrim($format, '.');
        }

        $result = null;

        if ($this->curl_exists) {

            $url = $this->gravatar_secure_base_url.$this->create_hash($email).$format;

            $ch = curl_init();

            $options = array(
                CURLOPT_USERAGENT, $this->gravatar_useragent,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => array(),
                CURLOPT_URL => $url,
                CURLOPT_TIMEOUT => 3,
            );

            if (!ini_get('safe_mode') && !ini_get('open_basedir')) {
                $options[CURLOPT_FOLLOWLOCATION] = true;
            }

            curl_setopt_array($ch, $options);

            $result = curl_exec($ch);

            $code = @ curl_getinfo($ch, CURLINFO_HTTP_CODE);

            @ curl_close($ch);

            if ($code != 200) {

                $this->last_error = GRAVATAR_CANT_CONNECT;
                return null;
            }

        } elseif ($this->allow_url_fopen) {

            $url = $this->gravatar_base_url.$this->create_hash($email).$format;

            $options = array(
                'http' => array(
                    'method' => 'GET',
                    'useragent' => $this->gravatar_useragent,
                ),
            );

            $context = stream_context_create($options);

            $result = @ file_get_contents($url, false, $context);

        } else {

            $this->last_error = GRAVATAR_CANT_CONNECT;
            return null;
        }

        if ($result === false) {

            $this->last_error = GRAVATAR_CANT_CONNECT;
            return null;
        }

        return $result;
    }

    /**
     * Returns the error code as a result of the last profile request operation.
     *
     * @return int          GRAVATAR_NO_ERROR - the last operation was successfull,
     *                      other returned value indicates failure.
     */
    public function last_error() {

        return $this->last_error;
    }

    /**
     * Creates a hash value from a provided e-mail address.
     * @link https://en.gravatar.com/site/implement/hash/
     *
     * @param   string      $email      A registered email.
     * @return  string/null             The hash for accessing the avatar or profile data.
     */
    public function create_hash($email) {

        return md5(strtolower(trim($email)));
    }

    protected function is_https() {

        if (function_exists('is_https')) {
            return is_https();
        }

        if (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off') {
            return true;
        } elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
            return true;
        } elseif (!empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off') {
            return true;
        }

        return false;
    }

    //--------------------------------------------------------------------------
    // The following original methods are kept here for backward compatibility.
    // Consider them as deprecated.
    //--------------------------------------------------------------------------


    /**
     * Set the email to be used, converting it into an md5 hash as required by gravatar.com
     *
     * @param string $email
     *
     * @return string|null Email hash or if email didn't validate then return NULL
     *
     * @deprecated
     */
    public function set_email($email)
    {
        $email = trim(strtolower($email));

        if ( ! filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE)
        {
            return md5($email);
        }

        return NULL;
    }

    /**
     * get_gravatar_url
     *
     * @see http://en.gravatar.com/site/implement/images/ for available options
     *
     * @param string $rating defaults to g
     * @param string $size defaults to 80
     * @param string $default_image default sets can be found on the above link
     * @param boolean $secure set to TRUE if a secure url is required
     *
     * @return string gratavar url
     *
     * @deprecated
     */
    public function get_gravatar($email, $rating = NULL, $size = NULL, $default_image = NULL, $secure = NULL)
    {
        $hash = $this->set_email($email);

        if ($hash === NULL)
        {
            // $hash has to be set to a value so the gravatar site can return a default image
            $hash = 'invalid_email';
        }

        $query_string = NULL;
        $options = array();

        if ($rating !== NULL)
        {
            $options['r'] = $rating;
        }

        if ($size !== NULL)
        {
            $options['s'] = $size;
        }

        if ($default_image !== NULL)
        {
            $options['d'] = urlencode($default_image);
        }

        if (count($options) > 0)
        {
            $query_string = '?'. http_build_query($options);
        }

        if ($secure !== NULL)
        {
            $base = $this->gravatar_secure_base_url;
        }
        else
        {
            $base = $this->gravatar_base_url;
        }

        return $base .'avatar/'. $hash . $query_string;
    }

    /**
     * Grab the full profile data for a given email from gravatar.com in xml format
     *
     * @param string $email
     * @param string fetch_method defaults to file, 'curl' is the other option
     *
     * @return object|null $xml->entry on success, NULL on an error
     *
     * @deprecated
     */
    public function get_profile($email, $fetch_method = 'file')
    {
        $hash = $this->set_email($email);

        if ($hash === NULL)
        {
            // A hash value of NULL will return no xml so the method returns NULL
            return NULL;
        }

        libxml_use_internal_errors(TRUE);

        if ($fetch_method === 'file')
        {
            if (ini_get('allow_url_fopen') == FALSE)
            {
                return NULL;
            }

            $str = file_get_contents($this->gravatar_base_url . $hash .'.xml');
        }

        if ($fetch_method === 'curl')
        {
            if ( ! function_exists('curl_init'))
            {
                return NULL;
            }

            $ch = curl_init();
            $options = array(
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_POST => TRUE,
                CURLOPT_URL => $this->gravatar_secure_base_url . $hash .'.xml',
                CURLOPT_TIMEOUT => 3
            );
            curl_setopt_array($ch, $options);
            $str = curl_exec($ch);
        }

        $xml = simplexml_load_string($str);

        if ($xml === FALSE)
        {
            $errors = array();
            foreach(libxml_get_errors() as $error)
            {
                $errors[] = $error->message.'\n';
            }
            $error_string = implode('\n', $errors);
            throw new Exception('Failed loading XML\n'. $error_string);
        }
        else
        {
            return $xml->entry;
        }
    }

}
