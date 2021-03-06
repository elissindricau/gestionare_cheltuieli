<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate chaltuiala object
include_once '../objects/cheltuiala.php';
  
$database = new Database();
$db = $database->getConnection();
  
$chelt = new Cheltuiala($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));

  
// make sure data is not empty
if(!empty($data->id)){
  
    // set product property values
    $chelt->id = $data->id;
    $chelt->utilizator_id = $data->utilizator_id;
    $chelt->categorie = $data->categorie;
    $chelt->suma = $data->suma;
    $chelt->descriere = $data->descriere;
    $chelt->data_cheltuielii = $data->data_cheltuielii;
  
    // create the product
    if($chelt->update()){
  
        // set response code - 200 OK
        http_response_code(200);
  
        // tell the user
        echo json_encode(array("message" => "Cheltuiala a fost updatata."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Nu am putut updata cheltuiala"));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Nu am putut updata cheltuiala. Id-ul lipseste."));
}
?>