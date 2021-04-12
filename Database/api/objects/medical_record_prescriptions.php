<?php
class Medical_Records_Prescriptions{
    // database connection and table name
    private $conn;
    private $table_name = "MR_Prescriptions";
    private $database = "HealthDatabase";

    //Object properties
    public $MR_Number;
    public $Prescription;

    public function __construct($db) {
        $this->conn = $db;
    }

    function showAllPrescriptions($mr_number){
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as p
                    WHERE p.MR_Number = $mr_number";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();
        return $stmt;
    }
}
?>