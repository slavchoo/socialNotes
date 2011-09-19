<?php

defined('SYSPATH') or die('No direct access allowed.');

/**
 * ORM model for autogenering form
 */
abstract class Model_Crud extends ORM {
    
    public $_form_fields = array();
    public $_grid_fields = array();
    
    public function labels() {
        $labels = parent::labels();
        $labels['id'] = 'ID';
        return $labels;
    }
    
    
    public function get_primary_key(){
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

// End Role Model