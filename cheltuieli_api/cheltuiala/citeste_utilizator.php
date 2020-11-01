<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/cheltuiala.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$chelt = new Cheltuiala($db);
  
// set ID property of record to read
$chelt->utilizator_id = isset($_GET['utilizator']) ? $_GET['utilizator'] : die();
 
if( $chelt->utilizator_id != null ){
    // read the details of product to be edited
    $stmt = $chelt->citeste_utilizator();
    $num = $stmt->rowCount();

    if($num > 0){
        // products array
        $chelt_arr=array();
        $chelt_arr["records"]=array();
    
        // retrieve our table contents
        // fetch() is faster than fetchAll()
        // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
    
            $chelt_item=array(
                "id" => $id,
                "categorie" => $categorie,
                "utilizator_id" => $utilizator_id,
                "suma" => $suma,
                "descriere" => $descriere,
                "data_cheltuielii" => $data_cheltuielii
            );
    
            array_push($chelt_arr["records"], $chelt_item);
        }
    
        // set response code - 200 OK
        http_response_code(200);
    
        // show products data in json format
        echo json_encode($chelt_arr);
    }

    else{
            // set response code - 404 Not found
            http_response_code(404);
        
            // tell the user product does not exist
            echo json_encode(array("message" => "Utilizatorul nu are nicio cheltuiala."));
    }
    

  
}
  
else{
      // set response code - 400 bad request
      http_response_code(400);
  
      // tell the user
      echo json_encode(array("message" => "Utilizatorul lipseste din request."));
}
?>