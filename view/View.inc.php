<?php

/* 
 * view/View.inc.php
 * @Project: YaddaYaddaYadda
 * @Author: Daniel, Jesper, Marianne & Peter
 */

require_once './model/Users.inc.php';
require_once './model/Yadda.inc.php';

abstract class View {
    
    protected $model;
    
    public function __construct($model) {
        $this->model = $model;        
    }
    
    private function top() {
        $s = sprintf("<!doctype html>
<html>
  <head>
    <meta charset='utf-8'/>
    <title>YaddaYaddaYadda &trade;</title>
    <link rel='stylesheet' type='text/css' href='css/style.css'>
    <link href='https://fonts.googleapis.com/css?family=Indie+Flower|Roboto:400,500,700' rel='stylesheet'>
  </head>
  <body>
");
        return $s;
    }
    
    private function bottom() {
        $s = sprintf("
     <footer>
     </footer>
  </body>
</html>");
        return $s;
    }
    
    private function topmenu() {
        $s = sprintf("        <header>
            <h1>YaddaYaddaYadda &trade;</h1>\n
            <ul id='menu'>\n
                <li><a href='%s'>Home</a></li>\n",
                $_SERVER['PHP_SELF']);
        if (Authentication::isAuthenticated()) {
            $s .= sprintf("               
                <li><a href='%s?f=yadda'>Yaddas</a></li>\n
                <li><a href='%s?f=profile'>Profile</a></li>\n",
                $_SERVER['PHP_SELF'], $_SERVER['PHP_SELF'], $_SERVER['PHP_SELF'], $_SERVER['PHP_SELF']);
        } else {
            $s .= sprintf("                <li><a href='%s?f=register'>Register User</a></li>\n",
                $_SERVER['PHP_SELF']);
        }
        if (!Authentication::isAuthenticated()) {
            $s .= sprintf("                 <li><a href='%s?f=login'>Login</a></li>\n"
                    , $_SERVER['PHP_SELF']);
        } else { 
            $s .= sprintf("                 <li><a href='%s?f=logout'>Logout</a></li>\n"
                    , $_SERVER['PHP_SELF']);
        }
        $s .= sprintf("             </ul>\n        </header>\n");
        
        if (Authentication::isAuthenticated()) {
            $s .= sprintf("<div class='welcome'><h1>Welcome $%s</h1></div>", Authentication::getLoginId());
        }
        return $s;
    }
    
    public function output($s) {
        print($this->top());
        print($this->topmenu());
        printf("%s", $s);
        print($this->bottom());
    }
    
}

