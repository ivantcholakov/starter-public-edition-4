<?php

// Platform's core initialization.
require dirname(__FILE__).'/../config.php';
require $PLATFORMCREATE;

ci()->load
    ->helper('url')
    ->library('template')
;

header( 'Content-Type: text/html; charset=UTF-8' );

//require 'Net/IDNA2.php';


$idn = Net_IDNA2::getInstance();

if (isset($_REQUEST['encode'])) {
    $decoded = isset($_REQUEST['decoded'])? $_REQUEST['decoded'] : '';
    
    try {
        $encoded = $idn->encode($decoded);
    }
    catch (Exception $e) {
        /* just swallow */
    }
}

if (isset($_REQUEST['decode'])) {
    $encoded = isset($_REQUEST['encoded'])? $_REQUEST['encoded'] : '';
    
    try {
        $decoded = $idn->decode($encoded);
    }
    catch (Exception $e) {
        /* just swallow */
    }
}

if (!isset($encoded)) {
    $encoded = '';
}

if (!isset($decoded)) {
    $decoded = '';
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>

<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Punycode Converter</title>

<?php

echo favicon();
echo apple_touch_icon_precomposed();

?>
    
<style type="text/css">

body
{
    font-family:        Helvetica, Arial, sans-serif;
    font-size:          10pt;
    background:         rgb( 255, 255, 255 );
}

#centered
{
    text-align:         center;
    vertical-align:     middle;
}

#round
{
    background-color:   rgb( 240, 240, 240 );
    border:             1px solid black;
    text-align:         center;
    vertical-align:     middle;
    padding:            4px;
}

#subhead
{
    font-size:          8pt;
}

</style>

</head>

<body>

<table width="780" border="0" cellpadding="0" cellspacing="0">
<tr>
    <td id="centered">
    <div id="round">
    <strong>IDNA Converter</strong><br />

    <span id="subhead">
    See <a href="http://faqs.org/rfcs/rfc3490.html" title="IDNA" target="_blank">RFC3490</a>,
    <a href="http://faqs.org/rfcs/rfc3491.html" title="Nameprep, a Stringprep profile" target="_blank">RFC3491</a>,
    <a href="http://faqs.org/rfcs/rfc3492.html" title="Punycode" target="_blank">RFC3492</a> and
    <a href="http://faqs.org/rfcs/rfc3454.html" title="Stringprep" target="_blank">RFC3454</a><br />
    </span>
   
    <br />

    This converter allows you to transfer domain names between the encoded (Punycode) notation and the
    decoded (UTF-8) notation.<br />
   
    Just enter the domain name in the respective field and click on the button right beside it to have
    it converted. Please be aware, that you might even enter complete domain names (like j&#xFC;rgen-m&#xFC;ller.de),
    but without the protocol (<strong>DO NOT</strong> enter http://m&#xFC;ller.de) or an email address.<br />
   
    Since the underlying library is still buggy, we cannot guarantee its usefulness and correctness. You should
    always doublecheck the results given here by converting them back to the original form.<br />
   
    Any productive use is discouraged and prone to fail.<br />
   
    <br />
   
    Make sure, that your browser is capable of the <strong>UTF-8</strong> character encoding.<br />
    
    <br />
    
    <table border="0" cellpadding="2" cellspacing="2" align="center">
    <tr>
        <td class="thead" align="left">Original</td>
        <td class="thead" align="right">Punycode</td>
    </tr>
    
    <tr>
        <td>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <input type="text" name="decoded" value="<?php echo $decoded; ?>" size="24" maxlength="255" />
        <input type="submit" name="encode" value="Encode &gt;&gt;" />
        </form>
        </td>
        
        <td>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <input type="submit" name="decode" value="&lt;&lt; Decode" />
        <input type="text" name="encoded" value="<?php echo $encoded; ?>" size="24" maxlength="255" />
        </form>
        </td>
    </tr>
    </table>
    </div>
    </td>
</tr>
</table>

<p style="margin-top: 25px;">
    <a href="<?php echo site_url('playground'); ?>">Back to the playground</a>
</p>

<?php

echo div_debug();

// Platform's core destruction.
require $PLATFORMDESTROY;

?>

</body>
</html>
