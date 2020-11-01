<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object file
include_once '../config/database.php';
include_once '../objects/cheltuiala.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare Categorie object
$chelt = new Cheltuiala($db);
  
// get Categorie id
$data = json_decode(file_get_contents("php://input"));
  
// set Categorie id to be deleted
$chelt->id = $data->id;
  
// delete the Categorie
if($chelt->delete()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "Cheltuiala a fost stearsa."));
}
  
// if unable to delete the Categorie
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Nu am putut sterge cheltuiala."));
}
?>