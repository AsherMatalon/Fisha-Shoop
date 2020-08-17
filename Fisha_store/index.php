<?php

require_once 'classes/User.php';

$connect = mysqli_connect("localhost", "root", "", "fisha");
$query = "SELECT * FROM shoppers ORDER BY id ASC";
$result = mysqli_query($connect, $query);

$objUser = new User();

// GET
if(isset($_GET['delete_id'])){
  $id = $_GET['delete_id'];
  try{
    if($id != null){
      if($objUser->delete($id)){
        $objUser->redirect('index.php?deleted');
      }
    }
  }catch(PDOException $e){
    echo $e->getMessage();
  }
}
?>

<!doctype html>
<html lang="en">
  <head>
  <?php require_once 'includes/head.php'; ?>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="js/myjs.js"></script>
  <style>
    #result {
    position: absolute;
    width: 100%;
    max-width:870px;
    cursor: pointer;
    overflow-y: auto;
    max-height: 400px;
    box-sizing: border-box;
    z-index: 1001;
  }
  .link-class:hover{
    background-color:#f1f1f1;
  }
  </style>
  </head>
    <body>
      <?php require_once 'includes/header.php'; ?>
      <div class="container-fluid">
        <div class="row">
          <?php require_once 'includes/sidebar.php'; ?>
          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
              <h1 style="margin-left-top: 10px">Shoopers Tabels</h1>
                <input type="text" id="myInput" onkeyup="myFunction()" class="col-lg-10 px-4" placeholder="Search by ID">
                   <div class="foo">
                      <input type="text" id="orderId"  name="orderId" class="col-lg-10 px-4"  value="" placeholder="Created Order by shooper ID ">
                      <button class="btn btn-primary " type="button" name="searchUser" id="searchUser" >Create Order</button>
                    </div>
              <?php
                if(isset($_GET['updated'])){
                  echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                    <strong>User!<strong> Updated success.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true"> &times; </span>
                    </button>
                  </div>';
                }elseif(isset($_GET['updatedWithDiffMail'])){
                  echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                    <strong>User!<strong> Updated success You cannot change Email he is unique.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true"> &times; </span>
                    </button>
                </div>';
                }else if(isset($_GET['deleted'])){
                  echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                  <strong>User!<strong> Deleted with success.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true"> &times; </span>
                    </button>
                  </div>';
                }else if(isset($_GET['inserted'])){
                  echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                    <strong>User!<strong> Inserted with success.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"> &times; </span>
                      </button>
                  </div>';
                }else if(isset($_GET['error'])){
                  var_dump($_GET['error']);
                  echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                    <strong>DB Error!<strong> Something went wrong with your action. Try again!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true"> &times; </span>
                    </button>
                  </div>';
                }
              ?>
                <table  id="myTable" class="table table-striped table-sm">
                <thead>
                    <tr>  
                      <th>ID</th>
                      <th>Email</th>
                      <th>Name</th>
                      <th>Last Name</th>
                      <th>Phone Number</th>
                      <th>City</th>
                      <th>Street</th>
                      <th>House Number</th>
                    </tr>
                  </thead>
                <?php
                  $query = "SELECT * FROM shoppers";
                  $stmt = $objUser->runQuery($query);
                  $stmt->execute();
                ?>
                <tbody>
                  <?php if($stmt->rowCount() > 0){
                    while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){
                  ?>
                  <tr>
                    <td><?php print($rowUser['id']); ?></td>
                    <td><?php print($rowUser['email']); ?></td>
                    <td>
                      <a href="form.php?edit_shopper=<?php print($rowUser['id']); ?>">
                        <?php print($rowUser['name']); ?>
                      </a>
                    </td>
                    <td><?php print($rowUser['last_name']); ?></td>
                    <td><?php print($rowUser['phone']); ?></td>
                    <td><?php print($rowUser['city']); ?></td>
                    <td><?php print($rowUser['street']); ?></td>
                    <td><?php print($rowUser['house_number']); ?></td>
                    <td>
                      <a class="confirmation" href="index.php?delete_id=<?php print($rowUser['id']); ?>">
                        <span data-feather="trash"></span>
                      </a>
                    </td>
                  </tr>
                <?php }} ?>
              </tbody>
            </table>
            <div class="container" style="width:900px;">
              <h5 align="center">Search orders by shopper</h5><br />   
              <div  class="row">
                <div class="col-md-10">
                  <select name="employee_list" id="employee_list" class="form-control">
                    <option value="">Select shopper</option>
                    <?php 
                      while($row = mysqli_fetch_array($result))
                        {
                        echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
                        }
                    ?>
                  </select>
                </div>
              <div class="col-md-2">
                <button type="button" name="search" id="search" class="btn btn-info">Search</button>
              </div>
            </div>
            <br />
              <div class="table-responsive" id="employee_details" style="display:none">
                <table class="table table-bordered">
                  <thead>
                  <tr>  
                    <th>No.</th>
                    <th>Order</th>
                    <th>User Id</th>
                    <th>Order Total</th>
                    <th>Created Order</th>
                  </tr>                   
                </thead>
                  <?php
                    $query = "SELECT * FROM orders  ";
                    $stmt = $objUser->runQuery($query);
                    $stmt->execute();
                  ?>
                <tbody>
                  <?php if($stmt->rowCount() > 0){
                    $countOrder="0";
                    while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){
                  ?>
                  <tr>
                    <td><?php print(++$countOrder); ?></td>
                    <td><?php print($rowUser['orderId']); ?></td>
                    <td><?php print($rowUser['userId']); ?></td>
                    <td><?php print($rowUser['orderTotal']); ?></td>
                    <td><?php print($rowUser['created_at']); ?></td>
                  </tr>
                  <?php }} ?>
                  </tbody>
                </table>
              </div>
            </div>
          </main>
        </div>
      </div>
      <?php require_once 'includes/footer.php'; ?>
      <script>
            // JQuery confirmation
            $('.confirmation').on('click', function () {
                return confirm('Are you sure you want do delete this user?');
            });
      </script>
  </body>
</html>



