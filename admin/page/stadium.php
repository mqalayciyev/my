<?php

$action = (isset($_GET["page"]) && isset($_GET["action"]) && isset($_GET["id"])) ? "edit" : "add";

$text = "";
$id = "";
if($action === "edit"){
    $sql = "SELECT * FROM stadium WHERE id='".$_GET['id']."'";
    $stadium = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $text = $stadium['text'];
    $id = $_GET['id'];
}

?>
<div id="about" class="row">
    <div class="col-12 py-3 mb-5">
        <h2>Ev Stadionu</h2>
        <div class="row">

            <div class="col-12">
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
            <div id="file" class="col-12">
                <form method="POST" name="13" novalidate="novalidate" enctype="multipart/form-data">
                    <div class="col-12 border rounded p-3">
                        <label for="image">Şəkil seç</label>
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
                        <input type="hidden" name="query" value="<?=$action?>" />
                        <input type="hidden" name="id" value="<?=$id?>" />
                        <input type="file" name="sekil" id="upload_image" class="form-control h-100 p-0" />
                        <textarea name="text" class="col-12 form-control my-3" rows="10"
                            placeholder="Metn daxil edin . . ."><?=$text?></textarea>
                        <button id="save" type="button" class="crop_image btn btn-success">Saxla</button>
                        <button id="cancel" type="reset" class="btn btn-danger"><a style="color: white; text-decoration: none;" href="admin.php?page=stadium">Ləğv et</a></button>
                    </div>
                </form>
            </div>
            <div class="col-12 my-3">
                <?php
                    $sql = "SELECT * FROM stadium ORDER BY `status` DESC";
                    $query = mysqli_query($conn, $sql);
                    while($res = mysqli_fetch_assoc($query)){
                        $check = ($res['status']) ? "-check" : "";
                        echo '<div class="col-12 border rounded mb-3">
                        <div class="row">
                            <div class="col-4 border-right">
                                <img src="../media/stadium/'.$res['image'].'" class="w-100" alt="'.$res['image'].'"">
                            </div>
                            <div class="col-7">
                                <p>'.$res['text'].'</p>
                            </div>
                            <div class="col-1 border-left">
                                <div class="row align-items-center justify-content-center h-100">
                                    <ul class="list-inline m-0 p-0 text-center">
                                        <li class="text-justify"><a href="config.php?query=delete_stadium_info&id='.$res['id'].'"><i class="fas fa-trash fa-2x"></i></a></li>
                                        <li class="text-justify my-3"><a href="config.php?query=change_stadium_info_status&id='.$res['id'].'"><i class="far fa'.$check.'-square fa-2x"></i></a></li>
                                        <li class="text-justify"><a href="admin.php?page=stadium&action=edit&id='.$res['id'].'"><i class="fas fa-edit fa-2x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<script src="js/stadium.js"></script>