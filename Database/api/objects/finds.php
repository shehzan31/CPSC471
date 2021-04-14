<?php
class Finds {
    // database connection and table name
    private $conn;
    private $table_name = "Finds";
    private $database = "HealthDatabase";

    // Object properties
    public $Doctor_ID;
    public $H_Number;
    public $Condition;
    public $Date;
    public $Chart;

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {
        $query =   "SELECT 
                    *
                    FROM
                        ". $this->database . "." . $this->table_name ."";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query); 

        //execute query 
        $stmt->execute();
        return $stmt;
    }

    function doctor_ID($doctor_ID) {
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as f
                    WHERE f.Doctor_ID = $doctor_ID";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    function hnumber($hnumber) {
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as f
                    WHERE f.H_Number = $hnumber";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
    }
    
    function condition($condition) {
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as f
                    WHERE (f.Condition = '$condition')";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
    }
    
    function post($Doctor_ID, $H_Number, $Condition, $Date, $Chart) {
        $query =   "INSERT INTO $this->database.$this->table_name(Doctor_ID, H_Number, `Condition`, Date, Chart) VALUES
                    (?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$Doctor_ID, $H_Number, $Condition, $Date, $Chart]);
        echo "\nNew record created successfuly";
    }
    
    function insert($Doctor_ID, $H_Number, $Condition, $Date, $Chart) {
        $query =   "INSERT INTO $this->database.$this->table_name(Doctor_ID, H_Number, `Condition`, Date, Chart) VALUES
                    (?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$Doctor_ID, $H_Number, $Condition, $Date, $Chart]);
        return $stmt;
    }
}
?>