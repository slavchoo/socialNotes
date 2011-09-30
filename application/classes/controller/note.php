<?php

defined('SYSPATH') or die('No direct access allowed.');

class Controller_Note extends Controller_Template {

    protected $enable_group = array('login');

    public function action_index() {
        $username = $this->request->param('username');

        $note = Model::factory('note');
        $form = Formo::form()->orm('load', $note, array('title', 'text'))->add('save', 'submit');

        //validation
        if ($form->load($_POST)->validate()) {
            //saving to database
            try {
                $note->user_id = $this->_user->id;
                $note->save();
//                $form->orm('save_rel', $obj_orm);
            } catch (Kohana_Exception $e) {
                $this->template->content .= $e;
            }
        }


        try {
            if ($username) {
                $user = Model_User::get_user_by_name($username);
                $notes = $user->notes->find_all();
            } else {
                $this->request->redirect(Route::url('user_notes', array('username' => $this->_user->username)));
            }
        } catch (Kohana_Exception $e) { //@todo create custom exception
            //@todo handling;
        }

        $this->template->content = View::factory('frontend/note/index', array('notes' => $notes));
        $this->template->content->form = $form;
    }

    public function action_delete() {
        $id = $this->request->param('id');
        $note = Model::factory('note')->where('id', '=', $id)->find();
        if ($this->_user->id !== $note->user_id) {
            throw new Access_Exception("you can't delte or edit aliens notes");
        }
        $note->delete();
        $this->request->redirect(Route::url('user_notes', array('username' => $this->_user->username)));
    }

    public function action_edit() {
        $id = $this->request->param('id');

        $note = Model::factory('note')->where('id', '=', $id)->find();
        $form = Formo::form()->orm('load', $note, array('title', 'text'))->add('save', 'submit');

        if ($this->_user->id !== $note->user_id) {
            throw new Access_Exception("you can't delte or edit aliens notes");
        }

        //validation
        if ($form->load($_POST)->validate()) {
            //saving to database
            try {
                $note->user_id = $this->_user->id;
                $note->save();
                $this->request->redirect(Route::url('user_notes', array('username' => $this->_user->username)));
//                $form->orm('save_rel', $obj_orm);
            } catch (Kohana_Exception $e) {
                $this->template->content .= $e;
            }
        }

        $this->template->content = $form;
    }

}