<?php
if(!isset($_SESSION["admin"])){
    header("Location: ../index.php");
}

?>
<div id="about" class="row">
    <div class="col-12 py-3 mb-5">
        <h2>Turnir cedveli URL adresleri</h2>
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
                <form action="config.php" method="post">
                    <div class="col-12 border rounded p-3">
                        <input type="hidden" name="query" value="add_turnir">
                        <input type="text" name="url" class="form-control mb-2" placeholder="URL adresi daxil edin">
                        <button id="save" type="submit" class="btn btn-success">Saxla</button>
                        <button id="cancel" type="reset" class="btn btn-danger">Ləğv et</button>
                    </div>
                </form>
            </div>
            <div class="col-12 my-3">
                <?php
                $sql = "SELECT * FROM turnir";
                $query = mysqli_query($conn, $sql);
                while($response = mysqli_fetch_assoc($query)){
                    $check = ($response['status']) ? "-check" : "";
                    echo '<div class="col-12 border rounded">
                    <div class="row h-100 align-items-center">
                        <div class="col-9 p-3">
                            <a href="'.$response['url'].'">'.$response['url'].'</a>
                        </div>
                        <div class="col-3 border-left">
                            <ul class="list-inline text-center m-0">
                                <li class="list-inline-item"><a href="config.php?query=delete_turnir_url&id='.$response['id'].'"><i class="fas fa-trash fa-2x"></i></a></li>
                                <li class="list-inline-item"><a href="config.php?query=turnir_status_update&id='.$response['id'].'"><i class="far fa'.$check.'-square fa-2x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>';
                }
                
                
                ?>
                
            </div>
        </div>
    </div>
</div>