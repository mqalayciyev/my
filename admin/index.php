<?php
session_start();

if(isset($_SESSION["admin"])){
    header("Location: admin.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Admin Panel</title>

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="css/mail.css">


    <!-- <script src="https://kit.fontawesome.com/56018e5250.js" crossorigin="anonymous"></script> -->
    <script src="js/56018e5250.js"></script>
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.8.2/angular.js"></script> -->
    <script src="js/angular.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-animate/1.8.2/angular-animate.js"></script> -->
    <script src="js/angular-animate.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-route/1.8.2/angular-route.js"></script> -->
    <script src="js/angular-route.js"></script>

</head>
<body ng-app="app" ng-controller="appcont">
    <div class="col-12 vh-100 context">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-4 p-4 rounded">
                <form action="login.php">
                    <h3 class="text-center p-4 text-white ">Admin Panel</h3>
                    <input type="text" name="username" placeholder="Username" class="form-control">
                    <input type="password" name="password" placeholder="Password" class="form-control mt-2 mb-3">
                    <p class="alert alert-danger"><span></span> <i class="close">&times</i></p>
                    <button type="submit" name="login" class="btn btn-primary col-12">Login</button>
                </form>
            </div>
        </div>
    </div>    
    <script src="js/index.js"></script>
</body>
</html>