<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); // Remove line to use class outside of codeigniter
/*
* Gravatar library for use with codeigniter
* 
* @author Ryan Marshall <ryan@irealms.co.uk>
* @link http://www.irealms.co.uk
* @link https://github.com/rsmarshall/Codeigniter-Gravatar
* @package Codeigniter
* @subpackage Gravatar
*
*/

class Gravatar {
    
    private $base_url = 'http://www.gravatar.com/';
    private $secure_base_url = 'https://secure.gravatar.com/';

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
/* End of file Gravatar.php */
/* Location: ./application/libraries/Gravatar.php */
