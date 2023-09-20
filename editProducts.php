<?php
$title = "Home";
include './config/dbOperations.php';
include './utils/phpOperations.php';
$nameErr = $priceErr = $descriptionErr = null;

session_start();
$id = $_GET['id'];
$records = getTableDataByCondition('products', '*', "where id = '$id'");
if(count($records) > 0) {
    $record = $records[0];
}
else {
    header("Location: products.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
       $nameErr = "Name is required";
    }
    if (empty($_POST["price"])) {
        $priceErr = "Price is required";
    }
    if (empty($_POST["description"])) {
        $descriptionErr = "description is required";
    }

    if($nameErr== null && $priceErr== null && $descriptionErr== null ){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
      $updated= updateTableData("products", "name = '$name', description = '$description', price = '$price'", "where id = '$id'" );
      if($updated==true){
        // need to change redirect to products
        header('Location: products.php');
      }
      else{
         print_r("Something went wrong in signup");
      }
}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './partials/assets.php'; ?>
    <title><?php
            echo $title
            ?></title>
</head>

<body class="m-0 p-0">
    <div class="container-fluid m-0 p-0">
        <?php include './partials/dashboard-header.php'; ?>

        <div class="pt-110 d-flex align-items-center justify-content-center">
            <form class="col-lg-10 col-md-8 col-sm-10 bg-white rounded-lg shadow-lg p-5" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo isset($nameErr) ? '' :  $record['name']; ?>">
                    <small id="emailHelp" class="form-text text-danger">
                            <?php echo $nameErr; ?>
                        </small>
                  </div>
                <div class="form-group">
                    <label >Price</label>
                    <input type="text" class="form-control" name="price" placeholder="Price" value="<?php echo isset($priceErr) ? '' :  $record['price']; ?>">
                    <small id="emailHelp" class="form-text text-danger">
                            <?php echo $priceErr; ?>
                        </small>
                  </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" rows="5" name="description" placeholder="Description"><?php echo isset($descriptionErr) ? '' :  $record['description']; ?></textarea>
                    <small id="emailHelp" class="form-text text-danger">
                            <?php echo $descriptionErr; ?>
                        </small>
                  </div>
                <button type="submit" name="submit" class="btn button-design width100">Submit</button>
            </form>
        </div>

    </div>
</body>

</html>