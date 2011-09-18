<?php

defined('SYSPATH') or die('No direct access allowed.');

class Model_Role extends Model_Auth_Role {

    protected $_primary_val = 'name';

}

// End Role Model