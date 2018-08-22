<?php

namespace App;

class Auth {

    //Checks if $_SESSION['user'] has assigned values and returns true or false respectively.
    public static function isLogged() {
        if (isset($_SESSION['user'])) {
            return TRUE;
        }
        return false;
    }

    //Sets $_SESSION['user'] to the given username and password
    public static function setLogin($user) {
        $_SESSION['user'] = $user;
        return true;
    }

    //Returns the username of the user
    public static function getUsername() {
        return $_SESSION['user']['username'];
    }

    //Returns the id of the user
    public static function getUserId() {
        return $_SESSION['user']['id'];
    }

    public static function getUserAvatar() {
        return $_SESSION['user']['avatar'];
    }

//    public static function changeAvatar($avatar){
//        return $_SESSION['user']['avatar'] = $avatar;
//    }
}
