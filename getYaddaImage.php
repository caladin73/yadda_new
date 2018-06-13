<?php
    session_start();

    require_once './model/Model.inc.php';
    $dbh = Model::connect();

    foreach($_GET as $key => $value) {
        $$key = trim($value);  // vars with names as in form
    }
    
    if(isset($id)) {
        $sql  = "SELECT Imagedata, mimetype FROM Image where YaddaID = :id";
    
        try {    
            $q = $dbh->prepare($sql);
            $q->bindValue(':id', $id);
            $q->execute();
            $out = $q->fetch();
        } catch(PDOException $e)  {
            printf("Error getting yadda image.<br/>". $e->getMessage(). '<br/>' . $sql);
            die('Error getting image');
        } catch(Exception $e)  {
            printf("Error getting yadda image.<br/>". $e->getMessage(). '<br/>' . $sql);
            die('Error getting image');
        }
        if(!$out) {
            echo 'XX';
            die();
        }
        
        $out['Imagedata'] = stripslashes($out['Imagedata']);
        header("Content-type: " . $out['mimetype']);
        echo $out['Imagedata'];	
    } else {
        echo 'X';
    }
    