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
}

?>