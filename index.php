<?php
session_start();
if (isset($_SESSION['user'])) {
    header('location:home.php');
}

//ACTUALIZAR LA TABLA DE VISITAS CADA VEZ QUE UN USUARIO INGRESA A LA PÁGINA WEB
include_once "assets/php/config.php";
$db = new Database();

$sql = "UPDATE visitors SET hits = hits+1 WHERE id=1";
$stmt = $db->conn->prepare($sql);
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Administrador de Usuarios, Mensajes y Notas" />
    <!-- CDN CSS BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
    <!-- CDN CUSTOM CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <title>USER SYSTEM BY ACD6</title>
</head>

<body>

    <div class="container">
        <!-- Inicio Formulario Login -->
        <div class="row justify-content-center wrapper" id="login-box">
            <div class="col-lg-10 my-auto">
                <div class="card-group myShadow">
                    <div class="card rounded-left p-4" style="flex-grow: 1.4;">
                        <h1 class="text-center font-weight-bold textOrange">Sign in to Account</h1>
                        <hr class="my-3">
                        <form action="#" method="POST" class="px-3" id="login-form">
                            <div id="loginAlert"></div>
                            <!-- Input Email -->
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-envelope fa-lg"></i>
                                    </span>
                                </div>
                                <input type="email" name="email" id="email" class="form-control rounded-0" placeholder="E-Mail" required value="<?php if (isset($_COOKIE['email'])) {
                                                                                                                                                    echo $_COOKIE['email'];
                                                                                                                                                } ?>">
                            </div>
                            <!-- Input Password -->
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="fas fa-key fa-lg"></i>
                                    </span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control rounded-0" placeholder="Password" required value="<?php if (isset($_COOKIE['password'])) {
                                                                                                                                                                echo $_COOKIE['password'];
                                                                                                                                                            } ?>">
                            </div>
                            <!-- Checkbox Remember me and Forgot Password -->
                            <div class="form-group">
                                <!-- Checkbox Remember me -->
                                <div class="custom-control custom-checkbox float-left">
                                    <input type="checkbox" name="rem" class="custom-control-input" id="customCheck" <?php if (isset($_COOKIE['email'])) { ?> checked <?php } ?>>
                                    <label for="customCheck" class="custom-control-label">Remember me</label>
                                </div>
                                <!-- Forgot Password -->
                                <div class="forgot float-right">
                                    <a href="#" id="forgot-link">Forgot Pasword?</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Sign In" id="login-btn" class="btn btn-danger btn-lg btn-block myBtn">
                            </div>
                        </form>
                    </div>
                    <div class="card justify-content-center rounded-right myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">Hello Friends!</h1>
                        <hr class="my-3 bg-light myHr">
                        <p class="text-center font-weight-bolder text-light lead">Enter your personal details and start your journey with us!</p>
                        <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="register-link">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Formulario Login -->

        <!-- Inicio Formulario de Registro -->
        <div class="row justify-content-center wrapper" id="register-box" style="display: none;">
            <div class="col-lg-10 my-auto">
                <div class="card-group myShadow">
                    <div class="card justify-content-center rounded-left myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">Welcome Back!</h1>
                        <hr class="my-3 bg-light myHr">
                        <p class="text-center font-weight-bolder text-light lead">To keep connected with us please login with your personal info.</p>
                        <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="login-link">Sign In</button>
                    </div>
                    <div class="card rounded-right p-4" style="flex-grow: 1.4;">
                        <h1 class="text-center font-weight-bold textOrange">Create Account</h1>
                        <hr class="my-3">
                        <form action="#" method="POST" class="px-3" id="register-form">
                            <div id="regAlert"></div>
                            <!-- Input Name -->
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-user fa-lg"></i>
                                    </span>
                                </div>
                                <input type="text" name="name" id="name" class="form-control rounded-0" placeholder="Full Name" required>
                            </div>

                            <!-- Input Email -->
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-envelope fa-lg"></i>
                                    </span>
                                </div>
                                <input type="email" name="email" id="remail" class="form-control rounded-0" placeholder="E-Mail" required>
                            </div>

                            <!-- Input Password -->
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="fas fa-key fa-lg"></i>
                                    </span>
                                </div>
                                <input type="password" name="password" id="rpassword" class="form-control rounded-0" placeholder="Password" required minlength="6">
                            </div>

                            <!-- Input Confirm Password -->
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="fas fa-key fa-lg"></i>
                                    </span>
                                </div>
                                <input type="password" name="cpassword" id="cpassword" class="form-control rounded-0" placeholder="Confirm Password" required minlength="6">
                            </div>

                            <div class="form-group">
                                <div id="passError" class="text-danger font-weight-bold"></div>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Sign Up" id="register-btn" class="btn btn-danger btn-lg btn-block myBtn">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- Fin Formulario de Registro -->

        <!-- Inicio de Formulario Olvidé Contraseña -->
        <div class="row justify-content-center wrapper" id="forgot-box" style="display: none;">
            <div class="col-lg-10 my-auto">
                <div class="card-group myShadow">
                    <div class="card justify-content-center rounded-left myColor p-4">
                        <h1 class="text-center font-weight-bold text-white">Reset Password</h1>
                        <hr class="my-3 bg-light myHr">
                        <button class="btn btn-outline-light btn-lg align-self-center font-weight-bolder mt-4 myLinkBtn" id="back-link">Back</button>
                    </div>
                    <div class="card rounded-right p-4" style="flex-grow: 1.4;">
                        <h1 class="text-center font-weight-bold textOrange">Forgot Your Password</h1>
                        <hr class="my-3">
                        <p class="lead text-center text-secondary">To reset your password, enter the registered e-mail address and we will send you the rest instructions on your e-mail!</p>
                        <form action="#" method="POST" class="px-3" id="forgot-form">
                            <div id="forgotAlert"></div>
                            <!-- Input Email -->
                            <div class="input-group input-group-lg form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0">
                                        <i class="far fa-envelope fa-lg"></i>
                                    </span>
                                </div>
                                <input type="email" name="email" id="femail" class="form-control rounded-0" placeholder="E-Mail" required>
                            </div>

                            <div class="form-group">
                                <input type="submit" value="Reset Password" id="forgot-btn" class="btn btn-danger btn-lg btn-block myBtn">
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- Fin de Formulario Olvidé Contraseña -->
    </div>

    <!-- CDN JQUERY.MIN.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <!-- CDN BOOTSTRAP.BUNDLE.MIN.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.bundle.min.js" integrity="sha512-kBFfSXuTKZcABVouRYGnUo35KKa1FBrYgwG4PAx7Z2Heroknm0ca2Fm2TosdrrI356EDHMW383S3ISrwKcVPUw==" crossorigin="anonymous"></script>
    <!-- CDN JS FONTAWESOME -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/js/all.min.js" integrity="sha512-YSdqvJoZr83hj76AIVdOcvLWYMWzy6sJyIMic2aQz5kh2bPTd9dzY3NtdeEAzPp/PhgZqr4aJObB3ym/vsItMg==" crossorigin="anonymous"></script>
    <!-- CUSTOM JS -->
    <script type="text/javascript" src="assets/js/app.js"></script>
</body>

</html>