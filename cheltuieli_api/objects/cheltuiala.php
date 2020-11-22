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
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY data_cheltuielii DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }


    function citeste_utilizator(){
    
        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE utilizator_id LIKE " . $this->utilizator_id ;
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
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