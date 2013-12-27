<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ($path != '') {

    echo file_get_contents($path);

} else {

    echo '# The file README.md has not been found.';

}
