<?php
class Medical_Records_Tests{
    // database connection and table name
    private $conn;
    private $table_name = "MR_Tests";
    private $database = "HealthDatabase";

    //Object properties
    public $MR_Number;
    public $Test;

    public function __construct($db) {
        $this->conn = $db;
    }

    function showAllTests($mr_number){
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as t
                    WHERE t.MR_Number = $mr_number";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();
        return $stmt;
    }

    function insert($mr_number, $test_id) {
        $query =   "INSERT INTO $this->database.$this->table_name(MR_Number, Test) VALUES
        (?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$mr_number, $test_id]);
        return $stmt;
    }
    function post($mr_num, $test) {
        $query =   "INSERT INTO $this->database.$this->table_name(MR_Number, Test) VALUES
                    (?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$mr_num, $test]);
        echo "\nNew record created successfuly";
    }

    function delete($Test_ID) {
        $query =   "DELETE FROM $this->database.$this->table_name as d
                    WHERE d.Test = $Test_ID";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        echo "\nMedical Record Test deleted\n";
    }
}
?>