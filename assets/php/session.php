<?php

session_start();
require_once "auth.php";
$cuser = new Auth();

if(!isset($_SESSION['user'])){
    header("location: index.php");
    die;
}

$cemail = $_SESSION['user'];

$data = $cuser->currentUser($cemail);

$cid = $data['id'];
$cname = $data['name'];
$cpass = $data['password'];
$cphone = $data['phone'];
$cgender = $data['gender'];
$cdob = $data['dob'];
$cphoto = $data['photo'];
$created = $data['created_at'];

//formato de fecha día Mes Año
$reg_on = date('d M Y',strtotime($created));

$verified = $data['verified'];

// Dividir el nombre hasta el primer espacio
$fname = strtok($cname," ");

if($verified == 0){
    $verified = "Not Verified!";
}else{
    $verified = "Verified!";
}
