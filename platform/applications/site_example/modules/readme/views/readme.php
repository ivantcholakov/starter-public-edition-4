<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ($path != '') {

    echo $this->auto_link->parse_string(
        $this->markdown->parse($path, null, true, array('full_path' => true))
        , null, true
    );

} else {

?>

    <h1>The file README.md has not been found.</h1>

<?php

}
