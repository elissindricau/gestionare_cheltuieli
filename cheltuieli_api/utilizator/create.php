<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate utilizator object
include_once '../objects/utilizator.php';

  
$database = new Database();
$db = $database->getConnection();
  
$util = new Utilizator($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(!empty($data->nume)){
  
    // set product property values
    $util->nume = $data->nume;
    $util->prenume = $data->prenume;
    $util->email = $data->email;
    $util->parola = $data->parola;
    $util->buget = $data->buget;
  
    $last_id = $util->create();


    // create the product
    if($last_id){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Utilizatorul a fost adaugat: " . $last_id));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Nu am putut adauga utilizatorul"));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Nu am putut adauga utilizatorul. Ceva lipseste."));
}
?>