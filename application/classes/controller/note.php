<?php

defined('SYSPATH') or die('No direct access allowed.');

class Controller_Note extends Controller_Template {

    protected $enable_group = array('login');

    public function action_index() {
        $username = $this->request->param('username');

        $user = ORM::factory('user');
        
        try {
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
        die;
    }

}