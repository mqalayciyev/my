<div id="about" class="row">
    <div class="col-12 py-3 mb-5">
        <h2>Galereya</h2>
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
                        <input type="file" name="sekil" id="upload_image" class="form-control h-100 p-0 mb-3" />
                        <button id="save" type="button" class="crop_image btn btn-success">Saxla</button>
                        <button id="cancel" type="reset" class="btn btn-danger">Ləğv et</button>
                    </div>
                </form>
            </div>
            <div class="col-12 my-3">
                <div class="col-12 border rounded">
                    <div class="row">
                        <?php
                            $sql = "SELECT * FROM galeri ORDER BY `status` DESC";
                            $query = mysqli_query($conn, $sql);
                            while($res = mysqli_fetch_assoc($query)){
                                $check = ($res['status']) ? "-check" : "";
                                echo '<div class="col bg-primary p-0 border">
                                        <div class="row p-3 justify-content-center ">
                                            <img class="" style="height: 150px; max-width: 220px" src="../media/albom/'.$res['image'].'" alt="'.$res['image'].'">
                                        </div>
                                        <div class="col-12 bg-success px-0" style="height: 50px">
                                            <div class="row align-items-center justify-content-around m-0 h-100">
                                                <span class=""><a href="config.php?query=delete_galeri_image&id='.$res['id'].'"><i class="text-danger fas fa-trash"></i></a></span>
                                                <span class=""><a href="config.php?query=change_galeri_status&id='.$res['id'].'"><i class="far fa'.$check.'-square"></i></a></span>
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
</div>
<script src="js/galeri.js"></script>