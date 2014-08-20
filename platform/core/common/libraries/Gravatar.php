<?php defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * Gravatar library for CodeIgniter
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 *
 * Based on the initial work of Ryan Marshall.
 * @author Ryan Marshall <ryan@irealms.co.uk>
 * @link http://www.irealms.co.uk
 * @link https://github.com/rsmarshall/Codeigniter-Gravatar
 */

class Gravatar {

    protected $ci;

    protected $base_url = 'http://www.gravatar.com/';
    protected $secure_base_url = 'https://secure.gravatar.com/';
    protected $image_extension = '.png';
    protected $image_size = 80;
    protected $default_image = '';
    protected $force_default_image = false;
    protected $rating = '';
    protected $useragent = 'PHP Gravatar Library';

    public function __construct($config = array()) {

        $this->ci = get_instance();

        $this->ci->load->helper('email');

        if (!is_array($config)) {
            $config = array();
        }

        if (isset($config['gravatar_base_url'])) {
            $this->base_url = (string) $config['gravatar_base_url'];
        }

        if (isset($config['gravatar_secure_base_url'])) {
            $this->secure_base_url = (string) $config['gravatar_secure_base_url'];
        }

        if (isset($config['gravatar_image_extension'])) {
            $this->image_extension = (string) $config['gravatar_image_extension'];
        }

        if (isset($config['gravatar_image_size'])) {

            $image_size = (int) $config['gravatar_image_size'];

            if ($image_size > 0) {
                $this->image_size = $image_size;
            }
        }

        if (isset($config['gravatar_default_image'])) {
            $this->default_image = (string) $config['gravatar_default_image'];
        }

        if (isset($config['gravatar_force_default_image'])) {
            $this->force_default_image = !empty($config['gravatar_force_default_image']);
        }

        if (isset($config['gravatar_rating'])) {
            $this->rating = (string) $config['gravatar_rating'];
        }

        if (isset($config['gravatar_useragent'])) {
            $this->useragent = (string) $config['gravatar_useragent'];
        }
    }

    /**
     * Creates a URL for requesting a Gravatar image.
     * @link http://en.gravatar.com/site/implement/images/
     */
    public function get($email, $size = null, $default_image = null, $force_default_image = null, $rating = null) {

        $url = (is_https() ? $this->secure_base_url : $this->base_url).'avatar/'.$this->create_hash($email).$this->image_extension;

        $query = array();

        $size = (int) $size;

        if ($size <= 0) {
            $size = $this->image_size;
        }

        if ($size > 0) {
            $query['s'] = $size;
        }

        if (isset($default_image)) {
            $default_image = (string) $default_image;
        } else {
            $default_image = $this->default_image;
        }

        if ($default_image != '') {
            $query['d'] = $default_image;
        }

        if (isset($force_default_image)) {
            $force_default_image = !empty($force_default_image);
        } else {
            $force_default_image = $this->force_default_image;
        }

        if ($force_default_image) {
            $query['f'] = 'y';
        }

        if (isset($rating)) {
            $rating = (string) $rating;
        } else {
            $rating = $this->rating;
        }

        if ($rating != '') {
            $query['r'] = $rating;
        }

        if (!empty($query)) {
            $url = http_build_url($url, array('query' => $query));
        }

        return $url;
    }

    public function get_profile_data($email) {

        $result = $this->execute_profile_request($email, 'php');

        if ($result == '') {
            return null;
        }

        $result = @ unserialize($result);

        if (!is_array($result) || !isset($result['entry']) || !isset($result['entry'][0])) {
            return null;
        }

        return $result['entry'][0];
    }

    /**
     * Executes a request to Gravatar profile data and returns raw received response.
     * @param type $email
     * @param type $format  '', 'json', 'xml', 'php', 'vcf', 'qr'.
     * @return string/null
     */
    public function execute_profile_request($email, $format = null) {

        if (!valid_email($email)) {
            return null;
        }

        $format = trim($format);

        if ($format != '') {
            $format = '.'.ltrim($format, '.');
        }

        $result = null;

        if (function_exists('curl_init')) {

            $this->ci->load->library('curl');
            $this->curl = $this->ci->curl;

            $url = $this->secure_base_url.$this->create_hash($email).$format;

            $this->curl->create($url);
            $this->curl->post();

            $this->curl->option('useragent', $this->useragent);
            $this->curl->option('returntransfer', true);
            $this->curl->option('timeout', 3);

            $result = $this->curl->execute();
        }

        elseif (ini_get('allow_url_fopen')) {

            $url = $this->base_url.$this->create_hash($email).$format;

            $options = array(
                'http' => array(
                    'method' => 'GET',
                    'useragent' => $this->useragent,
                ),
            );

            $context = stream_context_create($options);

            $result = @ file_get_contents($url, false, $context);
        }

        if ($result === false) {
            return null;
        }

        return $result;
    }

    /**
     * Creates a hash value from a provided e-mail address.
     * @link https://en.gravatar.com/site/implement/hash/
     */
    public function create_hash($email) {

        return md5(UTF8::strtolower(trim($email)));
    }


    //--------------------------------------------------------------------------
    // The following original methods are kept here for backward compatibility.
    // Consider them as deprecated.
    //--------------------------------------------------------------------------


    /*
     * Set the email to be used, converting it into an md5 hash as required by gravatar.com
     *
     * @param string $email
     *
     * @return string|null Email hash or if email didn't validate then return NULL
     */
    public function set_email($email)
    {
        $email = strtolower($email);
        $email = trim($email);

        if( ! filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE)
        {
            return md5($email);
        }

        return NULL;
    }

    /*
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
            $base = $this->secure_base_url;
        }
        else
        {
            $base = $this->base_url;
        }

        return $base .'avatar/'. $hash . $query_string;
    }

    /*
     * Grab the full profile data for a given email from gravatar.com in xml format
     *
     * @param string $email
     * @param string fetch_method defaults to file, 'curl' is the other option
     *
     * @return object|null $xml->entry on success, NULL on an error
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

            $str = file_get_contents($this->base_url . $hash .'.xml');
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
                CURLOPT_URL => $this->secure_base_url . $hash .'.xml',
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
