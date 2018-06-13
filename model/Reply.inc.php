<?php

error_reporting(E_ALL);

require_once 'DbP.inc.php';
require_once 'DbH.inc.php';

class Reply extends Model {
    private $yaddaID;
    private $yaddaIDReply;
    
    function __construct($yaddaID, $yaddaIDReply) {
        $this->yaddaID = $yaddaID;
        $this->yaddaIDReply = $yaddaIDReply;
    }

    public function create() {
           
        $sql = "insert into Reply (YaddaID, YaddaIDReply) values (".$this->getYaddaID().",".$this->getYaddaIDReply().")";
        $dbh = Model::connect();
        try {
            $q = $dbh->prepare($sql);
            $q->execute();
        } catch(PDOException $e) {
            printf("<p>Insert failed on Reply: <br />%s<br />%s</p>\n",
                $e->getMessage(), $sql);
            throw $e;
        }
        $dbh->query('commit');
    }
    
    public function update() {
        
    }
    
    function getYaddaID() {
        return $this->yaddaID;
    }

    function getYaddaIDReply() {
        return $this->yaddaIDReply;
    }

    function setYaddaID($yaddaID) {
        $this->yaddaID = $yaddaID;
    }

    function setYaddaIDReply($yaddaIDReply) {
        $this->yaddaIDReply = $yaddaIDReply;
    }    
}