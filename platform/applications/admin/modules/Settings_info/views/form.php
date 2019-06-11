<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
                <div class="col-md-12">
                  <div class="card sameheight-item items" data-exclude="xs,sm,lg">
                    <div class="card-header bordered">
                      <div class="header-block">
                        <h3 class="title"><?php echo lang('admin disputes all_dispute'); ?></h3>
                      </div>
                   </div>
                   <div class="card-block">
                     <div class="row">

<?php echo form_open('', array('role'=>'form')); ?>

    <?php foreach ($settings as $setting) : ?>

        <?php // prepare field settings
        $field_data = array();

        if ($setting['is_numeric'])
        {
            $field_data['type'] = "number";
            $field_data['step'] = "any";
        }

        if ($setting['options'])
        {
            $field_options = array();
            if ($setting['input_type'] == "dropdown")
            {
                $field_options[''] = lang('admin input select');
            }
            $lines = explode("\n", $setting['options']);
            foreach ($lines as $line)
            {
                $option = explode("|", $line);
                $field_options[$option[0]] = $option[1];
            }
        }

        switch ($setting['input_size'])
        {
            case "small":
                $col_size = "col-sm-3";
                break;
            case "medium":
                $col_size = "col-sm-6";
                break;
            case "large":
                $col_size = "col-sm-9";
                break;
            default:
                $col_size = "col-sm-6";
        }

        if ($setting['input_type'] == 'textarea')
        {
            $col_size = "col-sm-12";
        }
        ?>

        <?php if ($setting['translate'] && $this->session->languages && $this->session->language) : ?>

            <?php // has translations ?>
            <?php
            $setting['value'] = (@unserialize($setting['value']) !== FALSE) ? unserialize($setting['value']) : $setting['value'];
            if ( ! is_array($setting['value']))
            {
                $old_value = $setting['value'];
                $setting['value'] = array();
                foreach ($this->session->languages as $language_key=>$language_name)
                {
                    $setting['value'][$language_key] = ($language_key == $this->session->language) ? $old_value : "";
                }
            }
            ?>

                <div class="form-group <?php echo $col_size; ?><?php echo form_error($setting['name']) ? ' has-error' : ''; ?>">
                    <?php echo form_label($setting['label'], $setting['name'], array('class'=>'control-label')); ?>
                    <?php if (strpos($setting['validation'], 'required') !== FALSE) : ?>
                        <span class="required">*</span>
                    <?php endif; ?>
                    <div role="tabpanel">
                        <ul class="nav nav-tabs" role="tablist">
                            <?php foreach ($this->session->languages as $language_key=>$language_name) : ?>
                                <li role="presentation" class="<?php echo ($language_key == $this->session->language) ? 'active' : ''; ?>"><a href="#<?php echo $language_key; ?>" aria-controls="<?php echo $language_key; ?>" role="tab" data-toggle="tab"><?php echo $language_name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>

                        <div class="tab-content">
                            <?php foreach ($this->session->languages as $language_key=>$language_name) : ?>
                                <div role="tabpanel" class="tab-pane<?php echo ($language_key == $this->session->language) ? ' active' : ''; ?>" id="<?php echo $language_key; ?>">
                                    <br />
                                    <?php
                                    $field_data['name']  = $setting['name'] . "[" . $language_key . "]";
                                    $field_data['id']    = $setting['name'] . "-" . $language_key;
                                    $field_data['class'] = "form-control underlined" . (($setting['show_editor']) ? " editor" : "");
                                    $field_data['value'] = (@$setting['value'][$language_key]) ? $setting['value'][$language_key] : "";

                                    // render the correct input method
                                    if ($setting['input_type'] == 'input')
                                    {
                                        echo form_input($field_data);
                                    }
                                    
                                    elseif ($setting['input_type'] == 'textarea')
                                    {
                                        echo form_textarea($field_data);
                                    }
                                    elseif ($setting['input_type'] == 'radio')
                                    {
                                        echo "<br />";
                                        foreach ($field_options as $value=>$label)
                                        {
                                            echo form_radio(array('name'=>$field_data['name'], 'id'=>$field_data['id'] . "-" . $value, 'value'=>$value, 'checked'=>(($value == $field_data['value']) ? 'checked' : FALSE)));
                                            echo $label;
                                        }
                                    }
                                    elseif ($setting['input_type'] == 'dropdown')
                                    {
                                        echo form_dropdown($setting['name'], $field_options, $field_data['value'], 'id="' . $field_data['id'] . '" class="' . $field_data['class'] . '"');
                                    }
                                    elseif ($setting['input_type'] == 'timezones')
                                    {
                                        echo "<br />";
                                        echo timezone_menu($field_data['value']);
                                    }
                                    ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <?php if ($setting['help_text']) : ?>
                        <span class="help-block"><?php echo $setting['help_text']; ?></span>
                    <?php endif; ?>
                </div>

        <?php else : ?>

            <?php // no translations
            $field_data['name']  = $setting['name'];
            $field_data['id']    = $setting['name'];
            $field_data['class'] = "form-control underlined" . (($setting['show_editor']) ? " editor" : "");
            $field_data['value'] = $setting['value'];
                       
            $field_data2['name']  = $setting['name'];
            $field_data2['id']    = $setting['name'];
            $field_data2['class'] = "form-control underlined" . (($setting['show_editor']) ? " editor" : "");
            $field_data2['value'] = $setting['value'];

            ?>
           
                     
                <div class="form-group <?php echo $col_size; ?><?php echo form_error($setting['name']) ? ' has-error' : ''; ?>">
                    <?php echo form_label($setting['label'], $setting['name'], array('class'=>'control-label')); ?>
                    <?php if (strpos($setting['validation'], 'required') !== FALSE) : ?>
                        <span class="required">*</span>
                    <?php endif; ?>

                    <?php // render the correct input method
                     if ($setting['input_type'] == 'file')
                    {
                        echo form_upload($field_data2);
                    }
                    if ($setting['input_type'] == 'input')
                    {
                        echo form_input($field_data);
                    }
                    elseif ($setting['input_type'] == 'textarea')
                    {
                        echo form_textarea($field_data);
                    }
                    elseif ($setting['input_type'] == 'radio')
                    {
                        echo "<br />";
                        foreach ($field_options as $value=>$label)
                        {
                            echo form_radio(array('name'=>$field_data['name'], 'id'=>$field_data['id'] . "-" . $value, 'value'=>$value, 'checked'=>(($value == $field_data['value']) ? 'checked' : FALSE)));
                            echo $label;
                        }
                    }
                    elseif ($setting['input_type'] == 'dropdown')
                    {
                        echo form_dropdown($setting['name'], $field_options, $field_data['value'], 'id="' . $field_data['id'] . '" class="' . $field_data['class'] . '"');
                    }
                    elseif ($setting['input_type'] == 'timezones')
                    {
                        echo "<br />";
                        echo timezone_menu($field_data['value'],  'form-control underlined"' . $field_data['id'] . '" class="' . $field_data['class'] . '"');
                    }
                    ?>

                    <?php if ($setting['help_text']) : ?>
                        <span class="help-block"><?php echo $setting['help_text']; ?></span>
                    <?php endif; ?>
                </div>
          

                    
      

        <?php endif; ?>

    <?php endforeach; ?>
                  
    </div>
  </div>

      
        <div class="card-footer" style="text-align:right"> 
                                             <a class="btn btn-secondary btn-sm" href="<?php echo $cancel_url; ?>"><?php echo lang('core button cancel'); ?></a>
                                                    <button type="submit"  class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-save"></span> <?php echo lang('core button save'); ?></button>
                                        </div>


<?php echo form_close(); ?>
