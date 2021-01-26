<?php

if(!isset($_SESSION["admin"])){
    header("Location: ../index.php");
}

$action = (isset($_GET["page"]) && isset($_GET["action"]) && isset($_GET["id"])) ? "edit" : "add";
$text = "";
$id = "";
if($action === "edit"){
    $sql = "SELECT * FROM `zaqatalatv` WHERE id='".$_GET['id']."'";
    $zaqatalatv = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $text = $zaqatalatv['basliq'];
    $id = $_GET['id'];
}

$video = "d-none";
$galeri = "d-none";
$team = "d-none";
$p = (isset($_GET["q"])) ? $_GET["q"] : "video";
$$p = "d-block";

?>

<div id="home" class="row">
    <div class="col-12 pb-4 mb-4">
        <div class="row">
            <div class="col-12 navbar-div bg-dark p-3">
                <ul class="list-inline m-0">
                    <li class="list-inline-item"><a href="admin.php?page=home&q=video">Video</a></li>
                    <li class="list-inline-item"><a href="admin.php?page=home&q=galeri">Fotoalbom</a></li>
                    <li class="list-inline-item"><a href="admin.php?page=home&q=team">Komanda</a></li>
                </ul>
            </div>
            <div class="col-12 my-3 px-4 <?=$video?>">
                <h1>ZAQATALA TV</h1>
                <div class="row">
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
                <div class="row border rounded p-2">
                    <p class="w-100">Video əlavə et . . .</p>
                    <form action="config.php" method="post" class="w-100" enctype="multipart/form-data">
                        <input type="hidden" name="query" value="upload_video_tv">
                        <input type="hidden" name="action" value="<?=$action?>" />
                        <input type="hidden" name="id" value="<?=$id?>" />
                        <input type="file" name="file" class=" px-0 border rounded" />
                        <textarea name="text" placeholder="Başlıq" required class="col-12 form-control my-2" rows="3"><?=$text?></textarea>
                        <input type="submit" name="send" value="Yüklə" class="btn btn-primary">
                        <input type="reset" value="Ləğv et" class="btn btn-danger">               
                    </form>
                </div>

                <div class="row justify-content-around border rounded mt-3">
                    <?php
                        $sql = "SELECT * FROM zaqatalatv ORDER BY `status` DESC";
                        $query = mysqli_query($conn, $sql);
                        while($res = mysqli_fetch_assoc($query)){
                            $check = ($res['status']) ? "-check" : "";
                            echo '<div class="col bg-primary p-0 border">
                                    <div class="row p-3 justify-content-center ">
                                        <video class="" style="height: 220px; max-width: 260px" src="../media/video/'.$res['video'].'" controls></video>
                                    </div>
                                    <p class="p-3 text-white m-0">'.$res['basliq'].'</p>
                                    <div class="col-12 bg-success px-0" style="height: 50px">
                                        <div class="row align-items-center justify-content-around m-0 h-100">
                                            <span class=""><a href="config.php?query=video_delete_tv&id='.$res['id'].'"><i class="text-danger fas fa-trash"></i></a></span>
                                            <span class=""><a href="config.php?query=video_status_tv&id='.$res['id'].'"><i class="far fa'.$check.'-square"></i></a></span>
                                            <span class=""><a href="admin.php?page=home&q=video&action=edit&id='.$res['id'].'"><i class="far fa-edit"></i></a></span>
                                        </div>
                                    </div>
                                </div>';
                        }
                    ?>
                </div>

            </div>
            <div class="col-12 my-3 px-4 <?=$galeri?>">
                <h1>FOTOALBOM</h1>
                <div class="row justify-content-around border rounded mt-3">
                    <?php
                        $sql = "SELECT * FROM home WHERE kategori='fotoalbom' ORDER BY `status` DESC";
                        $query = mysqli_query($conn, $sql);
                        while($res = mysqli_fetch_assoc($query)){
                            $check = ($res['status']) ? "-check" : "";
                            echo '<div class="col bg-primary p-0 border">
                                    <div class="row p-3 justify-content-center ">
                                        <img class="" style="height: 150px; max-width: 220px" src="../media/albom/'.$res['image'].'" alt="'.$res['image'].'">
                                    </div>
                                    <div class="col-12 bg-success px-0" style="height: 50px">
                                        <div class="row align-items-center justify-content-around m-0 h-100">
                                            <span class=""><a href="config.php?query=home_fotoalbom_status&id='.$res['id'].'"><i class="far fa'.$check.'-square"></i></a></span>
                                        </div>
                                    </div>
                                </div>';
                        }
                    ?>
                </div>

            </div>
            <div class="col-12 my-3 px-4 <?=$team?>">
                <h1>KOMANDA</h1>
                <div class="row justify-content-around border rounded mt-3">
                    <?php
                        $sql = "SELECT * FROM home WHERE kategori='komanda' ORDER BY `status` DESC";
                        $query = mysqli_query($conn, $sql);
                        while($res = mysqli_fetch_assoc($query)){
                            $check = ($res['status']) ? "-check" : "";
                            echo '<div class="col bg-primary p-0 border">
                                    <div class="row p-3 justify-content-center ">
                                        <img class="" style="height: 150px; max-width: 220px" src="../media/staff/'.$res['image'].'" alt="'.$res['image'].'">
                                    </div>
                                    <div class="col-12 bg-success px-0" style="height: 50px">
                                        <div class="row align-items-center justify-content-around m-0 h-100">
                                            <span class=""><a href="config.php?query=home_komanda_status&id='.$res['id'].'"><i class="far fa'.$check.'-square"></i></a></span>
                                        </div>
                                    </div>
                                </div>';
                        }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>