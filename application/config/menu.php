<?php

//main menu
return array(
    'Users' => array(
        'View Users' => array(
            'link' => 'admin_user:index',
            'ico_class' => 'icn_view_users',
        ),
        'Add New User' => array(
            'link' => 'admin_user:create',
            'ico_class' => 'icn_add_user',
        ),
    ),
    'Notes' => array(
        'View Notes' => array(
            'link' => 'admin_note:index',
            'ico_class' => 'icn_categories',
        ),
        'Add New Note' => array(
            'link' => 'admin_note:create',
            'ico_class' => 'icn_new_article',
        ),
    ),
    'Admin' => array(
        'Logout' => array(
           'link' => 'auth:logout',
            'ico_class' => 'icn_jump_back',
        ),
    ),
);

