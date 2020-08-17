<?php
//getOrders.php

if(isset($_POST["id"]))
{
    $connect = mysqli_connect("localhost", "root", "", "fisha");
    $query = "SELECT * FROM orders WHERE userId = '".$_POST['id']."'";
    $result = mysqli_query($connect, $query);
    while($row = mysqli_fetch_assoc($result))
    {
        $data["orderId"] = $row["orderId"];
        $data["userId"] = $row["userId"];
        $data["orderTotal"] = $row["orderTotal"];
        $data["created_at"] = $row["created_at"];
    }
    print_r (json_encode($data));
}
?>
