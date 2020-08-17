<?php
require_once 'classes/user.php';

$objUser = new User();
// GET FOR EDIT EXICTED SHOOPER
if(isset($_GET['edit_shopper'])){
    $id = $_GET['edit_shopper'];
    $stmt = $objUser->runQuery("SELECT * FROM shoppers WHERE id=:id");
    $stmt->execute(array(":id" => $id));
    $rowUser = $stmt->fetch(PDO::FETCH_ASSOC);
    $emailInsrted=$rowUser['email'];
}else{
  $id = null;
  $rowUser = null;
}
// POST FOR CREATED NEW SHOOPER
if(isset($_POST['btn_save'])){
  $email  = strip_tags($_POST['email']);
  $name   = strip_tags($_POST['name']);
  $lastname  = strip_tags($_POST['last_name']);
  $phone  = strip_tags($_POST['phone']);
  $city  = strip_tags($_POST['city']);
  $street  = strip_tags($_POST['street']);
  $housenumber  = strip_tags($_POST['house_number']);
  
  try{
      if($id != null){
        if($emailInsrted != $_POST['email'] ){
          function alert($msg) {
            echo "<script type='text/javascript'>alert('$msg');</script>";
          }   
        }
        if(($objUser->UpdateShopper( $name, $lastname, $phone, $city, $street, $housenumber, $id))&&($emailInsrted != $_POST['email'] )){
          $objUser->redirect('index.php?updatedWithDiffMail');
        }elseif(($objUser->UpdateShopper( $name, $lastname, $phone, $city, $street, $housenumber, $id))&&($emailInsrted == $_POST['email'] )){
          $objUser->redirect('index.php?updated');
        }
      }else{
          if($objUser->CreateNewShopper($email, $name, $lastname,$phone,$city,$street,$housenumber)){
            $objUser->redirect('index.php?inserted');
          }else{
            $objUser->redirect('index.php?error');
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
  </head>
    <body>
      <?php require_once 'includes/header.php'; ?>
        <div class="container-fluid">
          <div class="row">
            <?php require_once 'includes/sidebar.php'; ?>
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
              <h1 style="margin-top: 10px">Add / Edit Users</h1>
              <p>Required fields are in (*)</p>
              <form  method="post">
                <div class="form-group">
                  <label for="id">Id:</label>
                  <input class="form-control" type="text" name="id" id="id" value="<?php print($rowUser['id']); ?>" readonly>
                </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter Shopper's email" name="email" value="<?php print($rowUser['email']); ?>">
              </div>
              <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" placeholder="Enter Shopper's name" name="name" value="<?php print($rowUser['name']); ?>">
              </div>
              <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" class="form-control" id="lastname" placeholder="Enter Shopper's last name" name="last_name" value="<?php print($rowUser['last_name']); ?>">
              </div>
              <div class="form-group">
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" class="form-control" id="phone" placeholder="Enter Shopper's phone number" name="phone" value="<?php print($rowUser['phone']); ?>">
              </div>
              <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" placeholder="Enter Shopper's city" name="city" value="<?php print($rowUser['city']); ?>">
              </div>
              <div class="form-group">
                <label for="street">Street:</label>
                <input type="text" class="form-control" id="street" placeholder="Enter Shopper's street" name="street" value="<?php print($rowUser['street']); ?>">
              </div>
              <div class="form-group">
                <label for="houserNunber">House Number</label>
                <input type="text" class="form-control" id="house_number" placeholder="Enter Shopper's house number" name="house_number" value="<?php print($rowUser['house_number']); ?>">
              </div>
              <div class="form-group col-md-12 text-center">
                <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="Save">
              </form>
            </main>
          </div>
        </div>
        <?php require_once 'includes/footer.php'; ?>
    </body>
</html>