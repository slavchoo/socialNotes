<?php

defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends Model_Baseapp_User {

    protected $_has_many = array(
        'user_tokens' => array('model' => 'user_token'),
        'roles' => array('model' => 'role', 'through' => 'roles_users'),
        'notes' => array('model' => 'note'),
    );
    
    public static function get_user_by_name($username){
        $user = ORM::factory('user')->where('username', '=', $username)->find();
        return $user;
    }

}