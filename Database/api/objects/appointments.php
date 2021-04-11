<?php
class Appointment {
    // database connection and table name
    private $conn;
    private $table_name = "Appointment";
    private $database = "HealthDatabase";

    // Object properties
    public $Appointment_ID;
    public $location;
    public $date;
    public $time;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query =   "SELECT 
                    *
                    FROM
                        ". $this->database . "." . $this->table_name ."";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query); 

        //execute query 
        $stmt->execute();
        return $stmt;
    }

    function getAppointments($A_ID){
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as a
                    WHERE a.Appointment_ID = $A_ID";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();
        return $stmt;
    }

}

?>