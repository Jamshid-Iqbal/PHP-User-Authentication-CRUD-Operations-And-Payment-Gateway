<?php session_start();
include './config/dbOperations.php';
include './utils/phpOperations.php';



$cardOwnerErr = $cardNumberErr = $expirationDateErr = $cvvNumberErr = null;
if (isset($_POST['submitCard']) || isset($_POST['submitPaypal'])) {

    if (empty($_POST["cardOwner"])) {
        $cardOwnerErr = "Card name is required";
    }
    if (empty($_POST["cardNumber"])) {
        $cardNumberErr = "Card number is required";
    }
    if (empty($_POST["expirationDate"])) {
        $expirationDateErr = "Expiration date is required";
    }

    if (empty($_POST["cvvNumber"])) {
        $cvvNumberErr = "CVV number is required";
    }
    if ($cardOwnerErr == null && $cardNumberErr == null && $expirationDateErr == null && $cvvNumberErr == null) {
        $isSaved = insertData("orders", ["user_id", "product_id"], [$_SESSION["id"], $_GET["id"]]);
        if ($isSaved == true) {
            header('Location: orders.php');
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './partials/assets.php'; ?>
    <title>products</title>
</head>

<body class="m-0 p-0">
    <div class="container-fluid m-0 p-0 ">
        <?php include './partials/dashboard-header.php'; ?>
        <!-- For demo purpose -->
        <div class="container-fluid pt-110">
            <div class="col-lg-6 col-sm-12 m-auto ">
                <div class="card ">
                    <div class="card-header">
                        <div class="bg-white shadow-sm pt-4 pl-2 pr-2 pb-2">
                            <!-- Credit card form tabs -->
                            <ul role="tablist" class="nav bg-light nav-pills rounded nav-fill mb-3">
                                <li class="nav-item"> <a data-toggle="pill" href="#credit-card" class="nav-link active "> <i class="fas fa-credit-card mr-2"></i> Credit Card </a> </li>
                                <li class="nav-item"> <a data-toggle="pill" href="#paypal" class="nav-link "> <i class="fab fa-paypal mr-2"></i> Paypal </a> </li>
                            </ul>
                        </div> <!-- End -->
                        <!-- Credit card form content -->
                        <div class="tab-content">
                            <!-- credit card info-->
                            <div id="credit-card" class="tab-pane fade show active pt-3">
                                <form action="" method="post">
                                    <div class="form-group"> <label for="username">
                                            <h6>Card Owner</h6>
                                        </label> <input type="text" name="cardOwner" placeholder="Card Owner Name" class="form-control">
                                        <small id="emailHelp" class="form-text text-danger">
                                            <?php echo $cardOwnerErr; ?>
                                        </small>
                                    </div>


                                    <div class="form-group"> <label for="username">
                                            <h6>Card Number</h6>
                                        </label> <input type="text" name="cardNumber" placeholder="Card Number" class="form-control">
                                        <small id="emailHelp" class="form-text text-danger">
                                            <?php echo $cardNumberErr; ?>
                                        </small>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group"> <label><span class="hidden-xs">
                                                        <h6>Expiration Date</h6>
                                                    </span></label>
                                                <div class="input-group"> <input type="date" name="expirationDate" class="form-control" placeholder="dd-mm-yyyy" value="" min="1997-01-01" max="2030-12-31">
                                                </div>
                                                <small id="emailHelp" class="form-text text-danger">
                                                    <?php echo $expirationDateErr ?>
                                                </small>
                                            </div>
                                        </div>


                                        <div class="col-sm-4">
                                            <div class="form-group mb-4"> <label data-toggle="tooltip" title="Three digit CV code on the back of your card">
                                                    <h6>CVV <i class="fa fa-question-circle d-inline"></i></h6>
                                                </label> <input type="text" name="cvvNumber" class="form-control">
                                                <small id="emailHelp" class="form-text text-danger">
                                                    <?php echo $cvvNumberErr; ?>
                                                </small>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="card-footer">
                                        <button type="submit" name="submitCard" class="subscribe btn btn-primary btn-block shadow-sm"> Purchase </button>
                                </form>
                            </div>
                        </div> <!-- End -->
                        <!-- Paypal info -->
                        <div id="paypal" class="tab-pane fade pt-3">
                            <h6 class="pb-2">Select your paypal account type</h6>
                            <div class="form-group "> <label class="radio-inline"> <input type="radio" name="optradio" checked> Domestic </label> <label class="radio-inline"> <input type="radio" name="optradio" class="ml-5">International </label></div>
                            <p> <button type="submit" name="submitPaypal" class="btn btn-primary "><i class="fab fa-paypal mr-2"></i> Purchase </button> </p>
                            <p class="text-muted"> Note: After clicking on the button, you will be directed to a secure gateway for payment. After completing the payment process, you will be redirected back to the website to view details of your order. </p>
                        </div> <!-- End -->
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>