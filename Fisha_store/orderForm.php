<?php

  $id=$_GET['id'];

?>

<!doctype html>
<html lang="en">
  <head>
    <?php require_once 'includes/head.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="js/myjs.js"></script>
  </head>
  <body>
  <?php require_once 'includes/header.php'; ?>
    <div class="container-fluid">
      <div class="row">
        <?php require_once 'includes/sidebar.php'; ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <h1 style="margin-top: 10px">Add order</h1>
          <p>Required fields are in (*)</p>
          <div class="form-group">
            <label for="lastName">OrderTotal:</label>
            <input type="hidden"  value = "<?php echo $id; ?>" name='userId' id='userId'>
            <input type="text" class="form-control" id="orderTotal" placeholder="Enter Total Order" name="orderTotal" >
          </div>
          <div class="form-group col-md-12 text-center">
            <input onclick = 'saveForm()' class="btn btn-primary mb-2" type="submit" name="btn_save" value="Save" >
          </div>
        </main>
      </div>
    </div>
      <?php require_once 'includes/footer.php'; ?>
  </body>
</html>
<