<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Facebook PHP SDK v4 for CodeIgniter 3
 *
 * Library wrapper for Facebook PHP SDK v4. Check user login status, publish to feed
 * and more with easy to user CodeIgniter syntax.
 *
 * This library requires that Facebook PHP SDK v4 is installed with composer, and that CodeIgniter
 * config is set to autoload the vendor folder. More information in the CodeIgniter user guide at
 * https://www.codeigniter.com/userguide3/general/autoloader.html?highlight=composer
 *
 * It also requires CodeIgniter session library to be correctly configured.
 *
 * @package     CodeIgniter
 * @category    Libraries
 * @author      Mattias Hedman
 * @license     MIT
 * @link        https://github.com/darkwhispering/facebook-sdk-v4-codeigniter
 * @version     2.0.0
 */

// Load all required Facebook classes
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookJavaScriptLoginHelper;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphSessionInfo;
use Facebook\FacebookHttpable;
use Facebook\FacebookCurl;
use Facebook\FacebookCurlHttpClient;

Class Facebook {

    /**
     * Facebook login helper
     *
     * @var object
     */
    protected $helper;

    // ------------------------------------------------------------------------

    public function __construct()
    {
        // Load config
        $this->load->config('facebook');

        // Load required libraries and helpers
        $this->load->library('session');
        $this->load->helper('url');

        // App id and secret
        $app_id     = $this->config->item('facebook_app_id');
        $app_secret = $this->config->item('facebook_app_secret');

        // Initiate the Facebook SDK
        FacebookSession::setDefaultApplication($app_id, $app_secret);

        // Load correct helper depending or login type
        // that is set in the config
        if ($this->config->item('facebook_login_type') == 'js')
        {
            // Javascript helper
            $this->helper = new FacebookJavaScriptLoginHelper();
        }
        else if ($this->config->item('facebook_login_type') == 'canvas')
        {
            // Canvas helper
            $this->helper = new FacebookCanvasLoginHelper();
        }
        else if ($this->config->item('facebook_login_type') == 'web')
        {
            // Web helper (redirect)
            // Modified by Ivan Tcholakov, 18-APR-2015.
            //$this->helper = new FacebookRedirectLoginHelper(base_url() . $this->config->item('facebook_login_redirect_url'));
            $this->helper = new FacebookRedirectLoginHelper(site_url($this->config->item('facebook_login_redirect_url')));
        }

        // Create session right away if we have one
        $this->facebook_session();
    }

    // ------------------------------------------------------------------------

    /**
    * Check if user are logged in by checking if we have a Facebook
    * session active.
    *
    * @return  bool
    **/
    public function logged_in()
    {
        // Check if we have an active Facebook session
        if ($this->facebook_session())
        {
            // Session found
            return true;
        }

        // No session found
        return false;
    }

    // ------------------------------------------------------------------------

    /**
     * Generate Facebook login url for Facebook Redirect Login (web)
     *
     * @return  string
     */
    public function login_url()
    {
        // Login type must be web, else return empty string
        if ($this->config->item('facebook_login_type') != 'web')
        {
            return '';
        }

        // Create login url
        $url = $this->helper->getLoginUrl($this->config->item('facebook_permissions'));

        // Return login url
        return $url;
    }

    // ------------------------------------------------------------------------

    /**
     * Generate Facebook login url for Facebook Redirect Login (web)
     *
     * @return  string
     */
    public function logout_url()
    {
        // Login type must be web, else return empty string
        if ($this->config->item('facebook_login_type') != 'web')
        {
            return '';
        }

        // Get users facebook session
        $session = $this->facebook_session();

        // Can't generate link if we don't have a loaded helper
        // and active session
        if ( ! isset($this->helper) && ! isset($session))
        {
            return '';
        }

        // Create logout url
        // Modified by Ivan Tcholakov, 18-APR-2015.
        //$url = $this->helper->getLogoutUrl($session, base_url() . $this->config->item('facebook_logout_redirect_url'));
        $url = $this->helper->getLogoutUrl($session, site_url($this->config->item('facebook_logout_redirect_url')));
        //

        // Return logout url
        return $url;
    }

    // ------------------------------------------------------------------------

    /**
     * Destroy out Facebook token
     *
     * @return  string
     */
    public function destroy_session()
    {
        // Remove our Facebook token from session
        $this->session->unset_userdata('fb_token');
    }

    // ------------------------------------------------------------------------

    /**
    * Get user ID
    *
    * @return  array
    **/
    public function user_id()
    {
        // Get users facebook session
        $session = $this->facebook_session();

        // Continue only if we have a session
        if ($session)
        {
            try
            {
                // Get users ID
                $user = (new FacebookRequest($session, 'GET', '/me'))
                    ->execute()
                    ->getGraphObject()
                    ->asArray();

                // Return data
                return $this->response(200, 'success', array('user_id' => $user['id']));
            }
            catch(FacebookRequestException $e)
            {
                // Log error as debug
                log_message('debug', '[FACEBOOK PHP SDK - User ID] code: ' . $e->getCode().' | message: '.$e->getMessage());

                // Return error
                return $this->response($e->getCode(), $e->getMessage());
            }
        }

        return $this->response(463, 'Expired');
    }

    // ------------------------------------------------------------------------


    /**
    * Get all user details and accepted permissions list
    *
    * @return  array
    **/
    public function user()
    {
        // Get users facebook session
        $session = $this->facebook_session();

        // Continue only if we have a session
        if ($session)
        {
            try
            {
                // Get user details
                $user = (new FacebookRequest($session, 'GET', '/me'))
                    ->execute()
                    ->getGraphObject()
                    ->asArray();

                // Get users permissions list
                $user['permissions'] = (new FacebookRequest($session, 'GET', '/me/permissions'))
                    ->execute()
                    ->getGraphObject()
                    ->asArray();

                // Return data
                return $this->response(200, 'success', $user);
            }
            catch(FacebookRequestException $e)
            {
                // Log error as debug
                log_message('debug', '[FACEBOOK PHP SDK - User] code: ' . $e->getCode().' | message: '.$e->getMessage());

                // Return error
                return $this->response($e->getCode(), $e->getMessage());
            }
        }

        return $this->response(463, 'Expired');
    }

    // ------------------------------------------------------------------------

    /**
    * Retrieve a single post from users wall
    *
    * Required permission: read_stream
    *
    * @param   int     $id   Post ID
    *
    * @return  array
    **/
    public function get_post($id = NULL)
    {
        // ID required, exit if not provided
        if ( ! $id)
        {
            return array();
        }

        // Get users facebook session
        $session = $this->facebook_session();

        // Continue only if we have a session
        if ($session)
        {
            try
            {
                // Get post data
                $post = (new FacebookRequest($session, 'GET', '/'.$id))
                    ->execute()
                    ->getGraphObject()
                    ->asArray();

                // Return post data
                return $this->response(200, 'success', $post);
            }
            catch(FacebookRequestException $e)
            {
                // Log error as debug
                log_message('debug', '[FACEBOOK PHP SDK - Get post] code: ' . $e->getCode().' | message: '.$e->getMessage());

                // Return error
                return $this->response($e->getCode(), $e->getMessage());
            }
        }

        return $this->response(463, 'Expired');
    }

    // ------------------------------------------------------------------------

    /**
    * Publish a post to the users feed
    *
    * Required permission: publish_actions
    *
    * @param   string  $message  Message to publish
    *
    * @return  array
    **/
    public function publish_text($message = '')
    {
        // Get user facebook session
        $session = $this->facebook_session();

        // Continue only if we have a session
        if ($session)
        {
            try
            {
                // Publish post
                $response = (new FacebookRequest($session, 'POST', '/me/feed',
                        array(
                            'message' => $message
                        )
                    ))
                    ->execute()
                    ->getGraphObject()
                    ->asArray();

                // Return data
                return $this->response(200, 'success', array('post_id' => $response['id']));
            }
            catch(FacebookRequestException $e)
            {
                // Log error as debug
                log_message('debug', '[FACEBOOK PHP SDK - Publish text] code: ' . $e->getCode().' | message: '.$e->getMessage());

                // Return error
                return $this->response($e->getCode(), $e->getMessage());
            }
        }

        return $this->response(463, 'Expired');

    }

    // ------------------------------------------------------------------------

    /**
    * Publish (upload) a video to the users feed
    *
    * Required permission: publish_actions
    *
    * @param   string  $file         Path to video file
    * @param   string  $description  Video description text
    * @param   string  $title        Video title text
    *
    * @return  array
    **/
    public function publish_video($file = '', $description = '', $title = '')
    {
        // Get users facebook session
        $session = $this->facebook_session();

        if ($session)
        {
            try
            {
                // Publish video
                $response = (new FacebookRequest($session, 'POST', '/me/videos',
                        array(
                            'description' => $description,
                            'title'       => $title,
                            'source'      => '@'.$file
                        )
                    ))
                    ->execute()
                    ->getGraphObject()
                    ->asArray();

                // Return data
                return $this->response(200, 'success', array('video_id' => $response['id']));
            }
            catch(FacebookRequestException $e)
            {
                // Log error as debug
                log_message('debug', '[FACEBOOK PHP SDK - Publish video] code: ' . $e->getCode().' | message: '.$e->getMessage());

                // Return error
                return $this->response($e->getCode(), $e->getMessage());
            }
        }

        return $this->response(463, 'Expired');
    }

    // ------------------------------------------------------------------------

    /**
    * Publish image to users feed
    *
    * Supports externally hosted images only! No direct upload
    * to Facebook.com albums at this time.
    *
    * Required permission: publish_actions
    *
    * @param   string  $image    URL to image
    * @param   string  $message  Image description text
    *
    * @return  array
    **/
    public function publish_image($image = '', $message = '')
    {
        // Get users facebook session
        $session = $this->facebook_session();

        if ($session)
        {
            try
            {
                // Publish image
                $response = (new FacebookRequest($session, 'POST', '/me/photos',
                        array(
                            'url'     => $image,
                            'message' => $message
                        )
                    ))
                    ->execute()
                    ->getGraphObject()
                    ->asArray();

                // Return image ID
                return $this->response(200, 'success', array('image_id' => $response['id']));
            }
            catch(FacebookRequestException $e)
            {
                // Log error as debug
                log_message('debug', '[FACEBOOK PHP SDK - Publish image] code: ' . $e->getCode().' | message: '.$e->getMessage());

                // Return error
                return $this->response($e->getCode(), $e->getMessage());
            }
        }

        return $this->response(463, 'Expired');
    }

    // ------------------------------------------------------------------------

    /**
    * Checking if the user is already signed in with Facebook
    * and get the session data from the Facebook cookie or
    * our current if it is still valid
    *
    * @return  object
    **/
    private function facebook_session()
    {
        // Check if our own session token exists
        if ($this->session->userdata('fb_token'))
        {
            // Create new session for the token
            $session = new FacebookSession($this->session->userdata('fb_token'));

            // validate the access token to make sure it's still valid
            try
            {
                if (!$session->validate())
                {
                    // Not valid, create new session
                    $session = $this->get_new_session();
                }
            }
            catch (Exception $e)
            {
                // Error, create new session
                $session = $this->get_new_session();
            }
        }
        else
        {
            // We don't have a session, create a new
            $session = $this->get_new_session();
        }

        // Return session object data
        return $session;
    }

    // ------------------------------------------------------------------------

    /**
    * Get a new session from Facebook
    *
    * @return  object
    **/
    private function get_new_session()
    {
        try
        {
            // Get session from JS or Canvas helper
            if ($this->config->item('facebook_login_type') == 'js' OR $this->config->item('facebook_login_type') == 'canvas')
            {
                $session = $this->helper->getSession();
            }

            // Get session for redirect (web)
            else
            {
                $session = $this->helper->getSessionFromRedirect();
            }
        }
        catch (FacebookRequestException $e)
        {
            // Log error as debug
            log_message('debug', '[FACEBOOK PHP SDK - Get session FacebookRequestException] code: ' . $e->getCode().' | message: '.$e->getMessage());
        }
        catch (Exception $e)
        {
            // Log error as debug
            log_message('debug', '[FACEBOOK PHP SDK - Get session Exception] code: ' . $e->getCode().' | message: '.$e->getMessage());
        }

        // If we got a session we need to exchange it for
        // a long lived session.
        if (isset($session))
        {
            // Get long lived token
            $token = $session->getLongLivedSession()->getToken();

            // Create a new session with the long lived token
            $session = new FacebookSession($token);

            // Save the token to the current session
            $this->session->set_userdata('fb_token', $token);

            // Return the token
            return $token;
        }

        // Could not get a session, so return null
        return NULL;
    }

    // ------------------------------------------------------------------------

    /**
     * Format response
     *
     * @param   int      $code     Status code
     * @param   string   $message  Detailed response message
     * @param   array    $data     Any other data to include
     *
     * @return  array
     */
    private function response($code = 200, $message = 'Success', $data = array())
    {
        // Return ID
        $response = array(
            'code'    => $code,
            'message' => $message,
            'data'    => $data
        );

        return $response;
    }

    // ------------------------------------------------------------------------

    /**
    * Enables the use of CI super-global without having to define an extra variable.
    * I can't remember where I first saw this, so thank you if you are the original author.
    *
    * Copied from the Ion Auth library
    *
    * @access  public
    * @param   $var
    * @return  mixed
    */
    public function __get($var)
    {
        return get_instance()->$var;
    }


}
