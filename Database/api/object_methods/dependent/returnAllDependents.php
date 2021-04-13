<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../../config/database.php';
include_once '../../objects/dependent.php';
include_once '../../objects/person.php';


session_start();

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

$dependent = new Dependent($db);
$person = new Person($db);

$SIN = 123456789;

$stmt1 = $dependent->returnAllDependents($SIN);
$num1 = $stmt1 ->rowCount();

if($num1 > 0){
    

    while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        $d = $stmt1->fetch();
        $dsin = $d['D_SIN'];
        $relation = $d['Relationship'];
        $stmt2 = $person->sin($dsin);
        $num2 = $stmt2->rowCount();
    
        if($num2 == 1){
            $arr = array();
            $arr['records'] = array();

            while($row1 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                extract($row1);
                $item = array(
                    "DFName"      => $fname,
                    "DMInit"      => $minit,
                    "DLName"      => $lname,
                    "Relation"    => $relation,
                );

                array_push($arr['records'], $item);
            }
        }
    }

    // show products data in json format
    echo json_encode($arr);  

}
else {
    echo json_encode(
        array("message" => "No Dependents found.")
    );
}
?>