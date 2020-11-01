<?php
class Cheltuiala{
  
    // database connection and table name
    private $conn;
    private $table_name = "cheltuieli";
  
    // object properties
    public $id;
    public $utilizator_id;
    public $categorie;
    public $suma;
    public $descriere;
    public $data_cheltuielii;

  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read products
    function citeste_tot(){
    
        // select all query
        $query = "SELECT * FROM " . $this->table_name;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }


    function citeste_utilizator(){
    
        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE utilizator LIKE " . $this->utilizator_id ;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    function citeste_utilizator_luna($luna){
    
        $stmt = $this->citeste_utilizator();
        $num = $stmt->rowCount();

        if($num > 0){
            // products array
            $chelt_arr=array();
        
            // retrieve our table contents
            // fetch() is faster than fetchAll()
            // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                // extract row
                // this will make $row['name'] to
                // just $name only
                extract($row);
                echo $data_cheltuielii;

                /*
        
                $cat_item=array(
                    "id" => $id,
                    "categorie" => $categorie,
                    "utilizator" => $utilizator
                );
        
                array_push($cat_arr["records"], $cat_item);
                */
            }
    }
}

    // create product
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    categorie=:categorie, utilizator_id=:utilizator_id, suma=:suma, descriere=:descriere, data_cheltuielii=:data_cheltuielii";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->categorie=htmlspecialchars(strip_tags($this->categorie));
        $this->utilizator_id=htmlspecialchars(strip_tags($this->utilizator_id));
        $this->suma=htmlspecialchars(strip_tags($this->suma));
        $this->descriere=htmlspecialchars(strip_tags($this->descriere));
        $this->data_cheltuielii=htmlspecialchars(strip_tags($this->data_cheltuielii));
    
        // bind values
        $stmt->bindParam(":categorie", $this->categorie);
        $stmt->bindParam(":utilizator_id", $this->utilizator_id);
        $stmt->bindParam(":suma", $this->suma);
        $stmt->bindParam(":descriere", $this->descriere);
        $stmt->bindParam(":data_cheltuielii", $this->data_cheltuielii);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
    
    function update(){

        $query = "UPDATE
        " . $this->table_name . "
        SET
            categorie=:categorie, utilizator_id=:utilizator_id, suma=:suma, descriere=:descriere, data_cheltuielii=:data_cheltuielii
        WHERE
            id=:id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->categorie=htmlspecialchars(strip_tags($this->categorie));
        $this->utilizator_id=htmlspecialchars(strip_tags($this->utilizator_id));
        $this->suma=htmlspecialchars(strip_tags($this->suma));
        $this->descriere=htmlspecialchars(strip_tags($this->descriere));
        $this->data_cheltuielii=htmlspecialchars(strip_tags($this->data_cheltuielii));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind values
        $stmt->bindParam(":categorie", $this->categorie);
        $stmt->bindParam(":utilizator_id", $this->utilizator_id);
        $stmt->bindParam(":suma", $this->suma);
        $stmt->bindParam(":descriere", $this->descriere);
        $stmt->bindParam(":data_cheltuielii", $this->data_cheltuielii);
        $stmt->bindParam(":id", $this->id);

        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;

    }

    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

}
?>