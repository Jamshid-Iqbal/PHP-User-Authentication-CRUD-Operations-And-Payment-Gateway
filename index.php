<?php
$title = "Home";
include './config/dbOperations.php';
include './utils/phpOperations.php';
$nameErr = $priceErr = $descriptionErr = null;

session_start();

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

    if ($nameErr == null && $priceErr == null && $descriptionErr == null) {
        $isSaved = insertData("products", ["name", "price", "description"], [$_POST["name"], $_POST["price"], $_POST["description"]]);
        if ($isSaved == true) {
            // need to change redirect to products
            header('Location: products.php');
        } else {
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
                    <input type="text" class="form-control" name="name" placeholder="Name">
                    <small id="emailHelp" class="form-text text-danger">
                        <?php echo $nameErr; ?>
                    </small>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" class="form-control" name="price" placeholder="Price">
                    <small id="emailHelp" class="form-text text-danger">
                        <?php echo $priceErr; ?>
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Description</label>
                    <textarea class="form-control" rows="5" name="description" placeholder="Description"></textarea>
                    <small id="emailHelp" class="form-text text-danger">
                        <?php echo $descriptionErr; ?>
                    </small>
                </div>
                <button type="submit" name="submit" class="btn button-design width100">Submit</button>
            </form>
        </div>
        <div class="container posts-content mt-3">
            <div class="row ">
                <?php
                //include './post.php';
                ?>


            </div>
        </div>

    </div>
</body>

</html>