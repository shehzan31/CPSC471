<?php

class Schedule {

    // database connection and table name
    private $conn;
    private $table_name = "Schedules";
    private $database = "HealthDatabase";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function insert($hnum, $aid, $did) {
        $query =   "INSERT INTO $this->database.$this->table_name(H_Number, Appointment_ID, Doctor_ID) VALUES
        (?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->execute([$hnum, $aid, $did]);
        return $stmt;
    }
}