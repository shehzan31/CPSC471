<?php
class Admin {
    // database connection and table name
    private $conn;
    private $table_name = "Admin";
    private $database = "HealthDatabase";

    // Object properties
    public $Admin_ID;
    public $Master_Login;


    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
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

    function post_person($SIN, $FName, $MInit, $LName, $Address_line, $Province, $City, $Postal_code, $Gender, $DOB) {
        $query =   "INSERT INTO $this->database.$this->Person(SIN, FName, MInit, LName, Address_line, Province, City, Postal_code, Gender, DOB)
                    VALUES ($SIN, $FName, $MInit, $LName, $Address_line, $Province, $City, $Postal_code, $Gender, $DOB);

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        echo "New Person created\n";
    }

    function post_doctor($Doctor_ID, $sin) {
        $query =   "INSERT INTO $this->database.Doctor(Doctor_ID, SIN)
                    VALUES ($Doctor_ID, $sin);

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        echo "New Doctor created\n";
    }

    function doctor_info($Doctor_ID) {
        $query =   "SELECT *
                    FROM $this->database.Doctor as d
                    WHERE d.Doctor_ID = $Doctor_ID";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }
}
?>