<?php
class MedicalRecordCondition{
    // database connection and table name
    private $conn;
    private $table_name = "MR_Conditions";
    private $database = "HealthDatabase";

    //Object properties
    public $MR_Number;
    public $Condition;

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
    
    function showAllConditions($mr_number){
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as a
                    WHERE a.MR_Number = $mr_number";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();
        return $stmt;
    }
    
    function showAllHConditions($hnum){
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as a
                    WHERE a.H_Number = $hnum";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);
        
        //execute query
        $stmt->execute();
        return $stmt;
    }
    
    function insert($mr_number, $condition) {
        $query =   "INSERT INTO $this->database.$this->table_name(MR_Number, `Condition`) VALUES
        (?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$mr_number, $condition]);
        return $stmt;
        echo "\nNew record created successfuly";

    }

}
?>