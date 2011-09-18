<?php

defined('SYSPATH') or die('No direct script access.');

/**
 * Template Controller
 *
 * @package   KW-Core
 * @author    Kohana-World Development Team
 * @license   MIT License
 * @copyright 2011 Kohana-World Development Team
 */
abstract class Controller_Template extends Kohana_Controller_Template {

    /**
     * Page template
     *
     * @var View
     */
    public $template = 'frontend/template/main';
    /**
     * The need of authorization
     *
     * @var bool
     */
    protected $_auth_required = FALSE;
    /**
     * @var Auth
     */
    protected $_auth;
    /**
     * @var Model_User
     */
    protected $_user;
    /**
     * Is the request is Ajax-like
     *
     * @var boolean
     */
    protected $_ajax = FALSE;
    protected $enable_group = NULL;

    public function before() {
        parent::before();

        // Ajax-like request check
        if ($this->request->is_ajax() OR !$this->request->is_initial()) {
            $this->_ajax = TRUE;
        } else {
            Static_Css::getInstance()->add('media/img/style.css');
            Static_Css::getInstance()->add('media/css/pagination.css');
            Static_Css::getInstance()->add('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/themes/base/jquery-ui.css');
            Static_Js::getInstance()->add('https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js');
            Static_Js::getInstance()->add('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js');
            Static_Js::getInstance()->add('media/js/scripts.js');
        }

        $this->_auth = Auth::instance();
        $this->_user = $this->_auth->get_user();

        // Auth require check
        if ($this->_auth_required AND !Auth::instance()->logged_in($this->enable_group)) {
            Session::instance()->set('url', $_SERVER['REQUEST_URI']);
            throw new Access_Exception("Permission denied");
        }

        if ($this->auto_render) {
            // default template variables  initialization
            $this->template->title = ''; // page title
            $this->template->content = ''; // page content
            $this->template->sidebar = ''; // page sidebar
            $this->template->counters = View::factory('counters');
            $this->template->bind_global('_user', $this->_user);
        }
    }

    public function after() {
        // Using template content on Ajax-like requests
        if ($this->_ajax === TRUE) {
            $this->response->body($this->template->content);
        } else {
            parent::after();
        }
    }

}

// End Controller_Template
