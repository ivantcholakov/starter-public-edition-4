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
echo css('lib/semantic/semantic.min.css');
echo css('lib/font-awesome-4/font-awesome.css');

?>

    <style>
.navbeer {
    height: 60px !important;
}
.navbeer-brand {
    display: inline-block;
}
.navbeer-brand img {
    height: 60px !important;
    line-height: 60px !important;
}
/*
    In case of you are using text for the Brand Name instead image,
    put your text inside a span tag
*/
.navbeer-brand span {
    line-height: 60px !important;
    white-space: nowrap;
    margin-left: 15px;
    color: #ccc;
}
.navbeer-sandwich {
    position: relative !important;
    display: none;
}
.navbeer-sandwich-icon {
    margin: 0 !important;
    padding: 0 !important;
}
.navbeer-sandwich .menu .icon {
    position: absolute !important;
    top: 40% !important;
    right: 10px !important;
}

#example {
    width: 100%;
}
    </style>

<?php

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

        <div class="ui grid">
            <div class="row">

                <!-- See http://chineque.com.br/labs/navbeer/ -->
                <nav id="example" class="column">
                    <div class="navbeer ui inverted teal borderless menu page grid">
                        <div class="navbeer-sandwich ui dropdown item" style="display: none;">
                            <i class="navbeer-sandwich-icon content big icon"></i>
                            <div class="navbeer-sandwich-content menu"></div><!--Keep empty-->
                        </div>
                        <a class="navbeer-brand" href="#">
                            <img src="<?php echo base_uri('apple-touch-icon-precomposed.png'); ?>" />
                            <!--<span><strong>COMPANY NAME</strong></span>-->
                        </a>
                        <div class="navbeer-menu right menu">
                            <a class="item navbeer-collapsable-item" href="#"><strong>ITEM</strong></a>
                            <a class="item navbeer-collapsable-item" href="#"><strong>ITEM</strong></a>
                            <a class="item navbeer-collapsable-item" href="#"><strong>ITEM</strong></a>
                            <div class="navbeer-collapsable-item ui dropdown item">
                                <strong>DROPDOWN</strong>
                                <i class="dropdown icon"></i>
                                <div class="menu">
                                    <a class="item" href="#"><strong>ITEM</strong></a>
                                    <a class="item" href="#"><strong>ITEM</strong></a>
                                    <a class="item" href="#"><strong>ITEM</strong></a>
                                </div>
                            </div>
                            <!-- This link will not collapse -->
                            <a class="item" href="#"><strong>FIXED ITEM</strong></a>
                        </div>
                    </div>
                </nav>

            </div>
        </div>

        <div class="ui grid page">

            <div class="row">

                <div class="column">

                    <p>See information about the menu example: <a href="http://chineque.com.br/labs/navbeer/" target="_blank">http://chineque.com.br/labs/navbeer/</a></p>

                </div>

            </div>

            <div class="row">

                <div class="column">

                    <p>The touch icon should be seen here:</p>
                    <p><img src="<?php echo base_uri('apple-touch-icon-precomposed.png'); ?>" class="ui image" /></p>

                </div>

            </div>

            <div class="row">

                <div class="column">

                    <h1 class="ui header">Dealing with Legacy Pages Example</h1>

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

                </div>

            </div>

            <div class="row">

                <div class="column">

                    <p>Yet another image should be seen here:</p>
                    <p><?php echo image('lib/processing.gif', null, 'class="ui image"'); /* Inserting an image using a helper function. */ ?></p>

                </div>

            </div>

            <div class="row">

                <div class="column">

                    <p>
                        <a href="<?php echo site_url('playground'); ?>" class="ui primary button"><i class="fa fa-angle-double-left"></i> Back to the Playground</a>
                    </p>

                </div>

            </div>

        </div>

<?php

echo js_jquery_extra_selectors();
echo js_bp_plugins();
echo js_mbp_helper();
echo js_scale_fix_ios();
echo js_imgsizer();

echo js('lib/semantic/semantic.min.js');

?>


<script type="text/javascript" src="<?php echo js_url('lib/webfontloader/webfontloader.js'); ?>"></script>

<script type="text/javascript">
//<![CDATA[

    WebFont.load({
        custom: {
            families: [
                'Lato',
                'Icons',
                'Material Icons',
                'FontAwesome'
            ],
            urls: [
                ASSET_CSS_URI + 'lib/lato/latofonts.min.css',
                ASSET_CSS_URI + 'lib/semantic-icons-default/icons.css',
                ASSET_CSS_URI + 'lib/material-icons/material-icons.min.css',
                ASSET_CSS_URI + 'lib/font-awesome-4/font-awesome.min.css'
            ]
        },
        timeout: 2000
    });

//]]>
</script>

<script type="text/javascript">
//<![CDATA[

    (function($) {

        $.fn.navBeer = function () {
            var
                navBeerBrand    = jQuery('.navbeer-brand', this),
                navBeerSandwich = jQuery('.navbeer-sandwich', this),
                navBeerMenu     = jQuery('.navbeer-menu', this),
                menuWidthCompensation = 30, // Try change this if the navbar is collapsing too early or to later.
                navBeerWidth    = navBeerBrand.width() + navBeerMenu.width() + menuWidthCompensation,
                navBeerCollapse = function () {
                    if (jQuery(window).width() < navBeerWidth) {
                        // Get the navbar items and put them into the sandwich menu.
                        navBeerMenu
                            .find('.navbeer-collapsable-item')
                            .appendTo(navBeerSandwich.find('.navbeer-sandwich-content'));
                        navBeerSandwich.show();
                    } else {
                        // Give the items back to the navbar.
                        navBeerSandwich
                            .hide()
                            .find('.navbeer-collapsable-item ')
                            .prependTo(navBeerMenu);
                        navBeerMenu.show();
                    }
                }
            ;
            // Check to collapse on page load.
            navBeerCollapse();
            // ...or when window resize.
            jQuery(window).on('resize', function(){
                navBeerCollapse();
            });
        };

    }(jQuery));

    $(function () {

        $('.ui.dropdown').dropdown();
        $('#example').navBeer();
    });

//]]>
</script>

<?php

echo div_debug();

// Platform's core destruction.
require $PLATFORMDESTROY;

?>

</body>
</html>
