<?php

class Prescribes {

    // database connection and table name
    private $conn;
    private $table_name = "Prescribes";
    private $database = "HealthDatabase";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insert($did, $hnum, $pname, $SDate, $EDate) {
        $query =   "INSERT INTO $this->database.$this->table_name(Doctor_ID, H_Number, PName, Start_Date, End_Date) VALUES
        (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$did, $hnum, $pname, $SDate, $EDate]);
        return $stmt;
    }

    /*public function readDates($did, $hnum, $pname){
        $query = "SELECT *
                  FROM $this->database.$this->table as p
                  WHERE p.Pname = '$pname' and p.Doctor_ID = '$did' and p.H_Number = '$hnum'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }*/
}