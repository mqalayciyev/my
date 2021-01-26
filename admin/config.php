<?php

session_start();
require "db.php";
if(!isset($_SESSION["admin"])){
    header("Location: index.php");
}

if(isset($_GET["query"])){
    if($_GET['query'] === "delete_header_image"){
        $dir = "../media/header/";
        $sql = "SELECT `image` FROM header WHERE id='".$_GET['id']."'";
        $file = mysqli_fetch_assoc(mysqli_query($conn, $sql))['image'];
        $sql = "DELETE FROM header WHERE id='".$_GET['id']."'";
        if(mysqli_query($conn, $sql)){
            if(unlink($dir.$file)){
                $message = "Fayl silindi";
                $_SESSION['success'] = $message;
                header("Location: admin.php?page=header");
            }
            else{
                $message = "XƏTA";
                $_SESSION['error'] = $message;
                header("Location: admin.php?page=header");
            }
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=header");
        }
    }
    
    elseif($_GET['query'] == "upload_image_galeri"){
        $data = $_POST["image"];

		$image_array_1 = explode(";", $data);

		$image_array_2 = explode(",", $image_array_1[1]);

        $data = base64_decode($image_array_2[1]);
        $dir = "../media/albom/";
        $img = [];
        if(is_dir($dir)){
            if($d = opendir($dir)){
                while(($file = readdir($d)) !== false){
                    if(strpos($file, "img") !== false){
                        array_push($img, $file);
                    }
                }
            }
        }
        $index = count($img)-1;
        $number = substr($img[$index], 3, 1) + 1;

        $imageName = "img". $number . '.jpeg';
        

        file_put_contents($dir.$imageName, $data);

        $sql = "INSERT INTO galeri (`image`) VALUES ('$imageName')";
        $sql1 = "INSERT INTO home (`kategori`, `image`) VALUES ('fotoalbom', '$imageName')";
		if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql1)){
			$message = "Fayl yükləndi";
            $_SESSION['success'] = $message;
        }
        else{
            unlink($dir.$imageName);
            $message = "XƏTA";
            $_SESSION['error'] = $message;
        }
    }
    elseif($_GET['query'] === "delete_galeri_image"){
        $dir = "../media/albom/";
        $sql = "SELECT `image` FROM galeri WHERE id='".$_GET['id']."'";
        $file = mysqli_fetch_assoc(mysqli_query($conn, $sql))['image'];
        $sql = "DELETE FROM galeri WHERE id='".$_GET['id']."'";
        if(unlink($dir.$file)){
            if(mysqli_query($conn, $sql)){
                $message = "Fayl silindi";
                $_SESSION['success'] = $message;
                header("Location: admin.php?page=galeri");
            }
            else{
                $message = "Sorğu xətası";
                $_SESSION['error'] = $message;
                header("Location: admin.php?page=galeri");
            }
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=galeri");
        }
    }
    elseif($_GET['query'] === "add_contact_info"){
        $sql = "SELECT * FROM contact";
        if(mysqli_num_rows(mysqli_query($conn, $sql)) === 0){
            $sql = "INSERT INTO contact (ofis, stadium, email, map, facebook, instagram, twitter, youtube) 
            VALUES ('".$_GET['ofis']."', '".$_GET['stadion']."', '".$_GET['email']."', '".$_GET['map']."', '".$_GET['facebook']."', '".$_GET['instagram']."', '".$_GET['twitter']."', '".$_GET['youtube']."')";
             if(mysqli_query($conn, $sql)){
                $message = "Məlumat əlavə edildi";
                $_SESSION['success'] = $message;
                header("Location: admin.php?page=contact");
             }
             else{
                $message = "XƏTA";
                $_SESSION['error'] = $message;
                header("Location: admin.php?page=contact");
             }
        }
        else{
            $message = "Bazada bu bölmə üzrə məlumat mövcuddur. Bu halda yalnız köhnə məlumatı yeniliyə bilərsiniz.";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=contact");
        }
    }
    elseif($_GET['query'] === "edit_contact_info"){
        $sql = 'UPDATE `contact` SET `ofis` = "'.$_GET['ofis'].'", `stadium` = "'.$_GET['stadion'].'", `email` = "'.$_GET['email'].'", `map` = "'.$_GET['map'].'", `facebook` = "'.$_GET['facebook'].'", `instagram` = "'.$_GET['instagram'].'", `twitter` = "'.$_GET['twitter'].'", `youtube` = "'.$_GET['youtube'].'"  WHERE `id`="'.$_GET['id'].'"';
        echo $sql;
        if(mysqli_query($conn, $sql)){
            $message = "Məlumat əlavə edildi";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=contact");
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=contact");
        }
    }
    elseif($_GET['query'] === "video_delete_tv"){
        $dir = "../media/video/";
        $sql = "SELECT `video` FROM zaqatalatv WHERE id='".$_GET['id']."'";
        $file = mysqli_fetch_assoc(mysqli_query($conn, $sql))['video'];
        $sql = "DELETE FROM zaqatalatv WHERE id='".$_GET['id']."'";
        if(unlink($dir.$file)){
            if(mysqli_query($conn, $sql) ){
                $message = "Fayl silindi";
                $_SESSION['success'] = $message;
                header("Location: admin.php?page=home&q=video");
            }
            else{
                $message = "Sorğu xətası";
                $_SESSION['error'] = $message;
                header("Location: admin.php?page=home&q=video");
            }
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=home&q=video");
        }

    }
    elseif($_GET['query'] === "change_header_status"){
        $sql = "SELECT `status` FROM header WHERE id='".$_GET['id']."'";
        $status = mysqli_fetch_assoc(mysqli_query($conn, $sql))['status'];
        $sql = ($status) ? "UPDATE header SET `status`=0 WHERE `id`=".$_GET['id'] : "UPDATE header SET `status`=1 WHERE `id`=".$_GET['id'];
        if(mysqli_query($conn, $sql)){
            $message = "Status dəyişdirildi";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=header");
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=header");
        }
    }
    elseif($_GET['query'] === "change_galeri_status"){
        $sql = "SELECT `status` FROM galeri WHERE id='".$_GET['id']."'";
        $status = mysqli_fetch_assoc(mysqli_query($conn, $sql))['status'];
        $sql = ($status) ? "UPDATE galeri SET `status`=0 WHERE `id`=".$_GET['id'] : "UPDATE galeri SET `status`=1 WHERE `id`=".$_GET['id'];
        if(mysqli_query($conn, $sql)){
            $message = "Status dəyişdirildi";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=galeri");
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=galeri");
        }
    }
    elseif($_GET['query'] === "video_status_tv"){
        $sql = "SELECT `status` FROM zaqatalatv WHERE id='".$_GET['id']."'";
        
        $status = mysqli_fetch_assoc(mysqli_query($conn, $sql))['status'];
        $sql = ($status) ? "UPDATE zaqatalatv SET `status`=0 WHERE `id`=".$_GET['id'] : "UPDATE zaqatalatv SET `status`=1 WHERE `id`=".$_GET['id'];

        if(mysqli_query($conn, $sql)){
            $message = "Status dəyişdirildi";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=home&q=video");
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=home&q=video");
        }

    }
    elseif($_GET['query'] === "news_status_change"){
        $sql = "SELECT * FROM news WHERE id='".$_GET['id']."'";
        $status = mysqli_fetch_assoc(mysqli_query($conn, $sql))['status'];
        $sql = ($status) ? "UPDATE news SET `status`=0 WHERE `id`=".$_GET['id'] : "UPDATE news SET `status`=1 WHERE `id`=".$_GET['id'];

        if(mysqli_query($conn, $sql)){
            $message = "Status dəyişdirildi";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=news");
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=news");
        }
    }
    elseif($_GET['query'] === "news_media_status"){
        $sql = "SELECT * FROM news_media WHERE id='".$_GET['id']."'";
        $status = mysqli_fetch_assoc(mysqli_query($conn, $sql))['status'];
        $sql = ($status) ? "UPDATE news_media SET `status`=0 WHERE `id`=".$_GET['id'] : "UPDATE news_media SET `status`=1 WHERE `id`=".$_GET['id'];

        if(mysqli_query($conn, $sql)){
            $message = "Status dəyişdirildi";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=news");
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=news");
        }
    }
    elseif($_GET['query'] === "news_delete"){
        $sql = "SELECT * FROM news_media WHERE news='".$_GET['id']."'";
        $query = mysqli_query($conn, $sql);
        $media = [];
        while($res = mysqli_fetch_assoc($query)){
            array_push($media, $res);
        }
        echo "<pre>";
        print_r($media);
        echo "</pre>";

        $sql2 = "DELETE FROM news_media WHERE news='".$_GET['id']."'";
        if(mysqli_query($conn, $sql2)){
            for($i=0; $i<count($media); $i++){
                if($media[$i]["type"] === "image"){
                    unlink("../media/news/".$media[$i]["media"]);
                }
                elseif($media[$i]["type"] === "video"){
                    unlink("../media/news/video/".$media[$i]["media"]);
                }
            }
            $sql = "SELECT * FROM news WHERE id='".$_GET['id']."'";
            $media = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            $sql2 = "DELETE FROM news WHERE id='".$_GET['id']."'";
            if(mysqli_query($conn, $sql2)){
                unlink("../media/news/".$media["image"]);
                $message = "Xəbər Silindi";
                $_SESSION['success'] = $message;
                header("Location: admin.php?page=news");
            }
            else{
                $message = "XƏTA";
                $_SESSION['error'] = $message;
                header("Location: admin.php?page=news");
            }
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=news");
        }

    }
    elseif($_GET['query'] === "delete_news_media"){
        $sql = "SELECT * FROM news_media WHERE id='".$_GET['id']."'";
        $media = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $sql2 = "DELETE FROM news_media WHERE id='".$_GET['id']."'";
        
        if(mysqli_query($conn, $sql2)){
            if($media["type"] === "image"){
                unlink("../media/news/".$media["media"]);
            }
            elseif($media["type"] === "video"){
                unlink("../media/news/video/".$media["media"]);
            }
            $message = "Media Silindi";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=news");
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=news");
        }
    }
    elseif($_GET['query'] === "turnir_status_update"){
        $sql = "UPDATE `turnir` SET `status`=0";
        mysqli_query($conn, $sql);
        $sql = "UPDATE `turnir` SET `status`=1 WHERE `id`='".$_GET['id']."'";
        if(mysqli_query($conn, $sql)){
            $message = "Status dəyişdirildi.";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=turnir");
        }
        else{
            $message = "Status dəyişdirilmədi.";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=turnir");
        }
    }
    elseif($_GET['query'] === "delete_turnir_url"){
        $sql = "DELETE FROM `turnir` WHERE `id`='".$_GET['id']."'";
        if(mysqli_query($conn, $sql)){
            $message = "URL silindi.";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=turnir");
        }
        else{
            $message = "URL silinmədi.";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=turnir");
        }
    }
    elseif($_GET['query'] === "delete_stadium_info"){
        $sql = "SELECT * FROM stadium WHERE id='".$_GET['id']."'";
        $query = mysqli_query($conn, $sql);
        $image = mysqli_fetch_assoc($query)['image'];

        $sql = "SELECT * FROM stadium";
        $query = mysqli_query($conn, $sql);
        $count =  mysqli_num_rows($query);
        if($count > 1){
            $sql = "DELETE FROM stadium WHERE id='".$_GET['id']."'";
            if(mysqli_query($conn, $sql)){
                if($count == 2){
                    $sql = "UPDATE `about` SET `status`=1";
                    mysqli_query($conn, $sql);
                }
                unlink("../media/stadium/".$image);
                $message = "Məlumat silindi.";
                $_SESSION['success'] = $message;
                header("Location: admin.php?page=stadium");
            }
            else{
                $message = "Məlumat silinmədi.";
                $_SESSION['error'] = $message;
                header("Location: admin.php?page=stadium");
            }
        }
        else{
            $sql = "UPDATE `about` SET `status`=1";
            mysqli_query($conn, $sql);
            $message = "Məlumat sayı 2-dən az olduğu üçün silinmədi.";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=stadium");
        }
    }
    elseif($_GET['query'] === "change_stadium_info_status"){
        $sql = "UPDATE `stadium` SET `status`=0";
        mysqli_query($conn, $sql);
        $sql = "UPDATE `stadium` SET `status`=1 WHERE `id`='".$_GET['id']."'";
        if(mysqli_query($conn, $sql)){
            $message = "Status dəyişdirildi.";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=stadium");
        }
        else{
            $message = "Status dəyişdirilmədi.";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=stadium");
        }
    }
    elseif($_GET['query'] === "delete_about_info"){
        $sql = "SELECT * FROM about WHERE id='".$_GET['id']."'";
        $query = mysqli_query($conn, $sql);
        $image = mysqli_fetch_assoc($query)['image'];

        $sql = "SELECT * FROM about";
        $query = mysqli_query($conn, $sql);
        $count =  mysqli_num_rows($query);
        if($count > 1){
            $sql = "DELETE FROM about WHERE id='".$_GET['id']."'";
            if(mysqli_query($conn, $sql)){
                if($count == 2){
                    $sql = "UPDATE `about` SET `status`=1";
                    mysqli_query($conn, $sql);
                }
                
                unlink("../media/about/".$image);
                $message = "Məlumat silindi.";
                $_SESSION['success'] = $message;
                header("Location: admin.php?page=about");
            }
            else{
                $message = "Məlumat silinmədi.";
                $_SESSION['error'] = $message;
                header("Location: admin.php?page=about");
            }
        }
        else{
            $sql = "UPDATE `about` SET `status`=1";
            mysqli_query($conn, $sql);
            $message = "Məlumat sayı 2-dən az olduğu üçün silinmədi.";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=about");
        }
    }
    elseif($_GET['query'] === "change_about_info_status"){
        $sql = "UPDATE `about` SET `status`=0";
        mysqli_query($conn, $sql);
        $sql = "UPDATE `about` SET `status`=1 WHERE `id`='".$_GET['id']."'";
        if(mysqli_query($conn, $sql)){
            $message = "Status dəyişdirildi.";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=about");
        }
        else{
            $message = "Status dəyişdirilmədi.";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=about");
        }
    }
    elseif($_GET['query'] === "edit_about_image_rotate"){
        $sql = "UPDATE `about` SET `rotate`='".$_GET['rotate']."' WHERE `id`='".$_GET['id']."'";
        if(mysqli_query($conn, $sql)){
            echo "Success";
        }
        else{
            echo "Error";
        }
    }
    elseif($_GET['query'] === "change_team_status"){
        $sql = "SELECT * FROM `team` WHERE id='".$_GET['id']."'";
        $response = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $sql = ($response['status']) ? "UPDATE team SET `status`=0 WHERE `id`=".$_GET['id'] : "UPDATE team SET `status`=1 WHERE `id`=".$_GET['id'];

        if(mysqli_query($conn, $sql)){
            $message = "Status dəyişdirildi.";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=team");
        }
        else{
            $message = "Status dəyişdirilmədi.";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=team");
        }
    }
    elseif($_GET['query'] === "delete_team"){
        $sql = "SELECT * FROM team_media WHERE team='".$_GET['id']."'";
        $query = mysqli_query($conn, $sql);
        $media = [];
        while($res = mysqli_fetch_assoc($query)){
            array_push($media, $res);
        }

        $sql2 = "DELETE FROM team_media WHERE team='".$_GET['id']."'";
        if(mysqli_query($conn, $sql2)){
            for($i=0; $i<count($media); $i++){
                if($media[$i]["type"] === "image"){
                    unlink("../media/staff/images/".$media[$i]["media"]);
                }
                elseif($media[$i]["type"] === "video"){
                    unlink("../media/staff/video/".$media[$i]["media"]);
                }
            }
            $sql = "SELECT * FROM team WHERE id='".$_GET['id']."'";
            $media = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            $sql2 = "DELETE FROM team WHERE id='".$_GET['id']."'";
            if(mysqli_query($conn, $sql2)){
                if($media["image"] !== "avatar.png"){
                    unlink("../media/staff/".$media["movqe"]."/".$media["image"]);
                }
                
                $message = $media["name"] . " Silindi";
                $_SESSION['success'] = $message;
                header("Location: admin.php?page=team");
            }
            else{
                $message = "XƏTA";
                $_SESSION['error'] = $message;
                header("Location: admin.php?page=team");
            }
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=team");
        }

    }
    elseif($_GET['query'] === "delete_team_media"){
        $sql = "SELECT * FROM team_media WHERE id='".$_GET['id']."'";
        $media = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $sql2 = "DELETE FROM team_media WHERE id='".$_GET['id']."'";
        
        if(mysqli_query($conn, $sql2)){
            if($media["type"] === "image"){
                unlink("../media/staff/images/".$media["media"]);
            }
            elseif($media["type"] === "video"){
                unlink("../media/staff/video/".$media["media"]);
            }
            $message = "Media Silindi";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=team");
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=team");
        }
    }
    elseif($_GET['query'] === "team_media_status"){
        $sql = "SELECT * FROM team_media WHERE id='".$_GET['id']."'";
        $status = mysqli_fetch_assoc(mysqli_query($conn, $sql))['status'];
        $sql = ($status) ? "UPDATE team_media SET `status`=0 WHERE `id`=".$_GET['id'] : "UPDATE team_media SET `status`=1 WHERE `id`=".$_GET['id'];

        if(mysqli_query($conn, $sql)){
            $message = "Status dəyişdirildi";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=team");
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=team");
        }
    }
    elseif($_GET['query'] === "games_status_update"){
        $sql = "SELECT * FROM `games` WHERE id='".$_GET['id']."'";
        $status = mysqli_fetch_assoc(mysqli_query($conn, $sql))['status'];
        $sql = ($status) ? "UPDATE `games` SET `status`=0 WHERE `id`=".$_GET['id'] : "UPDATE `games` SET `status`=1 WHERE `id`=".$_GET['id'];

        if(mysqli_query($conn, $sql)){
            $message = "Status dəyişdirildi";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=games");
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=games");
        }
    }
    elseif($_GET['query'] === "delete_games"){
        $sql = "DELETE FROM `games` WHERE id='".$_GET['id']."'";
         
        if(mysqli_query($conn, $sql)){
            $message = "Oyun Silindi";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=games");
        }
        else{
            $message = "XƏTA";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=games");
        }
    }
    elseif($_GET['query'] === "mail_type"){
        $id = $_GET['id'];
        $type = $_GET['type'];
        $url = $_GET['url'];
        $sql = "UPDATE `mail` SET `type` = '$type', `moving` = '$type' WHERE `id` = '$id'";
        
        if(mysqli_query($conn, $sql)){
            header("Location: admin.php?page=mail&q=maillist&s=".$url);
        }
        else{
            header("Location: admin.php?page=mail&q=maillist&s".$url);
        }
    }
    else{
        header("Location: admin.php");
    }
}
elseif(isset($_POST['query'])){
    if($_POST['query'] === "upload_video_tv"){
        if($_POST['action'] === "add"){
            if($_FILES['file']['name'] !== "" && $_FILES['file']['tmp_name'] !== ""){
                $title = $_POST['text'];
                if($title === ""){
                    $message = "Xəta! Başlıq boş ola bilməz.";
                    $_SESSION['error'] = $message;
                    header("Location: admin.php?page=home&q=video");
                }
                $file = explode("/", $_FILES['file']['type']);
                
                $dir = "../media/video/";
    
                $vid = [];
                if(is_dir($dir)){
                    if($d = opendir($dir)){
                        while(($files = readdir($d)) !== false){
                            array_push($vid, $files);
                        }
                    }
                }
                $index = count($vid)-1;
                $number = substr($vid[$index], 5, 1) + 1;
                $file_name = "video".$number.".".$file[1];
                $file_dir = $dir.$file_name;
                
                $ok = ($file[0] !== "video") ? 0 : 1;
                echo $ok;
    
                if($ok){
                    $title = str_replace("'", "\'", $title);
                    $sql = "INSERT INTO zaqatalatv (`video`, `basliq`) VALUES ('$file_name', '$title')";
                    if(move_uploaded_file($_FILES["file"]["tmp_name"], $file_dir) && mysqli_query($conn, $sql)){
                        $message = "Fayl yükləndi";
                        $_SESSION['success'] = $message;
                        header("Location: admin.php?page=home&q=video");
                    }
                    else{
                        unlink($file_dir);
                        $message = "Xəta! Fayl yüklənmədi";
                        $_SESSION['error'] = $message;
                        header("Location: admin.php?page=home&q=video");
                    }
                }
                else{
                    $message = "Xəta! Fayl yüklənmədi";
                    $_SESSION['error'] = $message;
                    header("Location: admin.php?page=home&q=video");
                }
            }
            else{
                $message = "Xəta! Məlumatı əlavə etmək olmadı. Fayl boşdur və ya maksimum yükləmə ölçüsü çoxdur.";
                $_SESSION['error'] = $message;
                header("Location: admin.php?page=home&q=video");
            }
        }
        elseif($_POST['action'] === "edit"){
            $title = $_POST['text'];
            if($title === ""){
                $message = "Xəta! Başlıq boş ola bilməz.";
                $_SESSION['error'] = $message;
                header("Location: admin.php?page=home&q=video");
            }

            $id = $_POST['id'];
            $file_name = "";
            if($_FILES['file']['tmp_name'] !== ""){
                
                $file = explode("/", $_FILES['file']['type']);
                
                $dir = "../media/video/";
    
                $vid = [];
                if(is_dir($dir)){
                    if($d = opendir($dir)){
                        while(($files = readdir($d)) !== false){
                            array_push($vid, $files);
                        }
                    }
                }
                $index = count($vid)-1;
                $number = substr($vid[$index], 5, 1) + 1;
                $file_name = "video".$number.".".$file[1];
                $file_dir = $dir.$file_name;
                
                $ok = ($file[0] !== "video") ? 0 : 1;
                if($ok){
                    move_uploaded_file($_FILES["file"]["tmp_name"], $file_dir);
                }
            }
            $title = str_replace("\"", "'", $title);
            $sql = ($file_name === "") ? "UPDATE `zaqatalatv` SET `basliq` = \"$title\" WHERE `id` = '$id'" : "UPDATE `zaqatalatv` SET `video` = '$file_name', `basliq` ='$title' WHERE `id` = '$id'";

            if(mysqli_query($conn, $sql)){
                $message = "Məlumat yeniləndi";
                $_SESSION['success'] = $message;
                header("Location: admin.php?page=home&q=video&action=edit&id=$id");
            }
            else{
                ($file_name !== "") ? unlink("../media/video/".$file_name) : null;
                $message = "Xəta! Məlumat yenilənmədi";
                $_SESSION['error'] = $message;
                header("Location: admin.php?page=home&q=video&action=edit&id=$id");
            }
        }        
    }
    elseif ($_POST['query'] === 'add_news'){
        $title = $_POST['title'];
        $text = $_POST['text'];
        $tag = $_POST['tag'];
        $file_dir = "";
        $file_name = "";
        $file2_dir = "";
        $file2_name = "";
        $file2_ext;

        if($_FILES['file']['tmp_name'] !== ""){
            $dir = "../media/news/";
            $img = [];
            if(is_dir($dir)){
                if($d = opendir($dir)){
                    while(($file = readdir($d)) !== false){
                        if(strpos($file, "img") !== false){
                            array_push($img, $file);
                        }
                    }
                }
            }
            $index = count($img)-1;
            $number = substr($img[$index], 3, 1) + 1;
            $ok = 1;
            $type = strtolower(pathinfo($dir.$_FILES["file"]["name"], PATHINFO_EXTENSION));
            $file_name = "img".$number.".".$type;
            
            $check = getimagesize($_FILES['file']['tmp_name']);

            $ok = ($check === false ||
                $_FILES["file"]["size"] > 2000000 ||
                $type != "jpg" && $type != "png" && $type != "jpeg" && $type != "gif" ) ? 0 : 1;
            
            if($ok){
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $dir.$file_name)){
                    $file_dir = $dir.$file_name;
                }
                else{
                    $file_dir = false;
                }
            }
            else{
                $file_dir = false;
            }
        }

        
        if($_FILES['file2']['tmp_name'] !== ""){
            $dir = "../media/news/";
            $file2_ext = explode("/", $_FILES['file2']['type']);
            if($file2_ext[0] === "video"){
                $dir .= "video/";
                $video = [];
                if(is_dir($dir)){
                    if($d = opendir($dir)){
                        while(($files = readdir($d)) !== false){
                            if(strpos($file, "video") !== false){
                                array_push($video, $files);
                            }
                        }
                    }
                }
                $index = count($video)-1;
                $number = substr($video[$index], 5, 1) + 1;
                
                $type = strtolower(pathinfo($dir.$_FILES["file2"]["name"], PATHINFO_EXTENSION));
                $file2_name = "video".$number.".".$type;
                $file2_dir = $dir.$file2_name;

                
            }
            elseif($file2_ext[0] === "image"){
                $img = [];
                $ok = 1;

                if(is_dir($dir)){
                    if($d = opendir($dir)){
                        while(($file = readdir($d)) !== false){
                            if(strpos($file, "img") !== false){
                                array_push($img, $file);
                            }
                        }
                    }
                }
                $index = count($img)-1;
                $number = substr($img[$index], 3, 1) + 1;

                
                $type = strtolower(pathinfo($dir.$_FILES["file2"]["name"], PATHINFO_EXTENSION));
                $file2_name = "img".$number.".".$type;
                

                $check = getimagesize($_FILES['file2']['tmp_name']);
                $ok = ($check === false ||
                    $_FILES["file"]["size"] > 2000000 ||
                    $type != "jpg" && $type != "png" && $type != "jpeg" && $type != "gif" ) ? 0 : 1;
                
                if($ok){
                    if(move_uploaded_file($_FILES["file2"]["tmp_name"], $dir.$file2_name)){
                        $file2_dir = $dir.$file2_name;
                    }else{
                        $file2_dir = false;
                    }
                }
                else{
                    $file2_dir = false;
                }
            }
        }
        
        if($file_dir !== false && $file_dir !== ""){
            $sql = "INSERT INTO news (`basliq`, `etiket`, `metn`, `image`) VALUES ('$title', '$tag', '$text', '$file_name')";
            echo $sql;
            if(mysqli_query($conn, $sql)){
                $id = mysqli_insert_id($conn);
                if($file2_dir !== false && $file2_dir !== ""){
                    $sql = "INSERT INTO news_media (`news`, `media`, `type`) VALUES ('".$id."', '$file2_name', '".$file2_ext[0]."')";
                    echo $sql;
                    if(mysqli_query($conn, $sql)){
                        echo "ok";
                    }
                    else{
                        unlink($file2_dir);
                    }
                }
                $message = "Xəbər əlavə edildi.";
                $_SESSION['success'] = $message;
                header("Location: admin.php?page=news");
            }
            else{
                unlink($file_dir);
                $message = "Fayl yüklənmədi.";
                $_SESSION['error'] = $message;
                header("Location: admin.php?page=news");
            }
        }
        else{
            $message = "Xəbər əlavə olunmadı.";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=news");
        }
    }

    elseif($_POST['query'] === 'update_news'){
        $title = $_POST['title'];
        $text = $_POST['text'];
        $tag = $_POST['tag'];
        $file_dir = "";
        $file_name = "";
        $file2_dir = "";
        $file2_name = "";
        $file2_ext;
        echo "<pre>";
        print_r($_FILES);
        echo "</pre>";

        if($_FILES['file']['tmp_name'] !== ""){
            $dir = "../media/news/";
            $img = [];
            if(is_dir($dir)){
                if($d = opendir($dir)){
                    while(($file = readdir($d)) !== false){
                        if(strpos($file, "img") !== false){
                            array_push($img, $file);
                        }
                    }
                }
            }
            $index = count($img)-1;
            $number = substr($img[$index], 3, 1) + 1;
            $ok = 1;
            $type = strtolower(pathinfo($dir.$_FILES["file"]["name"], PATHINFO_EXTENSION));
            $file_name = "img".$number.".".$type;
            
            $check = getimagesize($_FILES['file']['tmp_name']);

            $ok = ($check === false ||
                $_FILES["file"]["size"] > 2000000 ||
                $type != "jpg" && $type != "png" && $type != "jpeg" && $type != "gif" ) ? 0 : 1;
            
            if($ok){
                if(move_uploaded_file($_FILES["file"]["tmp_name"], $dir.$file_name)){
                    $file_dir = $dir.$file_name;
                }
                else{
                    $file_dir = false;
                }
            }
            else{
                $file_dir = false;
            }
        }

        
        if($_FILES['file2']['tmp_name'] !== ""){
            $dir = "../media/news/";
            $file2_ext = explode("/", $_FILES['file2']['type']);
            if($file2_ext[0] === "video"){
                $dir .= "video/";
                $video = [];
                if(is_dir($dir)){
                    if($d = opendir($dir)){
                        while(($files = readdir($d)) !== false){
                            if(strpos($file, "video") !== false){
                                array_push($video, $files);
                            }
                        }
                    }
                }
                $index = count($video)-1;
                $number = substr($video[$index], 5, 1) + 1;
                
                $type = strtolower(pathinfo($dir.$_FILES["file2"]["name"], PATHINFO_EXTENSION));
                $file2_name = "video".$number.".".$type;
                $file2_dir = $dir.$file2_name;

                
            }
            elseif($file2_ext[0] === "image"){
                $img = [];
                $ok = 1;

                if(is_dir($dir)){
                    if($d = opendir($dir)){
                        while(($file = readdir($d)) !== false){
                            if(strpos($file, "img") !== false){
                                array_push($img, $file);
                            }
                        }
                    }
                }
                $index = count($img)-1;
                $number = substr($img[$index], 3, 1) + 1;

                
                $type = strtolower(pathinfo($dir.$_FILES["file2"]["name"], PATHINFO_EXTENSION));
                $file2_name = "img".$number.".".$type;
                

                $check = getimagesize($_FILES['file2']['tmp_name']);
                $ok = ($check === false ||
                    $_FILES["file"]["size"] > 2000000 ||
                    $type != "jpg" && $type != "png" && $type != "jpeg" && $type != "gif" ) ? 0 : 1;
                
                if($ok){
                    if(move_uploaded_file($_FILES["file2"]["tmp_name"], $dir.$file2_name)){
                        $file2_dir = $dir.$file2_name;
                    }else{
                        $file2_dir = false;
                    }
                }
                else{
                    $file2_dir = false;
                }
            }
        }
        
        if($file_dir !== false && $file_dir !== ""){
            $sql = "SELECT * FROM news WHERE id='".$_POST['id']."'";
            $media = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            $sql2 = "UPDATE news SET `basliq`='".$_POST['basliq']."', `etiket`='".$_POST['tag']."', `metn`='".$_POST['text']."', `image`='$file_name'  WHERE `id`='".$_POST['id']."'";
            
            if(mysqli_query($conn, $sql2)){
                unlink("../media/news/".$media['image']);
                $message = "Xəbər yeniləndi.";
                $_SESSION['success'] = $message;
                header("Location: admin.php?page=news");
            }
            else{
                unlink($file_dir);
                $message = "Xəbər yenilənmədi.";
                $_SESSION['error'] = $message;
                header("Location: admin.php?page=news");
            }
        }
        if($file2_dir !== false && $file2_dir !== ""){
            $sql = "INSERT INTO news_media (`news`, `media`, `type`) VALUES ('".$_POST['id']."', '$file2_name', '".$file2_ext[0]."')";
            if(mysqli_query($conn, $sql)){
                $message = "Xəbər yeniləndi.";
                $_SESSION['success'] = $message;
                header("Location: admin.php?page=news");
            }
            else{
                unlink($file2_dir);
                $message = "Xəbər yenilənmədi.";
                $_SESSION['error'] = $message;
                header("Location: admin.php?page=news");
            }
        }
        else{
            $sql = "UPDATE news SET `basliq`='".$_POST['basliq']."', `etiket`='".$_POST['tag']."', `metn`='".$_POST['text']."'  WHERE `id`='".$_POST['id']."'";
            if(mysqli_query($conn, $sql)){
                $message = "Xəbər yeniləndi.";
                $_SESSION['success'] = $message;
                header("Location: admin.php?page=news");
            }
            else{
                $message = "Xəbər yenilənmədi.";
                $_SESSION['success'] = $message;
                header("Location: admin.php?page=news");
            }
        }
    }

    elseif($_POST['query'] === 'add_news_media' && $_FILES['file']['tmp_name'] !== ""){
        $dir = "../media/news/";
        $file_ext = explode("/", $_FILES['file']['type']);
        $file_dir = "";
        $file_name = "";
        if($file_ext[0] === "video"){
            $dir = $dir."video/";
            $video = [];
            if(is_dir($dir)){
                if($d = opendir($dir)){
                    while(($files = readdir($d)) !== false){
                        if(strpos($file, "video") !== false){
                            array_push($video, $file);
                        }
                    }
                }
            }
            $index = count($video)-1;
            $number = substr($video[$index], 5, 1) + 1;
            
            $type = strtolower(pathinfo($dir.$_FILES["file"]["name"], PATHINFO_EXTENSION));
            $file_name = "video".$number.".".$type;
            $file_dir = $dir.$file_name;

            
        }
        elseif($file_ext[0] === "image"){
            $img = [];
            $ok = 1;

            if(is_dir($dir)){
                if($d = opendir($dir)){
                    while(($file = readdir($d)) !== false){
                        if(strpos($file, "img") !== false){
                            array_push($img, $file);
                        }
                        
                    }
                }
            }
            $index = count($img)-1;
            $number = substr($img[$index], 3, 1) + 1;
            // echo $number;

            
            $type = strtolower(pathinfo($dir.$_FILES["file"]["name"], PATHINFO_EXTENSION));
            $file_name = "img".$number.".".$type;
            

            $check = getimagesize($_FILES['file']['tmp_name']);
            $ok = ($check === false ||
                $_FILES["file"]["size"] > 2000000 ||
                $type != "jpg" && $type != "png" && $type != "jpeg" && $type != "gif" ) ? 0 : 1;
            
            if($ok){
                $file_dir = $dir.$file_name;
            }
            else{
                $file_dir = false;
            }
        }

        $sql = "INSERT INTO news_media (`news`, `media`, `type`) VALUES ('".$_POST['id']."', '$file_name', '".$file_ext[0]."')";
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $file_dir) && mysqli_query($conn, $sql)){
            $message = "Fayl əlavə edildi.";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=news");
        }
        else{
            $message = "Fayl yüklənmədi.";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=news");
        }

    }
    elseif($_POST['query'] === "add_turnir"){
        $sql = "INSERT INTO turnir (`url`) VALUES ('".$_POST['url']."')";
        if(mysqli_query($conn, $sql)){
            $message = "URL əlavə edildi.";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=turnir");
        }
        else{
            $message = "URL əlavə edilmədi";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=turnir");
        }
    }
    elseif($_POST['query'] === "add_stadium_info"){
        $data = $_POST["image"];

		$image_array_1 = explode(";", $data);

		$image_array_2 = explode(",", $image_array_1[1]);

        $data = base64_decode($image_array_2[1]);
        $dir = "../media/stadium/";
        $img = [];
        if(is_dir($dir)){
            if($d = opendir($dir)){
                while(($file = readdir($d)) !== false){
                    if(strpos($file, "img") !== false){
                        array_push($img, $file);
                    }
                }
            }
        }
        $index = count($img)-1;
        $number = substr($img[$index], 3, 1) + 1;

        $imageName = "img". $number . '.jpeg';
        

        file_put_contents($dir.$imageName, $data);

        $sql = "INSERT INTO stadium (`image`, `text`) VALUES ('$imageName', '".$_POST['text']."')";
        if(mysqli_query($conn, $sql)){
            $message = "Məlumat əlavə edildi.";
            $_SESSION['success'] = $message;
        }
        else{
            $message = "Məlumat əlavə edilmədi.";
            $_SESSION['error'] = $message;
        }
    }
    elseif($_POST['query'] === "edit_stadium_info"){
        $data = $_POST["image"];
        if($data !== ""){
            $image_array_1 = explode(";", $data);

            $image_array_2 = explode(",", $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);
            $dir = "../media/stadium/";
            $img = [];
            if(is_dir($dir)){
                if($d = opendir($dir)){
                    while(($file = readdir($d)) !== false){
                        if(strpos($file, "img") !== false){
                            array_push($img, $file);
                        }
                    }
                }
            }
            $index = count($img)-1;
            $number = substr($img[$index], 3, 1) + 1;

            $imageName = "img". $number . '.jpeg';
            

            file_put_contents($dir.$imageName, $data);

            $sql = "UPDATE stadium SET `text`='".$_POST['text']."', `image`='$imageName' WHERE id='".$_POST['id']."'";
            if(mysqli_query($conn, $sql)){
                $message = "Məlumat yeniləndi.";
                $_SESSION['success'] = $message;
            }
            else{
                $message = "Məlumat yenilənmədi.";
                $_SESSION['error'] = $message;
            }
        }
        else{
            $sql = "UPDATE stadium SET `text`='".$_POST['text']."' WHERE id='".$_POST['id']."'";
            if(mysqli_query($conn, $sql)){
                $message = "Məlumat yeniləndi.";
                $_SESSION['success'] = $message;
            }
            else{
                $message = "Məlumat yenilənmədi.";
                $_SESSION['error'] = $message;
            }
        }
    }
    elseif($_POST['query'] === "add_about_info"){
        $data = $_POST["image"];

		$image_array_1 = explode(";", $data);

		$image_array_2 = explode(",", $image_array_1[1]);

        $data = base64_decode($image_array_2[1]);
        $dir = "../media/about/";
        $img = [];
        if(is_dir($dir)){
            if($d = opendir($dir)){
                while(($file = readdir($d)) !== false){
                    if(strpos($file, "img") !== false){
                        array_push($img, $file);
                    }
                }
            }
        }
        $index = count($img)-1;
        $number = substr($img[$index], 3, 1) + 1;

        $imageName = "img". $number . '.jpeg';
        

        file_put_contents($dir.$imageName, $data);

        $sql = "INSERT INTO about (`image`, `text`, `rotate`) VALUES ('$imageName', '".$_POST['text']."', '0deg')";
        if(mysqli_query($conn, $sql)){
            $message = "Məlumat əlavə edildi.";
            $_SESSION['success'] = $message;
        }
        else{
            $message = "Məlumat əlavə edilmədi.";
            $_SESSION['error'] = $message;
        }
    }
    elseif($_POST['query'] === "edit_about_info"){
        $data = $_POST["image"];
        if($data !== ""){
            $image_array_1 = explode(";", $data);

            $image_array_2 = explode(",", $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);
            $dir = "../media/about/";
            $img = [];
            if(is_dir($dir)){
                if($d = opendir($dir)){
                    while(($file = readdir($d)) !== false){
                        if(strpos($file, "img") !== false){
                            array_push($img, $file);
                        }
                    }
                }
            }
            $index = count($img)-1;
            $number = substr($img[$index], 3, 1) + 1;

            $imageName = "img". $number . '.jpeg';
            

            file_put_contents($dir.$imageName, $data);

            $sql = "UPDATE about SET `text`='".$_POST['text']."', `image`='$imageName' WHERE id='".$_POST['id']."'";
            if(mysqli_query($conn, $sql)){
                $message = "Məlumat yeniləndi.";
                $_SESSION['success'] = $message;
            }
            else{
                $message = "Məlumat yenilənmədi.";
                $_SESSION['error'] = $message;
            }
        }
        else{
            $sql = "UPDATE about SET `text`='".$_POST['text']."' WHERE id='".$_POST['id']."'";
            if(mysqli_query($conn, $sql)){
                $message = "Məlumat yeniləndi.";
                $_SESSION['success'] = $message;
            }
            else{
                $message = "Məlumat yenilənmədi.";
                $_SESSION['error'] = $message;
            }
        }
    }
    elseif($_POST['query'] === "add_team"){
        $data = $_POST["image"];
        $name = $_POST['name'];
        $movqe = $_POST['movqe'];
        $number = $_POST['number'];
        $date = $_POST['date'];
        $country = $_POST['country'];
        $facebook = $_POST['facebook'];
        $instagram = $_POST['instagram'];
        $twitter = $_POST['twitter'];
        $youtube = $_POST['youtube'];
        

        if($data !== ""){
            
            $image_array_1 = explode(";", $data);

            $image_array_2 = explode(",", $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);
            $dir = "../media/staff/".$movqe."/";

            $imageName = $name.'.jpeg';
            

            file_put_contents($dir.$imageName, $data);

            $sql = "INSERT INTO 
                        team 
                        (`name`, `nomre`, `avatar`, `movqe`, `date`, `country`, `instagram`, `facebook`, `twitter`, `youtube`) 
                        VALUES 
                        ('$name', '$number', '$imageName', '$movqe', '$date', '$country', '$instagram', '$facebook', '$twitter', '$youtube')";
            echo $sql;
            if(mysqli_query($conn, $sql)){
                $message = "Məlumat yeniləndi.";
                $_SESSION['success'] = $message;
                echo "Success";
            }
            else{
                $message = "Məlumat yenilənmədi.";
                $_SESSION['error'] = $message;
                echo "Error";
            }
        }
        else{
            $sql = "INSERT INTO team (`name`, `nomre`, `movqe`, `date`, `country`, `instagram`, `facebook`, `twitter`, `youtube`) VALUES ('$name', '$number', '$movqe', '$date', '$country', '$instagram', '$facebook', '$twitter', '$youtube')";
            if(mysqli_query($conn, $sql)){
                $message = "Məlumat yeniləndi.";
                $_SESSION['success'] = $message;
                echo "Success";
            }
            else{
                $message = "Məlumat yenilənmədi.";
                $_SESSION['error'] = $message;
                echo "Error";
            }
        }
    }
    elseif($_POST['query'] === "edit_team"){
        $data = $_POST["image"];
        $id = $_POST['id'];
        $name = $_POST['name'];
        $movqe = $_POST['movqe'];
        $number = $_POST['number'];
        $date = $_POST['date'];
        $country = $_POST['country'];
        $facebook = $_POST['facebook'];
        $instagram = $_POST['instagram'];
        $twitter = $_POST['twitter'];
        $youtube = $_POST['youtube'];
        

        if($data !== ""){
            $sql = "SELECT * FROM team WHERE id='$id'";
            $response = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            if($response['avatar'] !== "avatar.png"){
                unlink("../media/staff/".$response['movqe']."/".$response['avatar']);
            }
            
            $image_array_1 = explode(";", $data);

            $image_array_2 = explode(",", $image_array_1[1]);

            $data = base64_decode($image_array_2[1]);
            $dir = "../media/staff/".$movqe."/";

            $imageName = $name.'.jpeg';
            

            file_put_contents($dir.$imageName, $data);
            $sql = "UPDATE team SET `name`='$name', `nomre`='$number', `avatar`='$imageName', `movqe`='$movqe', `date`='$date', `country`='$country', `instagram`='$instagram', `facebook`='$facebook', `twitter`='$twitter', `youtube`='$youtube' WHERE id='$id'";

            echo $sql;
            if(mysqli_query($conn, $sql)){
                $message = "Məlumat yeniləndi.";
                $_SESSION['success'] = $message;
                echo "Success";
            }
            else{
                $message = "Məlumat yenilənmədi.";
                $_SESSION['error'] = $message;
                echo "Error";
            }
        }
        else{
            $sql = "UPDATE team SET `name`='$name', `nomre`='$number', `movqe`='$movqe', `date`='$date', `country`='$country', `instagram`='$instagram', `facebook`='$facebook', `twitter`='$twitter', `youtube`='$youtube' WHERE id='$id'";

            if(mysqli_query($conn, $sql)){
                $message = "Məlumat yeniləndi.";
                $_SESSION['success'] = $message;
                echo "Success";
            }
            else{
                $message = "Məlumat yenilənmədi.";
                $_SESSION['error'] = $message;
                echo "Error";
            }
        }
    }
    elseif($_POST['query'] === 'add_team_media' && $_FILES['file']['tmp_name'] !== ""){
        $sql = "SELECT * FROM team WHERE id='".$_POST['id']."'";
        $response = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        $dir = "../media/staff/";
        $file_ext = explode("/", $_FILES['file']['type']);
        $file_dir = "";
        $file_name = "";
        if($file_ext[0] === "video"){
            $dir = $dir."video/";
            $video = [];
            if(is_dir($dir)){
                if($d = opendir($dir)){
                    while(($files = readdir($d)) !== false){
                        if(strpos($file, "video") !== false){
                            array_push($video, $file);
                        }
                    }
                }
            }
            $index = count($video)-1;
            $number = substr($video[$index], 5, 1) + 1;
            
            $type = strtolower(pathinfo($dir.$_FILES["file"]["name"], PATHINFO_EXTENSION));
            $file_name = "video".$number.".".$type;
            $file_dir = $dir.$file_name;

            
        }
        elseif($file_ext[0] === "image"){
            $dir = $dir."images/";
            $img = [];
            $ok = 1;

            if(is_dir($dir)){
                if($d = opendir($dir)){
                    while(($file = readdir($d)) !== false){
                        if(strpos($file, "img") !== false){
                            array_push($img, $file);
                        }
                        
                    }
                }
            }
            $index = count($img)-1;
            $number = substr($img[$index], 3, 1) + 1;
            // echo $number;

            
            $type = strtolower(pathinfo($dir.$_FILES["file"]["name"], PATHINFO_EXTENSION));
            $file_name = "img".$number.".".$type;
            

            $check = getimagesize($_FILES['file']['tmp_name']);
            $ok = ($check === false ||
                $_FILES["file"]["size"] > 2000000 ||
                $type != "jpg" && $type != "png" && $type != "jpeg" && $type != "gif" ) ? 0 : 1;
            
            if($ok){
                $file_dir = $dir.$file_name;
            }
            else{
                $file_dir = false;
            }
        }

        $sql = "INSERT INTO team_media (`team`, `media`, `type`) VALUES ('".$_POST['id']."', '$file_name', '".$file_ext[0]."')";
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $file_dir) && mysqli_query($conn, $sql)){
            $message = "Fayl əlavə edildi.";
            $_SESSION['success'] = $message;
            header("Location: admin.php?page=team");
        }
        else{
            $message = "Fayl yüklənmədi.";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=team");
        }

    }
    elseif($_POST['query'] === 'add_games'){
        $oyun = $_POST['oyun'];
        $stadion = $_POST['stadion'];
        $date = $_POST['date'];
        $gorus = $_POST['gorus'];
        $komanda_1 = $_POST['komanda_1'];
        $komanda_2 = $_POST['komanda_2'];
        $logo_1 = $_POST['logo_1'];
        $logo_2 = $_POST['logo_2'];
        if(trim($oyun) !== "" && trim($stadion) !== "" && trim($date) !== "" && trim($gorus) !== "" && trim($komanda_1) !== "" && trim($komanda_2) !== ""){
            function getWeekday($d) {
                return date('w', strtotime($d));
            }
            function dateCompare($d){
                if(strtotime($d) > strtotime("now")){
                    return 0;
                }
                else{
                    return 1;
                }
            }
            function imageMove($img, $name){
                $image_array_1 = explode(";", $img);

                $image_array_2 = explode(",", $image_array_1[1]);

                $img = base64_decode($image_array_2[1]);
                $dir = "../media/team_logos/";
                $name = strtolower($name);

                $imageName = $name.'.png';
                if(!file_exists($dir.$imageName)){
                    file_put_contents($dir.$imageName, $img);
                    return $imageName;
                }
                else{
                    return $imageName;
                }
            }
            $week = getWeekday($date);
            $oyun_status = dateCompare($date);
            $logo_1 = imageMove($logo_1, $komanda_1);
            $logo_2 = imageMove($logo_2, $komanda_2);
            $sql = "INSERT INTO `games` (`oyun`, `stadium`, `gorus`, `tarix`, `hefte`, `team_1`, `team_1_logo`, `team_2`, `team_2_logo`, `oyun_status`)
                                VALUES ('$oyun', '$stadion', '$gorus', '$date', '$week', '$komanda_1', '$logo_1', '$komanda_2', '$logo_2', '$oyun_status')";
            if(mysqli_query($conn, $sql)){
                echo "Success";
                $message = "Oyun məlumatı əlavə edildi.";
                $_SESSION['success'] = $message;
            }
            else{
                echo "Error";
                $message = "Oyun məlumatı əlavə edilmədi.";
                $_SESSION['error'] = $message;
            }
        }
        else{
            echo "null";
        }
    }
    elseif($_POST['query'] === 'team_qol'){
        $team_1_qol = $_POST['team_1_qol'];
        $team_2_qol = $_POST['team_2_qol'];
        $id = $_POST['id'];
        if(trim($team_1_qol) !== "" && trim($team_2_qol) !== ""){
            $sql = "UPDATE `games` SET `team_1_qol`='$team_1_qol', `team_2_qol`='$team_2_qol', `qeyd`='1' WHERE id='$id'";
            if(mysqli_query($conn, $sql)){
                $message = "Oyun məlumatı əlavə edildi.";
                $_SESSION['success'] = $message;
                header("Location: admin.php?page=games");
            }
            else{
                $message = "Oyun məlumatı əlavə edilmədi.";
                $_SESSION['error'] = $message;
                header("Location: admin.php?page=games");
            }
        }
        else{
            $message = "Qol sayları qeyd edilməyib.";
            $_SESSION['error'] = $message;
            header("Location: admin.php?page=games");
        }

    }
    elseif($_POST['query'] === 'edit_games'){
        $id = $_POST['id'];
        $oyun = $_POST['oyun'];
        $stadion = $_POST['stadion'];
        $date = $_POST['date'];
        $gorus = $_POST['gorus'];
        $komanda_1 = $_POST['komanda_1'];
        $komanda_2 = $_POST['komanda_2'];
        $team_1_qol = (isset($_POST['team_1_qol'])) ? $_POST['team_1_qol'] : NULL;
        $team_2_qol = (isset($_POST['team_2_qol'])) ? $_POST['team_2_qol'] : NULL;
        $logo_1 = $_POST['logo_1'];
        $logo_2 = $_POST['logo_2'];
        if(trim($logo_1) === "" && trim($logo_1) === ""){
            if(trim($oyun) !== "" && trim($stadion) !== "" && trim($date) !== "" && trim($gorus) !== "" && trim($komanda_1) !== "" && trim($komanda_2) !== ""){
                function getWeekday($d) {
                    return date('w', strtotime($d));
                }
                function dateCompare($d){
                    if(strtotime($d) > strtotime("now")){
                        return 0;
                    }
                    else{
                        return 1;
                    }
                }
                $week = getWeekday($date);
                $oyun_status = dateCompare($date);
                if(trim($team_1_qol) !== "" && trim($team_2_qol) !== ""){
                    $sql = "UPDATE `games` SET `oyun`='$oyun', `stadium`='$stadion', `gorus`='$gorus', `tarix`='$date', `hefte`='$week', `team_1`='$komanda_1', `team_1_qol`='$team_1_qol', `team_2`='$komanda_2', `team_2_qol`='$team_2_qol', `oyun_status`='$oyun_status' WHERE `id`='$id'";
                }
                else{
                    $sql = "UPDATE `games` SET `oyun`='$oyun', `stadium`='$stadion', `gorus`='$gorus', `tarix`='$date', `hefte`='$week', `team_1`='$komanda_1', `team_2`='$komanda_2', `oyun_status`='$oyun_status' WHERE `id`='$id'";
        
                }
                
                if(mysqli_query($conn, $sql)){
                    echo "Success";
                    $message = "Oyun məlumatı dəyişdirildi.";
                    $_SESSION['success'] = $message;
                }
                else{
                    echo "Error";
                    $message = "Oyun məlumatı dəyişdirilmədi.";
                    $_SESSION['error'] = $message;
                }
            }
            else{
                echo "null";
            }
        }
        else{
            if(trim($oyun) !== "" && trim($stadion) !== "" && trim($date) !== "" && trim($gorus) !== "" && trim($komanda_1) !== "" && trim($komanda_2) !== ""){
                function getWeekday($d) {
                    return date('w', strtotime($d));
                }
                function dateCompare($d){
                    if(strtotime($d) > strtotime("now")){
                        return 0;
                    }
                    else{
                        return 1;
                    }
                }
                function imageMove($img, $name){
                    $image_array_1 = explode(";", $img);
    
                    $image_array_2 = explode(",", $image_array_1[1]);
    
                    $img = base64_decode($image_array_2[1]);
                    $dir = "../media/team_logos/";
                    $name = strtolower($name);
    
                    $imageName = $name.'.png';
                    if(!file_exists($dir.$imageName)){
                        file_put_contents($dir.$imageName, $img);
                        return $imageName;
                    }
                    else{
                        return $imageName;
                    }
                }
                $week = getWeekday($date);
                $oyun_status = dateCompare($date);
                $logo_1 = imageMove($logo_1, $komanda_1);
                $logo_2 = imageMove($logo_2, $komanda_2);
                if(trim($team_1_qol) !== "" && trim($team_2_qol) !== ""){
                    $sql = "UPDATE `games` SET `oyun`='$oyun', `stadium`='$stadion', `gorus`='$gorus', `tarix`='$date', `hefte`='$week', `team_1`='$komanda_1', `team_1_qol`='$team_1_qol', `team_2`='$komanda_2', `team_2_qol`='$team_2_qol', `oyun_status`='$oyun_status' WHERE `id`='$id'";
                }
                else{
                    $sql = "UPDATE `games` SET `oyun`='$oyun', `stadium`='$stadion', `gorus`='$gorus', `tarix`='$date', `hefte`='$week', `team_1`='$komanda_1', `team_2`='$komanda_2', `oyun_status`='$oyun_status' WHERE `id`='$id'";
        
                }

                if(mysqli_query($conn, $sql)){
                    echo "Success";
                    $message = "Oyun məlumatı dəyişdirildi.";
                    $_SESSION['success'] = $message;
                }
                else{
                    echo "Error";
                    $message = "Oyun məlumatı dəyişdirilmədi.";
                    $_SESSION['error'] = $message;
                }
            }
            else{
                echo "null";
            }
        }
    }
    elseif($_POST['query'] === 'add_header_image'){        
        function imageNameFind($n, $conn){
            $sql = "SELECT * FROM `header` WHERE `image` = 'img$n.jpeg'";
            $query = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($query);
            $exist = file_exists("../media/header/img".$n.".jpeg");
            if($count == 0 && !$exist){
                return "img$n.jpeg";
            }
            else{
                 return imageNameFind(++$n, $conn);
            }
        }
        $data = $_POST["image"];
        $image_array_1 = explode(";", $data);
        $image_array_2 = explode(",", $image_array_1[1]);
        $data = base64_decode($image_array_2[1]);
        $dir = "../media/header/";
        $imageName = imageNameFind(1, $conn);
        
        file_put_contents($dir.$imageName, $data);
        $sql = "INSERT INTO `header` (`image`) VALUES ('$imageName')";
        if(mysqli_query($conn, $sql)){
            echo "Success";
            $message = "Şəkil əlavə edildi.";
            $_SESSION["success"] = $message;
        }
        else{
            echo "Error";
            $message = "Xəta! Şəkil əlavə edilmədi.";
            $_SESSION["error"] = $message;
        }
    }
    elseif($_POST['query'] === 'trash_mail'){
        $id = $_POST['id'];
        for($i = 0; $i < count($id); $i++){
            $sql = "SELECT * FROM `mail` WHERE `id` = '".$id[$i]."'";
            $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            if($res['type'] == "trash"){
                $sql = "DELETE FROM `mail` WHERE `id` = '".$id[$i]."' ";
                mysqli_query($conn, $sql);
            }
            else{
                $sql = "UPDATE `mail` SET `type` = 'trash' WHERE `id` = '".$id[$i]."' ";
                mysqli_query($conn, $sql);
            }
        }

    }
    elseif($_POST['query'] === 'move_mail'){
        $id = $_POST['id'];
        

        for($i = 0; $i < count($id); $i++){
            $sql = "SELECT * FROM `mail` WHERE `id` = '".$id[$i]."'";
            $res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            $type = ($_POST['archive'] == "true") ? $res['mainly_type'] : $res['moving'];

            $sql = "UPDATE `mail` SET `type` = '$type', `moving` = '$type' WHERE `id` = '".$id[$i]."' ";
            mysqli_query($conn, $sql);
        }

    }
    elseif($_POST['query'] === 'mail_archive'){
        $id = $_POST['id'];
        for($i = 0; $i < count($id); $i++){
            $sql = "UPDATE `mail` SET `type` = 'archive', `moving` = 'archive' WHERE `id` = '".$id[$i]."'";
            mysqli_query($conn, $sql);
        }

    }
    elseif($_POST['query'] === 'send_mail'){
        $message = wordwrap($_POST['message'], 70, "\r\n");
        $to      = $_POST['to'];
        $subject = $_POST['subject'];
        $from = $_POST['from'];
        $headers = 'From: '. $from . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $sent = mail($to, $subject, $message, $headers);
        if($sent){
            $sql  = "INSERT INTO `mail` (`name`, `email`, `send`, `subject`, `text`, `type`, `mainly_type`, `moving`, `status`) VALUES ('$to', '$to', '$from', '$subject', '$message', 'sent', 'sent', 'sent', '1')";
            $query = mysqli_query($conn, $sql);
            if($query){
                $message = "Mesaj göndərildi.";
                $_SESSION["success"] = $message;
                header("Location: admin.php?page=mail&q=compase");
            }
            else{
                $message = "Xəta! Mesaj göndərilmədi.";
                $_SESSION["error"] = $message;
                header("Location: admin.php?page=mail&q=compase");
            }
        }
        else{
            $message = "Xəta! Mesaj göndərilmədi. Mailler servere qoşulmaq olmadı.";
            $_SESSION["error"] = $message;
            header("Location: admin.php?page=mail&q=compase");
        }
    }
    else{
        header("Location: admin.php");
    }
}
else{
    header("Location: admin.php");
}


?>