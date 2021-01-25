<?php
session_start();
require "db.php";

if(isset($_POST["username"]) && isset($_POST["password"])){
    if($_POST["username"] != "" && $_POST["password"] != ""){
        $user = $_POST["username"];
        $pass = $_POST["password"];
        $sql = "SELECT * FROM admin";
        $sorgu = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        if($user === $sorgu["username"] || $user === $sorgu["email"] && $pass === $sorgu["password"]){
            $_SESSION['admin'] = "admin";
            echo "ok";
        }
        else{
            echo "Username və ya Password səhvdir!!!";
        }
    }
    else{
        echo "Username və ya Password doldurulmayıb!!!";
    }
}
else{
    header("Loaction: index.php");
}

?>