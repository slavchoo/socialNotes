<?php

defined('SYSPATH') or die('No direct access allowed.');

class Controller_Note extends Controller_Template {

    protected $enable_group = array('login');

    public function action_index() {
        $username = $this->request->param('username');

        try {
            if ($username) {
                $user = Model_User::get_user_by_name($username);
                $notes = $user->notes->find_all();
            } else {
                $notes = $this->_user->notes->find_all();
            }
        } catch (Kohana_Exception $e) { //todo create custom exception
            //todo handling
        }

        $this->template->content = View::factory('frontend/note/index', array('notes' => $notes));
    }

}