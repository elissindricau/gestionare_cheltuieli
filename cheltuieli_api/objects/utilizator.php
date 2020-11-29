<?php

include_once '../objects/categorie.php';

class Utilizator{
  
    // database connection and table name
    private $conn;
    private $table_name = "utilizatori";
  
    // object properties
    public $id;
    public $nume;
    public $prenume;
    public $email;
    public $parola;
    public $buget;

  
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
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = '" . $this->email."'";
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }

    // create product
    function create(){
    
        //$cat = new Categorie();

        // query to insert record
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    nume=:nume, prenume=:prenume, email=:email, parola=:parola, buget=:buget";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->nume=htmlspecialchars(strip_tags($this->nume));
        $this->prenume=htmlspecialchars(strip_tags($this->prenume));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->parola=htmlspecialchars(strip_tags($this->parola));
        $this->buget=htmlspecialchars(strip_tags($this->buget));
    
        // bind values
        $stmt->bindParam(":nume", $this->nume);
        $stmt->bindParam(":prenume", $this->prenume);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":parola", $this->parola);
        $stmt->bindParam(":buget", $this->buget);
    
        // execute query
        if($stmt->execute()){

            $last_id = $this->conn->lastInsertId();
            $cat = new Categorie($this->conn);
            $cat->copiaza_defaults($last_id);
            return $last_id;

        }
    
        return false;
        
    }
    
    function update($test){

        if($test){

        $query = "UPDATE
        " . $this->table_name . "
        SET
            nume=:nume, prenume=:prenume, email=:email, parola=:parola, buget=:buget;
        WHERE
            id=:id";

        //echo $this->id;

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->nume=htmlspecialchars(strip_tags($this->nume));
        $this->prenume=htmlspecialchars(strip_tags($this->prenume));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->parola=htmlspecialchars(strip_tags($this->parola));
        $this->buget=htmlspecialchars(strip_tags($this->buget));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind values
        $stmt->bindParam(":nume", $this->nume);
        $stmt->bindParam(":prenume", $this->prenume);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":parola", $this->parola);
        $stmt->bindParam(":buget", $this->buget);
        $stmt->bindParam(":id", $this->id);

        // execute query
        if($stmt->execute()){
            return $this->id;
        }
    
        return false;

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