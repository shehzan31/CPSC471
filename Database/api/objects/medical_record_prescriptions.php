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
    function insert($mr_number, $pname) {
        $query =   "INSERT INTO $this->database.$this->table_name(MR_Number, Prescription) VALUES
        (?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$mr_number, $pname]);
        return $stmt;
    }
    function post($mr_num, $pres) {
        $query =   "INSERT INTO $this->database.$this->table_name(MR_Number, Prescription) VALUES
                    (?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$mr_num, $pres]);
        echo "\nNew record created successfuly";
    }
}
?>