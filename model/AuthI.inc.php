<?php

/* 
 * model/AuthI.inc.php
 * @Project: YaddaYaddaYadda
 * @Author: Daniel, Jesper, Marianne & Peter
 */

interface AuthI {
    public static function authenticate($user, $pwd);
    public static function isAuthenticated();
    public static function isAdministrator();
    public static function logout();
}



