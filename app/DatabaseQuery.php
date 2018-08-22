<?php

namespace App;

class DatabaseQuery {

    public $connect;

    public function __construct(DatabaseConnection $dbConnect) {
        $this->connect = $dbConnect->connection;
    }

    public function fetchAll($query) {
        $stmt = sqlsrv_query($this->connect, $query);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $rows = [];

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            array_push($rows, $row);
        }

        return $rows;
    }

    public function fetchOne($query) {
        $stmt = sqlsrv_query($this->connect, $query);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }


        return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    }

    public function find($tablename, $id) {
        $query = "SELECT * "
                . "FROM $tablename"
                . " WHERE id = $id";

        $stmt = sqlsrv_query($this->connect, $query);
        return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    }

    public function insert($tableName, $data) {
        $tableRow = array_keys($data);
        $tableData = array_values($data);
        $length = count($tableRow);
        $questionMarkArr = array();

        for ($i = 0; $i < $length; $i += 1) {
            array_push($questionMarkArr, '?');
        }

        $comma_separated = implode(",", $questionMarkArr);
        $cols = implode(',', $tableRow);
        $query = "INSERT INTO $tableName($cols) VALUES ($comma_separated)";
        $stmt = sqlsrv_query($this->connect, $query, $tableData);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    public function update($tableName, $data) {
        $id = $data['id'];
        unset($data['id']);

        $tableRow = array_keys($data);
        $tableData = array_values($data);
        $key = implode(',', $tableRow);
        $value = implode(',', $tableData);
        $query = "UPDATE $tableName"
                . " SET " . implode(' = ?, ', array_keys($data)) . ' = ?'
                . " WHERE id = $id";
        $stmt = sqlsrv_query($this->connect, $query, $tableData);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    public function delete($tableName, $id) {
        $query = "DELETE FROM $tableName WHERE id = $id";
        $query2 = "DELETE FROM company WHERE id = $id";
        $stmt = sqlsrv_query($this->connect, $query);
        
        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

}
