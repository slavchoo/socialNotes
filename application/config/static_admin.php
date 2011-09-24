<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<?php

return array(
    'js' => array(
        'script/jquery-1.6.3.min.js',
        'script/hideshow.js',
        'script/jquery.tablesorter.min.js',
        'script/jquery.equalHeight.js',
    ),
    'css' => array(
        'css/admin/layout.css',
    ),
    'hack' => array(
        '<!--[if lt IE 9]>' => array(
            'css' => array(
                'css/ie.css',
            ),
            'js' => array(
                'http://html5shim.googlecode.com/svn/trunk/html5.js',
            ),
        ),
    )
);
