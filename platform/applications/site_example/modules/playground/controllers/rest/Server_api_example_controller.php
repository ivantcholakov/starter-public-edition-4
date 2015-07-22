<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Server_api_example_controller extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['user_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function user_get($id)
    {
        if ($this->get('id') !== NULL)
        {
            $id = $this->get('id');
        }

        $id = (int) $id;

        if ($id <= 0)
        {
            // Set the response and exit
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }

        // $user = $this->some_model->getSomething( $this->get('id') );
        $users = array(
            1 => array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com', 'fact' => 'Loves swimming'),
            2 => array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com', 'fact' => 'Has a huge face'),
            3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => 'Is a Scott!', array('hobbies' => array('fartings', 'bikes'))),
        );

        // Get the user from the array by the given id.
        $user = isset($users[$id]) ? $users[$id] : NULL;

        if ($user)
        {
            $this->set_response($user, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response(array(
                'status' => FALSE,
                'error' => 'User could not be found'
            ), REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    public function user_post()
    {
        // $this->some_model->update_user($this->get('id'));
        $message = array(
            'id' => $this->get('id'),
            'name' => $this->post('name'),
            'email' => $this->post('email'),
            'message' => 'Added a resource'
        );

        $this->set_response($message, REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
    }

    public function user_delete()
    {
        // $this->some_model->delete_something($this->get('id'));
        $message = array(
            'id' => $this->get('id'),
            'message' => 'Deleted the resource'
        );

        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function users_get()
    {
        // $users = $this->some_model->get_something($this->get('limit'));
        $users = array(
            array('id' => 1, 'name' => 'Some Guy', 'email' => 'example1@example.com'),
            array('id' => 2, 'name' => 'Person Face', 'email' => 'example2@example.com'),
            3 => array('id' => 3, 'name' => 'Scotty', 'email' => 'example3@example.com', 'fact' => array('hobbies' => array('fartings', 'bikes'))),
        );

        if ($users)
        {
            $this->set_response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }
        else
        {
            $this->set_response(array(
                'status' => FALSE,
                'error' => 'No users were found'
                ), REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
}
