<?php

require dirname(__FILE__).'/../config.php';
require $PLATFORMCREATE;

ci()->load
    ->helper('url')
    ->library('template')
;

echo html_begin();

echo head_begin();
echo meta_charset();

echo viewport();

?>

        <title>Testing http_build_url()</title>
<?php

echo favicon();
echo apple_touch_icon_precomposed();

echo css_normalize();

?>

    <style type="text/css">

    body {
        background-color: #fff;
        margin: 40px;
        font: 16px/20px normal Helvetica, Arial, sans-serif;
        color: #4F5155;
    }

    h1 {
        color: #444;
        font-size: 24px;
        margin: 0 0 14px 0;
        padding: 14px 15px 10px 15px;
    }

    code {
        font-family: Consolas, Monaco, Courier New, Courier, monospace;
        font-size: 16px;
        border: 1px solid #D0D0D0;
        color: #002166;
        display: block;
        margin: 14px 0 14px 0;
        padding: 12px 10px 12px 10px;
        overflow: hidden;
    }

    </style>

<?php

echo js_platform();
echo js_modernizr();
echo js_jquery();

echo head_end();
echo body_begin('id="page-top"');

?>
    <p style="margin-top: 25px;">
        <a href="<?php echo site_url('playground'); ?>">Back to the playground</a>
    </p>

<?php

echo '<h3>Redis Caching Driver Test</h3>';

echo 'phpredis version: '.@phpversion('redis');
echo '<br />';
echo '<br />';
echo '<hr />';

echo '<br />';

echo 'Making a native Redis class instance: ';
echo '<br />';

if (!class_exists('Redis')) {
    die('Can not load redis.');
}

$redis = new Redis() or die('Can not load redis.');

$redis->connect('127.0.0.1');

$redis_server_info = $redis->info();
$redis_server_version = $redis_server_info['redis_version'];

echo 'Redis server version: '.$redis_server_version;

echo '<br />';
echo '<br />';

echo 'Loading CodeIgniter\'s cache with redis driver.';

echo '<br />';
echo '<br />';

ci()->load->driver('cache', array('adapter' => 'redis'));

// Let us see whwther they work.

echo 'The following value should increment on every page reload.';

echo '<br />';

ci()->cache->increment('test_key_1');
echo print_d(ci()->cache->get('test_key_1'));
echo '<div style="clear: both;"/>';

echo '<br />';
echo '<br />';

echo 'The following value should decrement on every page reload.';

echo '<br />';

ci()->cache->decrement('test_key_2');
echo print_d(ci()->cache->get('test_key_2'));
echo '<div style="clear: both;"/>';

echo '<br />';
echo '<br />';

echo 'Saving and reading an ordinary string.';

echo '<br />';

ci()->cache->save('test_key_3', '--- An ordinary string ---');
echo print_d(ci()->cache->get('test_key_3'));
echo '<div style="clear: both;"/>';

echo '<br />';
echo '<br />';

echo 'Saving and reading an object.';

echo '<br />';

$object = new stdClass();
ci()->cache->save('test_key_4', $object);
echo print_d(ci()->cache->get('test_key_4'));
echo '<div style="clear: both;"/>';

echo '<br />';

echo '<hr />';

echo '<br />';

echo 'Making an array of objects ($records variable).';

echo '<br />';

$records = json_decode('[{"id":1},{"id":2},{"id":3}]');
echo print_d($records);
echo '<div style="clear: both;"/>';

echo '<br />';
echo '<br />';

echo 'Saving $records within cache under "records" key.';

echo '<br />';

ci()->cache->save('records', $records);

echo '<hr />';
echo '<br />';

echo 'Reading "records" and showing the result.';

echo '<br />';

$records_read = ci()->cache->get('records', $records);
echo print_d($records_read);
echo '<div style="clear: both;"/>';

echo '<br />';
echo '<br />';

echo 'Reading metadata of "records" and showing the result.';

echo '<br />';

$records_read = ci()->cache->get_metadata('records');
echo print_d($records_read);
echo '<div style="clear: both;"/>';

echo '<br />';
echo '<hr />';
echo '<br />';

echo 'Deleting "records" and showing the result.';

echo '<br />';

$result_delete = ci()->cache->delete('records', $records);
echo print_d($result_delete);
echo '<div style="clear: both;"/>';

echo '<br />';
echo '<br />';

echo 'Deleting "records" again and showing the result.';

echo '<br />';

$result_delete = ci()->cache->delete('records', $records);
echo print_d($result_delete);
echo '<div style="clear: both;"/>';

echo '<br />';
echo '<br />';

echo 'Reading deleted "records" and showing the result.';

echo '<br />';

$records_read = ci()->cache->get('records', $records);
echo print_d($records_read);
echo '<div style="clear: both;"/>';

echo '<br />';
echo '<br />';

echo 'Reading metadata of non-existing "records" and showing the result.';

echo '<br />';

$records_read = ci()->cache->get_metadata('records');
echo print_d($records_read);
echo '<div style="clear: both;"/>';

echo '<br />';
echo '<hr />';
echo '<br />';

?>

    <p style="margin-top: 25px;">
        <a href="<?php echo site_url('playground'); ?>">Back to the playground</a>
    </p>

<?php

echo js_bp_plugins();
echo js_mbp_helper();
echo js_scale_fix_ios();
echo js_imgsizer();

echo div_debug();

require $PLATFORMDESTROY;

?>
    </body>
</html>
