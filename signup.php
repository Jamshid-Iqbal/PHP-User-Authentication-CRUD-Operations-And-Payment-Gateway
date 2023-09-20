<?php
session_start();
include './config/dbOperations.php';
$emailErr = $passErr = $firstNameErr = $lastNameErr = $confirmPassErr = $passwordCheck = null;
$email = $password = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["firstName"])) {
        $firstNameErr = "Firstname is required";
    }
    if (empty($_POST["lastName"])) {
        $lastNameErr = "Last name is required";
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else if (!filter_var(($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
    if (empty($_POST["password"])) {
        $passErr = "Password is required";
    }
    if (empty($_POST["confirmPassword"])) {
        $confirmPassErr = "Password is required";
    }
    if (($_POST["password"]) != ($_POST["confirmPassword"])) {
        $passwordCheck = "Password is not same";
    }
    if ($emailErr == null && $passErr == null && $firstNameErr == null && $lastNameErr == null && $confirmPassErr == null && $passwordCheck == null) {
        $users = getTableDataByCondition("users", "*", "WHERE email = '" . $_POST["email"] . "'");
        if (count($users) > 0) {
            $emailErr = "user already exist! please login";
        } else {
            $isSaved = insertData("users", ["first_name", "last_name", "email", "password"], [$_POST["firstName"], $_POST["lastName"], $_POST["email"], $_POST["password"]]);
            if ($isSaved == true) {
                header('Location: login.php');
            } else {
                print_r("Something went wrong in signup");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './partials/assets.php'; ?>
    <title>Signup</title>
</head>

<body class="m-0 p-0">
    <div class="container-fluid m-0 p-0">
        <?php include './partials/header.php';
        ?>
        <div class="pt-110 d-flex flex-row justify-content-center align-items-center">
            <form class="col-lg-5 col-md-8 col-sm-10" method="post">
                <div class="bg-white p-5 rounded-lg shadow-lg">
                    <h1>Signup</h1>
                    <div class="form-group">
                        <label for="First-name" class="m-0">First Name</label>
                        <input type="text" class="form-control" id="First-name" placeholder="First Name" name=firstName>
                        <small id="emailHelp" class="form-text text-danger">
                            <?php echo $firstNameErr; ?>
                        </small>
                    </div>
                    <div class="form-group">
                        <label for="Last-name" class="m-0">Last Name</label>
                        <input type="text" class="form-control" id="Last-name" placeholder="Last Name" name="lastName">
                        <small id="text" class="form-text text-danger"><?php echo $lastNameErr; ?></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="m-0">Email address</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                        <small id="emailHelp" class="form-text text-danger"><?php echo $emailErr; ?></small>
                    </div>
                    <div class="form-group d-flex flex-wrap password-wrap">
                        <label for="exampleInputPassword1" class="m-0">Password</label>
                        <input type="password" class="form-control width90 password" id="password" placeholder="Password" name="password">
                        <span class="input-group-text width10 toggle-button">
                            <i class="fa fa-eye" id="togglePassword" style="cursor: pointer"></i>
                        </span>
                        <small id="emailHelp" class="form-text text-danger"><?php echo $passErr; ?></small>
                    </div>
                    <div class="form-group d-flex flex-wrap password-wrap">
                        <label for="confirm-password" class="m-0">Confirm Password</label>
                        <input type="password" class="form-control width90 password" id="password" placeholder="Confirm Password" name="confirmPassword">
                        <span class="input-group-text width10 toggle-button">
                            <i class="fa fa-eye" id="togglePassword" style="cursor: pointer"></i>
                        </span>
                        <small id="emailHelp" class="form-text text-danger"><?php echo $confirmPassErr;
                                                                            echo $passwordCheck; ?></small>
                    </div>

                    <div class="form-group form-check ">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">I accept terms & conditions</label>
                    </div>
                    <div class="d-flex width100 justify-content-center">
                        <a href="" class="width100">
                            <button type="submit" class="btn button-design rounded width100">Submit</button>
                        </a>
                    </div>
                    <div class="form-group mt-3">
                        <p class="text-center"> Already have an account?
                            <a href="./login.php" class="deco-none text-secondary"> Login</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="./public/js/app.js"></script>
</body>

</html>