<?php

/* 
 * view/LoginView.inc.php
 * @Project: YaddaYaddaYadda
 * @Author: Daniel, Jesper, Marianne & Peter
 */

require_once 'view/View.inc.php';

class LoginView extends View {
    
    public function __construct($model) {
        parent::__construct($model);
    }
    
    private function loginForm() {
        $s = sprintf("\n
            <form action='%s' method='post'>\n
            <table id='login'>\n
                <caption>Login</caption>\n
                <tr>\n
                    <td>Userid:</td><td><input type='text' name='username'/></td>\n
                </tr>\n
                <tr>\n
                    <td>Pwd: </td><td><input type='password' name='password'/></td>\n
                </tr>\n
                <tr>\n
                    <td></td>\n
                    <td>
                        <p>
                        <input class='button' type='submit' value='OK'/>&nbsp;&nbsp;&nbsp;
                        <button class='button' onclick='window.location=./index.php?f=home'>Cancel</button>
                        </p>
                    </td>\n
                </tr>\n", $_SERVER['PHP_SELF']);
                
        if (!Model::areCookiesEnabled()) {
            $s .= "<tr><td colspan='2' class='err'>Cookies 
            from this domain must be 
                      enabled before attempting login.</td></tr>";
        }
        $s .= "          </table>\n";
        $s .= "          </form>\n";
        return $s;
    }
    
    private function displayLogin() {
        $s = "        <main class='main'>\n";
        if (!Authentication::isAuthenticated()) {
            $s .= $this->loginForm();
        }
        $s .= "        </main>\n";
        return $s;
    }
    
    public function display() {
        $this->output($this->displayLogin());
    }
    
}