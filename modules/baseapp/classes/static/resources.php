<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<?php

abstract class Static_Resources {   

    private function __clone() {}

    abstract public function getAll();
}

