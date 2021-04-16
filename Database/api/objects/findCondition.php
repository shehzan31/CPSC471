<?php

class FindCondition {

    // database connection and table name
    private $conn;
    private $table_name = "Finds";
    private $database = "HealthDatabase";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insert($did, $hnum, $cond, $date, $chart) {
        $query =   "INSERT INTO $this->database.$this->table_name(Doctor_ID, H_Number, Condition, Date, Chart) VALUES
        (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$did, $hnum, $cond, $date, $chart]);
        return $stmt;
    }
}