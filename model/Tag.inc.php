<?php

//
// Author : Jesper Uth Krab
// Made On : Oct 23, 2017 2:56:07 PM  
//

error_reporting(E_ALL);

require_once 'Tag.inc.php';

class Tag {
    private $tagName;
    private $yaddaID;
    
    function __construct($TagName, $YaddaID) {
        $this->tagName = $TagName;
        $this->yaddaID = $YaddaID;
    }
 
    /**
     * Returns text with tag link formatting. Html.
     * @return string
     */
    public static function getTextWithTagLinks($text) {
        $s = "";
        
        $tokens = explode(" ",$text);
        
        foreach ($tokens as $tok) {
            if(preg_match("/¤/", $tok)) {
                $s .= "<a href='TODO_getyaddaswiththistag.php?tag=".$tok."'>".$tok."</a> ";
                
            } else {
                $s .= $tok." ";
            }
                
        }
        
        return $s;
    }
    
    public static function getTagsInText($text) {
        return preg_grep("/^¤\w+/", explode(' ', $text));     
    }
    
    public function getTagName() {
        return $this->tagName;
    }
    public function setTagName($TagName) {
        $this->tagName = $TagName;
    }
       
    public static function create($tags, $yaddaID) {
        
        if(isset($yaddaID) && strcmp($yaddaID, '')<>0 && count($tags) > 0) {
            
            $sql = "insert into Tag (Tagname, YaddaID) values ";

            foreach($tags as $x => $x_value) {

                $sql .= sprintf(" ('%s', '%s'),"
                                    , $x_value
                                    , $yaddaID
                                );
            }
            $sql = substr($sql, 0, -1); // fjern sidste ','
            
            $dbh = Model::connect();
            try {
                $q = $dbh->prepare($sql);
                $q->execute();
            } catch(PDOException $e) {
                printf("<p>Insert failed on Tag: <br />%s<br/>%s</p>\n",
                    $e->getMessage(), $sql);
                throw $e;
            }
            $dbh->query('commit');
        }
    }
    
    public function getTag () {
        
    }
    
    public function retrieveMany () {
        
    }
    
    public function createObject () {
        
    }
    
    function getYaddaID() {
        return $this->yaddaID;
    }

    function setYaddaID($YaddaID) {
        $this->yaddaID = $YaddaID;
    }
}