<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Events Library for CodeIgniter - Configuration
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2015
 * @license The MIT License, http://opensource.org/licenses/MIT
 */

/*

The following configuration option contains a list of files that contain classes
for registering event listeners, used by the Events class.

Example:

$config['event_registration_classes'] = array(
    APPPATH.'events.php',
    APPPATH.'events/Class_1.php',
    APPPATH.'events/Class_2.php',
);

Each file should contain only one class with an arbitrary name. Invent your own
class naming convention for avoiding name collisions.

Example:
--------------------------------------------------------------------------------

<?php defined('BASEPATH') or exit('No direct script access allowed');

class Events_Example {

    protected $ci = null;

    public function __construct() {

        $this->ci = get_instance();

        // Register event listeners.
        Events::register('event_1', array($this, 'event_1'));
        Events::register('event_2', array($this, 'event_2'));
    }

    public function event_1($data = array()) {

        // It is desireable implementation to be moved outside this file,
        // because it is loaded at initialization, it is good it to be kept small.
        return Modules::run('sample_module/index', $data);
    }

    public function event_2($data = array()) {

        // An example about using a model.
        $this->ci->load('sample_model);
        return $this->ci->sample_model->sample_method($data);
    }

}

--------------------------------------------------------------------------------

Every module directory is scanned for presence of file named events.php - these
files are procesed automatically, they needn't be included within
$config['event_registration_classes'] array.

*/
$config['event_registration_classes'] = array(
    APPPATH.'events.php',
    COMMONPATH.'events.php',
);
