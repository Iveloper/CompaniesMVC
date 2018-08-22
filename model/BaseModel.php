<?php

namespace Model;

use App\DatabaseQuery;
use App\DatabaseConnection;

class BaseModel {

    public $db;
    public $page = 1;
    public $perPage = 5;
    public $order = 'ASC';
    public $searchCompany;
    public $searchPerson;
    public $searchUser;
    public $rows;
    public $paginateSql;
    public $orderBySql;

    //Makes the connection to the Database
    public function __construct() {
        $this->db = new DatabaseQuery(new DatabaseConnection());
    }

    public function applyFilters() {

        if (isset($_GET['option'])) {
            $this->perPage = $_GET['option'];
        }

        if (isset($_GET['page'])) {
            $this->page = $_GET['page'];
        }

        $startFrom = (($this->page - 1) * $this->perPage) + 1;
        $endTo = $startFrom - 1 + $this->perPage;

        if (isset($_GET['searchCompany']) && $_GET['searchCompany']) {
            foreach ($_GET['searchCompany'] as $column => $filterValue) {
                $this->searchCompany .= " AND " . $column . " LIKE '%" . $filterValue . "%'";
            }
        }

        if (isset($_GET['searchPerson']) && $_GET['searchPerson']) {
            foreach ($_GET['searchPerson'] as $column2 => $filterValue2) {
                $this->searchPerson .= " AND " . $column2 . " LIKE '%" . $filterValue2 . "%'";
            }
            foreach($_GET['searchPerson'] as $rows => $values){
                if($rows == 'companyname'){
                    $rows = 'company_id';
                }
                $this->rows .= " AND p." . $rows . " LIKE '%" . $values . "%'";
            }
        }
        
        if (isset($_GET['searchUser']) && $_GET['searchUser']) {
            foreach ($_GET['searchUser'] as $key => $userValue) {
                $this->searchUser .= " AND u." . $key . " LIKE '%" . $userValue . "%'";
            }
        }


        $this->paginateSql = " where row between " . $startFrom . " and " . $endTo;

        if (isset($_GET['sort'])) {

            $this->orderBySql = " ORDER BY " . $_GET['sort'];

            if (isset($_GET['order'])) {
                $this->order = $_GET['order'];
            }

            $this->orderBySql .= ' ' . $this->order;

            if (isset($_GET['order']) && $_GET['order'] == 'ASC') {
                $this->order = 'DESC';
            } else {
                $this->order = 'ASC';
            }
        }
    }

    public function isAdmin() {
        
    }

    public function getCurrentUser() {
        
    }

}
