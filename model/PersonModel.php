<?php

namespace Model;

use Model\BaseModel;
use App\Auth;
use App\FlashMessage;

class PersonModel extends BaseModel {

    const tableName = 'Person';

    public function __construct() {
        parent::__construct();
    }

    //This method filters the information and returns an array with the processed info.
    public function selectPerson() {
        $this->applyFilters();

        $sql = "select t.id, t.name, t.adress, t.phone, t.email, t.companyname AS company
                   from (
                        select ROW_NUMBER() over(order by p.id) row, p.id, p.name, p.adress, p.phone, p.email, c.name AS companyname "
                . "from " . self::tableName . " p JOIN company c ON c.id = p.company_id" . " "
                . "WHERE p.user_id = " . Auth::getUserId() . ""
                . ")t ";
        $sql .= $this->paginateSql;
        
        
        if (isset($_GET['searchPerson']) && $_GET['searchPerson']) {
            $sql .= $this->searchPerson;
        }


        if (isset($_GET['order'])) {
            $sql .= $this->orderBySql;
        }
        $sort = $this->db->fetchAll($sql);


        
        $totalSql = "select count(p.id) as total "
                . "from " . self::tableName . " p JOIN company c ON c.id = p.company_id WHERE p.user_id = " . Auth::getUserId();
        $totalSql .= $this->rows;
        $totalRows = $this->db->fetchAll($totalSql);

        return [
            'sort' => $sort,
            'orderPerson' => $this->order,
            'total' => $totalRows,
            'perPage' => $this->perPage
        ];
    }

    //Deletes a person from the DB
    public function deletePerson($id) {
        FlashMessage::setMessage('danger', 'Your data has been deleted!');
        return $this->db->delete(self::tableName, $id);
    }

    //Checks if the given parameter already exists in the DB, if so it leads to page to update the info, if not to insert info in the DB
    public function personSave($data) {
        if (isset($data['id']) && $data['id']) {
            FlashMessage::setMessage('success', 'Your data has been updated!');

            return $this->db->update(self::tableName, $data);
        } else {
            $data['user_id'] = Auth::getUserId();
            FlashMessage::setMessage('success', 'Your data has been inserted!');

            return $this->db->insert(self::tableName, $data);
        }
    }

    //This method finds a person by given ID
    public function getPerson($id) {
        return $this->db->find(self::tableName, $id);
    }

    //This method selects all the info about the person and the company by given ID and returns the result.
    public function displayRecord($id) {
        $query = "SELECT p.name, p.adress, p.phone, p.email, c.name AS company_name, c.adress AS company_adress, c.phone AS company_phone, c.email AS company_email 
                    FROM person p
                    JOIN company c ON c.id = p.company_id
                    WHERE p.id = $id";
        return $this->db->fetchAll($query);
    }
    
    public function rules(){
        return $rules = [
                    'name' => [
                        'required' => 1,
                        'size' => 20,
                        'numbersOnly' => false
                    ],
                    'email' => [
                        'required' => 1,
                        'size' => 50,
                        'numbersOnly' => false,
                        'checkEmail' => true
                    ],
                    'adress' => [
                        'required' => 1,
                        'size' => 100,
                        'numbersOnly' => false
                    ],
                    'phone' => [
                        'required' => 1,
                        'size' => 10,
                        'numbersOnly' => true
                    ]
                ];
    }

}
