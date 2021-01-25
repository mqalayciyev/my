<?php

$action = (isset($_GET["page"]) && isset($_GET["action"]) && isset($_GET["id"])) ? "edit" : "add";

$id = "";
$oyun = "";
$stadion = "";
$tarix = "";
$gorus = "";
$team_1 = "";
$team_1_qol = "";
$team_2 = "";
$team_2_qol = "";
$ev = "";
$sefer = "";
if($action === "edit"){
    $sql = "SELECT * FROM games WHERE id='".$_GET['id']."'";
    $games = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    $id = $_GET['id'];
    $oyun = $games['oyun'];
    $stadion = $games['stadium'];
    $tarix = $games['tarix'];
    $gorus = $games['gorus'];

    ($gorus == "E") ? $ev = "selected" : $sefer = "selected";

    $team_1 = $games['team_1'];
    $team_1_qol = $games['team_1_qol'];
    $team_2 = $games['team_2'];
    $team_2_qol = $games['team_2_qol'];
}

?>
<div class="col-12 p-3 mb-5">
    <h2>Oyunlar</h2>

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
        <div class="col-12 p-3 border rounded">
            <form action="">
                <input type="hidden" name="query" value="<?=$action?>" />
                <input type="hidden" name="id" value="<?=$id?>" />
                <input type="text" name="oyun" value="<?=$oyun?>" placeholder="Oyun" class="form-control mb-2">
                <input type="text" name="stadion" value="<?=$stadion?>" placeholder="Stadion" class="form-control mb-2">
                <input type="datetime-local" name="date" value="<?=$tarix?>" placeholder="Stadion" class="form-control mb-2">
                <select name="gorus" class="form-control mb-2">
                    <option name="null" value="">-- Görüş --</option>
                    <option name="ev" <?=$ev?> value="E">Ev</option>
                    <option name="sefer" <?=$sefer?> value="S">Səfər</option>
                </select>
                <div id="file" class="col-12 p-3 border rounded mb-2">
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

                    <input type="file" id="upload_image" name="">
                    <?php
                        if(strlen(trim($team_1_qol)) > 0){
                            echo '<input type="number" name="team_1_qol" value="'.$team_1_qol.'" placeholder="'.$team_1.' qol sayı" class="form-control mt-2">';
                        }
                    ?>
                    <input type="text" name="komanda-1" value="<?=$team_1?>" placeholder="1-ci Komanda" class="form-control mt-2">
                </div>

                <div id="file_2" class="col-12 p-3 border rounded mb-2">
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

                    <input type="file" id="upload_image" name="">
                    <?php
                        if(strlen(trim($team_2_qol)) > 0){
                            echo '<input type="number" name="team_2_qol" value="'.$team_2_qol.'" placeholder="'.$team_2.' qol sayı" class="form-control mt-2">';
                        }
                    ?>
                    <input type="text" name="komanda-2" value="<?=$team_2?>" placeholder="2-ci Komanda" class="form-control mt-2">
                </div>
                <button id="save" type="button" class="crop_image btn btn-success">Saxla</button>
                <button id="cancel" type="reset" class="btn btn-danger"><a style="text-decoration: none; color: white;" href="admin.php?page=games">Ləğv et</a></button>
            </form>
        </div>
        <?php
            $sql = "SELECT * FROM `games` WHERE `oyun_status` = '1' AND `qeyd` = '0' ORDER BY `status` DESC";
            $query = mysqli_query($conn, $sql);
            echo "<div id='without_result' class='col-12 p-3 alert-danger mb-4'><h2>Oyun Nəticəsi Qeyd Ediləcək</h2><div class='row'>";
            while($res = mysqli_fetch_assoc($query)){
                $check = ($res['status']) ? "-check" : "";
                $id = $res['id'];
                $team_1 = $res['team_1'];
                $team_1_logo = $res['team_1_logo'];
                $team_2 = $res['team_2'];
                $team_2_logo = $res['team_2_logo'];
                $oyun = $res['oyun'];
                $stadion = $res['stadium'];
                $gorus = $res['gorus'];
                $tarix = $res['tarix'];
                $hefte = $res['hefte'];
                $hefte_arr = ['B.E.', 'Ç.A.', 'Ç.', 'C.A.', 'C.', 'Ş.', 'B.'];
                $ay_arr = ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'İyun', 'İyul', 'Avqust', 'Sentyabr', 'Oktyabr', 'Noyabr', 'Dekabr'];
                $tarix = explode("T", $tarix);
                $date = date_create($tarix[0]);
                $date = date_format($date, "d-m-Y");
                $date = explode("-", $date);
                $day = trim($date[0], "0");
                $month = $ay_arr[trim($date[1], "0")-1];
                $year = $date[2];
                $date = $day . " ". $month . " " .$year;
                $time = $tarix[1];
                $gorus = ($gorus == "E") ? "Ev" : "Səfər";

                $tarix = $date . " " . $time;

                $hefte = $hefte_arr[$hefte];
                echo '<div class="col-12 px-4 my-3 border border-dark rounded">
                <div class="row h-100">
                    <div class="col-3 align-self-center text-center">
                        <img style="width: 50px; height: 50px;" src="../media/team_logos/'.$team_1_logo.'" alt="">
                        <p>'.$team_1.'</p>
                    </div>
                    <div class="col-6">
                        <p>Oyun : '.$oyun.'</p>
                        <p>Stadion : '.$stadion.'</p>
                        <p>Görüş : '.$gorus.'</p>
                        <p>Tarix : '.$hefte." ".$tarix.'</p>
                    </div>
                    <div class="col-3 align-self-center text-center">
                        <img style="width: 50px; height: 50px;" src="../media/team_logos/'.$team_2_logo.'" alt="">
                        <p>'.$team_2.'</p>
                    </div>
                    <div class="col-12 p-3">
                        <form action="config.php" method="post">
                            <div class="row">
                                <input type="hidden" name="query" value="team_qol">
                                <input type="hidden" name="id" value="'.$id.'">
                                <input type="number" class="form-control col-5" name="team_1_qol" placeholder="'.$team_1.' qol sayı"/>
                                <input type="number" class="form-control col-5" name="team_2_qol" placeholder="'.$team_2.' qol sayı"/>
                                <input type="submit" class="btn btn-success col" name="save" value="Saxla"/>
                            </div>

                        </form>
                    </div>
                </div>
            </div>';
            }
            echo "</div></div>";

            $sql = "SELECT * FROM `games` WHERE `oyun_status` = '0' ORDER BY `status` DESC";
            $query = mysqli_query($conn, $sql);
            echo "<div id='next_games' class='col-12 p-3 alert-primary mb-4'><h2>Gələcək oyunlar</h2><div class='row'>";
            while($res = mysqli_fetch_assoc($query)){
                $check = ($res['status']) ? "-check" : "";
                $id = $res['id'];
                $team_1 = $res['team_1'];
                $team_1_logo = $res['team_1_logo'];
                $team_2 = $res['team_2'];
                $team_2_logo = $res['team_2_logo'];
                $oyun = $res['oyun'];
                $stadion = $res['stadium'];
                $gorus = $res['gorus'];
                $tarix = $res['tarix'];
                $hefte = $res['hefte'];
                $hefte_arr = ['B.E.', 'Ç.A.', 'Ç.', 'C.A.', 'C.', 'Ş.', 'B.'];
                $ay_arr = ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'İyun', 'İyul', 'Avqust', 'Sentyabr', 'Oktyabr', 'Noyabr', 'Dekabr'];
                $tarix = explode("T", $tarix);
                $date = date_create($tarix[0]);
                $date = date_format($date, "d-m-Y");
                $date = explode("-", $date);
                $day = trim($date[0], "0");
                $month = $ay_arr[trim($date[1], "0")-1];
                $year = $date[2];
                $date = $day . " ". $month . " " .$year;
                $time = $tarix[1];
                $gorus = ($gorus == "E") ? "Ev" : "Səfər";

                $tarix = $date . " " . $time;

                $hefte = $hefte_arr[$hefte];
                echo '<div class="col-12 my-3 border border-dark rounded">
                <div class="row h-100">
                    <div class="col-3 align-self-center text-center">
                        <img style="width: 50px; height: 50px;" src="../media/team_logos/'.$team_1_logo.'" alt="">
                        <p>'.$team_1.'</p>
                    </div>
                    <div class="col-6">
                        <p>Oyun : '.$oyun.'</p>
                        <p>Stadion : '.$stadion.'</p>
                        <p>Görüş : '.$gorus.'</p>
                        <p>Tarix : '.$hefte." ".$tarix.'</p>
                    </div>
                    <div class="col-3 align-self-center text-center">
                        <img style="width: 50px; height: 50px;" src="../media/team_logos/'.$team_2_logo.'" alt="">
                        <p>'.$team_2.'</p>
                    </div>
                    <div class="col-12 border-top p-3">
                        <ul class="list-inline text-center row justify-content-around m-0">
                            <li class="list-inline-item"><a href="config.php?query=delete_games&id='.$id.'"><i class="fas fa-trash fa-2x"></i></a></li>
                            <li class="list-inline-item"><a href="config.php?query=games_status_update&id='.$id.'"><i class="far fa'.$check.'-square fa-2x"></i></a></li>
                            <li class="list-inline-item"><a href="admin.php?page=games&action=edit&id='.$id.'"><i class="fas fa-edit fa-2x"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>';
            }
            echo "</div></div>";

            $sql = "SELECT * FROM `games` WHERE `oyun_status` = '1' AND `qeyd` = '1' ORDER BY `status` DESC";
            $query = mysqli_query($conn, $sql);
            echo "<div id='played_games' class='col-12 p-3 alert-warning'><h2>Oynanılmış Oyunlar</h2><div class='row'>";
            while($res = mysqli_fetch_assoc($query)){
                $check = ($res['status']) ? "-check" : "";
                $id = $res['id'];
                $team_1 = $res['team_1'];
                $team_1_qol = $res['team_1_qol'];
                $team_1_logo = $res['team_1_logo'];
                $team_2 = $res['team_2'];
                $team_2_qol = $res['team_2_qol'];
                $team_2_logo = $res['team_2_logo'];
                $oyun = $res['oyun'];
                $stadion = $res['stadium'];
                $gorus = $res['gorus'];
                $tarix = $res['tarix'];
                $hefte = $res['hefte'];
                $hefte_arr = ['B.E.', 'Ç.A.', 'Ç.', 'C.A.', 'C.', 'Ş.', 'B.'];
                $ay_arr = ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'İyun', 'İyul', 'Avqust', 'Sentyabr', 'Oktyabr', 'Noyabr', 'Dekabr'];
                $tarix = explode("T", $tarix);
                $date = date_create($tarix[0]);
                $date = date_format($date, "d-m-Y");
                $date = explode("-", $date);
                $day = trim($date[0], "0");
                $month = $ay_arr[trim($date[1], "0")-1];
                $year = $date[2];
                $date = $day . " ". $month . " " .$year;
                $time = $tarix[1];
                $gorus = ($gorus == "E") ? "Ev" : "Səfər";

                $tarix = $date . " " . $time;

                $hefte = $hefte_arr[$hefte];
                echo '<div class="col-12 my-3 border border-dark rounded">
                <div class="row h-100">
                    <div class="col-3 align-self-center text-center">
                        <img style="width: 50px; height: 50px;" src="../media/team_logos/'.$team_1_logo.'" alt="">
                        <p>'.$team_1.'</p>
                        <h1>'.$team_1_qol.'</h1>
                    </div>
                    <div class="col-6">
                        <p>Oyun : '.$oyun.'</p>
                        <p>Stadion : '.$stadion.'</p>
                        <p>Görüş : '.$gorus.'</p>
                        <p>Tarix : '.$hefte." ".$tarix.'</p>
                    </div>
                    <div class="col-3 align-self-center text-center">
                        <img style="width: 50px; height: 50px;" src="../media/team_logos/'.$team_2_logo.'" alt="">
                        <p>'.$team_2.'</p>
                        <h1>'.$team_2_qol.'</h1>
                    </div>
                    <div class="col-12 border-top p-3">
                        <ul class="list-inline text-center row justify-content-around m-0">
                            <li class="list-inline-item"><a href="config.php?query=delete_games&id='.$id.'"><i class="fas fa-trash fa-2x"></i></a></li>
                            <li class="list-inline-item"><a href="config.php?query=games_status_update&id='.$id.'"><i class="far fa'.$check.'-square fa-2x"></i></a></li>
                            <li class="list-inline-item"><a href="admin.php?page=games&action=edit&id='.$id.'"><i class="fas fa-edit fa-2x"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>';
            }
        
        ?>
    </div>
</div>
<script src="js/games.js"></script>