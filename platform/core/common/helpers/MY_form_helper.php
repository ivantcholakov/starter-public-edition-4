<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('form_open'))
{
    function form_open($action = '', $attributes = array(), $hidden = array())
    {
        $CI =& get_instance();

        // If an action is not a full URL then turn it into one
        if ($action && strpos($action, '://') === FALSE)
        {
                $action = $CI->config->site_url($action);
        }
        elseif ( ! $action)
        {
            // If no action is provided then set to the current url
            $action = $CI->config->site_url($CI->uri->uri_string());
        }

        $attributes = _attributes_to_string($attributes);

        if (stripos($attributes, 'method=') === FALSE)
        {
            $attributes .= ' method="post"';
        }

        if (stripos($attributes, 'accept-charset=') === FALSE)
        {
            $attributes .= ' accept-charset="'.strtolower(config_item('charset')).'"';
        }

        $form = '<form action="'.$action.'"'.$attributes.">\n";

        // Add CSRF field if enabled, but leave it out for GET requests and requests to external websites
        // Modified by Ivan Tcholakov, 04-NOV-2011.
        //if ($CI->config->item('csrf_protection') === TRUE && ! (strpos($action, $CI->config->base_url()) === FALSE OR stripos($form, 'method="get"') !== FALSE))
        // Aways add the hidden value for protecting AJAX requests, when the global configuration option 'csrf_protection' is off.
        if ( ! (strpos($action, $CI->config->site_url()) === FALSE OR stripos($form, 'method="get"') !== FALSE))
        //
        {
                $hidden[$CI->security->get_csrf_token_name()] = $CI->security->get_csrf_hash();
        }

            if (is_array($hidden) && count($hidden) > 0)
        {
                $form .= '<div style="display:none;">'.form_hidden($hidden).'</div>';
        }

        return $form;
    }
}

if (!function_exists('validation_errors_array'))
{
    function validation_errors_array()
    {
        if (FALSE === ($OBJ =& _get_validation_object()))
        {
            return array();
        }

        return $OBJ->error_array();
    }
}

if (!function_exists('build_validation_message'))
{
    /*
     * This function might be useful for client-side validation - preparing messages.
     * Sample JavaScript fragment for jQuery Validation Plugin:
     * ...
     * messages: {
     *     name: {
     *        required: <?php echo json_encode(build_validation_message('required', $this->lang->line('ui_title'))); ?>
     *     },
     * },
     * ...
     */
    function build_validation_message($rule, $field = NULL, $param = NULL)
    {
        get_instance()->lang->load('form_validation');

        $line = get_instance()->lang->line('form_validation_'.$rule);

        return str_replace(array('{field}', '{param}'), array($field, $param), $line);
    }
}
