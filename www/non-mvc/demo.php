<?php

// Platform's core initialization.
require dirname(__FILE__).'/../config.php'; // This is www/config.php file.
require $PLATFORMCREATE;

// Accessing the dummy controller.
$CI = get_instance();

// Accessing the dummy controller properties.
$CI->load
    ->helper('url')
    ->library('template')
;

// An alternative syntax (it will be used with preference):
//ci()->load
//    ->helper('url')
//    ->library('template')
//;

echo html_begin();

?>

<head>
    <meta charset="utf-8" />
<?php

// Accessing some configuration options.
$title = config_item('default_title');
$description = config_item('default_description');
$keywords = config_item('default_keywords');

// Accessing the dummy controller properties.

ci()->template->title($title);
ci()->template->set_metadata('description', $description);
ci()->template->set_metadata('keywords', $keywords);

// Using some helper functions.
template_title();
echo viewport();
template_metadata();

echo favicon();
echo apple_touch_icon_precomposed();
echo cleartype_ie();

// A CSS loading example.
echo css('lib/bootstrap-3/bootstrap.css');
echo css('lib/font-awesome-4/font-awesome.css');

// Loading javascripts example.
echo js_platform();
echo js_selectivizr();
echo js_modernizr();
echo js_respond();

echo js_jquery();

?>

</head>
<?php

echo body_begin('id="page-top"');

?>

        <section class="container">

            <div class="row" style="margin-top: 40px;">

                <div class="col-sm-12">

                    <div class="clearfix">

                        The touch icon should be seen here:
                        <br />
                        <img src="<?php echo base_uri('apple-touch-icon-precomposed.png'); ?>" class="thumbnail" />

                    </div>

                    <div class="page-header">
                        <h1>Dealing with Legacy Pages Example</h1>
                    </div>

                    <p>
                        This is a sample of an "old legacy page" that is not rewritten in (H)MVC style yet. Sometimes this costs a lot of time.
                        In this case access to the configuration, helper functions, etc. might be useful. This is why the core of the framework
                        initializes at the beginning of the page (using a dummy controller) and destroys itself at the end of the page. Between
                        these two actions you can read framework's configurations options, using asset helper functions, access database and so forth.
                        Please, have a look at PHP source code of this page.
                    </p>

                    <p>
                        If it is necessary, use the helper function <strong>get_instance()</strong> to access the dummy controller and its properties and methods.
                    </p>

                    <p>
                        Yet another image should be seen here:
                        <br />
                        <?php echo image('lib/processing.gif', null, 'class="thumbnail"'); /* Inserting an image using a helper function. */ ?>
                    </p>

                    <p>
                        <a href="<?php echo site_url('playground'); ?>" class="btn btn-primary"><i class="fa fa-angle-double-left"></i> Back to the playground</a>
                    </p>

                </div>

            </div>

        </section>

<?php

echo js_jquery_extra_selectors();
echo js_bp_plugins();
echo js_mbp_helper();
echo js_scale_fix_ios();
echo js_imgsizer();

echo div_debug();

// Platform's core destruction.
require $PLATFORMDESTROY;

?>

</body>
</html>
