<?php

class DbConnection {

    private static $instance = null;
    private $conn;
    private $dbserver = "localhost";
    private $dbname = "meubanco";
    private $dbuser = "root";
    private $dbpasswrd = "";

    private function __construct(){
        $this->conn = new PDO("mysql:host={$this->dbserver};dbname={$this->dbname}", $this->dbuser, $this->dbpasswrd);
    }

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new DbConnection();
}
    
        return self::$instance;
    }
  
    public function getConnection(){
        return $this->conn;
    }

}

?>