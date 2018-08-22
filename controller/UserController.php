<?php

namespace Controller;

use App\Controller;
use Model\UserModel;
use Exception;

class UserController extends Controller {

    public $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function useradd() {
        return $this->view('users/useradd', array());
    }

    public function userlist() {
        $select = $this->model->selectUser();

        return $this->view('users/userlist', $select);
    }

    public function useredit() {
        if (isset($_GET)) {
            $update = $this->model->getUser($_GET['id']);
        }
        return $this->view('users/useredit', $update);
    }

    public function usersave() {
        try {
            if (isset($_POST)) {
                $this->model->personSave($_POST);
                header('Location: /userlist');
                die();
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function useractivate() {
        if (isset($_GET['id'])) {
            $activate = $this->model->activateUser($_GET['id']);
        }
        header('Location: /userlist');
        die();
    }

    public function userdelete() {
        if (isset($_GET['id'])) {
            $delete = $this->model->deleteUser($_GET['id']);
        }
        header('Location: /userlist');
        die();
    }

    public function avatarupload() {
        if (isset($_GET)) {
            $update = $this->model->getUser($_GET['id']);
        }
        return $this->view('users/avatarform', $update);
    }

    public function getAvatar() {
        if (isset($_POST)) {
            if (is_uploaded_file($_FILES['avatar']['tmp_name'])) {

                $this->model->getAvatar($_FILES['avatar'], $_POST);
                // Auth::changeAvatar($_FILES['avatar']['name']); 
            
                
            }
        }
        header('Location: /userlist');
        die();
    }

}
