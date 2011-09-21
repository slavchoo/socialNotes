<?php

defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends Model_Auth_User {

    public $_form_fields = array('username', 'email', 'roles', 'password');
    public $_grid_fields = array(
        'id' => array(),
        'username' => array(),
        'email' => array(),
        'roles' => array(
            'type' => 'text',
            'callback' => 'role',
            'sortable' => FALSE
        ),
    );

    /**
     * If it's callback for relation then $text is a some object
     * @param type $text
     * @return type 
     */
    public function role($obj) {
        $text = "";
        foreach ($obj->find_all() as $role) {
            $text .= $role->name . ", ";
        }

        return trim($text, ", ");
    }

    //rules for form validation
    public function rules() {
        return array(
            'username' => array(
                array('not_empty'),
                array('min_length', array(':value', 4)),
                array('max_length', array(':value', 32)),
                array('regex', array(':value', '/^[-\pL\pN_.]++$/uD')),
            ),
            'password' => array(
                array('not_empty'),
                array('min_length', array(':value', 8)),
                array('max_length', array(':value', 64)),
            ),
            'email' => array(
                array('not_empty'),
                array('min_length', array(':value', 4)),
                array('max_length', array(':value', 127)),
                array('email'),
            ),
        );
    }

    //this function is necessary for formo
    public function formo() {
        return array(
            'user_tokens' => array(
                'render' => FALSE,
            ),
            'notes' => array(
                'driver' => 'textarea'
            ),
            'password' => array(
                'driver' => 'password',
            ),
        );
    }

    public function labels() {
        $labels = parent::labels();
        $labels['id'] = 'ID';
        return $labels;
    }

    public function get_primary_key() {
        return $this->_primary_key;
    }

    public function add_to_grid($column) {
        if (array_key_exists($column, $this->_object)) {
            return $this->_object[$column];
        } elseif (isset($this->_belongs_to[$column])) {
            return "belongs_to_text";
        } elseif (isset($this->_has_one[$column])) {
            return "has_one_text";
        } elseif (isset($this->_has_many[$column])) {
            return "has_many_text";
        } else {
            throw new Kohana_Exception('The :property property does not exist in the :class class',
                    array(':property' => $column, ':class' => get_class($this)));
        }
    }

}