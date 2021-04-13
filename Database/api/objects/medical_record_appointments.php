<?php
class Medical_Records_Appointments{
    // database connection and table name
    private $conn;
    private $table_name = "MR_Appointments";
    private $database = "HealthDatabase";

    //Object properties
    public $MR_Number;
    public $Appointment;

    public function __construct($db) {
        $this->conn = $db;
    }

    function showAllApointments($mr_number){
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as a
                    WHERE a.MR_Number = $mr_number";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute query
        $stmt->execute();
        return $stmt;
    }

    function insert($mr_number, $appointment) {
        $query =   "INSERT INTO $this->database.$this->table_name(MR_Number, Appointment) VALUES
        (?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$mr_number, $appointment]);
        return $stmt;
    }

}
?>