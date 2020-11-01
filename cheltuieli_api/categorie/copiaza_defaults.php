<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/categorie.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$cat = new Categorie($db);
  
// set ID property of record to read
$cat->utilizator = isset($_GET['utilizator']) ? $_GET['utilizator'] : die();
 
if( $cat->utilizator != null ){
    if($cat->copiaza_defaults()){

        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Categoriile au fost adaugate."));
    }

    else{

        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Nu am putut adauga categoriile"));
    }
    

  
}
  
else{
      // set response code - 400 bad request
      http_response_code(400);
  
      // tell the user
      echo json_encode(array("message" => "Utilizatorul lipseste din request."));
}
?>