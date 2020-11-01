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

    function copiaza_defaults($utilizator) {

        $this->utilizator = $utilizator;
        
        foreach($this->default_cat as $cat){
            $this->categorie = $cat;

            $this->create();
        }

    }

    function citeste_categorii($utilizator){
    
        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE utilizator LIKE " . $utilizator ;
    
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
    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " WHERE SKU LIKE " . $this->SKU . " LIMIT 0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->SKU);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->name = $row['name'];
        $this->SKU = $row['SKU'];
        $this->quantity = $row['quantity'];
        $this->id = $row['id'];
    }

    // update the product
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    name = :name,
                    quantity = :quantity,
                WHERE
                    SKU = :SKU";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->quantity=htmlspecialchars(strip_tags($this->quantity));
        $this->SKU=htmlspecialchars(strip_tags($this->SKU));
    
        // bind new values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':SKU', $this->SKU);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }
    
        return false;
    }

        // update the product
    function update_quantity(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    quantity = :quantity
                WHERE
                    SKU = :SKU";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->quantity=htmlspecialchars(strip_tags($this->quantity));
        $this->SKU=htmlspecialchars(strip_tags($this->SKU));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':SKU', $this->SKU);
    
        // execute the query
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