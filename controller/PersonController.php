<?php

namespace Controller;

use App\Controller;
use Model\PersonModel;
use Model\CompanyModel;
use App\PersonValidator;
use Exception;
use App\FlashMessage;

class PersonController extends Controller {

    public $model;
    public $companies;

    //Конструктор,който назначава две свойста: Модел - нов обект от PersonModel, Companies - CompanyModel
    public function __construct() {
        $this->model = new PersonModel();
        $this->companies = new CompanyModel();
    }

    //Обръща се към метода selectPerson
    public function personlist() {
        $select = $this->model->selectPerson();
        return $this->view('/person/personlist', $select);
    }

    //Обръща се към метода getCompanies
    public function personadd() {
        $companies = $this->companies->getCompanies();
        return $this->view('person/personadd', $companies);
    }

    //Обръща се към метода getPerson
    public function personedit() {
        if (isset($_GET)) {
            $update = $this->model->getPerson($_GET['id']);
        }
        return $this->view('/person/personedit', $update);
    }

    //Обръща се към метода deletePerson
    public function persondelete() {
        if (isset($_GET['id'])) {
            $delete = $this->model->deletePerson($_GET['id']);
        }
        header('Location: /personlist');
    }

    //Обръща се към метода personSave
    public function personsave() {
        try {
            if (isset($_POST)) {
                $validationResult = PersonValidator::validate($_POST, $this->model->rules());
                if (empty($validationResult)) {
                    $this->model->personSave($_POST);
                    header('Location: /personlist');
                    die();
                } else {
                    FlashMessage::addData($_POST);
                    FlashMessage::setMessage('danger', $validationResult);
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    die();
                }
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    //Обръща се към метода displayRecord
    public function personrecord() {
        if (isset($_GET['id'])) {
            $display = $this->model->displayRecord($_GET['id']);
        }
        return $this->view('/person/personrecord', $display);
    }

}
