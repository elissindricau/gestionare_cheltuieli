<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/cheltuiala.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$chelt = new Cheltuiala($db);
  
// query products
$stmt = $chelt->citeste_tot();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
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
  
    // tell the user no products found
    echo json_encode(
        array("message" => "Nu am gasit nicio cheltuiala.")
    );
}

?>