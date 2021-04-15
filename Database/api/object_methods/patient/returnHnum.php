<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/patient.php';

start_session();
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

$mrnum = $_SESSION['user'];
  
// initialize object
$patient = new Patient($db);
  
// query products
$stmt = $patient->returnHnum($mrnum);
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num == 1){
  
    // products array
    $products_arr=array();
    $products_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
        $patient_item=array(
            "hnum" => $H_Number,
        );
  
        array_push($products_arr["records"], $patient_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($products_arr);
}

else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}

?>