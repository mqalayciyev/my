<?php
if(!isset($_SESSION["admin"])){
    header("Location: ../index.php");
}

?>
<div class="row header">
    <div class="col-12 px-4 pb-4 mb-4">
        <div class="row">
            <div class="col-12">
                <h1>Basliq Sekilleri</h1>
                <div class="row">
                    <?php 
                    if(isset($_SESSION['error'])){
                        echo '<div class="alert alert-danger col-12">'.$_SESSION['error'].'</div>';
                        unset($_SESSION['error']);
                    }
                    elseif(isset($_SESSION['success'])){
                        echo '<div class="alert alert-success col-12">'.$_SESSION['success'].'</div>';
                        unset($_SESSION['success']);
                    }
                    else{
                        echo null;
                    }
                    
                    
                    ?>

                </div>

                <div id="file" class="row border rounded p-2">
                    <p class="w-100">Şəkil əlavə et . . .</p>
                    <form action="config.php" class="w-100" method="post" enctype="multipart/form-data">
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
                        <input type="file" name="file" id="upload_image" class="col-12 px-0 border rounded my-3" />
                        <input type="submit" name="send" value="Upload" class="crop_image btn btn-primary">
                        <input type="reset" value="Cancel" class="cancel btn btn-danger">
                    </form>
                </div>
            </div>


            <div id="photos" class="col-12 border rounded my-3">
                <div class="row justify-content-around">
                    <?php
                        $sql = "SELECT * FROM header ORDER BY `status` DESC";
                        $query = mysqli_query($conn, $sql);
                        while($res = mysqli_fetch_assoc($query)){
                            $check = ($res['status']) ? "-check" : "";
                            echo '<div class="col bg-primary p-0 border">
                                    <div class="row p-3 justify-content-center ">
                                        <img class="" style="height: 150px; max-width: 220px" src="../media/header/'.$res['image'].'" alt="'.$res['image'].'">
                                    </div>
                                    <div class="col-12 bg-success px-0" style="height: 50px">
                                        <div class="row align-items-center justify-content-around m-0 h-100">
                                            <span class=""><a href="config.php?query=delete_header_image&id='.$res['id'].'"><i class="text-danger fas fa-trash"></i></a></span>
                                            <span class=""><a href="config.php?query=change_header_status&id='.$res['id'].'"><i class="far fa'.$check.'-square"></i></a></span>
                                            <span class=""><b>&#x26F6</b></span>
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
<script src="js/header.js"></script>