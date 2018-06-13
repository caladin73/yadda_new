<?php
    session_start();
    require_once './DbP.inc.php';
    require_once './DbH.inc.php';
    $dbh = DbH::getDbH();

    foreach($_GET as $key => $value) {
        $$key = trim($value);  // vars with names as in form
    }
    if(isset($id)) {
            $sql  = "SELECT ProfilImage, mimetype FROM Users where Username = :id";
    
        try {    
            $q = $dbh->prepare($sql);
            $q->bindValue(':id', $id);
            $q->execute();
            $out = $q->fetch();
        } catch(PDOException $e)  {
            printf("Error getting image.<br/>". $e->getMessage(). '<br/>' . $sql);
            die('Error getting image');
        } catch(Exception $e)  {
            printf("Error getting image.<br/>". $e->getMessage(). '<br/>' . $sql);
            die('Error getting image');
        }
        $out['ProfilImage'] = stripslashes($out['ProfilImage']);
        header("Content-type: " . $out['mimetype']);
        echo $out['ProfilImage'];	
    } else {
        echo 'X';
    }
    