<?php
session_start();
if (isset($_SESSION['username'])) {
    header("location:admin-dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin</title>
    <!-- CDN CSS BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        html,
        body {
            height: 100%;
        }
    </style>
</head>

<body class="bg-dark">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center">
            <div class="col-lg-5">
                <div class="card border-danger shadow-lg">
                    <div class="card-header bg-danger">
                        <h3 class="m-0 text-white"><i class="fas fa-user-cog"></i>&nbsp;Admin Panel Login</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" class="px-3" id="admin-login-form">
                            <div id="adminLoginAlert"></div>
                            <div class="form-group">
                                <input type="text" name="username" class="form-control form-control-lg rounded-3" placeholder="Username" required autofocus>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg rounded-3" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Login" name="admin-login" class="btn btn-danger btn-block btn-lg rounded-3" id="adminLoginBtn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS JS -->
    <?php require_once "assets/php/scripts.php"; ?>
    <!-- CUSTOM JS -->
    <script src="assets/js/app-admin.js"></script>
</body>

</html>