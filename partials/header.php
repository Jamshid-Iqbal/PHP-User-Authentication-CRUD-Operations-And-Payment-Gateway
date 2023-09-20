<?php include './utils/session.php';
// session_start();

if (isSession() == true) {
    header('Location: ./index.php');
}
?>
<header class="position-fixed width100 m-0 p-0 z-index-1">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand font-weight-bold rounded" href="http://www.mobitsolutions.com">MobIT Solutions</a>
        <a class="nav-link deco-none text-secondary" href="#">Home <span class="sr-only">(current)</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav width100 justify-content-end">
                <li class="nav-item">
                    <a class="nav-link" href="./signup.php">Signup</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./login.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>
</header>