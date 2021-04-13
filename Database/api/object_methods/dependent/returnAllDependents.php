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
//         $d = $stmt1->fetch();
        $dsin = $row['D_SIN'];
        $relation = $row['Relationship'];
        $stmt2 = $person->sin($dsin);
        $num2 = $stmt2->rowCount();
        $arr = array();
        $arr['records'] = array();
        if($num2 == 1){


            while($row1 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                extract($row1);
                $item = array(
                    "DFName"      => $FName,
                    "DMInit"      => $MInit,
                    "DLName"      => $LName,
                    "Relation"    => $relation,
                );

                array_push($arr['records'], $item);           
            }
        }
        echo json_encode($arr);
        
    }

    // show products data in json format

}
else {
    echo json_encode(
        array("message" => "No Dependents found.")
    );
}
?>