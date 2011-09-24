<?php

defined('SYSPATH') or die('No direct access allowed.');

abstract class Controller_Admin_GRID extends Controller_Admin {

    protected $_model = ""; //for bind controller with model
    protected $_action_prefix = "admin/";
    protected $_sorting = array();

    public function action_edit() {

        //getting obj id
        $obj_id = $this->request->param('id');
        //creation an object of a table
        $obj_orm = ORM::factory($this->_model, $obj_id);

        //creating a form with input fields and submit button
        $form = Formo::form()
                ->orm('load', $obj_orm, $obj_orm->_form_fields)
                ->add(I18n::get('save'), 'submit');

        //validation
        if ($form->load($_POST)->validate()) {
            //saving to database
            try {
                $obj_orm->save();
                $form->orm('save_rel', $obj_orm);
            } catch (Kohana_Exception $e) {
                $this->template->content .= $e;
            }
            $this->request->redirect($this->get_curr_route_index_url());
        }

        //render
        $block = View::factory('admin/template/block/full');
        $block->module_header = I18n::get('Edit form');
        $block->module_content = $form->render();
        $this->template->content = $block;
    }

    public function action_create() {

        $obj_orm = ORM::factory($this->_model);

        //creating a form with input fields and submit button
        $form = Formo::form()->orm('load', $obj_orm, $obj_orm->_form_fields)->add(I18n::get('save'), 'submit');

        //validation
        if ($form->load($_POST)->validate()) {
            //saving to database
            try {
                $obj_orm->save();
                $form->orm('save_rel', $obj_orm);
            } catch (Database_Exception $e) {
                $this->template->content .= $e;
            }
            $this->request->redirect($this->get_curr_route_index_url());
        }

        //render

        $block = View::factory('admin/template/block/full');
        $block->module_header = I18n::get('Edit form');
        $block->module_content = $form->render();
        $this->template->content = $block;
    }

    public function action_delete() {
        //getting user id
        $obj_id = $this->request->param('id');
        //creation an object of a table
        $obj_orm = ORM::factory($this->_model, $obj_id);
        $obj_orm->delete();
        $this->request->redirect($this->get_curr_route_index_url());
        //die("Model " . $this->_model . " obj with id = $obj_id deleted");
    }

    /**
     * this method use for filtrate dataset entity
     * For example, it can be used for pagination
     * @return ORM 
     */
    public function grid_before() {
        $obj_orm = ORM::factory($this->_model);
        $order_label = Request::initial()->query('order_by');
        $direction = Request::initial()->query('direction');
        $direction = (!empty($direction)) ? $direction : "DESC";
        $direction = strtoupper($direction);
        $direction = ($direction === "ASC") ? "DESC" : "ASC"; //invert direction of sorting

        if ($order_label) {
            $find_title = array_search($order_label, ORM::factory($this->_model)->labels());
            $find_title = empty($find_title) ? $order_label : $find_title;
            if (!empty($find_title)) {
                $find_title = $order_label;
                $this->_sorting[$find_title] = $direction;
                foreach ($this->_sorting as $order_by => $direction) {
                    $obj_orm->order_by($order_by, $direction);
                }
            }
        }
        return $obj_orm->find_all();
    }

    public function action_grid() {

        $obj_orm = $this->grid_before();
        $grid = $this->grid($obj_orm);
        $this->grid_after($grid);
    }

    public function grid($obj_orm) {
        $grid = new Grid();
        $grid->link()->action($this->_action_prefix . $this->_model . '/create')->text(I18n::get('add new'))->class('alt_btn');
        $orm = ORM::factory($this->_model);
        $labels = $orm->labels();
        $grid_fields = ORM::factory($this->_model)->_grid_fields;

        foreach ($grid_fields as $field_name => $field_data) {
            if (empty($field_data)) {
//                $field_data = Kohana::$config->load('grid')->as_array();
                $config = new Kohana_Config_File_Reader();
                $field_data = $config->load('grid');
            }
            $label = isset($labels[$field_name]) ? $labels[$field_name] : $field_name;
            $obj = $grid->column($field_data['type'])->field($field_name)->title(I18n::get($label));
            if ($field_data['type'] === 'sortable_text') {
                $obj->order_by($field_name);
                if (isset($this->_sorting[$field_name])) {
                    $obj->direction = $this->_sorting[$field_name];
                }
            }
            if ($field_data['callback']) {
                $obj->callback(array(ORM::factory($this->_model), $field_data['callback']));
            }
        }
        $grid->data($obj_orm);
        return $grid;
    }

    /**
     * this id method for create additional fields to grid
     * and for render grid
     * @param Grid $grid 
     */
    public function grid_after(Grid $grid) {
        $grid->column('action')->title(I18n::get('Actions'))->url($this->_action_prefix . $this->_model . '/edit')->text(I18n::get('edit'))->class('edit');
        $grid->column('action')->title(I18n::get('Actions'))->url($this->_action_prefix . $this->_model . '/delete')->text(I18n::get('delete'))->class('delete');

        $block = View::factory('admin/template/block/full');
        $block->module_header = 'GRID';
        $block->module_content = View::factory('admin/template/container/tab');
        $block->module_content->container_content = $grid->render();
        $this->template->content .= $block;
    }

    public function action_index() {
        parent::action_index();
        $this->action_grid();
    }

    public function get_route_name() {
        return 'admin_' . $this->_model;
    }

    public function get_curr_route_index_url() {
        return Route::url($this->get_route_name(), array('action' => 'index'));
    }

}
