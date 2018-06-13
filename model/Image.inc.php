<?php

//
// Author : Jesper Uth Krab
// Made On : Oct 23, 2017 3:36:14 PM  
//

error_reporting(E_ALL);

require_once 'Yadda.inc.php';

class Image {
    private $yaddaID;
    private $imagedata;
    
    public function getImagedata() {
        return $this->imagedata;
    }
    public function setImagedata($Imagedata) {
        $this->imagedata = $Imagedata;
    }
      
    function __construct($YaddaID, $Imagedata) {
        $this->yaddaID = $YaddaID;
        $this->imagedata = $Imagedata;
    }

    function getYaddaID() {
        return $this->yaddaID;
    }

    function setYaddaID($YaddaID) {
        $this->yaddaID = $YaddaID;
    }
}