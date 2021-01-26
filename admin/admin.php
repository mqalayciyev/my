<?php
session_start();
require "db.php";
if(!isset($_SESSION["admin"])){
    header("Location: index.php");
}

if(isset($_GET["action"])){
    if($_GET["action"] == "logout"){
        unset($_SESSION["admin"]);
        header("Location: index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="css/croppie.css">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/news.css">
    <link rel="stylesheet" href="css/team.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="stylesheet" href="css/statistika.css">
    
    

    <!-- <script src="https://kit.fontawesome.com/56018e5250.js" crossorigin="anonymous"></script> -->
    <script src="../js/56018e5250.js"></script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.2/angular.js"></script> -->
    <script src="js/angular.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-animate/1.8.2/angular-animate.js"></script> -->
    <script src="js/angular-animate.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-route/1.8.2/angular-route.js"></script> -->
    <script src="js/angular-route.js"></script>
    <script src="js/croppie.js"></script>
    <title>Admin Panel</title>
</head>

<body ng-app="admin" ng-controller="adminCont">
    <div class="container-fluid bg-dark">
        <div class="row">
            <div ng-show="durum" class="col nav-div">
                <p class="header-group">Zaqatala PFK</p>
                <ul>
                    <li><a href="admin.php">Statistika</a></li>
                    <li><label for="dropdown" class="text-white m-0 p-0" ng-click="eylem()">Panellər <i class="fas fa-angle-{{angle}}"></i></label>
                        <ul id="dropdown-div" ng-style="panel == true && {'height' : 'max-content'}">
                            <li><a href="?page=header">Başlıq</a></li>
                            <li><a href="?page=home">Ana Səhifə</a></li>
                            <li><a href="?page=news">Xəbərlər</a></li>
                            <li><a href="?page=team">Komanda</a></li>
                            <li><a href="?page=about">Haqqımızda</a></li>
                            <li><a href="?page=games">Oyunlar</a></li>
                            <li><a href="?page=turnir">Turnir Cədvəli</a></li>
                            <li><a href="?page=stadium">Ev Stadionu</a></li>
                            <li><a href="?page=galeri">Galereya</a></li>
                            <li><a href="?page=contact">Əlaqə</a></li>
                        </ul>
                    </li>
                    <li><a href="?page=mail">Masajlar</a></li>
                </ul>
            </div>
            <div class="col page px-0">
                <div class="col-12 page-header">
                    <div class="row w-100">
                        <span class="align-self-center"><i class="fas fa-bars fa-2x" ng-click="durum = !durum"></i></span>
                        <span class="align-self-center"><a href="#">Page 1</a></span>
                        <span  class="align-self-center"><a href="#">Page 2</a></span>
                        <div class="dropdown nav-item ml-auto">
                            <a href="#" class="dropdown-toggle nav-link text-white" data-toggle="dropdown">
                            <div class="photo">
                                <img src="img/admin.png" alt="Profile Photo">
                            </div>
                            <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu dropdown-navbar bg-white">
                                <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Profile</a></li>
                                <li class="nav-link"><a href="javascript:void(0)" class="nav-item dropdown-item">Settings</a></li>
                                <li class="dropdown-divider"></li>
                                <li class="nav-link"><a href="admin.php?action=logout" class="nav-item dropdown-item">Çıxış</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-12 page-body bg-light">
                    <?php
                        $url = (isset($_GET['page'])) ? "page/" . $_GET['page'] . ".php" : "page/statistika.php";
                        require $url;
                    ?>
                </div>
            </div>
        </div>

    </div>

    <script src="js/admin.js"></script>

</body>

</html>