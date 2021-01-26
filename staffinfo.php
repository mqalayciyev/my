<?php

$display = "";
$URL = $_SERVER['PHP_SELF'];
$str = "/index.php/i";
if(!isset($_GET['page']) && !isset($_GET['player']) && preg_match($str, $URL) == 0){
    echo "<script>window.open('index.php','_self')</script>";

}
else{
    $sql = "SELECT * FROM `team` WHERE `id` = ".$_GET['player']." AND `status` = 1";
    $query = mysqli_query($conn, $sql);
    $movqe_arr = ['admin' => 'Administrator', 'doctor' => 'Həkim', 'trainer' => 'Məşqçi', 'doorman' => 'Qapıçı', 'forward' => 'Hücumçu', 'defender' => 'Müdafiəçi', 'midfielder' => 'Yarım Müdafiəçi'];
    if(mysqli_num_rows($query) === 0){
        $display = "d-none";
        require "404.php";
    }
    else{
        $display = "d-block";
        $team = mysqli_fetch_assoc($query);
        $movqe = $movqe_arr[$team['movqe']];
        
    }
}
?>


<div id="staff-info" class="col-12 pt-3 pb-5 bg-white <?=$display?>">
    <div class="row justify-content-center h-100">
        <img class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3" src=<?php echo "'media/staff/" .$team['movqe'] . "/" . $team['avatar']."'";?> alt="<?=$team['avatar']?>">
        <div class="col-12 col-md-7 col-lg-6 ml-md-3 ml-lg-5 align-self-center player-info-div h-100">
            <div class="row align-items-center h-100">
                <div class="col-2 text-center">
                    <span><?=$team['nomre']?></span>
                </div>
                <div class="col">
                    <h3><?=$team['name']?></h3>
                    
                    <hr class="w-100 bg-white">
                    <p><strong>Mövqe: </strong> <?=$movqe?></p>
                    <p><strong>Doğum tarixi: </strong> <?=$team['date']?></p>
                    <p><strong>Ölkə/Şəhər: </strong> <?=$team['country']?></p>
                    <p><a href="<?=$team['facebook']?>"><i class="fab fa-facebook-f"></i></a><a href="<?=$team['instagram']?>"><i class="fab fa-instagram"></i></a><a href="<?=$team['twitter']?>"><i class="fab fa-twitter"></i></a></p>
                </div>
                
            </div>

            
        </div>

    </div>
    <div class="col-12 mt-5">
        <h3>FOTO</h3>
        <div class="row justify-content-center">
            <div class=" img-full card-columns pt-2 pb-4 px-3">
                <?php
                    $sql = "SELECT * FROM `team_media` WHERE `team` = ".$_GET['player']." AND `status` = 1";
                    $query = mysqli_query($conn, $sql);
                    while($team_media = mysqli_fetch_assoc($query)){
                        if($team_media['type'] === "image"){
                            echo "<div class='col-11 col-lg-5 p-0'>
                                <img src='media/staff/images".$team_media['media']."' alt='".$team_media['media']."' class='w-100' />
                            </div>";
                        }
                        else{
                            echo "<div class='col-11 col-lg-5 p-0'>
                                <video src='media/staff/video/".$team_media['media']."' class='w-100' controls></video>
                            </div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>