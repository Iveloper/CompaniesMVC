<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

/**
 * Description of FlashMessage
 *
 * @author ivelin
 */
class FlashMessage {

    public static function setMessage($type, $message) {
        $_SESSION['msg']['type'] = $type;
        $_SESSION['msg']['message'] = $message;

        return true;
    }

    public static function getMessage() {
        if (isset($_SESSION['msg'])) {
            self::createDiv();          
            unset($_SESSION['msg']);
        } else {
            echo '';
        }
    }
    
    public static function createDiv(){
        
       if(is_array($_SESSION['msg']['message'])) {
                foreach ($_SESSION['msg']['message'] as $msg) {
                    echo '<div class="alert alert-' . $_SESSION['msg']['type'] . ' role="alert">' . $msg . '</div>';
                }
            } else {
                echo '<div class="alert alert-' . $_SESSION['msg']['type'] . ' role="alert">' . $_SESSION['msg']['message'] . '</div>';
            }
        }
    
    public static function addData($data) {
        $_SESSION['formdata'] = $data;
        return true;
    }
    
    public static function getData($element){
        if(isset($_SESSION['formdata'][$element])){
            return $_SESSION['formdata'][$element];
        }
        return '';
    }
    
    public static function unsetData() {
        if(isset($_SESSION['formdata'])) {
            unset($_SESSION['formdata']);
        }
            
        return true;
    }

}
