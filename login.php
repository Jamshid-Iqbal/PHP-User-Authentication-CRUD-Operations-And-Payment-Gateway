<!-- php code for validationas -->
<?php
include './config/dbOperations.php';
session_start();

$emailErr = $passErr = null;
$email = $pass = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    }
    if (empty($_POST["pass"])) {
        $passErr = "Password is required";
    }
    if ($emailErr == null && $passErr == null) {
        $users = getTableDataByCondition("users", "*", "WHERE email = '$email' AND password = '$pass'");
        if (count($users) > 0) {
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["pass"] = $_POST["pass"];
            $_SESSION["id"] = $users[0]["id"];
            $_SESSION["address"] = $users[0]["address"];
            $_SESSION["phone"] = $users[0]["phone"];
            $_SESSION["birthday"] = $users[0]["birthday"];
            $_SESSION["gender"] = $users[0]["gender"];
            $_SESSION["description"] = $users[0]["description"];
            $_SESSION["first_name"] = $users[0]["first_name"];
            $_SESSION["last_name"] = $users[0]["last_name"];
            header('Location: ./index.php');
        } else {
            $emailErr = "Invalid credentials";
            // print_r("Invalid credentials");
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './partials/assets.php'; ?>
    <title>Login</title>
</head>

<body class="m-0 p-0">
    <div class="container-fluid m-0 p-0">
        <?php include './partials/header.php'; ?>
        <div class="pt-110 d-flex flex-row justify-content-center align-items-center">
            <form class="col-lg-5 col-md-8 col-sm-10" method="post">
                <div class="bg-white p-5 rounded-lg shadow-lg">
                    <h1>Login</h1>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                        <small id="emailHelp" class="form-text text-danger"><?php echo $emailErr; ?></small>

                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group d-flex flex-wrap password-wrap">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control width90 password" id="password" placeholder="Password" name="pass">

                        <span class="input-group-text width10 toggle-button">
                            <i class="fa fa-eye" id="togglePassword" style="cursor: pointer"></i>
                        </span>
                        <small id="emailHelp" class="form-text text-danger"> <?php echo $passErr; ?></small>

                    </div>
                    <div class="form-group form-check ">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div>
                    <div class="d-flex width100 justify-content-center">
                        <a href="./index.php" class="width100">
                            <button type="submit" class="btn button-design rounded width100 login12" name="login">Submit</button>
                        </a>
                    </div>

                    <div class="form-group mt-3">
                        <p class="text-center"> Don't have an account?
                            <a href="./signup.php" class="deco-none text-secondary"> Make one</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="./public/js/app.js"></script>
</body>

</html>