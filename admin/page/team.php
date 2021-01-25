<?php
$action = (isset($_GET["page"]) && isset($_GET["action"]) && isset($_GET["id"])) ? "edit" : "add";

$text = "";
$id = "";
$name = "";
$movqe = "";

$admin = "";
$trainer = "";
$doctor = "";
$doorman = "";
$forward = "";
$midfielder = "";
$defender = "";


$number = "";
$date = "";
$country = "";
$facebook = "";
$instagram = "";
$twitter = "";
$youtube = "";

if($action === "edit"){
    $sql = "SELECT * FROM team WHERE id='".$_GET['id']."'";
    $team = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    
    $id = $_GET['id'];
    $name = $team['name'];
    $movqe = $team['movqe'];
    
    $$movqe = "selected";
    $number = $team['nomre'];
    $date = $team['date'];
    $country = $team['country'];
    $facebook = $team['facebook'];
    $instagram = $team['instagram'];
    $twitter = $team['twitter'];
    $youtube = $team['youtube'];
    
}

?>

<div id="team" class="row">
    <div class="col-12 py-3">
        <div id="file" class="row align-items-center justify-content-center h-100">
            <div class="col-12 text-center fa-2x">Oyunçu Profili Yarat</div>
            <div class=" text-left col-12">
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

            <div class="col-12">
                <form method="POST" novalidate="novalidate" enctype="multipart/form-data">
                    <div id="uploadimageModal" class="col-12 p-0" role="dialog">
                        <div class="modal-content border-0">
                            <div class="modal-body ">
                                <div class="col-12 p-0">
                                    <div class=" text-center">
                                        <div id="image_demo" class="w-100" style=" margin-top:30px"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 border rounded p-3">
                        <label for="sekil">Oyunçu şəkili</label>
                        <input type="file" name="sekil" id="upload_image" class="form-control h-100 p-0" />
                    </div>
                    <div class="form-group inline-form">
                        <input type="hidden" name="query" value="<?=$action?>" />
                        <input type="hidden" name="id" value="<?=$id?>" />
                        <input type="text" name="name" value="<?=$name?>" placeholder="Ad Soyad" class="form-control">
                        <input type="number" name="number" value="<?=$number?>" placeholder="Oyunçu nömrəsi" class="form-control">
                        <select name="position" class="form-control">
                            <option name="null" value="">--Mövqe seç---</option>
                            <option name="admin" <?=$admin?> value="admin">Administrator</option>
                            <option name="trainer" <?=$trainer?> value="trainer">Məşqçi</option>
                            <option name="doctor" <?=$doctor?> value="doctor">Həkim</option>
                            <option name="doorman" <?=$doorman?> value="doorman">Qapıçı</option>
                            <option name="striker" <?=$forward?> value="forward">Hücumçu</option>
                            <option name="midfielder" <?=$midfielder?> value="midfielder">Yarım Müdafiəçi</option>
                            <option name="defender" <?=$defender?> value="defender">Müdafiəçi</option>
                        </select>
                        <input type="date" name="date" value="<?=$date?>" placeholder="Doğum tarixi" class="form-control">
                        <input type="text" name="country" value="<?=$country?>" placeholder="Ölkə / Şəhər" class="form-control">
                        <input type="text" name="facebook" value="<?=$facebook?>" placeholder="Facebook" class="form-control">
                        <input type="text" name="instagram" value="<?=$instagram?>" placeholder="Instagram" class="form-control">
                        <input type="text" name="twitter" value="<?=$twitter?>" placeholder="Twitter" class="form-control">
                        <input type="text" name="youtube" value="<?=$youtube?>" placeholder="Youtube" class="form-control">
                    </div>
                    <button id="save" type="button" class="crop_image btn btn-success">Saxla</button>
                    <button id="cancel" type="reset" class="btn btn-danger"><a style="text-decoration: none; color: white;" href="admin.php?page=team">Ləğv et</a></button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 border-top p-3 mb-5">
        <div class="row px-3">
            <?php
            $sql = "SELECT * FROM team ORDER BY `status` DESC";
            $query = mysqli_query($conn, $sql);
            while($res = mysqli_fetch_assoc($query)){
                $check = ($res['status']) ? "-check" : "";
                $id = $res['id'];
                $avatar = $res['avatar'];
                $name = $res['name'];
                $movqe = $res['movqe'];
                $number = $res['nomre'];
                $date = $res['date'];
                $country = $res['country'];
                $facebook = $res['facebook'];
                $instagram = $res['instagram'];
                $twitter = $res['twitter'];
                $youtube = $res['youtube'];
                echo '<div class="col-12 border mb-3">
                <div class="row justify-content-center">
                    <div class="col-4 mx-auto border-right">
                        <img class="w-100" src="../media/staff/'.$movqe.'/'.$avatar.'" alt="">
                    </div>
                    <div class="col-7">
                        <p>Ad : '.$name.'</p>
                        <p>Nömrə : '.$number.'</p>
                        <p>Mövqe : '.$movqe.'</p>
                        <p>Doğum tarixi : '.$date.'</p>
                        <p>Ölkə/Şəhər : '.$country.'</p>
                        <p>Facebook : <a href="'.$facebook.'">'.$facebook.'</a></p>
                        <p>Instagram : <a href="'.$instagram.'">'.$instagram.'</a></p>
                        <p>Twitter : <a href="'.$twitter.'">'.$twitter.'</a></p>
                        <p>Yotube : <a href="'.$youtube.'">'.$youtube.'</a></p>
                    </div>
                    <div class="col-1 border-left">
                        <div class="row align-items-center justify-content-center h-100">
                            <ul class="list-inline m-0 p-0 text-center">
                                <li class="text-justify"><a href="config.php?query=delete_team&id='.$id.'"><i class="fas fa-trash fa-2x"></i></a></li>
                                <li class="my-3 text-justify"><a href="config.php?query=change_team_status&id='.$id.'"><i class="far fa'.$check.'-square fa-2x"></i></a>
                                </li>
                                <li class="text-justify"><a href="admin.php?page=team&action=edit&id='.$id.'"><i class="fas fa-edit fa-2x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 border-top">';
                echo "<form action='config.php' method='post' enctype='multipart/form-data' class='w-100 border p-3 my-2'>
                                    <input type='hidden' name='query' value='add_team_media'>
                                    <input type='hidden' name='id' value='$id'>
                                    <input type='file' name='file' class='col-12 px-0 border rounded mb-2'>
                                    <input type='submit' value='Əlavə et' class='btn btn-success'>
                                </form>";
                echo "<h2 class='col-12'>$name şəkilləri</h2>";
                $sql2 = "SELECT * FROM team_media WHERE team='$id' ORDER BY `status` DESC";
                $query2 = mysqli_query($conn, $sql2);
                while($media = mysqli_fetch_assoc($query2)){
                    $check2 = ($media['status']) ? "-check" : "";
                    $id_media = $media['id'];
                    $media = ($media['type'] === "video") ? "<video style='height: 150px; max-width: 220px' controls src='../media/staff/video/".$media['media']."'></video>" : '<img class="" style="height: 150px; max-width: 220px" src="../media/staff/images/'.$media['media'].'" alt="'.$media['media'].'">';
                    echo '<div class="col bg-primary p-0 border">
                            <div class="row p-3 justify-content-center ">
                                '.$media.'
                            </div>
                            <div class="col-12 bg-success px-0" style="height: 50px">
                                <div class="row align-items-center justify-content-around m-0 h-100">
                                    <span class=""><a href="config.php?query=delete_team_media&id='.$id_media.'"><i class="text-danger fas fa-trash"></i></a></span>
                                    <span class=""><a href="config.php?query=team_media_status&id='.$id_media.'"><i class="far fa'.$check2.'-square"></i></a></span>
                                    <span class=""><b>&#x26F6</b></span>
                                </div>
                            </div>
                        </div>';
                }
                echo "</div>
                    </div>
                    </div>";
                        
            
            }
        
            
            
            ?>
        </div>
    </div>
</div>

<script src="js/team.js"></script>