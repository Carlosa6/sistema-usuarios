<?php
require_once "assets/php/session.php";
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

    <title><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php')); ?> | USER SYSTEM</title>
    <!-- CDN CSS DATATABLE -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>
    <style type="text/css">
        @import url("https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&display=swap");

        * {
            font-family: 'Maven Pro', sans-serif;
        }
        .bgprimario{
            background-color:#72a7e0;
            color:#fff;
        }
        .bgexito{
            background-color: #75a881;
            color:#fff;
        }
        .bgadvert{
            background-color: #eac560;
            color:#fff;
        }
        .bgmora{
            background-color:#c56183;
            color:#fff;
        }
        .bordermora{
            border:1px solid #c56183;
        }
        .bgorange{
            background-color: #f08a5d;
            color:#fff;
        }
        .borderorange{
            border:1px solid #f08a5d;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><i class="fas fa-code fa-lg"></i>&nbsp;&nbsp;USER SYSTEM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'home.php') ? 'text-info active' : '' ?>" href="home.php"><i class="fas fa-home"></i>&nbsp;Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'profile.php') ? 'text-info active' : '' ?>" href="profile.php"><i class="fas fa-user-circle"></i>&nbsp;Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'feedback.php') ? 'text-info active' : '' ?>" href="feedback.php"><i class="fas fa-comment-dots"></i>&nbsp;Feedback</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (basename($_SERVER['PHP_SELF']) == 'notification.php') ? 'text-info active' : '' ?>" href="notification.php"><i class="fas fa-bell"></i>&nbsp;Notification&nbsp;<span id="checkNotification"></span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-cog"></i>&nbsp;Hi! <?= $fname; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#"><i class="fas fa-cog"></i>&nbsp;Setting</a>
                        <a class="dropdown-item" href="assets/php/logout.php"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>