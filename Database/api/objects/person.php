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
}
?>