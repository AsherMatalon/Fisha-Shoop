<?php

require 'Database.php';

class User {
    private $conn;

    // Constructor
    public function __construct(){
      $database = new Database();
      $db = $database->dbConnection();
      $this->conn = $db;
    }


    // Execute queries SQL
    public function runQuery($sql){
      $stmt = $this->conn->prepare($sql);
      return $stmt;
    }

    // Insert
    public function CreateNewShopper($email,$name,$lastname,$phone,$city,$street,$housenumber){
      try{
        $stmt = $this->conn->prepare("INSERT INTO shoppers (email,name,last_name,phone,city,street,house_number) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$email,$name,$lastname,$phone,$city,$street,$housenumber]);
        return $stmt;
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }


    // Update
    public function UpdateShopper($name,$lastname,$phone,$city,$street,$housenumber, $id){
        try{
         
          $stmt = $this->conn->prepare("UPDATE shoppers SET name= ?, last_name= ?, phone= ?, city= ?, street= ?, house_number= ?  WHERE id= ?");
          $stmt->execute([$name,$lastname,$phone,$city,$street,$housenumber, $id]);
          return $stmt;
        }catch(PDOException $e){
          echo $e->getMessage();
        }
    }

    // Delete
    public function delete($id){
      try{
        $stmt = $this->conn->prepare("DELETE FROM shoppers WHERE id = :id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return $stmt;
      }catch(PDOException $e){
          echo $e->getMessage();
      }
    }

    // Redirect URL method
    public function redirect($url){
      header("Location: $url");
    }
}
?>