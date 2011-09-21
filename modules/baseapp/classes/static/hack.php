<?php defined('SYSPATH') or die('No direct access allowed.'); ?>
<?php

class Static_Hack extends Static_Resources {

    private $resources = array();
    static protected $instance = NULL;

    public function add($resource) {
        if ($resource) {
            $this->resources = $resource;
        }
    }

    public function getAll() {
        $str = "";
        foreach ($this->resources as $hack_tag => $resources) {
            $str .= $hack_tag . "\r\n";
            
            foreach ($resources['css'] as $css_link) {//css
                $str .= "\t\t".Html::style($css_link)."\r\n";
            }
            
            foreach ($resources['js'] as $js_link){//js
                $str .= "\t\t".HTML::script($js_link)."\r\n";
            }

            $str .= "\t<![endif]-->\r\n";
        }
        return $str;
    }

    /**
     *
     * @return Static_CSS 
     */
    public static function getInstance() {
        if (self::$instance == NULL) {
            self::$instance = new Static_Hack();
        }
        return self::$instance;
    }

    private function __construct() {
        
    }

}

?>
