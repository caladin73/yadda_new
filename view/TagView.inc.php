<?php

/* 
 * view/TagView.inc.php
 * @Project: YaddaYaddaYadda
 * @Author: Daniel, Jesper, Marianne & Peter
 */

require_once 'view/View.inc.php';

class TagView extends View {
    
    public function __construct($model) {
        parent::__construct($model);
    }
    
    private function displayManyTags() {
        
    }
    
    public function display() {
        $this->output($this->displayManyTags());
    }
    
}

