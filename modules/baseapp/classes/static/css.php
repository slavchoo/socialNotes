<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<?php

class Static_CSS extends Static_Resources {

    private $resources = array();
    static protected $instance = NULL;
    
    public function add($resource) {
        if ($resource)
        {
            $this->resources[] = $resource;
        }
    }

    public function getAll() {
        $str = "";
        foreach ($this->resources as $resource)
        {
            $str .= Html::style($resource)."\n";
        }
        return $str;
    }

    /**
     *
     * @return Static_CSS 
     */
    public static function getInstance() {
        if (self::$instance == NULL)
        {
            self::$instance = new Static_CSS();
        }
        return self::$instance;
    }

    private function __construct() {
        
    }

}

?>
