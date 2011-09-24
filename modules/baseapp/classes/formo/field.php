<?php defined('SYSPATH') or die('No direct script access.');

class Formo_Field extends Formo_Core_Field {
    
    public function get_driver(){
        return $this->_settings['driver'];
    }
}