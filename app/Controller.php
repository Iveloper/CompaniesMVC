<?php
namespace App;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Controller
 *
 * @author ivelin
 */
class Controller {

    //put your code here
    
    /*The First parameter is the path to the file, the second parameter is a method from the model which executes and processes queries.
     * Extract method allows every key from the array which is returned in the model to be accessed in the view as a variable with the exact same name.
     *     */
    public function view($key, $data = []) {
        extract($data);

        require ROOT_DIR . "/view/$key.php";
    }

}
