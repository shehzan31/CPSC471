<?php

class Prescribes {

    // database connection and table name
    private $conn;
    private $table_name = "Prescribes";
    private $database = "HealthDatabase";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insert($hnum, $aid, $did) {
        $query =   "INSERT INTO $this->database.$this->table_name(Doctor_ID, H_Number, PName, Start_Date, End_Date) VALUES
        (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$did, $hnum, $pname, $SDate $EDate]);
        return $stmt;
    }
}