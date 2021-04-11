<?php
class Test{
    // database connection and table name
    private $conn;
    private $table_name = "Test";
    private $database = "HealthDatabase";
    
    // Object Properties
    public $TName;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    function read(){
        $query =   "SELECT
                    *
                    FROM
                        ".$this->database . "." . $this->table_name ."";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);
        
        //execute query
        $stmt->execute();
        return $stmt;
    }
    
    function tName($tname) {
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as t
                    WHERE t.TName = $tname";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
    }
    
    function post($tName) {
        $query =   "INSERT INTO $this->database.$this->table_name(TName) VALUES
                    (?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$tName]);
        echo "\nNew record created successfuly";
    }
}

?>