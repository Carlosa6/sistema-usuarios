<?php

session_start();
if (!isset($_SESSION['username'])) {
    header("location:index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $title = basename($_SERVER['PHP_SELF'], '.php'); //toma el nombre del archivo actual
    $title = explode('-', $title); //quitar el '-' al nombre del archivo
    $title = ucfirst($title[1]); //primera letra en mayúscula
    ?>
    <!-- CDN CSS BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
    <title><?= $title; ?> | Admin Panel</title>
    <!-- CDN CSS DATATABLE -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- CUSTOM JS -->
    <script>
        $(document).ready(function(){
            $("#open-nav").click(function(){
                $(".admin-nav").toggleClass("animate");
            });
        });
    </script>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="admin-nav p-0">
                <h4 class="text-light text-center p-2">Admin Panel</h4>
                <div class="list-group list-group-flush">
                    <!-- DASHBOARD -->
                    <a href="admin-dashboard.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-dashboard.php') ? 'nav-active' : ''; ?>"><i class="fas fa-chart-pie"></i>&nbsp;&nbsp;Dashboard</a>
                    <!-- USERS -->
                    <a href="admin-users.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-users.php') ? 'nav-active' : ''; ?>"><i class="fas fa-user-friends"></i>&nbsp;&nbsp;Users</a>
                    <!-- NOTES -->
                    <a href="admin-notes.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-notes.php') ? 'nav-active' : ''; ?>"><i class="fas fa-sticky-note"></i>&nbsp;&nbsp;Notes</a>
                    <!-- FEEDBACK -->
                    <a href="admin-feedback.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-feedback.php') ? 'nav-active' : ''; ?>"><i class="fas fa-comment"></i>&nbsp;&nbsp;Feedback</a>
                    <!-- NOTIFICATION -->
                    <a href="admin-notification.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-notification.php') ? 'nav-active' : ''; ?>"><i class="fas fa-bell"></i>&nbsp;&nbsp;Notification</a>
                    <!-- USUARIOS ELIMINADOS -->
                    <a href="admin-deleteduser.php" class="list-group-item text-light admin-link <?= (basename($_SERVER['PHP_SELF']) == 'admin-deleteduser.php') ? 'nav-active' : ''; ?>"><i class="fas fa-user-slash"></i>&nbsp;&nbsp;Deleted Users</a>
                    <!-- EXPORT USERS -->
                    <a href="#" class="list-group-item text-light admin-link"><i class="fas fa-table"></i>&nbsp;&nbsp;Export Users</a>
                    <!-- PROFILE -->
                    <a href="#" class="list-group-item text-light admin-link"><i class="fas fa-id-card"></i>&nbsp;&nbsp;Profile</a>
                    <!-- SETTING -->
                    <a href="#" class="list-group-item text-light admin-link"><i class="fas fa-cog"></i>&nbsp;&nbsp;Setting</a>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-lg-12 pt-2 d-flex justify-content-between" style="background-color: #f3904f;">
                        <!-- BARRA PARA CERRAR Y ABRIR EL NAV -->
                        <a href="#" class="text-white" id="open-nav"><h3><i class="fas fa-bars"></i></h3></a>
                        <!-- NOMBRE DE LA PESTAÁ ACTUAL -->
                        <h4 class="text-light"><?= $title; ?></h4>
                        <!-- LOGOUT -->
                        <a href="assets/php/logout.php" class="text-light mt-1"><i class="fa fa-sign-out-alt" aria-hidden="true"></i>&nbsp;Logout</a>
                    </div>
                </div>