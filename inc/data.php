<?php
session_start();
require "../admin/db.php";

if(isset($_POST['query'])){
    if($_POST['query'] === "turnir"){
        $sql = "SELECT * FROM `turnir` WHERE `status` = 1";
        $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));

        $veri = file_get_contents($res['url']);

        $pattern = '@<table cellpadding="1" (.*?)>(.*?)</table>@si';

        preg_match_all($pattern, $veri, $yazilar);

        print_r($yazilar[0][0]);
    }
    elseif($_POST['query'] === "header"){
        $sql = "SELECT * FROM `header` WHERE `status` = 1";
        $query = mysqli_query($conn, $sql);
        $arr = array();
        while($res = mysqli_fetch_assoc($query)){
            array_push($arr, $res['image']);
        }
        print_r (json_encode($arr));
    }
    elseif($_POST['query'] === "send_mail"){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $text = $_POST['text'];
        $text = str_replace("\"", "'", $text);
        $sql = "INSERT INTO `mail` (`name`, `email`, `text`, `mainly_type`, `moving`, `type`)  VALUES ('$name', '$email', \"$text\", 'inbox', 'inbox', 'inbox')";
        echo $sql;
        if(mysqli_query($conn, $sql)){
            $message = "Mesaj göndərildi.";
            $_SESSION['success'] = $message;
            header("Location: ../index.php?page=contact");
        }
        else{
            $message = "Xəta! Mesaj göndərilmədi.";
            $_SESSION['error'] = $message;
            header("Location: ../index.php?page=contact");
        }
    }
}
else{
    header("Location: ../index.php");
}

?>