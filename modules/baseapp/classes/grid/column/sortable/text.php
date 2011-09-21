<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of test
 *
 * @author slavchoo
 */
class Grid_Column_Sortable_Text extends Grid_Column_Text {
    
    /**
     * @var string field to order
     */
    public $order_by = "";
    
    /**
     * @var string ordering direction
     */
    public $direction = "ASC";
    
    public function render_header() {
        $html = parent::render_header();
        $anchor = ($this->direction == "ASC")? " &uarr; " : " &darr; ";
        $html .= HTML::anchor(Request::detect_uri().'?order_by='.$this->order_by.'&direction='.$this->direction, $anchor);
        return $html;
    }
}

?>
