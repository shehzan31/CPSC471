<?php
class Person {
    // database connection and table name
    private $conn;
    private $table_name = "Person";
    private $database = "HealthDatabase";

    // Object properties
    public $SIN;
    public $FName;
    public $MInit;
    public $LName;
    public $Address_line;
    public $Province;
    public $City;
    public $Postal_code;
    public $Gender;
    public $DOB;

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

    function sin($sin) {
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as p
                    WHERE p.SIN = $sin";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    function post($SIN, $FName, $MInit, $LName, $Address_line, $Province, $City, $Postal_code, $Gender, $DOB) {
        $query =   "INSERT INTO $this->database.$this->table_name(SIN, FName, MInit, LName, Address_line, Province, City, Postal_code, Gender, DOB) VALUES
                    (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$SIN, $FName, $MInit, $LName, $Address_line, $Province, $City, $Postal_code, $Gender, $DOB]);
        echo "\nNew record created successfuly";
    }

    function delete($SIN) {
        $query =   "DELETE FROM $this->database.$this->table_name as p
                    WHERE p.SIN = $SIN";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        echo "\nPerson deleted\n";
    }

    function edit($SIN, $FName, $MInit, $LName, $Address_line, $Province, $City, $Postal_code, $Gender, $DOB) {
        $query =   "UPDATE $this->database.$this->table_name as p
                    SET p.FName = '$FName', p.MInit = '$MInit', p.LName = '$LName', p.Address_line = '$Address_line', p.Province = '$Province', p.City = '$City', p.Postal_code = '$Postal_code', p.Gender = '$Postal_code', p.DOB = '$DOB'
                    WHERE p.SIN = $SIN";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        echo "\nInformation Updated";
    }

}
?>