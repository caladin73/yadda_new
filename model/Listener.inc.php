<?php

//
// Author : Jesper Uth Krab
// Made On : Oct 23, 2017 3:40:37 PM  
//

error_reporting(E_ALL);

class Listener {
    private $usernameListener;
    private $usernameListensTo;
    
    public function getUsernameListener() {
        return $this->usernameListener;
    }
    public function setUsernameListener($UsernameListener) {
        $this->usernameListener = $UsernameListener;
    }

    public function getUsernameListensto() {
        return $this->usernameListensTo;
    }
    public function setUsernameListensto($UsernameListensto) {
        $this->usernameListensto = $UsernameListensto;
    }
    
    public function retrieveMany () {
        
    }
    
    public function createObject () {
        
    }
    
    function __construct($UsernameListener, $UsernameListensTo) {
        $this->usernameListener = $UsernameListener;
        $this->usernameListensTo = $UsernameListensTo;
    }
}
