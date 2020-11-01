<?php
class Categorie{
  
    // database connection and table name
    private $conn;
    private $table_name = "categorii";
  
    // object properties
    public $id;
    public $categorie;
    public $utilizator;

    public $default_cat = ["mancare", "haine", "utilitati", "sanatate", "transport", "cadouri", "altele"];
  
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

    function copiaza_defaults() {
        
        foreach($this->default_cat as $cat){
            $this->categorie = $cat;

            if($this->create() == false) {
                return false;
            }
        }

        return true;

    }

    function citeste_categorii(){
    
        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE utilizator LIKE " . $this->utilizator ;
    
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
                    categorie=:categorie, utilizator=:utilizator";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->categorie=htmlspecialchars(strip_tags($this->categorie));
        $this->utilizator=htmlspecialchars(strip_tags($this->utilizator));
    
        // bind values
        $stmt->bindParam(":categorie", $this->categorie);
        $stmt->bindParam(":utilizator", $this->utilizator);
    
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