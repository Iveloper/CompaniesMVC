<?php

namespace Controller;

use App\Controller;
use Model\UserModel;
use App\Auth;
use Exception;

class AuthController extends Controller {

    public $model;

    //Sets the property "model" to a new object of type UserModel.
    public function __construct() {
        $this->model = new UserModel();
    }

    /* This function sends two arguments (Username and Password) from the login form to the "auth" function from the UserModel. The auth function takes the two params,makes a query to the
     * database from where selects a row, which has username and password equal to these in the login form. If everything matches, the function sets the SQL row to the "setLogin" function
     * from Auth class. "setLogin" takes the row and sets a value to the $_SESSION array with key ['user'].
     */

    public function login() {
        try {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $auth = $this->model->auth($_POST['username'], $_POST['password']);
                Auth::setLogin($auth);
                header('Location: /companylist');
                die();
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        return $this->view('auth/login');
    }

    public function getAvatar() {
        $avatar = $this->model->userAvatar();
        Auth::getUserAvatar($avatar);
        header('Location: /companylist');
        die();
    }

    //In order to log an user out, this function destroys the session.
    public function logout() {
        session_destroy();
        header('Location: /login');
    }

}
