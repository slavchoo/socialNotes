<?php

defined('SYSPATH') or die('No direct script access.');

abstract class Controller_Admin extends Controller_Template {

    protected $_auth_required = TRUE;
    protected $enable_group = array("admin");
    public $template = 'admin/layout/main';
    
    public function before() {
        parent::before();
        $this->template->title = I18n::get("admin panel");
    }

    public function action_index() {
        
    }

}
