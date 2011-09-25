<?php

defined('SYSPATH') or die('No direct access allowed.');

class Helpers_Menu {

    public static function render($config) {
        $menu_arr = Kohana::$config->load('menu')->as_array();
        $html = "";
        Helpers_Menu::process($menu_arr, $html);
        return $html;
    }

    private static function process(array $menu_arr, &$html, $inner = 0) {
        foreach ($menu_arr as $title => $item) {
            if (!$inner) { //print group header
                Helpers_Menu::render_header($title, $html);
                $html .= '<ul class="toggle">';
            }

            if (isset($item['link'])) {
                Helpers_Menu::render_item($title, $item, $html, $inner);
            } else {
                if ($inner) { //print group header
                    $html .= Helpers_Menu::render_header($title, $html, $inner);
                    $html .= '<ul class="toggle">';
                }
                Helpers_Menu::process($item, $html, $inner + 1);

                if ($inner) { //print group header
                    $html .= '</ul>';
                }
            }
            if (!$inner) { //print group header
                $html .= '</ul>';
            }
        }
    }

    private static function render_item($title, $item, &$html) {
        $default_class = 'icn_tags';
        if(isset($item['ico_class'])){
            $default_class = $item['ico_class'];
        }
        $html .= '<li class="'.$default_class.'">' . Helpers_Menu::prepare_url($title, $item['link']) . "</li>";
    }

    private static function render_header($header, &$html, $inner = 0) {
        $html .= '<h3>';
        $i = $inner;
        while ($i--) {
            $html .= "&nbsp;&nbsp;&nbsp;";
        }
        $html .= I18n::get($header) . '</h3>';
    }

    private static function prepare_url($title, $item) {
        if (strpos($item, ':')) {
            list($route_name, $action) = explode(':', $item);
        }else{
            $route_name = $item;
            $action = 'index'; //todo use defauts action value instead index
        }
        return Html::anchor(Route::url($route_name, array('action' => $action)), I18n::get($title));
    }

}