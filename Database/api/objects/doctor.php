<?php
class Doctor{
    // database connection and table name
    private $conn;
    private $table_name = "Doctor";
    private $database = "HealthDatabase";
    
    // Object Properties
    public $Doctor_ID;
    public $SIN;
    
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
    
    function doctorID($doctorID) {
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as d
                    WHERE d.Doctor_ID = $doctorID";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
    }
    
    function post($doctorID, $sin) {
        $query =   "INSERT INTO $this->database.$this->table_name(Doctor_ID, SIN) VALUES
                    (?,?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$doctorID, $sin]);
        echo "\nNew record created successfuly";
    }
}

?>