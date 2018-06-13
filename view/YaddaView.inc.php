<?php

/* 
 * view/YaddaView.inc.php
 * @Project: YaddaYaddaYadda
 * @Author: Daniel, Jesper, Marianne & Peter
 */

require_once 'view/View.inc.php';

class YaddaView extends View {
    
    public function __construct($model) {
        parent::__construct($model);
    }
    
    private function displayManyYaddas() {
        
        $yaddas = Yadda::retrieveMany(); // hovedyaddas
        //$data = new test_hieraci_data();
                
        $s = "<div class='yaddas'>\n";
        foreach ($yaddas as $yadda) {
            $s .=  sprintf("%s<br />\n"
                , $yadda);
            
            $nodes = "";
            $nodes = Yadda::getChildren($yadda->getYaddaID(), 1, $nodes);
            $s .= $nodes;
        }
        $s .= "</div>\n";
        return $s;
    }
    
    private function yaddaForm() {
        $s = sprintf("
            <form action='%s?f=yadda' method='post' enctype='multipart/form-data' id='yaddaform'>\n
            <table id='create'>\n
                <caption>Post a Yadda&trade;!</caption>\n
                <tr>\n
                    <td>Message:</td><td><input type='text' name='text' required /></td>\n
                </tr>\n
                <tr>\n
                    <td>Image:</td><input type='hidden' name='MAX_FILE_SIZE' value='131072'/><td><input type='file' name='img' accept='image/*'/></td>\n
                </tr>\n
                <tr>\n
                    <td><input class='button' type='submit' value='Go'/></td>
                </tr>
            </div>", $_SERVER['PHP_SELF']);
        
        $s .= "          </table>\n";
        $s .= "          </form>\n";
        include_once './js/validate.js';
        return $s;
    }
    
    private function displayYadda() {
        $s = sprintf("<main id='yaddasmain'>\n%s\n%s</main>\n"
                    , $this->yaddaForm()
                    , $this->displayManyYaddas());
        return $s;
    }
    
    public function display() {
        $this->output($this->displayYadda());
    }   
}