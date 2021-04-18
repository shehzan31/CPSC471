<?php
class Doctor{
    // database connection and table name
    private $conn;
    private $table_name = "Doctor";
    private $database = "HealthDatabase";
    private $Orders_Table = "Orders";
    private $MR_Test_Table = "MR_Tests";
    private $Test_Table = "Test";
    
    // Object Properties
    public $Doctor_ID;
    public $SIN;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    function read(){
        $query =   "SELECT
                    *
                    FROM
                        ".$this->database . "." . $this->table_name ."";
        
        //prepare query statement
        $stmt = $this->conn->prepare($query);
        
        //execute query
        $stmt->execute();
        return $stmt;
    }
    
    function doctorID($doctorID) {
        $query =   "SELECT *
                    FROM $this->database.$this->table_name as d
                    WHERE d.Doctor_ID = $doctorID";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->execute();
        return $stmt;
    }
    
    function post($doctorID, $sin) {
        $query =   "INSERT INTO $this->database.$this->table_name(Doctor_ID, SIN) VALUES
                    (?,?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$doctorID, $sin]);
        echo "\nNew record created successfuly";
    }

    function orderNewTest($Doctor_ID, $H_Number, $MR_Number, $Test_ID, $Test_Name, $Date, $Result) {
        $query1 =   "INSERT INTO $this->database.$this->Orders_Table(Doctor_ID, H_number, Test_ID) VALUES
                    (?,?,?)";
        
        $stmt1 = $this->conn->prepare($query1);
        $stmt1->execute([$Doctor_ID, $H_Number, $Test_ID]);

        $query2 =   "INSERT INTO $this->database.$this->MR_Test_Table(MR_Number, Test) VALUES
                    (?,?)";
        
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->execute([$MR_Number, $Test_ID]);

        $query3 =   "INSERT INTO $this->database.$this->Test_Table(TName, Test_ID, Date, Result) VALUES
                    (?,?,?,?)";
        
        $stmt3 = $this->conn->prepare($query3);
        $stmt3->execute([$Test_Name, $Test_ID, $Date, $Result]);
        echo "\nNew test created successfuly";
    }


    function delete($Doctor_ID) {
        $query =   "DELETE FROM $this->database.$this->table_name as p
                    WHERE p.Doctor_ID = $Doctor_ID";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        echo "\nDoctor deleted\n";
    }


    function deleteTest($Doctor_ID, $H_Number, $MR_Number, $Test_ID) {
        $query1 =   "DELETE FROM $this->database.$this->Orders_Table as p
                    WHERE p.Doctor_ID = $Doctor_ID AND p.H_number = $H_Number AND p.Test_ID = $Test_ID";

        $stmt1 = $this->conn->prepare($query1);

        $stmt1->execute();

        $query2 =   "DELETE FROM $this->database.$this->MR_Test_Table as p
                    WHERE p.MR_Number = $MR_Number AND p.Test = $Test_ID";

        $stmt2 = $this->conn->prepare($query2);

        $stmt2->execute();

        $query3 =   "DELETE FROM $this->database.$this->Test_Table as p
                    WHERE p.Test_ID = $Test_ID";

        $stmt3 = $this->conn->prepare($query3);

        $stmt3->execute();

        echo "\nTest deleted\n";
    }
}

?>