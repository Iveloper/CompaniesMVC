<?php

namespace Model;

use Model\BaseModel;
use App\Auth;
use App\FlashMessage;

class CompanyModel extends BaseModel {

    const tablename = 'company';

    public function __construct() {
        parent::__construct();
    }

    //This method filters the information and returns an array with the processed info.
    public function getCompanies() {
        $this->applyFilters();

        $sql = "
                select id, name, adress, phone, email, bulstat, contragent_type, note, row
                from (
                    select ROW_NUMBER() over(order by id) row, id, name, adress, phone, email, bulstat, contragent_type, note
                    from (
                        select id, name, adress, phone, email, bulstat, contragent_type, note "
                        . "from " . self::tablename . " "
                        . "WHERE user_id = " . Auth::getUserId() . "
                    ) t
                    WHERE 1=1 ";
        $sql .= $this->searchCompany;
        $sql .= ") t " . $this->paginateSql;

        $companies = $this->db->fetchAll($sql);


        $totalSql = "select count(id) as total "
                . "from " . self::tablename . " "
                . "WHERE user_id = " . Auth::getUserId();

        $totalSql .= $this->searchCompany;
        
        $totalRows = $this->db->fetchAll($totalSql);

        
        return [
            'companies' => $companies,
            'order' => $this->order,
            'total' => $totalRows,
            'perPage' => $this->perPage
        ];
    }

    //Returns a company by given ID
    public function getCompany($id) {
        return $this->db->find(self::tablename, $id);
    }

    //Deletes a company by given ID
    public function deleteCompany($id) {
        FlashMessage::setMessage('danger', 'Your data has been deleted!');
        return $this->db->delete(self::tablename, $id);
    }

    //Checks the id if exists in the DB and from that decides wheter to insert or update it.
    public function companySave($data) {
        if (isset($data['id']) && $data['id']) {
            //edit
            FlashMessage::setMessage('success', 'Your data has been updated successfully!');
            return $this->db->update(self::tablename, $data);
        } else {
            $data['user_id'] = Auth::getUserId();
            FlashMessage::setMessage('success', 'Your data has been inserted successfully!');
            return $this->db->insert(self::tablename, $data);
        }
    }

    //Returns all the possible contragent types as dropdown buttons
    public function getContragentTypes() {
        $query = "SELECT id, name FROM COMPANY_TYPE";

        return $this->db->fetchAll($query);
    }

    //Displays all the information about a company
    public function companyPreview($id) {
        $query = "SELECT c.id, c.name, c.adress, c.phone, c.email, c.bulstat, c.note, ct.name AS contragent_type
                    FROM  company c
                    JOIN company_type ct ON ct.id = c.contragent_type
                    WHERE c.id = $id";

        return $this->db->fetchAll($query);
    }

    //Displays the info of a person who works for the company given by id
    public function displayPerson($id) {
        $query = "SELECT p.name, p.adress, p.email, p.phone 
                    FROM person p
                    JOIN company c ON c.id = p.company_id
                    WHERE c.id = $id";
        return $this->db->fetchAll($query);
    }
    
    public function rules(){
        return $rules = [
                    'name' => [
                        'required' => 1,
                        'size' => 20,
                        'numbersOnly' => false
                    ],
                    'bulstat' => [
                        'required' => 1,
                        'size' => 10,
                        'numbersOnly' => true,
                    ],
                    'email' => [
                        'required' => 1,
                        'size' => 50,
                        'numbersOnly' => false,
                        'checkEmail' => true,
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
