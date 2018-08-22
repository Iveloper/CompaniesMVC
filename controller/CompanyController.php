<?php

namespace Controller;

use App\Controller;
use Model\CompanyModel;
use App\Validator;
use Exception;
use App\FlashMessage as FlashMessage;

class CompanyController extends Controller {

    public $model;

    //Sets "model" property to a new object of type CompanyModel
    public function __construct() {
        $this->model = new CompanyModel();
    }

    //Gets "getCompanies" method from the Model.
    public function companylist() {
        $companies = $this->model->getCompanies();
        return $this->view('company/companylist', $companies);
    }

    //Gets "getContragentTypes" method from the Model.
    public function companyadd() {
        $contragent_types = $this->model->getContragentTypes();
        return $this->view('company/companyadd', $contragent_types);
    }

    //Gets "companySave" method from the Model.
    public function companysave() {
        try {
            if (isset($_POST)) {
                $validationResult = Validator::validate($_POST, $this->model->rules());
                if (empty($validationResult)) {
                    $this->model->companySave($_POST);
                    header('Location: /companylist');
                    die();
                } else {
                    FlashMessage::addData($_POST);
                    FlashMessage::setMessage('danger', $validationResult);
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    die;
                }
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    //Gets "getCompany" method from the Model.
    public function companyedit() {
        $company = $this->model->getCompany($_GET['id']);
        $contragentTypes = $this->model->getContragentTypes();

        return $this->view('company/companyedit', array('company' => $company, 'contragentType' => $contragentTypes));
    }

    //Gets "deleteCompany" method from the Model.
    public function companydelete() {
        if (isset($_GET['id'])) {
            $this->model->deleteCompany($_GET['id']);
        }
        header('Location: /companylist');
        die();
    }

    //Gets "companyPreview" method from the Model.
    public function companyrecord() {

        if (isset($_GET['id'])) {
            $preview = $this->model->companyPreview($_GET['id']);
        }
        return $this->view('/company/companyrecord', $preview);
    }

    //Gets "displayPerson" method from the Model.
    public function displayperson() {
        if (isset($_GET['id'])) {
            $display = $this->model->displayPerson($_GET['id']);
        }
        return $this->view('/company/displayperson', $display);
    }

}
