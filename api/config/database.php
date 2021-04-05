<$php
class Database{
    private $host = " 31.170.160.52";
    private $db_name = "HealthDatabase";
    private $username = "u960404786_root";
    private $password = "25!kRe+V";
    public $conn;

    public function getConnection(){
        $this->conn = null;

        try{

        $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }

}

?>