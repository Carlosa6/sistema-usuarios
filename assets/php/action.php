<?php

session_start();

//PHPMAILER
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

require_once "auth.php";
$user = new Auth();

//Handle Register Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'register'){
    $name = $user->test_input($_POST['name']); //sanitizar el input
    $email = $user->test_input($_POST['email']); //sanitizar el input
    $password = $user->test_input($_POST['password']); //sanitizar el input

    //encriptar password
    $hpass = password_hash($password,PASSWORD_DEFAULT);

    if ($user->user_exist($email)) {
        echo $user->showMessage("warning","This E-Mail is already registered!");
    }else{
        if($user->register($name,$email,$hpass)){
            // echo $user->showMessage("success","Successfully registered user");
            echo "register";
            $_SESSION['user'] = $email;
        }else{
            echo $user->showMessage("danger","Something went wrong! try again later!");
        }
    }
}

//Handle Login Ajax Request
if(isset($_POST['action']) && $_POST['action'] == "login"){
    $email = $user->test_input($_POST['email']);
    $password = $user->test_input($_POST['password']);

    $loggedInUser = $user->login($email);

    if($loggedInUser != null){
        if(password_verify($password,$loggedInUser['password'])){
            if(!empty($_POST['rem'])){
                setcookie("email",$email,time()+(30*24*60*60),'/');
                setcookie("password",$password,time()+(30*24*60*60),'/');
            }else{
                setcookie("email","",1,"/");
                setcookie("password","",1,"/");
            }

            echo "login";
            $_SESSION['user'] = $email;
        }else{
            echo $user->showMessage("danger","Password is incorrect!");
        }
    }else{
        echo $user->showMessage("danger","User not found!");
    }
}

//Handle Forgot Password Ajax Request
if(isset($_POST['action']) && $_POST['action'] == "forgot"){
    $email = $user->test_input($_POST['email']);
    $user_found = $user->currentUser($email);
    if($user_found != null){
        $token = uniqid();
        $token = str_shuffle($token);

        $user->forgot_password($token,$email);

        //enviar el email
        try {
            $mail->SMTPDebug = 3;
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = Database::USER_EMAIL;
            $mail->Password = Database::PASSWORD_EMAIL;
            // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;

            // $mail->setFrom(Database::USER_EMAIL,'Project Admin by ACD6');
            $mail->From = Database::USER_EMAIL;
            $mail->FromName = "Admin Project by ACD6";
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Reset Password";
            $mail->Body = "<h3>Click the below link to reset your password.<br><a href='http://localhost/user-system/reset-pass.php?email=".$email."&token=".$token."'>http://localhost/user-system/reset-pass.php?email=".$email."&token=".$token."</a><br>Regards<br>USER SYSTEM BY ACD6</h3>";

            $mail->send();
            echo $user->showMessage("success","We have send you the reset link in your e-mail ID, please check your e-mail!");
        } catch (Exception $e) {
            echo $user->showMessage("danger","Something went wrong, please try again later!");
        }

    }else{
        echo $user->showMessage("info","This e-mail is not registered!");
    }
}
