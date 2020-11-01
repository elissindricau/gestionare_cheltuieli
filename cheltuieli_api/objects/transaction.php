<?php
class Transaction{
  
    // database connection and table name
    private $conn;
    private $table_name = "transactions";
  
    // object properties
    public $id;
    public $SKU;
    public $increment;
    public $added;
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

        // read products
    function read(){
    
        // select all query
        $query = "SELECT * FROM " . $this->table_name;
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create transaction
    function create(){
    
        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    increment=:increment, SKU=:SKU ";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->increment=htmlspecialchars(strip_tags($this->increment));
        $this->SKU=htmlspecialchars(strip_tags($this->SKU));
    
        // bind values
        $stmt->bindParam(":increment", $this->increment);
        $stmt->bindParam(":SKU", $this->SKU);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    // read one transaction
    function readOne(){
    
        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = " . $this->id . " LIMIT 0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->SKU = $row['SKU'];
        $this->increment = $row['increment'];
        $this->id = $row['id'];
    }

    // delete transaction
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

    // read olastne transaction
    function getLast(){
    
        // query to read single record
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY ID DESC LIMIT 1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->SKU = $row['SKU'];
        $this->increment = $row['increment'];
        $this->id = $row['id'];
    }

}
?>