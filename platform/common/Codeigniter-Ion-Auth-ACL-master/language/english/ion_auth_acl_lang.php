<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Name:  Ion Auth ACL - English
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

// Permissions
$lang['permission_key_required']                    =   'Permission key is a required field';
$lang['permission_already_exists']                  =   'Permission key is already taken';
$lang['permission_creation_successful']             =   'Permission created successfully';
$lang['permission_update_successful']               =   'Permission updated successfully';
$lang['permission_delete_unsuccessful']             =   'Unable to delete permission';
$lang['permission_already_exists']                  =   'Permission key already exists';
$lang['permission_key_admin_not_alter']             =   'Admin permission key cannot be changed';
$lang['permission_delete_notallowed']               =   'Can\'t delete the administrators\' permission';

// Group Permissions
$lang['group_permissions_group_id_required']        =   'Group ID is a required field';
$lang['group_permissions_permission_id_required']   =   'Permission ID is a required field';
$lang['group_permissions_value_required']           =   'Value is a required field';
$lang['group_permission_add_unsuccessful']          =   'Permission could not be added to this group';
$lang['group_permission_delete_unsuccessful']       =   'Permission could not be removed from this group';
$lang['group_permission_delete_successful']         =   'Permission was successfully removed from this group';

// User Permissions
$lang['user_permissions_user_id_required']          =   'User ID is a required field';
$lang['user_permissions_permission_id_required']    =   'Permission ID is a required field';
$lang['user_permissions_value_required']            =   'Value is a required field';
$lang['user_permission_add_unsuccessful']           =   'Permission could not be added to this user';
$lang['user_permission_delete_unsuccessful']        =   'Permission could not be removed from this user';
$lang['user_permission_delete_successful']          =   'Permission was successfully removed from this user';
