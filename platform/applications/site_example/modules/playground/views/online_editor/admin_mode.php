<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2014
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

$content = @ isset($content) ? (string) $content : '';

?>

        <section>

            <div class="container">

<?php

template_partial('subnavbar');

?>

                <div class="page-header">
                    <h1>Online Editor - Admin Mode</h1>
                </div>

                <div class="row">

                    <div class="col-md-12">

                        <?php echo form_open('', 'method="post"'); ?>

                            <div>
<?php

$config = CKEditorConfig::get('admin');
$ckeditor = new CKEditor($config['basePath']);
$ckeditor->textareaAttributes = $config['textareaAttributes'];
$ckeditor->initialized = true;
$ckeditor->editor('content', $content, $config['config']);

?>
                            </div>

                            <br class="clear" />
    
                            <button type="submit" class="btn btn-primary">Submit Content</button>

                        <?php echo form_close(); ?>

                        <h2>Result:</h2>

                        <div><?php echo $content; ?></div>

                    </div>

                </div>

            </div>

        </section>
