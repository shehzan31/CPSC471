<?php
class Admin {
    // database connection and table name
    private $conn;
    private $table_name = "Admin";
    private $database = "HealthDatabase";

    private $person_table = "Person";
    private $patient_table = "Patient";
    private $doctor_table = "Doctor";


    // Object properties
    public $Admin_ID;
    public $Password;


    public function __construct($db) {
        $this->conn = $db;
    }

    function read_admin() {
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

    function read_person() {
        $query =   "SELECT 
                    *
                    FROM
                        ". $this->database . "." . $this->person_table ."";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query); 

        //execute query 
        $stmt->execute();
        return $stmt;
    }

    function read_patient() {
        $query =   "SELECT 
                    *
                    FROM
                        ". $this->database . "." . $this->patient_table ."";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query); 

        //execute query 
        $stmt->execute();
        return $stmt;
    }

    function read_doctor() {
        $query =   "SELECT 
                    *
                    FROM
                        ". $this->database . "." . $this->doctor_table ."";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query); 

        //execute query 
        $stmt->execute();
        return $stmt;
    }


    function post_admin($Admin_ID, $Password) {
        $query =   "INSERT INTO $this->database.$this->table_name(Admin_ID, Password)
                    VALUES (?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->execute([$Admin_ID, $Password]);
        echo "New ADMIN created\n";
    }

    function post_person($SIN, $FName, $MInit, $LName, $Address_line, $Province, $City, $Postal_code, $Gender, $DOB) {
        $query =   "INSERT INTO $this->database.$this->person_table(SIN, FName, MInit, LName, Address_line, Province, City, Postal_code, Gender, DOB) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$SIN, $FName, $MInit, $LName, $Address_line, $Province, $City, $Postal_code, $Gender, $DOB]);
        echo "\nNew person created!";
    }

    // function post_person($SIN, $FName, $MInit, $LName, $Address_line, $Province, $City, $Postal_code, $Gender, $DOB) {
    //     $query =   "INSERT INTO $this->database.$this->person_table(SIN, FName, MInit, LName, Address_line, Province, City, Postal_code, Gender, DOB) 
    //                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    //     $stmt = $this->conn->prepare($query);

    //     $stmt->execute([$SIN, $FName, $MInit, $LName, $Address_line, $Province, $City, $Postal_code, $Gender, $DOB]);
    //     echo "New Person created\n";
    // }

    function post_patient($H_Number, $MR_Number, $SIN) {
        $query =   "INSERT INTO $this->database.$this->patient_table(H_Number, MR_Number, SIN) 
                     VALUES (?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$H_Number, $MR_Number, $SIN]);
        echo "\nNew patient created!";
    }

    function post_doctor($Doctor_ID, $SIN) {
        $query =   "INSERT INTO $this->database.$this->doctor_table(Doctor_ID, SIN) 
                     VALUES (?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$Doctor_ID, $SIN]);
        echo "\nNew doctor created!";
    }

    function delete_person($SIN) {
        $query =   "DELETE FROM $this->database.$this->person_table as p
                    WHERE p.SIN = $SIN";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        echo "\nPerson deleted\n";
    }

    function delete_patient($H_Number) {
        $query =   "DELETE FROM $this->database.$this->patient_table as p
                    WHERE p.H_Number = $H_Number";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        echo "\nPatient deleted\n";
    }

    function delete_doctor($Doctor_ID) {
        $query =   "DELETE FROM $this->database.$this->doctor_table as p
                    WHERE p.Doctor_ID = $Doctor_ID";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        echo "\nDoctor deleted\n";
    }
}
?>