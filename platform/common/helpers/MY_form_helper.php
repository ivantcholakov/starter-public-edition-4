<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if (!function_exists('form_ckeditor')) {

    // Added by Ivan Tcholakov, 20-FEB-2016.
    function form_ckeditor($name, $value = null, $config_name = null, $options = array(), $events = array()) {

        $config_name = trim(@ (string) $config_name);

        if ($config_name == '') {
            $config_name = 'user';
        }

        $config = CKEditorConfig::get($config_name);

        if (empty($config)) {

            // Avoid these defaults, make sure that a configuration file exists.
            $config = array();

            $config['basePath'] = DEFAULT_BASE_URL.'assets/js/ckeditor/';
            $config['config']['baseHref'] = http_build_url(DEFAULT_BASE_URL.'../');
            $config['config']['fullPage'] = false;
            $config['config']['language'] = language_ckeditor();
            $config['config']['defaultLanguage'] = 'en';
            $config['config']['contentsLanguage'] = language_ckeditor();
            $config['config']['contentsLangDirection'] = get_instance()->lang->direction();

            $config['config']['contentsCss'][] = DEFAULT_BASE_URL.'assets/css/lib/editor.css';

            $config['config']['width'] = '';
            $config['config']['height'] = '100';
            $config['config']['resize_enabled'] = false;
            $config['textareaAttributes'] = array('rows' => 8, 'cols' => 60);

            $config['config']['entities_latin'] = false;
            $config['config']['entities_greek'] = false;

            $config['config']['forcePasteAsPlainText'] = true;
            $config['config']['toolbarCanCollapse'] = false;

            $config['config']['allowedContent'] = true;
        }

        $initialized = true;

        if (is_object($options)) {
            $options = get_object_vars($object);
        }

        if (!empty($options) && is_array($options)) {

            if (isset($options['initialized'])) {

                $initialized = !empty($options['initialized']);
                unset($options['initialized']);
            }

            if (isset($options['basePath'])) {
                unset($options['basePath']);
            }

            if (isset($options['textareaAttributes'])) {

                if (is_object($options['textareaAttributes'])) {
                    $options['textareaAttributes'] = get_object_vars($options['textareaAttributes']);
                }

                if (is_array($options['textareaAttributes'])) {
                    $config['textareaAttributes'] = $options['textareaAttributes'];
                }

                unset($options['textareaAttributes']);
            }

            if (!empty($options)) {
                $config['config'] = array_merge($config['config'], $options);
            }
        }

        $ckeditor = new CKEditor($config['basePath']);
        $ckeditor->returnOutput = true;
        $ckeditor->initialized = $initialized;
        $ckeditor->textareaAttributes = $config['textareaAttributes'];

        // Repopulate the value when form validation fails.

        $CI = get_instance();

        $value_editor = (isset($CI->form_validation) && is_object($CI->form_validation) && $CI->form_validation->has_rule($name))
            ? $CI->form_validation->set_value($name, $value)
            : $CI->input->post($name, FALSE);

        isset($value_editor) OR $value_editor = $value;

        return $ckeditor->editor($name, $value_editor, $config['config'], $events);
    }

}

if (!function_exists('form_per_page')) {

    // For serving pagination: A select box for choosing number of items to be shown per page.
    function form_per_page($name = null, $options = null, $selected = null, $extra_attributes = null, $min = null, $max = null) {

        $ci = get_instance();

        if (empty($options) || !is_array($options)) {
            $options = array(5, 10, 20, 30, 40, 50, 100, 200, 300, 400, 500, 1000);
        }

        $min = (int) $min;

        if ($min <= 0) {
            $min = $options[0];
        }

        $all = $max == 'all';

        $max = (int) $max;

        if ($max <= 0) {
            $max = $options[count($options) - 1];
        }

        if ($max < $min) {
            $max = $min;
        }

        $result_options = array();

        foreach ($options as $option) {

            if ($option >= $min && $option <= $max) {
                $result_options[(string) $option] = $ci->lang->line('ui_per_page', $option);
            }
        }

        if ($all) {
            $result_options['all'] = '-- '.$ci->lang->line('ui_all').' --';
        }

        return form_dropdown($name, $result_options, $selected, $extra_attributes);
    }

}

//------------------------------------------------------------------------------

if ( ! function_exists('form_open'))
{
    /**
     * Form Declaration
     *
     * Creates the opening portion of the form.
     *
     * @param       string      the URI segments of the form destination
     * @param       array       a key/value pair of attributes
     * @param       array       a key/value pair hidden data
     * @return      string
     */
    function form_open($action = '', $attributes = array(), $hidden = array())
    {
        $CI =& get_instance();

        // If no action is provided then set to the current url
        if ( ! $action)
        {
            // Modified by Ivan Tcholakov, 23-FEB-2015.
            //$action = $CI->config->site_url($CI->uri->uri_string());
            $action = CURRENT_URL;
            //
        }
        // If an action is not a full URL then turn it into one
        elseif (strpos($action, '://') === FALSE)
        {
            $action = $CI->config->site_url($action);
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
        //if ($CI->config->item('csrf_protection') === TRUE && strpos($action, $CI->config->base_url()) !== FALSE && ! stripos($form, 'method="get"'))
        // Aways add the hidden value for protecting AJAX requests, when the global configuration option 'csrf_protection' is off.
        if (strpos($action, $CI->config->base_url()) !== FALSE && ! stripos($form, 'method="get"'))        //
        {
            $hidden[$CI->security->get_csrf_token_name()] = $CI->security->get_csrf_hash();
        }

        if (is_array($hidden))
        {
            foreach ($hidden as $name => $value)
            {
                $form .= '<input type="hidden" name="'.$name.'" value="'.form_prep($value).'" style="display:none;" />'."\n";
            }
        }

        return $form;
    }
}

if ( ! function_exists('has_validation_error'))
{
    // Added by Ivan Tcholakov, 20-OCT-2015.
    /**
     * This function informs whether there is at least one error after validation.
     * @return bool     TRUE if there is an error (or errors), FALSE otherwise.
     */
    function has_validation_error()
    {
        if (FALSE === ($OBJ =& _get_validation_object()))
        {
            return FALSE;
        }

        return $OBJ->has_error();
    }
}

if ( ! function_exists('validation_errors_array'))
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

if ( ! function_exists('build_validation_message'))
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

if ( ! function_exists('form_value'))
{
    /**
     * Form Value (Raw)
     *
     * Grabs a value from the POST array for the specified field so you can
     * re-populate fields in some special or cutting-edge cases. If Form Validation
     * is active it retrieves the info from the validation class.
     *
     * Important: The result is not HTML-escaped or HTML-attribute-escaped,
     * you might need to do it additionaly according to the context of usage.
     *
     * @param       string      $field          Field name
     * @param       string      $default        Default value
     * @return      string
     * @deprecated
     */
    function form_value($field, $default = '')
    {
        return set_value($field, $default, FALSE);
    }
}


// Functions for BC compatibility with CI development before 21-JAN-2015.
// See: https://github.com/bcit-ci/CodeIgniter/issues/1953
// See: https://github.com/bcit-ci/CodeIgniter/issues/2477
// ------------------------------------------------------------------------

if ( ! function_exists('form_hidden'))
{
    /**
     * Hidden Input Field
     *
     * Generates hidden fields. You can pass a simple key/value string or
     * an associative array with multiple values.
     *
     * @param       mixed       $name           Field name
     * @param       string      $value          Field value
     * @param       bool        $recursing
     * @return      string
     */
    function form_hidden($name, $value = '', $recursing = FALSE)
    {
        static $form;

        if ($recursing === FALSE)
        {
            $form = "\n";
        }

        if (is_array($name))
        {
            foreach ($name as $key => $val)
            {
                form_hidden($key, $val, TRUE);
            }

            return $form;
        }

        if ( ! is_array($value))
        {
            $form .= '<input type="hidden" name="'.$name.'" value="'.form_prep($value)."\" />\n";
        }
        else
        {
            foreach ($value as $k => $v)
            {
                $k = is_int($k) ? '' : $k;
                form_hidden($name.'['.$k.']', $v, TRUE);
            }
        }

        return $form;
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('form_textarea'))
{
    /**
     * Textarea field
     *
     * @param       mixed       $data
     * @param       string      $value
     * @param       string      $extra
     * @return      string
     */
    function form_textarea($data = '', $value = '', $extra = '')
    {
        $defaults = array(
            'name' => is_array($data) ? '' : $data,
            'cols' => '40',
            'rows' => '10'
        );

        if ( ! is_array($data) OR ! isset($data['value']))
        {
            $val = $value;
        }
        else
        {
            $val = $data['value'];
            unset($data['value']); // textareas don't use the value attribute
        }

        return '<textarea '._parse_form_attributes($data, $defaults)._attributes_to_string($extra).'>'.form_prep($val, TRUE)."</textarea>\n";
    }
}

// --------------------------------------------------------------------

if ( ! function_exists('form_dropdown'))
{
    /**
     * Drop-down Menu
     *
     * @param       mixed       $data
     * @param       mixed       $options
     * @param       mixed       $selected
     * @param       mixed       $extra
     * @return      string
     */
    function form_dropdown($data = '', $options = array(), $selected = array(), $extra = '')
    {
        $defaults = array();

        if (is_array($data))
        {
            if (isset($data['selected']))
            {
                $selected = $data['selected'];
                unset($data['selected']); // select tags don't have a selected attribute
            }

            if (isset($data['options']))
            {
                $options = $data['options'];
                unset($data['options']); // select tags don't use an options attribute
            }
        }
        else
        {
            $defaults = array('name' => $data);
        }

        is_array($selected) OR $selected = array($selected);
        is_array($options) OR $options = array($options);

        // If no selected state was submitted we will attempt to set it automatically
        if (empty($selected))
        {
            if (is_array($data))
            {
                if (isset($data['name'], $_POST[$data['name']]))
                {
                    $selected = array($_POST[$data['name']]);
                }
            }
            elseif (isset($_POST[$data]))
            {
                $selected = array($_POST[$data]);
            }
        }

        $extra = _attributes_to_string($extra);

        $multiple = (count($selected) > 1 && stripos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

        $form = '<select '.rtrim(_parse_form_attributes($data, $defaults)).$extra.$multiple.">\n";

        foreach ($options as $key => $val)
        {
            $key = (string) $key;

            if (is_array($val))
            {
                if (empty($val))
                {
                    continue;
                }

                $form .= '<optgroup label="'.$key."\">\n";

                foreach ($val as $optgroup_key => $optgroup_val)
                {
                    $sel = in_array($optgroup_key, $selected) ? ' selected="selected"' : '';
                    $form .= '<option value="'.form_prep($optgroup_key).'"'.$sel.'>'
                        .(string) $optgroup_val."</option>\n";
                }

                $form .= "</optgroup>\n";
            }
            else
            {
                $form .= '<option value="'.form_prep($key).'"'
                    .(in_array($key, $selected) ? ' selected="selected"' : '').'>'
                    .(string) $val."</option>\n";
            }
        }

        return $form."</select>\n";
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('form_prep'))
{
    /**
     * Form Prep
     *
     * Formats text so that it can be safely placed in a form field in the event it has HTML tags.
     *
     * @param       string|string[]     $str                Value to escape
     * @param       bool                $is_textarea        Whether we're escaping for a textarea element
     * @return      string|string[]                         Escaped values
     */
    function form_prep($str = '', $is_textarea = FALSE)
    {
        if (is_array($str))
        {
            foreach (array_keys($str) as $key)
            {
                $str[$key] = form_prep($str[$key], $is_textarea);
            }

            return $str;
        }

        if ($is_textarea === TRUE)
        {
            return html_escape($str);
        }

        return str_replace(array("'", '"'), array('&#39;', '&quot;'), html_escape($str));
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('set_value'))
{
    /**
     * Form Value
     *
     * Grabs a value from the POST array for the specified field so you can
     * re-populate an input field or textarea. If Form Validation
     * is active it retrieves the info from the validation class
     *
     * @param       string      $field          Field name
     * @param       string      $default        Default value
     * @param       bool        $escape         Whether to escape HTML/attribute or not: TRUE/'html' = html escape, 'attr' = attribute escape, FALSE = no escape.
     * @return      string
     */
    function set_value($field = '', $default = '', $escape = 'attr')
    {
        $CI =& get_instance();

        $value = (isset($CI->form_validation) && is_object($CI->form_validation) && $CI->form_validation->has_rule($field))
            ? $CI->form_validation->set_value($field, $default)
            : $CI->input->post($field, FALSE);

        isset($value) OR $value = $default;

        if ($escape === FALSE)
        {
            return $value;
        }
        elseif ($escape === 'attr')
        {
            return str_replace(array("'", '"'), array('&#39;', '&quot;'), html_escape($value));
        }

        return html_escape($value);
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('_parse_form_attributes'))
{
    /**
     * Parse the form attributes
     *
     * Helper function used by some of the form helpers
     *
     * @param       array       $attributes     List of attributes
     * @param       array       $default        Default values
     * @return      string
     */
    function _parse_form_attributes($attributes, $default)
    {
        if (is_array($attributes))
        {
            foreach ($default as $key => $val)
            {
                if (isset($attributes[$key]))
                {
                    $default[$key] = $attributes[$key];
                    unset($attributes[$key]);
                }
            }

            if (count($attributes) > 0)
            {
                $default = array_merge($default, $attributes);
            }
        }

        $att = '';

        foreach ($default as $key => $val)
        {
            if ($key === 'value')
            {
                $val = form_prep($val);
            }
            elseif ($key === 'name' && ! strlen($default['name']))
            {
                continue;
            }

            $att .= $key.'="'.$val.'" ';
        }

        return $att;
    }
}

// ------------------------------------------------------------------------
// End BC functions
