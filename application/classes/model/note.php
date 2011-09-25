<?php

defined('SYSPATH') or die('No direct script access.');

class Model_Note extends Model_Crud {

    public $_form_fields = array('title', 'text', 'actual_date');
    public $_grid_fields = array(
        'id' => array(),
        'title' => array(),
        'slug' => array(),
        'created_at' => array(
            'type' => 'date',
            'callback' => NULL,
        ),
        'user_id' => array(),
        'actual_date' => array(
            'type' => 'date',
            'callback' => NULL,
        ),
    );
    protected $_created_column = array(
        'column' => 'created_at',
        'format' => TRUE,
    );
    protected $_belongs_to = array(
        'user' => array(
            'model' => 'user',
            'foreign_key' => 'user_id',
        ),
    );

}
