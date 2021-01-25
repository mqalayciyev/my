<?php
session_start();
require "admin/db.php";
$ip = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : "empty";
$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$tarayici = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "empty";
$geldigi_adres = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "empty";
$tarayici_dili = isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : "empty";
$sunucu_protokolu = isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : "empty";
$karakter_seti = isset($_SERVER['HTTP_ACCEPT_CHARSET']) ? $_SERVER['HTTP_ACCEPT_CHARSET'] : "empty";
$istek_metodu = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : "empty";
$uzak_port = isset($_SERVER['REMOTE_PORT']) ? $_SERVER['REMOTE_PORT'] : "empty";
$proxy_ip = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['REMOTE_PORT'] : "empty";
$cookie = isset($_SERVER['HTTP_COOKIE']) ? $_SERVER['HTTP_COOKIE'] : "empty";

$sql = "INSERT INTO `visitors` (`ip`, `host`, `tarayici`, `geldigi_adres`, `tarayici_dili`, `sunucu_protokolu`, `karakter_seti`, `istek_metodu`, `uzak_port`, `proxy_ip`, `cookie`) 
        VALUES ('$ip', '$host', '$tarayici', '$geldigi_adres', '$tarayici_dili', '$sunucu_protokolu', '$karakter_seti', '$istek_metodu', '$uzak_port', '$proxy_ip', '$cookie')";
mysqli_query($conn, $sql);

$wellcome = "d-block";
$page = "d-none";
$news = "d-none";
$team = "d-none";
$galeri = "d-none";
$contact = "d-none";
$search = "d-none";

if(isset($_GET['page'])){
    $wellcome = "d-none";
    $page = "d-block";
    $p = $_GET['page'];
    $$p = "d-block";
    if($p == "team"){
        $$p = "d-inline";
    }
    if(isset($_GET['v'])){
        $v = $_GET['v'];
        $$v = "d-block";
    }
}

$sql = "SELECT * FROM `contact`";
$response = mysqli_fetch_assoc(mysqli_query($conn, $sql));
$facebook = $response['facebook'];
$instagram = $response['instagram'];
$twitter = $response['twitter'];
$youtube = $response['youtube'];


?>






<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="">
    <meta name="author" content="Məhəmməd Qalayçiyev">
    <meta http-equiv="Content-Type" content="text/html; charset = UTF-8">
    <meta http-equiv="Content-Language" content="az">
    <title>ZAQATALA PFK</title>


    <link rel="shortcut icon" href="media/logo.png" type="text/css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/news.css">
    <link rel="stylesheet" href="css/team.css">
    <link rel="stylesheet" href="css/galeri.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/glide.core.css">
    <link rel="stylesheet" href="css/glide.theme.css">
    <link rel="stylesheet" href="css/animate.min.css" />


    <script src="js/56018e5250.js"></script>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/glide.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.2/angular.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-animate/1.8.2/angular-animate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-route/1.8.2/angular-route.js"></script> -->



</head>

<body class="bg-light w-100 m-0 p-0">
    <div class="loading fixed-top h-100">
        <div class="d-flex justify-content-center h-100">
            <img src="media/loading.gif" class="align-self-center" alt="loding.gif">
        </div>
    </div>
    <div class="hide-div search fixed-top h-100">
        <div class="hide-div d-flex justify-content-center h-100">
            <form class="hide-div align-self-center col-12 col-lg-10 col-xl-8" action="index.php?page=search" method="get">
                <div class="input-group animate__animated animate__bounceInDown">
                    <input type="hidden" name="page" value="search">
                    <input type="search" class="form-control border-0 col-12" name="search" value="" placeholder="Axtarış . . .">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-dark bg-white border-0 rounded-0" name="button" value="search">
                            <i class="fas fa-search i-text"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="img-view" class="row align-items-center">
        <div class="col-12 p-0">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8 w-100">
                    <div class="row justify-content-center">
                        <img class="image-div" src="">
                    </div>
                </div>
            </div>
            <span id="prev">◄</span>
            <span id="next">►</span>
        </div>
        <span id="close" class="fas fa-times"></span>
    </div>

    <div class="context bg-light">
        <div id="header" class="header-div position-relative">
            <div class="transparent-div "></div>

            

            <div class="navbar-menu col-12 d-lg-none">
                <div class="logo header-navbar-menu col-12 py-3 d-lg-none">
                    <div class="row clearfix">
                        <a href="index.php" class="nav-link p-0">
                            <img src="media/logo.png" alt="zaqatala pfk logo" />
                        </a>
                        <div class="text-white ml-auto">
                            <span class="nav-link d-inline-block ml-auto px-0 mx-3">
                                <i class="fas fa-search fa-2x"></i>
                            </span>
                            <i class="fas fa-bars fa-3x navbar-open"></i>
                        </div>
                    </div>
                </div>

                <div class="row hide-menu align-items-center px-3">
                    <i class="fas fa-bars fa-3x navbar-open"></i>
                    <p class="align-self-center"><a href="index.php" class="nav-link p-0 text-white">ZAQATALA PFK</a>
                    </p>
                    <span class="nav-link d-inline-block ml-auto px-0">
                        <i class="fas fa-search fa-2x"></i>
                    </span>
                </div>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light fixed-top col-12 m-0 p-0 hide">
                <div class="logo col p-0 d-none d-lg-block">
                    <div class="col-lg-12 col-xl-10">
                        <a href="index.php" class="nav-link">
                            <img src="media/logo.png" alt="zaqatala pfk logo" />
                            <h2 class="header-group header-group-logo ">ZAQATALA PFK</h2>
                        </a>
                    </div>
                </div>

                <div class="col-12 col-lg-7 pr-0 p-0 pl-lg-3 hide">
                    <ul id="navbarUl" class="navbar-nav d-flex justify-content-around m-0">
                        <li class="nav-item mx-md-1 m-0"><a href="?page=news"
                                class="nav-link text-white bottom-line">Xəbərlər</a></li>

                        <li class="li-dropdown nav-item m-0 mx-md-1">
                            <a href="" class="nav-link text-white bottom-line dropdown-toggle" id="navbarDropdown"
                                role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Komanda</a>
                            <div class="dropdown-menu p-0 animate__animated animate__flipInY"
                                aria-labelledby="navbarDropdown">
                                <a href="?page=team&v=about" aria-label="about"
                                    class="dropdown-item text-white">Haqqımızda</a>
                                <a <?php echo (isset($_GET['page']) && !isset($_GET['player']) && $_GET['page'] == 'team') ? '' : 'href="?page=team"'?>
                                    aria-label="coming-games" class="dropdown-item text-white">Gələcək Oyunlar</a>
                                <a <?php echo (isset($_GET['page']) && !isset($_GET['player']) && $_GET['page'] == 'team') ? '' : 'href="?page=team"'?>
                                    aria-label="games" class="dropdown-item text-white">Oyun Tarixçəsi</a>
                                <a <?php echo (isset($_GET['page']) && !isset($_GET['player']) && $_GET['page'] == 'team') ? '' : 'href="?page=team"'?>
                                    aria-label="tournament" class="dropdown-item text-white">Turnir Cədvəli</a>
                                <a <?php echo (isset($_GET['page']) && !isset($_GET['player']) && $_GET['page'] == 'team') ? '' : 'href="?page=team"'?>
                                    aria-label="staff" class="dropdown-item text-white">Oyunçular</a>
                                <a <?php echo (isset($_GET['page']) && !isset($_GET['player']) && $_GET['page'] == 'team') ? '' : 'href="?page=team"'?>
                                    aria-label="stadium" class="dropdown-item text-white">Ev Stadionu</a>
                            </div>
                        </li>
                        <!-- Tabletden basqa butun cihazlarda gorsenecek -->
                        <li class="nav-item m-0 mx-md-1 "><a href="?page=galeri"
                                class="nav-link text-white bottom-line">Galereya</a></li>
                        <li class="nav-item m-0 mx-md-1"><a href="?page=contact"
                                class="nav-link text-white bottom-line">Əlaqə</a></li>
                        <li class="nav-item m-0 mx-lg-1 vertical-line d-none d-lg-block">
                            <span class="nav-link text-white span-vertical-line"></span>
                        </li>
                        <li class="nav-item d-none d-lg-block">
                            <span class="nav-link text-white"><i class="fas fa-search"></i></span>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="header-well float-right text-right d-none <?=$wellcome?>">
                <h1 class="text-white font-weight-bold mb-4">Xoş Gəlmisiniz</h1>
                <h1><mark class="text-white font-weight-bold">Zaqatala PFK</mark></h1>
                <h1 class="text-white mt-4">Rəsmi Web Səhifəsi</h1>
                <button class="btn btn-outline-green mt-4 px-5"><a href="index.php?page=team"
                        class="text-white font-weight-bold">Haqqımızda</a></button>
            </div>

            <div class="text-left header-cont w-100">
                <p class="text-white font-weight-normal m-0 <?=$page?>">Zaqatala PFK</p>
                <h1 class="text-white font-weight-bold <?=$news?>">Xəbərlər</h1>
                <h1 class="text-white font-weight-bold <?=$team?>">Komanda</h1>

                <h1 class="text-white font-weight-bold <?=$galeri?>">Qalereya</h1>
                <h1 class="text-white font-weight-bold <?=$contact?>">Bizimlə Əlaqə</h1>
                <h1 style="word-wrap: break-word" class="text-white font-weight-bold <?=$search?>">Axtarış Nəticələri</h1>
            </div>
        </div>

        <?php

        if(!isset($_GET['page'])){
            $class = "d-flex";
        }else{
            $class = "d-none";
        }
        ?>

        <div class="w-100 context-div">

            <?php
            if(isset($_GET['page']) && isset($_GET['player'])){
                $page = "staffinfo";
            }
            else if(isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = "home";
            }


            $file = $page . ".php";
            if(!file_exists($file)) $file = "404.php";

            require $file;
            ?>

        </div>
    </div>

    <footer class="footer col-12">
        <div class="first-div row justify-content-center position-relative">
            <div class="col-12">
                <div class="row h-100">
                    <div class=" col-12 col-lg-4 pt-2 pt-lg-0  px-0 align-self-end">
                        <p class="font-weight-bold m-0">Zaqatala PFK</p>
                    </div>
                    <div class="nav_footer align-self-end col-12 col-lg-8">
                        <ul class="d-lg-flex">
                            <li><a href="index.php?page=news" class="bottom-line">Xəbərlər</a></li>
                            <li><a href="index.php?page=team" class="bottom-line">Komanda</a></li=>
                            <li><a href="index.php?page=galeri" class="bottom-line">Galereya</a></li>
                            <li><a href="index.php?page=contact" class="bottom-line">Əlaqə</a></li=>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col-12 px-0">
                <div class="social-div ml-auto">
                    <a href="<?=$facebook?>" target="_blank" class="link" title="Facebook"><i class="fab fa-facebook-f fa-2x"></i></a>
                    <a href="<?=$twitter?>" target="_blank" class="link" title="Twitter"><i class="fab fa-twitter fa-2x"></i></a>
                    <a href="<?=$instagram?>" target="_blank" class="link" title="Instagram"><i class="fab fa-instagram fa-2x"></i></a>
                    <a href="<?=$youtube?>" target="_blank" class="link" title="YouTube"><i class="fab fa-youtube fa-2x"></i></a>

                </div>
            </div>
        </div>
        <div class="second-div row">
            <div class="col-12">
                <div class="row align-items-center h-100">
                    <p class="text-white col-12 col-lg-6 px-2 text-lg-right m-lg-0 d-block d-lg-none">
                        Developer
                        <a href="https://www.instagram.com/mgalaychiyev" target="_blank">Məhəmməd Qalayçiyev</a>
                    </p>
                    <p class="text-white col-12 col-lg-6 text-center text-lg-left px-0 m-lg-0">
                        © <?=date("Y")?> ZAQATALA PFK. All copyrights reserved.
                    </p>
                    <p class="text-white col-12 col-lg-6 text-lg-right px-0 m-lg-0 d-none d-lg-block">
                        Developer
                        <a href="https://www.instagram.com/mgalaychiyev" target="_blank">Məhəmməd Qalayçiyev</a>
                    </p>
                </div>
            </div>

        </div>


    </footer>

    <script src="js/style.js"></script>
</body>

</html>