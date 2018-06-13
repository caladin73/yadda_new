<?php
/* 
 * view/UserView.inc.php
 * @Project: YaddaYaddaYadda
 * @Author: Daniel, Jesper, Marianne & Peter
 */

require_once 'View.inc.php';

class UserView extends View {
    
    public function __construct($model) {
        parent::__construct($model);
    }
    
    private function displayul() {
        $users = Users::retrieveMany();
        $s = "<div class='haves'>";
        $s .= "<table id='create'>";
        foreach ($users as $user) {
            $s .=  sprintf("<tr><td>%s</td><tr>\n"
                , $user);
        }
        $s .= "</table>";
        $s .= "</div>";
        return $s;
    }
    
    private function displayUser() {
        $user = Users::retriveOne();
        $s = "<div class='haves'>";
        if ($user == 'Placeholder') {
            $s .= sprintf("%s<br/>\n" , $user);
        } else {
            echo'Houston we have a problem!';
        }
    }

        private function registerForm() {
        $s = sprintf("
            <form id='formalia' action='%s?f=register' method='post' enctype=\"multipart/form-data\">\n
            <table id='create'>\n
                <caption>Create New User</caption>\n
                <tr>\n
                    <td>Username: </td><td><input type='text' name='username'/></td>\n
                </tr>\n
                <tr>\n
                    <td>Email: </td><td><input type='email' name='email'/></td>\n
                </tr>\n
                <tr>\n
                    <td>Name: </td><td><input type='text' name='name'/></td>\n
                </tr>\n
                <tr>\n
                    <td>Profile Image: </td><td><input type=\"file\" name=\"profileimage\" accept=\"image/*\"></td>\n
                </tr>\n
                <tr>\n
                    <td>Pwd: </td><td><input type='password' name='password'/></td>\n
                </tr>\n
                 <tr>\n
                    <td>Pwd repeat:</td><td><input type='password' name='pwd2'/></td>\n
                </tr>\n
                <tr>\n
                    <td><input class='button' type='submit' value='Go'/></td>
                </tr>
            </div>", $_SERVER['PHP_SELF']);
                
        if (!Model::areCookiesEnabled()) {
            $s .= "<tr><td colspan='2' class='err'>Cookies 
            from this domain must be 
                      enabled before attempting login.</td></tr>";
        }
        $s .= "          </div>\n";
        $s .= "          </form>\n";
        include_once './js/createUserVerify.js';
        return $s;
    }

    private function userActivateForm() {
        $s = sprintf("
            <form action='%s?f=profile' method='post'>\n
            <table id='create'>\n
                <caption>Activate User</caption>\n
                <tr>\n
                    <td>Username:</td><td><input type='text' name='username'/></td>\n
                </tr>\n
                <tr>
                <td><input type='radio' name='activated' value='1' checked></td><td> Activate</td>\n
                </tr>
                <tr>
                <td><input type='radio' name='activated' value='0'></td><td> Deactivate</td>\n
                </tr>
                <tr>\n
                    <td><input class='button' type='submit' value='Go'/></td>
                </tr>
            </div>", $_SERVER['PHP_SELF']);

        if (!Model::areCookiesEnabled()) {
            $s .= "<tr><td colspan='2' class='err'>Cookies 
            from this domain must be 
                      enabled before attempting login.</td></tr>";
        }
        $s .= "          </div>\n";
        $s .= "          </form>\n";
        return $s;
    }

    private function displayRegister() {
        $s = sprintf("<main class='main'>\n%s</main>\n"
                    , $this->registerForm());
        return $s;
    }
    
    private function displayActivate() {
        $s = sprintf("<main class='main'>\n%s\n%s</main>\n"
                    , $this->displayul()
                    , $this->userActivateForm());
        return $s;
    }

    public function display(){
       $this->output($this->displayRegister());
    }
    
    public function displayAdmin() {
        $this->output($this->displayActivate());
    }
}
