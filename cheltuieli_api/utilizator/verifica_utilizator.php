<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/utilizator.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$util = new Utilizator($db);
  
$data = json_decode(file_get_contents("php://input"));


// check if more than 0 record found

if(!empty($data->email)){
  
    // set product property values
    $util->email = $data->email;
    $util->parola = $data->parola;

    $stmt = $util->citeste_utilizator();
    $num = $stmt->rowCount();

    if($num == 1){
  
        // products array
        $util_arr=array();
        $util_arr["records"]=array();
      
        // retrieve our table contents
        // fetch() is faster than fetchAll()
        // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            // extract row
            // this will make $row['name'] to
            // just $name only
            extract($row);
      
            if($data->parola == $parola) {

                $util_item=array(
                    "id" => $id,
                    "nume" => $nume,
                    "prenume" => $prenume,
                    "email" => $email,
                    "parola" => $parola,
                    "buget" => $buget
                );
        
                array_push($util_arr["records"], $util_item);
            }
            else {

                // set response code - 404 Not found
                http_response_code(404);
      
                // tell the user no products found
                echo json_encode(
                    array("message" => "Nu am gasit.")
                );
            }
        }
      
        // set response code - 200 OK
        http_response_code(200);
      
        // show products data in json format
        echo json_encode($util_arr);
    }
    else{
      
        // set response code - 404 Not found
        http_response_code(404);
      
        // tell the user no products found
        echo json_encode(
            array("message" => "Nu am gasit niciun utilizator.")
        );
    }

}



?>