<?php

//
// Author : Jesper Uth Krab
// Made On : Oct 23, 2017 2:25:56 PM  
//

    error_reporting(E_ALL);

    require_once 'DbP.inc.php';
    require_once 'DbH.inc.php';

    class Users extends Model
    {
        private $username;
        private $password;
        private $name;
        private $email;
        private $admin;
        private $activated;
        private $profileImage;

    function __construct($Username, $Password, $Name, $Email, $Activated)
    {
        $this->username = $Username;
        $this->password = $Password;
        $this->email = $Email;
        $this->name = $Name;
        $this->email = $Email;
        $this->activated = $Activated;
    }

    function getProfileImage() {
        return $this->profileImage;
    }

    function setProfileImage($profileImage) {
        $this->profileImage = $profileImage;
    }

    public function getUsername() {
        return $this->username;
    }
    
    public function setUsername($Username) {
        $this->username = $Username;
    }

    public function getPassword() {
        return $this->password;
    }
    public function setPassword($Password) {
        $this->password = $Password;
    }

    public function getEmail() {
        return $this->email;
    }
    public function setEmail($Email) {
        $this->email = $Email;
    }

    public function getName() {
        return $this->name;
    }
    public function setName($Name) {
        $this->name = $Name;
    }

    public function getAdmin() {
        return $this->admin;
    }
    public function setAdmin($Admin) {
        $this->admin = $Admin;
    }

    public function getActivated() {
        return $this->activated;
    }
    public function setActivated($Activated) {
        $this->activated = $Activated;
    }

    public function create()
    {
        if(!(isset($_FILES['profileimage']))) {
            header("Location: index.php?f=register&error=2");
        } else if ($_FILES['profileimage']['error'] > UPLOAD_ERR_OK) {

            if($_FILES['profileimage']['error'] == UPLOAD_ERR_FORM_SIZE) {
                $_SESSION["error"] = "The file is too big";
            }
            header("Location: index.php?f=register&error=1");
        } else {

            $sql = "insert into Users (Username, Password, Name, Email, Admin, ProfilImage, Activated, mimetype) 
                        values (:uid, :pwd, :name, :email, :admin, :profileimg, :activated, :mimetype)";

            $profileImage = addslashes(file_get_contents($_FILES['profileimage']['tmp_name']));
            $imagetype = $_FILES['profileimage']['type'];

            $dbh = Model::connect();
            try {
                $q = $dbh->prepare($sql);
                $q->bindValue(':uid', $this->getUsername());
                $q->bindValue(':pwd', password_hash($this->getPassword(), PASSWORD_DEFAULT));
                $q->bindValue(':name', $this->getName());
                $q->bindValue(':email', $this->getEmail());
                $q->bindValue(':admin', 0);
                $q->bindValue(':profileimg', $profileImage);
                $q->bindValue(':activated', 0);
                $q->bindValue(':mimetype', $imagetype);
                $q->execute();
            } catch (PDOException $e) {
                printf("<p>Insert of user failed: <br/>%s</p>\n",
                    $e->getMessage());
            }
            $dbh->query('commit');
        }    
    }

    public function activateUser () {
            $sql = "UPDATE Users SET activated = (:activated) WHERE username = (:username)";

            $dbh = Model::connect();
            try {
                $q = $dbh->prepare($sql);
                $q->bindValue(':username', $this->getUsername());
                $q->bindValue(':activated', $this->getActivated());
                $q->execute();
            } catch (PDOException $e) {
                printf("<p>Insert of user failed: <br/>%s</p>\n",
                    $e->getMessage());
            }
            $dbh->query('commit');
        }

    public static function retrieveMany()
    {
            $users = array();
        $dbh = Model::connect();

        $sql = "select *";
        $sql .= " from view_allUsers";
        try {
            $q = $dbh->prepare($sql);
            $q->execute();
            while ($row = $q->fetch()) {
                $user = new Users($row['Username'], null, $row['Name'], $row['Email'], $row['Activated']);
                //$user = self::createObject($row);
                array_push($users, $user);
            }
        } catch(PDOException $e) {
            printf("<p>Query of users failed: <br/>%s</p>\n",
                $e->getMessage());
        } finally {
            return $users;
        }
    }
        
    public function __toString() {
        return $this->getUsername()." - ".($this->activated ? ', activated' : ', not activated');
    }

    public static function retrieveOne()
    {

    }

    public function update()
    {

    }

    public static function createObject($a)
    {
        //$Username, $Password, $Name, $Email, $ProfileImage (Order important!)
        $user = new Users($a['username'], $a['password'], $a['name'], $a['email'], $a['activated']);
        if (isset($a['password'])) {
            $user->setPassword($a['password']);
        }
        return $user;
    }
}