<?php
class Prescription{
    // database connection and table name
    private $conn;
    private $table_name = "Prescription";
    private $database = "HealthDatabase";
    
    // Object Properties
    public $Pname;
    public $Type;
    public $Field;
    
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
    
    function pname($pname) {
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as p
                    WHERE p.Pname = '$pname'";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
    }
    
    function post($pname, $type, $field) {
        $query =   "INSERT INTO $this->database.$this->table_name(PName, Type, Field) VALUES
                    (?,?,?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$pname, $type, $field]);
        return $stmt;
    }
}

?>