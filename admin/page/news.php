<?php
if(!isset($_SESSION["admin"])){
    header("Location: ../index.php");
}

$news_update = (isset($_GET["page"]) && isset($_GET["action"]) && isset($_GET["id"])) ? "d-block" : "d-none";

?>
<div id="news" class="row">
    <div class="col-12 py-4 mb-4">
        <div class="row px-3">
            <div class="col-12 border py-2 rounded">
                <h2>Xəbər əlavə et</h2>
                <div class="w-100">
                    <?php

                    if(isset($_SESSION['error'])){
                        echo '<div class="alert alert-danger col-12">'.$_SESSION['error'].'</div>';
                        unset($_SESSION['error']);
                    }
                    else if(isset($_SESSION['success'])){
                        echo '<div class="alert alert-success col-12">'.$_SESSION['success'].'</div>';
                        unset($_SESSION['success']);
                    }
                    else{
                        echo null;
                    }
                    
                    
                    ?>

                </div>
                <form action="config.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="query" value="add_news">
                    <input type="text" name="title" class="form-control mb-2" placeholder="Başlıq">
                    <input type="text" name="tag" class="form-control mb-2" placeholder="Tag">
                    <div class="col-12 border rounded mb-2">
                        <label for="title">Başlıq şəkli</label>
                        <input type="file" name="file" class="col-12 px-0 border rounded mb-2" placeholder="Başlıq">
                    </div>
                    <div class="col-12 border rounded mb-2">
                        <label for="title">Digər şəkillər</label>
                        <input type="file" name="file2" class="col-12 px-0 border rounded mb-2" placeholder="Başlıq">
                    </div>
                    <textarea name="text" class="form-control my-2" rows="10"
                        placeholder="Xəbər mətni . . ."></textarea>
                    <input type="submit" value="Paylaş" class="btn btn-success">
                </form>
            </div>
            <div class="col-12 border rounded my-3 p-3">
                <h2>Paylaşılmış xəbərlər</h2>
                <?php
                    $sql = "SELECT * FROM news ORDER BY `status` DESC";
                    $query = mysqli_query($conn, $sql);
                    while($res = mysqli_fetch_assoc($query)){
                        $check = ($res['status']) ? "-check" : "";
                        echo '<div class="col-12 border rounded my-3 py-3 px-4">
                        <div class="row">
                            <div class="col-4 border-right">
                                <div class="row h-100 align-items-center">
                                    <img src="../media/news/'.$res['image'].'" class="w-100" alt="'.$res['image'].'" srcset="">
                                </div>
                            </div>
                            <div class="col-7 p-3">
                                <h2>'.$res['basliq'].'</h2>
                                <mark style="background-color: green;">'.$res['etiket'].'</mark>
                                <p class="text-justify m-0">'.$res['metn'].'</p>
                                <hr>
                                <small>'.$res['tarix'].'</small>
                            </div>
                            <div class="col-1 border-left">
                                <div class="row align-items-center justify-content-center h-100">
                                    <ul class="list-inline m-0 p-0 text-center">
                                        <li class="text-justify"><a href="config.php?query=news_delete&id='.$res['id'].'"><i class="fas fa-trash fa-2x"></i></a></li>
                                        <li class="my-3 text-justify"><a href="config.php?query=news_status_change&id='.$res['id'].'"><i
                                                    class="far fa'.$check.'-square fa-2x"></i></a></li>
                                        <li class="text-justify"><a href="admin.php?page=news&action=edit&id='.$res['id'].'"><i class="fas fa-edit fa-2x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 border-top">
                                <div class="row justify-content-center p-2">';
                                echo "<form action='config.php' method='post' enctype='multipart/form-data' class='w-100 border p-3 mb-2'>
                                    <input type='hidden' name='query' value='add_news_media'>
                                    <input type='hidden' name='id' value='".$res['id']."'>
                                    <input type='file' name='file' class='col-12 px-0 border rounded mb-2'>
                                    <input type='submit' value='Əlavə et' class='btn btn-success'>
                                </form>";
                                echo "<h2 class='col-12'>Xəbərə aid digər şəkillər</h2>";
                        $sql2 = "SELECT * FROM news_media WHERE news='".$res['id']."' ORDER BY `status` DESC";
                        $query2 = mysqli_query($conn, $sql2);
                        while($media = mysqli_fetch_assoc($query2)){
                            $check2 = ($media['status']) ? "-check" : "";
                            $id = $media['id'];
                            $media = ($media['type'] === "video") ? "<video style='height: 150px; max-width: 220px' controls src='../media/news/video/".$media['media']."'></video>" : '<img class="" style="height: 150px; max-width: 220px" src="../media/news/'.$media['media'].'" alt="'.$media['media'].'">';
                            echo '<div class="col bg-primary p-0 border">
                                    <div class="row p-3 justify-content-center ">
                                        '.$media.'
                                    </div>
                                    <div class="col-12 bg-success px-0" style="height: 50px">
                                        <div class="row align-items-center justify-content-around m-0 h-100">
                                            <span class=""><a href="config.php?query=delete_news_media&id='.$id.'"><i class="text-danger fas fa-trash"></i></a></span>
                                            <span class=""><a href="config.php?query=news_media_status&id='.$id.'"><i class="far fa'.$check2.'-square"></i></a></span>
                                            <span class=""><b>&#x26F6</b></span>
                                        </div>
                                    </div>
                                </div>';
                        }
                        echo "</div>
                            </div>
                            </div>
                            </div>";
                                
                    
                    }
                
                
                ?>
                
            </div>
        </div>
    </div>
</div>

<div class="news-update p-3 <?=$news_update?>">
    <?php
    $id = $_GET['id'];
    $sql = "SELECT * FROM news WHERE id='".$id."' ORDER BY `status` DESC";
    $news = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $title = $news['basliq'];
    $tag = $news['etiket'];
    $text = $news['metn'];
    
    
    ?>
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-8 bg-primary p-3">
            <h2>Xəbəri yenilə</h2>
            
            <form action="config.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="query" value="update_news">
                <input type="hidden" name="id" value="<?=$id?>">
                <input type="text" name="basliq" value="<?=$title?>" class="form-control mb-2" placeholder="Başlıq">
                <input type="text" name="tag" value="<?=$tag?>" class="form-control" placeholder="Tag">
                <div class="col-12 border rounded my-2">
                    <label for="file">Başlıq şəkli</label>
                    <input type="file" name="file" class="col-12 px-0 bg-white border rounded my-1" placeholder="Başlıq">
                </div>
                <div class="col-12 border rounded">
                    <label for="file2">Digər şəkillər</label>
                    <input type="file" name="file2" class="col-12 px-0 bg-white border rounded my-1" placeholder="Başlıq" multiple>
                </div>
                <textarea name="text" class="form-control my-2" rows="10" placeholder="Xəbər mətni . . ."><?=$text?></textarea>
                <input type="submit" value="Saxla" class="btn btn-success">
                <button type="reset" class="btn btn-danger"><a style="color: white; text-decoration: none;" href="admin.php?page=news">Ləğv et</a></button>
            </form>
        </div>
    </div>
</div>