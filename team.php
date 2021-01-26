<?php
if(!isset($_GET['page']) && $_GET['page'] !== "team"){
    header("Location: index.php?page=team");
}

?>
<div id="team" class=" col-12">
    <?php
        $sql = "SELECT * FROM `about` WHERE `status` = 1";
        $response = mysqli_fetch_assoc(mysqli_query($conn, $sql));
    
    ?>
    <div class="row">
    <div id="about" class="col-12 py-5">
        <div class="col-12">
            <h2 class="header-group mb-4">Haqqımızda</h2>
        </div>

        <div class="col-12 position-relative">
            <img src="media/about/<?=$response['image']?>" style="transform: rotateY(<?=$response['rotate']?>)" alt="klub foto">
            <div class="about-div row">
                <p><?=$response['text']?></p>
                <span>Zaqatala Peşəkar Futbol Klubu</span>
            </div>
        </div>
    </div>

    <br>

    <div id="coming-games" class="col-12 py-5 bg-white">
        <h2 class="header-group col ">Gələcək oyunlar</h2>
        <!-- <form>
            <div class="input-group col-12 ">
                <select class="form-control col-12">
                    <option>---</option>
                    <option>Avropa Liqası</option>
                    <option>Azərbaycan Kuboku</option>
                    <option>Premyer Liqa</option>
                </select>
                <div class="input-group-append col-12 col-lg-2 px-0" style="z-index: 0;">
                    <button type="button" class="btn btn-outline-success col-12 font-weight-bold">Göstər</button>
                </div>
            </div>
        </form> -->
        <div class="mt-4 result">
            <div class="result-div col-12">
            <?php
                
                    $sql = "SELECT * FROM `games` WHERE `status` = 1 AND `qeyd` = 0 AND `oyun_status` = 0";
                    $query = mysqli_query($conn, $sql);
                    $hefte_arr = ['B.E.', 'Ç.A.', 'Ç.', 'C.A.', 'C.', 'Ş.', 'B.'];
                    $ay_arr = ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'İyun', 'İyul', 'Avqust', 'Sentyabr', 'Oktyabr', 'Noyabr', 'Dekabr'];
                    
                    $obj_coming_games = [];
                    while($res = mysqli_fetch_assoc($query)){
                        $team_1 = $res['team_1'];
                        $team_2 = $res['team_2'];
                        $tarix = $res['tarix']; 
                        $hefte = $res['hefte'];
                        $tarix = explode("T", $tarix);
                        $date = date_create($tarix[0]);
                        $date = date_format($date, "d-m-Y");
                        $date = explode("-", $date);
                        $day = trim($date[0], "0");
                        $month = $ay_arr[trim($date[1], "0")-1];
                        $year = $date[2];
                        $date = $day . " ". $month . " " .$year;
                        $time = $tarix[1];
                        $tarix = $date . " " . $time;
                        $week = $hefte_arr[$hefte];

                        $date = $week.' '.$tarix; // OBJECT
                        $gorus = $res['gorus'];
                        $oyun = $res['oyun'];
                        $stadium = $res['stadium'];
                        $team_1 = $res['team_1'];
                        $team_2 = $res['team_2'];
                        $team_1_logo = $res['team_1_logo'];
                        $team_2_logo = $res['team_2_logo'];
                        $coming_games = ["date" => $date,
                                        "gorus" => $gorus,
                                        "oyun" => $oyun,
                                        "stadium" => $stadium,
                                        "team_1" => $team_1,
                                        "team_2" => $team_2,
                                        "team_1_logo" => $team_1_logo,
                                        "team_2_logo" => $team_2_logo,];
                        array_push($obj_coming_games, $coming_games);
                    }
                    $comingGamesPerPage = 10;
                    $comingGamesCurrentPage = (isset($_GET['cp'])) ? $_GET['cp'] : 1;
        
                    $indexOfLastComingGames = $comingGamesCurrentPage * $comingGamesPerPage;
                    $indexOfFirstComingGames = $indexOfLastComingGames - $comingGamesPerPage;
                    
                    $currentComingGames = array_slice($obj_coming_games, $indexOfFirstComingGames, $comingGamesPerPage);
                    $totalComingGamesPageNums = ceil(count($obj_coming_games)/$comingGamesPerPage);
                    if(count($currentComingGames) > 0){
                        for($i = 0; $i < count($currentComingGames); $i++){
                            echo '<div class="col-12 bg-success position-relative mb-3">
                                <div class="row justify-content-center">
                                    <span class="gorus">'.$currentComingGames[$i]['gorus'].'</span>
                                    <div class="col-12 col-md-4 first-div px-5 py-3">
                                        <p>'.$currentComingGames[$i]['date'].'</p>
                                        <p>'.$currentComingGames[$i]['oyun'].'</p>
                                        <p>'.$currentComingGames[$i]['stadium'].'</p>
                                    </div>
                                    <div class="col-12  col-md-8 second-div ">
                                        <div class="row h-100 w-100 align-items-center">
                                            <div class="col">
                                                <p class="m-0">'.$currentComingGames[$i]['team_1'].'</p>
                                            </div>
                                            <div class="col">
                                                <img width="50" height="50" src="media/team_logos/'.$currentComingGames[$i]['team_1_logo'].'" alt="'.$currentComingGames[$i]['team_1_logo'].'">
                                                <p class="m-0 py-2">'.$currentComingGames[$i]['team_1'].'</p>
                                            </div>
                                            <div class="col">
                                                <img width="50" height="50" src="media/team_logos/'.$currentComingGames[$i]['team_2_logo'].'" alt="'.$currentComingGames[$i]['team_2_logo'].'">
                                                <p class="m-0 py-2">'.$currentComingGames[$i]['team_2'].'</p>
                                            </div>
                                            <div class="col">
                                                <p class="m-0">'.$currentComingGames[$i]['team_2'].'</p>
                                            </div>
            
            
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        }
                    }
                    else{
                        echo "Empty";
                    }
                    ?>
            </div>
            
        <div class="col-12 mt-4">
            <div class="row justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination">
                        <?php
                            $prevComingDisabled = ($comingGamesCurrentPage == 1 || count($currentComingGames) == 0) ? "disabled" : null;
                            $nextComingDisabled = ($comingGamesCurrentPage >= $totalComingGamesPageNums) ? "disabled" : null;
                            $prevComing = $comingGamesCurrentPage - 1;
                            $nextComing = $comingGamesCurrentPage + 1;
                            echo "<li class='page-item $prevComingDisabled'><a class='page-link' href='index.php?page=team&cp=$prevComing'>Previous</a></li>";
                            for($i = 1; $i <= $totalComingGamesPageNums; $i++){
                                $activeComing = ($i == $comingGamesCurrentPage) ? "active" : null;
                                echo "<li class='page-item $activeComing'><a class='page-link' href='index.php?page=team&cp=$i'>$i</a></li>";
                            }
                            echo "<li class='page-item $nextComingDisabled'><a class='page-link' href='index.php?page=team&cp=$nextComing'>Next</a></li>";
                        ?>
                    </ul>
                </nav>
            </div>
        </div>

        </div>
    </div>

    <br>

    <div id="games" class="col-12 py-5 my-0">
        <h2 class="header-group col  mb-4">Oyun Tarixçəsi</h2>
        <!-- <form>
            <div class="input-group col-12">
                <select class="form-control">
                    <option>-LIQA-</option>
                    <option>Avropa Liqası</option>
                    <option>Azərbaycan Kuboku</option>
                    <option>Premyer Liqa</option>
                </select>
                <select class="form-control">
                    <option>-IL-</option>
                    <option>2019/2020</option>
                    <option>2018/2019</option>
                    <option>2017/2018</option>
                </select>
                <div class="input-group-append col-12 col-lg-2 px-0" style="z-index: 0;">
                    <button type="button" class="btn rounded-0 btn-outline-success col-12 font-weight-bold">Göstər</button>
                </div>
            </div>
        </form> -->
        <div class="mt-4 result">
            <div class="col-12">
                <div class="result-div row justify-content-center card-divs" style="column-gap: 20px">
                    <?php
                    $gamesPerPage = 10;
                    $obj_games = [];
                    $sql = "SELECT * FROM `games` WHERE `status` = 1 AND `qeyd` = 1 AND `oyun_status` = 1";
                    $query = mysqli_query($conn, $sql);
                    $hefte_arr = ['Bazar ertəsi', 'Çərşənbə axşamı', 'Çərşənbə', 'Cümə axşamı', 'Cümə', 'Şənbə', 'Bazar'];
                    $ay_arr = ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'İyun', 'İyul', 'Avqust', 'Sentyabr', 'Oktyabr', 'Noyabr', 'Dekabr'];
                    
                    while($res = mysqli_fetch_assoc($query)){
                        $tarix = $res['tarix'];
                        $hefte = $res['hefte'];
                        $tarix = explode("T", $tarix);
                        $date = date_create($tarix[0]);
                        $date = date_format($date, "d-m-Y");
                        $date = explode("-", $date);
                        $day = trim($date[0], "0");
                        $month = $ay_arr[trim($date[1], "0")-1];
                        $year = $date[2];
                        $date = $day . " ". $month . " " .$year;
                        $time = $tarix[1];
                        $tarix = $date . " " . $time;
                        $week = $hefte_arr[$hefte];

                        $gorus = $res['gorus'];
                        $oyun = $res['oyun'];
                        $stadium = $res['stadium'];
                        $team_1 = substr($res['team_1'], 0, 3);
                        $team_2 = substr($res['team_2'], 0, 3);
                        $team_1_logo = $res['team_1_logo'];
                        $team_2_logo = $res['team_2_logo'];
                        $team_1_qol = $res['team_1_qol'];
                        $team_2_qol = $res['team_2_qol'];
                        $last_games = ["tarix" => $tarix,
                                        "week" => $week,
                                        "gorus" => $gorus,
                                        "oyun" => $oyun,
                                        "stadium" => $stadium,
                                        "team_1" => $team_1,
                                        "team_2" => $team_2,
                                        "team_1_logo" => $team_1_logo,
                                        "team_2_logo" => $team_2_logo,
                                        "team_1_qol" => $team_1_qol,
                                        "team_2_qol" => $team_2_qol];
                        array_push($obj_games, $last_games);
                    }
        
                    $gamesCurrentPage = (isset($_GET['gp'])) ? $_GET['gp'] : 1;
        
                    $indexOfLastGames = $gamesCurrentPage * $gamesPerPage;
                    $indexOfFirstGames = $indexOfLastGames - $gamesPerPage;
                    
                    $currentGames = array_slice($obj_games, $indexOfFirstGames, $gamesPerPage);
                    $totalGamesPageNums = ceil(count($obj_games)/$gamesPerPage);
                    if(count($currentGames) > 0){
                        for($i = 0; $i < count($currentGames); $i++){
                            echo '<div class=" bg-green col px-0 position-relative">           
                                <div class="w-100 bg-white px-0">
                                    <span class="gorus">'.$currentGames[$i]['gorus'].'</span>
                                    <p class="text-center pt-2 m-0">'.$currentGames[$i]['week'].'</p>
                                    <p class="text-center">'.$currentGames[$i]['tarix'].'</p>
                                    <div class="col-12 px-0 my-2">
                                        <div class="row justify-content-center h-100">
                                            <div><img width="50" height="50" src="media/team_logos/'.$currentGames[$i]['team_1_logo'].'" alt="'.$currentGames[$i]['team_1_logo'].'">
                                                <p class="text-center m-0">'.$currentGames[$i]['team_1'].'</p>
                                            </div>
                                            <div class="mx-1" style="align-self: center;">
                                                <p class="">'.$currentGames[$i]['team_1_qol'].' - '.$currentGames[$i]['team_2_qol'].'</p>
                                            </div>
                                            <div><img width="50" height="50" src="media/team_logos/'.$currentGames[$i]['team_2_logo'].'" alt="'.$currentGames[$i]['team_2_logo'].'">
                                                <p class="text-center m-0">'.$currentGames[$i]['team_2'].'</p>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-center p-2 m-0"><i class="fas fa-map-marker-alt"></i> '.$currentGames[$i]['stadium'].'</p>
                                </div>
                                <div class="row align-items-end justify-content-center">
                                    <p class="text-center align-self-center m-0 font-weight-bold text-white px-3">'.$currentGames[$i]['oyun'].'</p>
                                </div>
                            </div>';
                        }
                    }
                    else{
                        echo "Empty";
                    }
                    ?>
                </div>
            </div>


        <div class="col-12 mt-3">
            <div class="row justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination">
                        <?php
                            $prevGamesDisabled = ($gamesCurrentPage == 1 || count($currentGames) == 0) ? "disabled" : null;
                            $nextGamesDisabled = ($gamesCurrentPage >= $totalGamesPageNums) ? "disabled" : null;
                            $prevGames = $gamesCurrentPage - 1;
                            $nextGames = $gamesCurrentPage + 1;
                            echo "<li class='page-item $prevGamesDisabled'><a class='page-link' href='index.php?page=team&gp=$prevGames'>Previous</a></li>";
                            for($i = 1; $i <= $totalGamesPageNums; $i++){
                                $activeGames = ($i == $gamesCurrentPage) ? "active" : null;
                                echo "<li class='page-item $activeGames'><a class='page-link' href='index.php?page=team&gp=$i'>$i</a></li>";
                            }
                            echo "<li class='page-item $nextGamesDisabled'><a class='page-link' href='index.php?page=team&gp=$nextGames'>Next</a></li>";
                        ?>
                    </ul>
                </nav>
            </div>
        </div>

        </div>
    </div>

    <br>


    <div id="tournament" class="col-12 py-5 bg-white">
        <h2 class="header-group mb-4 px-3">Turnir cədvəli</h2>
        <div class="col-12 pb-3">
            
        </div>

    </div>

    <br>

    <div id="staff" class="pb-5 col-12  py-5" style="">
        <div class="col-12 clearfix">
            <div id="right-navbar" class="fixed-top shadow-lg p-1">
                <strong title="Aç" class="animate__animated animate__headShake animate__infinite">></strong>
                <div class="row align-content-around">
                    <p class="col-12"><span aria-label="admin">Administrator</span></p>
                    <p class="col-12"><span aria-label="doctor">Həkim</span></p>
                    <p class="col-12"><span aria-label="trainer">Məşqçilər</span></p>
                    <p class="col-12"><span aria-label="goalkeeper">Qapıçı</span></p>
                    <p class="col-12"><span aria-label="forwards">Hücumçular</span></p>
                    <p class="col-12"><span aria-label="defenders">Müdafiəçilər</span></p>
                    <p class="col-12"><span aria-label="midfielders">Yarım Müdafiəçilər</span></p>
                </div>
            </div>

            <div class="right-div col-12 position-relative">
                <h2 class="header-group">Heyət</h2>
                <h4 id="admin" class="font-weight-bold mt-0">Administrator</h4>
                <div class=" card-column row">
                <?php
                    $sql = "SELECT * FROM team WHERE `status` = 1 AND `movqe` = 'admin'";
                    $query = mysqli_query($conn, $sql);
                    while($res = mysqli_fetch_assoc($query)){
                        echo '<div class="card col-3 p-0">
                            <div class="img-div">
                                <img class="card-img-top w-100 h-100" src="media/staff/'.$res['movqe'].'/'.$res['avatar'].'">
                            </div>
                            <div class="card-div">
                                <ul>
                                    <li><span>A</span></li>
                                    <li><span></span></li>
                                    <li><a href="index.php?page=team&player='.$res['id'].'"><span>'.$res['name'].'</span></a></li>
                                </ul>
                            </div>
                        </div>';
                    }
                ?>
                </div>
                

                <h4 id="doctor" class="font-weight-bold mt-0">Həkim</h4>
                <div class=" card-column row">
                <?php
                    $sql = "SELECT * FROM team WHERE `status` = 1 AND `movqe` = 'doctor'";
                    $query = mysqli_query($conn, $sql);
                    while($res = mysqli_fetch_assoc($query)){
                        echo '<div class="card col-3 p-0">
                            <div class="img-div">
                                <img class="card-img-top w-100 h-100" src="media/staff/'.$res['movqe'].'/'.$res['avatar'].'">
                            </div>
                            <div class="card-div">
                                <ul>
                                    <li><span>H</span></li>
                                    <li><span></span></li>
                                    <li><a href="index.php?page=team&player='.$res['id'].'"><span>'.$res['name'].'</span></a></li>
                                </ul>
                            </div>
                        </div>';
                    }
                ?>
                </div>

                <h4 id="trainer" class="font-weight-bold mt-0">Məşqçilər</h4>
                <div class=" card-column row">
                <?php
                    $sql = "SELECT * FROM team WHERE `status` = 1 AND `movqe` = 'trainer'";
                    $query = mysqli_query($conn, $sql);
                    while($res = mysqli_fetch_assoc($query)){
                        echo '<div class="card col-3 p-0">
                            <div class="img-div">
                                <img class="card-img-top w-100 h-100" src="media/staff/'.$res['movqe'].'/'.$res['avatar'].'">
                            </div>
                            <div class="card-div">
                                <ul>
                                    <li><span>M</span></li>
                                    <li><span></span></li>
                                    <li><a href="index.php?page=team&player='.$res['id'].'"><span>'.$res['name'].'</span></a></li>
                                </ul>
                            </div>
                        </div>';
                    }
                ?>
                </div>

                <h4 id="goalkeeper" class="font-weight-bold">Qapıçı</h4>
                <div class=" card-column row">
                <?php
                    $sql = "SELECT * FROM `team` WHERE `status` = 1 AND `movqe` = 'doorman'";
                    $query = mysqli_query($conn, $sql);
                    while($res = mysqli_fetch_assoc($query)){
                        echo '<div class="card col-3 p-0">
                            <div class="img-div">
                                <img class="card-img-top w-100 h-100" src="media/staff/'.$res['movqe'].'/'.$res['avatar'].'">
                            </div>
                            <div class="card-div">
                                <ul>
                                    <li><span>'.$res['nomre'].'</span></li>
                                    <li><span></span></li>
                                    <li><a href="index.php?page=team&player='.$res['id'].'"><span>'.$res['name'].'</span></a></li>
                                </ul>
                            </div>
                        </div>';
                    }
                ?>
                </div>
                

                <h4 id="forwards" class="font-weight-bold">Hücumçular</h4>
                <div class=" card-column row">
                <?php
                    $sql = "SELECT * FROM team WHERE `status` = 1 AND `movqe` = 'forward'";
                    $query = mysqli_query($conn, $sql);
                    while($res = mysqli_fetch_assoc($query)){
                        echo '<div class="card col-3 p-0">
                            <div class="img-div">
                                <img class="card-img-top w-100 h-100" src="media/staff/'.$res['movqe'].'/'.$res['avatar'].'">
                            </div>
                            <div class="card-div">
                                <ul>
                                    <li><span>'.$res['nomre'].'</span></li>
                                    <li><span></span></li>
                                    <li><a href="index.php?page=team&player='.$res['id'].'"><span>'.$res['name'].'</span></a></li>
                                </ul>
                            </div>
                        </div>';
                    }
                ?>
                </div>

                <h4 id="defenders" class="font-weight-bold">Müdafiəçilər</h4>
                <div class=" card-column row">
                <?php
                    $sql = "SELECT * FROM team WHERE `status` = 1 AND `movqe` = 'defender'";
                    $query = mysqli_query($conn, $sql);
                    while($res = mysqli_fetch_assoc($query)){
                        echo '<div class="card col-3 p-0">
                            <div class="img-div">
                                <img class="card-img-top w-100 h-100" src="media/staff/'.$res['movqe'].'/'.$res['avatar'].'">
                            </div>
                            <div class="card-div">
                                <ul>
                                    <li><span>'.$res['nomre'].'</span></li>
                                    <li><span></span></li>
                                    <li><a href="index.php?page=team&player='.$res['id'].'"><span>'.$res['name'].'</span></a></li>
                                </ul>
                            </div>
                        </div>';
                    }
                ?>
                </div>

                <h4 id="midfielders" class="font-weight-bold" style="flex-wrap: wrap;">Yarım Müdafiəçilər</h4>
                <div class=" card-column row">
                <?php
                    $sql = "SELECT * FROM team WHERE `status` = 1 AND `movqe` = 'midfielder'";
                    $query = mysqli_query($conn, $sql);
                    while($res = mysqli_fetch_assoc($query)){
                        echo '<div class="card col-3 p-0">
                            <div class="img-div">
                                <img class="card-img-top w-100 h-100" src="media/staff/'.$res['movqe'].'/'.$res['avatar'].'">
                            </div>
                            <div class="card-div">
                                <ul>
                                    <li><span>'.$res['nomre'].'</span></li>
                                    <li><span></span></li>
                                    <li><a href="index.php?page=team&player='.$res['id'].'"><span>'.$res['name'].'</span></a></li>
                                </ul>
                            </div>
                        </div>';
                    }
                ?>
                </div>
            </div>

        </div>

    </div>

    <!-- <br> -->

    <div id="stadium" class="col-12 pt-5 bg-white">
        <?php
            $sql = "SELECT * FROM `stadium` WHERE `status` = 1";
            $response = mysqli_fetch_assoc(mysqli_query($conn, $sql));
        
        ?>
        <div class="col-12">
            <h2 class="header-group mb-4">Zaqatala pfk Ev Stadionu</h2>
        </div>

        <div class="col-12 pb-4">
            <img src="media/stadium/<?=$response['image']?>" class="col-12 col-lg-6" alt="Home Stadium">
            <p style="line-height: 2"><?=$response['text']?></p>
        </div>
    </div>
    </div>
</div>
<script src="js/scroll.js"></script>