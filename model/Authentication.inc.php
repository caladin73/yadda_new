<?php
   
/* 
 * model/AuthA.inc.php
 * @Project: YaddaYaddaYadda
 * @Author: Daniel, Jesper, Marianne & Peter
 */

require_once 'AuthA.inc.php'; // include the login parent

class Authentication extends AuthA {
    
    protected function __construct($user, $pwd) {
        parent::__construct($user);
        try {
            self::dbLookUp($user, $pwd);                        // invoke auth
            $_SESSION[self::$sessvar] = $this->getUserId();     // succes
        }
        catch (Exception $e) {
            self::$logInstance = FALSE;
            unset($_SESSION[self::$sessvar]);                   //miserys
        }      
    }
    
    public static function getUsername() {
        return $_SESSION[self::DISPVAR2];
    }
    
    public static function authenticate($user, $pwd) {
        if (! self::$logInstance) {
            self::$logInstance = new Authentication($user, $pwd);
        }
        return self::$logInstance;
    }

    protected static function dbLookUp($user, $pwd) {
        // Using prepared statement to prevent SQL injection
        $sql = "select Username, Password 
                from Users
                where Username = :uid
                and Activated = 1;";
        $dbh = Model::connect();
        try {
            $q = $dbh->prepare($sql);
            $q->bindValue(':uid', $user);
            $q->execute();
            $row = $q->fetch();
            if (!($row['Username'] === $user
                    && password_verify($pwd, $row['Password']))) { 
                 throw new Exception("Not authenticated", 42);   //misery
            }
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }
}

