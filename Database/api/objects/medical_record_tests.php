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

}
?>