<?php
namespace App;
class DatabaseConnection {
    public $connection;
    public $serverName;
    public $dbName;
    public $username;
    public $password;
    public $infoArray;


    public function __construct() {
        $dbConnectionConfig = require ROOT_DIR . '/config/database.php';
        
        $this->serverName = $dbConnectionConfig['serverName'];
        $this->dbName = $dbConnectionConfig['dbName'];
        $this->username = $dbConnectionConfig['username'];
        $this->password = $dbConnectionConfig['password'];
        $this->infoArray = array("Database" => "$this->dbName", "UID"=>"$this->username", "PWD"=>"$this->password");
        
        try{
            $this->connection = sqlsrv_connect($this->serverName, $this->infoArray);
            
            return $this->connection;
        }
        catch (PDOException $e){
            print $e->getMessage();
            
            die();
        }
    }
}

