<?php
defined('SYSPATH') or die('No direct script access.');

class Access_Exception extends Kohana_Exception {

    public function __construct($message, array $variables = NULL, $code = 0) {
        if (Auth::instance()->logged_in())
        {
            Request::current()->redirect('auth/permision');
        }
        else
        {
            Request::current()->redirect('auth/login');
        }
    }

}