<?php
require 'Database.php';

class Order {
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
    public function createNewOrder($post){
      $userId = $post['id'];
      $orderTotal=$post['orderTotal'];
      $id = json_decode($userId);
      $orderTotalNum = json_decode($orderTotal);
      $stmt = $this->conn->prepare("INSERT INTO orders (userId,orderTotal,created_at) VALUES(?, ?, NOW())");
        if($stmt->execute([$id,$orderTotalNum])){
          return true;
        }else{
          return false;
        }
    }
    public function getOrders($post){
      print_r($post);
      die();
      $userId=$post['id'];
      $stmt=$this->conn->prepare("SELECT * FROM orders WHERE userId = '".$_POST['id']."'");
      while ($row=$stmt->execute()){
        $data["orderId"] = $row["orderId"];
        $data["userId"] = $row["userId"];
        $data["orderTotal"] = $row["orderTotal"];
        $data["created_at"] = $row["created_at"];
      }
      echo json_encode($data);
    }
}
$order = new Order();
if (isset($_POST['orderTotal'])){
  $insert = $order->createNewOrder($_POST);
  if($insert){
    echo 'your order saved';
  }else{
  echo 'somthing faild';
  }
}
if (isset($_POST['id'])){
  $getOrders=$order->getOrders($_POST);
}
?>

  