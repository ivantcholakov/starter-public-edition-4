<?php if (!defined('BASEPATH')) { exit('No direct script access allowed.'); }

class Random_controller extends Base_Controller {

    public function __construct() {

        parent::__construct();

        $this->template
            ->title('Random Values Test')
        ;
    }

    public function index() {

        $this->template
            ->set_partial('scripts', 'random_scripts')
            ->build('random');
    }

}
