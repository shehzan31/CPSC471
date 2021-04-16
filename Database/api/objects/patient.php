<?php
class Patient{
    // database connection and table name
    private $conn;
    private $table_name = "Patient";
    private $database = "HealthDatabase";
    
    // Object Properties
    public $H_Number;
    public $MR_Number;
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
    
    function mr_number($h_number) {
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as p
                    WHERE p.H_Number = $h_number";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
    }
    
    function returnPatient($h_number) {
        $query =   "SELECT *
        FROM $this->database.$this->table_name as p
        WHERE p.H_Number = $h_number";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
    }
    function returnHnum($mrnum) {
        $query =   "SELECT *
        FROM $this->database.$this->table_name as p
        WHERE p.MR_Number = $mrnum";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
    }
    
    function post($h_num, $mr_num, $sin) {
        $query =   "INSERT INTO $this->database.$this->table_name(H_Number, MR_Number, SIN) VALUES
                    (?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$h_num, $mr_num, $sin]);
        echo "\nNew record created successfuly";
    }

    function delete_patient($H_Number) {
        $query =   "DELETE FROM $this->database.$this->table_name as p
                    WHERE p.H_Number = $H_Number";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        echo "\nPatient deleted\n";
    }
}

?>