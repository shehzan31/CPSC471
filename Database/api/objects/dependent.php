<?php
class Dependent {
    // database connection and table name
    private $conn;
    private $table_name = "Dependent";
    private $database = "HealthDatabase";

    // Object properties
    public $SIN;
    public $D_SSN;
    public $Relationship;

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

}

?>