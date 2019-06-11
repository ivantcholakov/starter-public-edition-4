<?php (defined('BASEPATH')) OR exit('No direct script access allowed');
/**
 * Name:  Ion Auth ACL
 *
 * Version: 1.0.0
 *
 * Author: Steve Goodwin
 *		   steve@weblogics.co.uk
 *         @steveg1987
 *
 * Location: http://github.com/steve-goodwin/ion_auth_acl
 *
 * Created:  18.09.2015
 *
 * Description:  Add's ACL (access control list) based on the existing Ion Auth library for codeigniter
 *
 * Requirements: PHP5 or above
 *
 */
class Ion_auth_acl
{
    protected $user_id              =   FALSE;
    protected $user_permissions     =   array();
    protected $user_groups          =   array();

    function __construct(array $config = array())
    {
        $this->load->model('ion_auth_acl_model');

        if (count($config) > 0)
            foreach ($config as $key => $val)
                $this->{$key} = $val;
        else
            $this->user_id = ( $this->ion_auth->logged_in() ) ? $this->ion_auth->user()->row()->id : FALSE;

        if( $this->ion_auth->logged_in() )
        {
            $this->user_groups          =   $this->get_user_groups($this->user_id);
            $this->user_permissions     =   $this->build_acl();
        }
    }

    /**
     * __call
     *
     * Acts as a simple way to call model methods without loads of stupid alias'
     *
     **/
    public function __call($method, $arguments)
    {
        if (!method_exists( $this->ion_auth_acl_model, $method) )
            throw new Exception('Undefined method Ion_auth_acl::' . $method . '() called');

        return call_user_func_array( array($this->ion_auth_acl_model, $method), $arguments);
    }

    /**
     * __get
     *
     * Enables the use of CI super-global without having to define an extra variable.
     *
     * I can't remember where I first saw this, so thank you if you are the original author. -Militis
     *
     * @access	public
     * @param	$var
     * @return	mixed
     */
    public function __get($var)
    {
        return get_instance()->$var;
    }

    /**
     * Has Permission
     *
     * Checks to see if a user should be granted a permission or not.
     *
     * @author Steve Goodwin
     * @param bool|FALSE $key
     * @param array $permissions
     * @return bool
     */
    public function has_permission($key = FALSE, $permissions = array())
    {
        if( ! $key ) return FALSE;

        $permissions || $permissions = $this->user_permissions;

        $key    =   strtolower($key);

        if( array_key_exists($key, $permissions) )
            return ( $permissions[$key]['value'] === '1' || $permissions[$key]['value'] === TRUE ) ? TRUE : FALSE;
        else
            return FALSE;
    }

    /**
     * Is Allowed
     *
     * Checks to see if a permission should be allowed.
     *
     * @author Steve Goodwin
     * @param bool|FALSE $key
     * @param array $permissions
     * @return bool
     */
    public function is_allowed($key = FALSE, $permissions = array())
    {
        if( ! $key ) return FALSE;

        $permissions || $permissions = $this->user_permissions;

        return ( $this->has_permission($key, $permissions) && ! $this->is_inherited($key, $permissions) ) ? TRUE : FALSE;
    }

    /**
     * Is Deny
     *
     * Checks to see if a permission should be denied.
     *
     * @author Steve Goodwin
     * @param bool|FALSE $key
     * @param array $permissions
     * @return bool
     */
    public function is_denied($key = FALSE, $permissions = array())
    {
        if( ! $key ) return FALSE;

        $permissions || $permissions = $this->user_permissions;

        if( array_key_exists($key, $permissions) )
            return ( $permissions[$key]['value'] === FALSE && $permissions[$key]['inherited'] != TRUE) ? TRUE : FALSE;
        else
            return FALSE;
    }

    /**
     * Is Inherited
     *
     * Checks to see if a permission is inherited or not.
     *
     * @author Steve Goodwin
     * @param bool|FALSE $key
     * @param array $permissions
     * @param string $sub_key
     * @return bool
     */
    public function is_inherited($key = FALSE, $permissions = array(), $sub_key = 'inherited')
    {
        if( ! $key ) return FALSE;

        $permissions || $permissions = $this->user_permissions;

        if( array_key_exists($key, $permissions) )
            return ( $permissions[$key][$sub_key] === TRUE ) ? TRUE : FALSE;
        else
            return FALSE;
    }

}
