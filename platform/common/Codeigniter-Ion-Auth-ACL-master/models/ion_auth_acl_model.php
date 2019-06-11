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
class Ion_auth_acl_model extends Ion_auth_model
{

    function __construct()
    {
        parent::__construct();

        $this->load->database();

        $this->lang->load('ion_auth_acl');

        $this->load->config('ion_auth_acl', TRUE);

        // initialize additional db tables data
        $this->tables  =	array_merge($this->tables, $this->config->item('tables', 'ion_auth_acl'));

        // initialize additional db join data
        $this->join     =   array_merge($this->join, $this->config->item('join', 'ion_auth_acl'));
    }

    /**
     * Create Permission
     *
     * @author Steve Goodwin
     * @param bool|FALSE $perm_key
     * @param string $perm_name
     * @return bool
     */
    public function create_permission($perm_key =  FALSE, $perm_name = '')
    {
        // bail if the permission key was not passed
        if( ! $perm_key)
        {
            $this->set_error('permissions_key_required');
            return FALSE;
        }

        // bail if the permission key already exists
        $existing_permissions = $this->db->get_where($this->tables['permissions'], array('perm_key' => $perm_key))->num_rows();
        if($existing_permissions !== 0)
        {
            $this->set_error('permissions_already_exists');
            return FALSE;
        }

        $data = array('perm_key'=>$perm_key,'perm_name'=>$perm_name);

        $this->trigger_events('extra_permission_set');

        // insert the new permission
        $this->db->insert($this->tables['permissions'], $data);
        $permission_id = $this->db->insert_id();

        // report success
        $this->set_message('permission_creation_successful');
        // return the brand new permission id
        return $permission_id;
    }

    /**
     * Update Permission
     *
     * @author Steve Goodwin
     * @param bool|FALSE $permission_id
     * @param bool|FALSE $perm_key
     * @param array $additional_data
     * @return bool
     */
    public function update_permission($permission_id = FALSE, $perm_key = FALSE, $additional_data = array())
    {
        if (empty($permission_id)) return FALSE;

        $data = array();

        if (!empty($perm_key))
        {
            // we are changing the perm key, so do some checks

            // bail if the perm key already exists
            $existing_permission = $this->db->get_where($this->tables['permissions'], array('perm_key' => $perm_key))->row();
            if(isset($existing_permission->id) && $existing_permission->id != $permission_id)
            {
                $this->set_error('permission_already_exists');
                return FALSE;
            }

            $data['perm_key'] = $perm_key;
        }

        // restrict change of perm key of the admin permission
        $permission = $this->db->get_where($this->tables['permissions'], array('id' => $permission_id))->row();
        if($this->config->item('admin_permission', 'ion_auth_acl') === $permission->perm_key && $perm_key !== $permission->perm_key)
        {
            $this->set_error('permission_key_admin_not_alter');
            return FALSE;
        }


        // IMPORTANT!! Third parameter was string type $description; this following code is to maintain backward compatibility
        // New projects should work with 3rd param as array
        if (is_string($additional_data)) $additional_data = array('perm_name' => $additional_data);


        // filter out any data passed that doesnt have a matching column in the permissions table
        // and merge the set permission data and the additional data
        if (!empty($additional_data)) $data = array_merge($this->_filter_data($this->tables['permissions'], $additional_data), $data);


        $this->db->update($this->tables['permissions'], $data, array('id' => $permission_id));

        $this->set_message('permission_update_successful');

        return TRUE;
    }

    /**
     * Remove Permission
     *
     * @author Steve Goodwin
     * @param bool|FALSE $permission_id
     * @return bool
     */
    public function remove_permission($permission_id = FALSE)
    {
        // bail if mandatory param not set
        if(!$permission_id || empty($permission_id))
        {
            return FALSE;
        }
        $permission = $this->permission($permission_id);
        if($permission->perm_key == $this->config->item('admin_permission', 'ion_auth_acl'))
        {
            $this->trigger_events(array('post_delete_permission', 'post_delete_permission_notallowed'));
            $this->set_error('permission_delete_notallowed');
            return FALSE;
        }

        $this->trigger_events('pre_delete_permission');

        $this->db->trans_begin();

        // remove all users from this permission
        $this->db->delete($this->tables['users_permissions'], array($this->join['permissions'] => $permission_id));
        // remove the permission itself
        $this->db->delete($this->tables['permissions'], array('id' => $permission_id));

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            $this->trigger_events(array('post_delete_permission', 'post_delete_permission_unsuccessful'));
            $this->set_error('permission_delete_unsuccessful');
            return FALSE;
        }

        $this->db->trans_commit();

        $this->trigger_events(array('post_delete_permission', 'post_delete_permission_successful'));
        $this->set_message('permission_delete_successful');
        return TRUE;
    }

    /**
     * Get User Groups
     *
     * Returns an ID based list of a specific users groups.
     *
     * @author Steve Goodwin
     * @param bool|FALSE $user_id
     * @return array
     */
    public function get_user_groups($user_id = FALSE)
    {
        $this->trigger_events('get_user_groups');

        $users_groups   =   array();

        foreach( $this->get_users_groups($user_id)->result() as $group )
            $users_groups[] = $group->id;

        return $users_groups;
    }

    /**
     * Get Groups
     *
     * Returns all groups in a formatted list.
     *
     * @author Steve Goodwin
     * @param string $format
     * @return array
     */
    public function get_groups($format = 'ids')
    {
        $this->trigger_events('get_groups');

        $groups     =   array();

        foreach( $this->groups()->result() as $group )
            if( $format == 'full' )
                $groups[]   =   array('id' => $group->id, 'name' => $group->name);
            else
                $groups[]   =   $group->id;

        return $groups;
    }

    /**
     * Permissions
     *
     * Returns all permissions in a formatted list.
     *
     * @param string $format
     * @param string $key
     * @return array
     */
    public function permissions($format = 'ids', $key = 'id')
    {
        $this->trigger_events('permissions');

        $this->db->order_by('perm_name', 'ASC');

        $query      =   $this->db->get($this->tables['permissions']);
        $result     =   $query->result();

        $permissions    =   array();

        foreach( $result as $permission )
            if( $format == 'full' )
                $permissions[$permission->{$key}]   =   array('id' => $permission->id, 'key' => $permission->perm_key, 'name' => $permission->perm_name);
            else
                $permissions[]   =   $permission->id;

        return $permissions;
    }

    /**
     * Permission
     *
     * Returns a specific permission based on a permission ID.
     *
     * @author Steve Goodwin
     * @param bool|FALSE $id
     * @return bool
     */
    public function permission($id = FALSE)
    {
        $this->trigger_events('permission');

        if( ! $id ) return FALSE;

        $this->db->where('id', $id);

        return $this->db->get($this->tables['permissions'])->row();
    }

    /**
     * Get User Permissions
     *
     * Returns a formatted list of user permissions.
     *
     * @param bool|FALSE $user_id
     * @return array
     */
    public function get_user_permissions($user_id = FALSE)
    {
        $this->trigger_events('get_user_permissions');

        // if no id was passed use the current users id
        $user_id || $user_id = $this->session->userdata('user_id');

        $this->db->where('user_id', $user_id);
        $this->db->order_by('created_at', 'ASC');

        $query  =   $this->db->get($this->tables['users_permissions']);

        $permissions            =   $this->permissions('full');
        $user_permissions       =   array();

        foreach( $query->result() as $perm )
        {
            $permission   =   ( array_key_exists($perm->perm_id, $permissions) ) ? $permissions[$perm->perm_id] : FALSE;

            if( ! $permission ) continue;

            $user_permissions[$permission['key']]     =   array(
                'id'            =>  $permission['id'],
                'name'          =>  $permission['name'],
                'key'           =>  $permission['key'],
                'inherited'     =>  FALSE,
                'value'         =>  ($perm->value == '1') ? TRUE : FALSE
            );
        }

        return $user_permissions;
    }

    /**
     * Add Permission To User
     *
     * @author Steve Goodwin
     * @param bool|FALSE $group_id
     * @param bool|FALSE $perm_id
     * @param int $value
     * @return bool
     */
    public function add_permission_to_user($user_id = FALSE, $perm_id = FALSE, $value = 0)
    {
        // bail if the user id & permission id were not passed
        if( ! $user_id)
        {
            $this->set_error('user_permissions_user_id_required');
            return FALSE;
        }

        if( ! $perm_id)
        {
            $this->set_error('user_permissions_permission_id_required');
            return FALSE;
        }

        $data   =   array('user_id' => $user_id, 'perm_id' => $perm_id);

        $existing_group_permission  =   $this->db->get_where($this->tables['users_permissions'], $data)->num_rows();

        $data['created_at']     =   strtotime('now');
        $data['updated_at']     =   strtotime('now');
        $data['value']          =   $value;

        $this->db->trans_start();

        if( $existing_group_permission )
            $this->db->replace($this->tables['users_permissions'], $data);
        else
            $this->db->insert($this->tables['users_permissions'], $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            $this->set_message('user_permission_add_unsuccessful');
            return FALSE;
        }
        else
        {
            $this->set_message('user_permission_add_successful');
            return TRUE;
        }
    }

    /**
     * Remove Permission From User
     *
     * @author Steve Goodwin
     * @param bool|FALSE $user_id
     * @param bool|FALSE $perm_id
     * @return bool
     */
    public function remove_permission_from_user($user_id = FALSE, $perm_id = FALSE)
    {
        // bail if the user id was not passed
        if( ! $user_id)
        {
            $this->set_error('user_permissions_user_id_required');
            return FALSE;
        }

        if( ! $perm_id)
        {
            $this->set_error('user_permissions_permission_id_required');
            return FALSE;
        }

        $this->trigger_events('pre_delete_user_permission');

        $this->db->trans_begin();

        // remove permission from the user
        if( ! $this->db->delete($this->tables['users_permissions'], array('user_id' => $user_id, 'perm_id' => $perm_id)) )
        {
            $this->trigger_events(array('post_delete_user_permission', 'post_delete_user_permission_unsuccessful'));
            $this->set_error('user_permission_delete_unsuccessful');
            return FALSE;
        }
        else
        {
            $this->trigger_events(array('post_delete_user_permission', 'post_delete_user_permission_successful'));
            $this->set_message('user_permission_delete_successful');
            return TRUE;
        }
    }

    /**
     * Add Permission To Group
     *
     * @author Steve Goodwin
     * @param bool|FALSE $group_id
     * @param bool|FALSE $perm_id
     * @param int $value
     * @return bool
     */
    public function add_permission_to_group($group_id = FALSE, $perm_id = FALSE, $value = 0)
    {
        // bail if the group id & permission id were not passed
        if( ! $group_id)
        {
            $this->set_error('group_permissions_group_id_required');
            return FALSE;
        }

        if( ! $perm_id)
        {
            $this->set_error('group_permissions_permission_id_required');
            return FALSE;
        }

        $data   =   array('group_id' => $group_id, 'perm_id' => $perm_id);

        $existing_group_permission  =   $this->db->get_where($this->tables['group_permissions'], $data)->num_rows();

        $data['created_at']     =   strtotime('now');
        $data['updated_at']     =   strtotime('now');
        $data['value']          =   $value;

        $this->db->trans_start();

        if( $existing_group_permission )
            $this->db->replace($this->tables['group_permissions'], $data);
        else
            $this->db->insert($this->tables['group_permissions'], $data);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            $this->set_message('group_permission_add_unsuccessful');
            return FALSE;
        }
        else
        {
            $this->set_message('group_permission_add_successful');
            return TRUE;
        }
    }

    /**
     * Remove Permission From Group
     *
     * @author Steve Goodwin
     * @param bool|FALSE $group_id
     * @param bool|FALSE $perm_id
     * @return bool
     */
    public function remove_permission_from_group($group_id = FALSE, $perm_id = FALSE)
    {
        // bail if the group id & permission id were not passed
        if( ! $group_id)
        {
            $this->set_error('group_permissions_group_id_required');
            return FALSE;
        }

        if( ! $perm_id)
        {
            $this->set_error('group_permissions_permission_id_required');
            return FALSE;
        }

        $this->trigger_events('pre_delete_group_permission');

        $this->db->trans_begin();
        
        // remove permission from the group
        $this->db->delete($this->tables['group_permissions'], array('group_id' => $group_id, 'perm_id' => $perm_id));
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE)
        {
            $this->trigger_events(array('post_delete_group_permission', 'post_delete_group_permission_unsuccessful'));
            $this->set_error('group_permission_delete_unsuccessful');
            return FALSE;
        }
        else
        {
            $this->trigger_events(array('post_delete_group_permission', 'post_delete_group_permission_successful'));
            $this->set_message('group_permission_delete_successful');
            return TRUE;
        }
    }

    /**
     * Get Group Permissions
     *
     * Returns a formatted list of group permissions.
     *
     * @param mixed|FALSE $group_id
     * @return array
     */
    public function get_group_permissions($group_id = FALSE)
    {
        $this->trigger_events('get_group_permissions');

        //  Try to get the currently logged in users groups if none supplied
        if( ! $group_id )
            foreach($this->get_users_groups()->result() as $group)
                $group_id[]     =   $group->id;

        //  Still No groups then theres nothing to do!
        if( ! $group_id )
            return FALSE;

        if( is_array($group_id) )
            $this->db->where_in('group_id', $group_id);
        else
            $this->db->where('group_id', $group_id);

        $query = $this->db->order_by('id', 'asc')
            ->get($this->tables['group_permissions']);

        $permissions            =   $this->permissions('full');
        $group_permissions	    =	array();

        foreach( $query->result() as $perm )
        {
            $permission	=	( array_key_exists($perm->perm_id, $permissions) ) ? $permissions[$perm->perm_id] : FALSE;

            if( ! $permission ) continue;

            $group_permissions[$permission['key']]	=	array(
                'id'				=>	$permission['id'],
                'name'				=>	$permission['name'],
                'key'				=>	$permission['key'],
                'inherited'		    =>	TRUE,
                'value'				=>	($perm->value === '1') ? TRUE : FALSE,
            );
        }

        return $group_permissions;
    }

    /**
     * Build ACL
     *
     * Gets all user & group permissions and merges them to build a full
     * list of permissions a specific user.
     *
     * @author Steve Goodwin
     * @param bool|FALSE $user_id
     * @return array
     */
    public function build_acl($user_id = FALSE)
    {
        $user_permissions   =   $this->get_user_permissions($user_id);
        $user_groups        =   $this->get_user_groups($user_id);
        $group_permissions  =   $this->get_group_permissions($user_groups);

        $permissions    =   array();

        if (count($user_groups) > 0)
            $permissions    =   array_merge($permissions, $group_permissions);

        $permissions    =   array_merge($permissions, $user_permissions);

        return $permissions;
    }

}
