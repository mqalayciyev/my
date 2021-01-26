<?php
$URL = $_SERVER['PHP_SELF'];
$str = "/index.php/i";
if(preg_match($str, $URL) == 0){
    header("Location: index.php");
}
$url ='index.php?page=';

?>

<div class=" home px-0">
    <div class="">
        <div class="last-game mt-5 mb-2">
            <div class="col-12 px-lg-0">
                <div class="row">
                    <div class="col-12 col-md-5 col-lg-6 pt-0 mt-5 mt-lg-0">
                        <div class="row h-100">
                            <div class="align-self-center px-1 px-lg-3 mb-5">
                                <h3 class="text-dark h3-weight">TƏQVİM</h3>
                                <h2 class="header-group">NƏTİCƏLƏR &</h2>
                                <h2 class="header-group-200">CƏDVƏLLƏR</h2>
                            </div>
                        </div>
                    </div>
                    <?php
                        $sql = "SELECT * FROM `games` WHERE `status` ='1' AND `qeyd`='1' AND `oyun_status` = '1' ORDER BY `tarix` ASC";
                        $last_game = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                        $ay_arr = ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'İyun', 'İyul', 'Avqust', 'Sentyabr', 'Oktyabr', 'Noyabr', 'Dekabr'];
                        $hefte_arr = ['Bazar ertəsi', 'Çərşənbə axşamı', 'Çərşənbə', 'Cümə axşamı', 'Cümə', 'Şənbə', 'Bazar'];
                        $tarix = $last_game['tarix'];
                        $hefte = $last_game['hefte'];
                        $hefte = $hefte_arr[$hefte];
                        $tarix = explode("T", $tarix);
                        $date = $tarix[0];
                        $time = $tarix[1];
                        $date = date_create($date);
                        $date = date_format($date, "d-m-Y");
                        $date = explode("-", $date);
                        $date = trim($date[0], "0") . " " . $ay_arr[trim($date[1], "0")] . " " . $date[2];
                        $date = $hefte . " " . $date . " Saat " . $time;
                    ?>
                    <div class="col-12 col-md-7 col-lg-6 mt-md-5">
                        <div class="row">
                            <div class="col-12">
                                <div class="row justify-content-between py-lg-3 h-100">
                                    <div class="col-12 pt-md-5">
                                        <div class="row justify-content-center mb-3 mb-md-0">
                                            <h5 class=""><?php echo $date . " " . $last_game['stadium'];?></h5>
                                        </div>
                                    </div>
                                    <div class="col-12 px-lg-5 py-0">
                                        <div class="row">
                                            <div class="col-6 col-md-3">
                                                <div class="d-flex h-100 justify-content-center">
                                                    <img class="align-self-center " src="media/team_logos/<?=$last_game['team_1_logo']?>" alt="<?=$last_game['team_1_logo']?>">
                                                </div>
                                            </div>
                                            <div class="col-6 d-md-none">
                                                <div class="d-flex h-100 justify-content-center">
                                                    <img class="align-self-center" src="media/team_logos/<?=$last_game['team_2_logo']?>" alt="<?=$last_game['team_2_qol']?>">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6 h-25">
                                                <div class="col-12 h-25">
                                                    <div class="row justify-content-center h-100">
                                                        <p class="align-self-end sec d-flex justify-content-center">
                                                            <span class="span"><?=$last_game['team_1_qol']?></span>
                                                            <span class="span-center">
                                                                <span class="text-center"></span>
                                                            </span>
                                                            <span class="span"><?=$last_game['team_2_qol']?></span>
                                                        </p>

                                                    </div>
                                                </div>
                                                <div class="col-12 mx-auto">
                                                    <div class="d-flex justify-content-between">
                                                        <i class="d-inline-block fis align-self-start "><?=$last_game['team_1']?></i>
                                                        <i class="d-inline-block thid align-self-start "><?=$last_game['team_2']?></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-3 d-none d-md-block">
                                                <div class="d-flex h-100">
                                                    <img class="align-self-center" src="media/team_logos/<?=$last_game['team_2_logo']?>" alt="<?=$last_game['team_2_qol']?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3 mx-auto ">
                                <div class="row justify-content-center">
                                    <button type="button" class="btn btn-outline-green btn-small mx-auto"
                                        name="button"><a href="<?=$url?>team">Daha
                                            çox</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 coming-last-game bg-light py-5">
            <?php
                $sql = "SELECT * FROM `games` WHERE `status` ='1' AND `qeyd`='0' AND `oyun_status` = '0' ORDER BY `tarix` DESC";
                $coming_game = mysqli_fetch_assoc(mysqli_query($conn, $sql));
            ?>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3 coming-game">
                        <h4 class="">Sonrakı Oyun</h4>
                        <div class="">
                            <a href="#">
                                <div class="">
                                    <h5><?=$coming_game['oyun']?></h5>
                                </div>
                                <div class="row justify-content-center">
                                    <p class="m-0 fist"><?=$coming_game['team_1']?> vs <?=$coming_game['team_2']?></p>
                                    <div class="col-12 my-3">
                                        <div class="row justify-content-center">
                                            <img src="media/team_logos/<?=$coming_game['team_1_logo']?>" alt="<?=$coming_game['team_1']?>">
                                            <img src="media/team_logos/<?=$coming_game['team_2_logo']?>" alt="<?=$coming_game['team_2']?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row justify-content-center">
                                            <p class="m-0"><?=$coming_game['stadium']?></p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row justify-content-center">
                                            <p class="m-0"><?=$coming_game['tarix']?></p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 tour-table mt-5 mb-3  my-lg-0">
                        <h4>Turnir Cədvəli</h4>
                        <h5>I divizion</h5>

                        <div class="t col-12 h-75 px-0">
                        </div>
                        <div class="col-12 mt-3 mt-lg-0">
                            <div class="row justify-content-center">
                                <button type="button" class="btn btn-outline-green my-3 mb-5" name="button"><a
                                        href="<?=$url?>team">Daha Çox</a></button>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-lg-block col-3 tour-logo p-0 pr-4">
                        <div class="row justify-content-center align-items-center h-100">
                            <div class="logo-img-div">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="last-news bg-white py-5">
            <div class="col-12 mb-4 mb-lg-5">
                <h3 class="h3-weight">KLUBDAN ən SON</h3>
                <h2 class="header-group">Son Xəbərlər</h2>
            </div>
            <div class="col-12">
                <div class="card-column row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-4">
                    <?php
                        $sql = "SELECT * FROM `news` WHERE `status` = 1 ORDER BY `tarix` DESC LIMIT 4";
                        $query = mysqli_query($conn, $sql);
                        $ay_arr = ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'İyun', 'İyul', 'Avqust', 'Sentyabr', 'Oktyabr', 'Noyabr', 'Dekabr'];
                        while($news = mysqli_fetch_assoc($query)){
                            $tarix = $news['tarix'];
                            $tarix = explode(" ", $tarix);
                            // substr($res['team_2'], 0, 3);
                            $date = date_create($tarix[0]);
                            $date = date_format($date, "d-m-Y");
                            $date = explode("-", $date);
                            $day = trim($date[0], "0");
                            $month = $ay_arr[trim($date[1], "0")-1];
                            $month = substr($month, 0, 3);
                                        echo '<div class="col mb-4 mb-lg-0"><div class="news-div card bg-light">
                                        <a href="'.$url.'news&id='.$news['id'].'">
                                        <div class="d-block col-12 p-0">
                                                <img src="media/news/'.$news['image'].'" class="card-img-top" alt="'.$news['image'].'">
                                                <div><span>'.$day.'</span><span>'.$month.'</span></div>
                                        </div>
                                        <div class="card-body">
                                        <p class="m-0 card-text">KLUB XƏBƏRLƏRİ</p>
                                                        <h4 class="text-center card-title">'.$news['basliq'].'</h4>
                                        <p class="card-text">'.$news['metn'].'</p>
                                        </div>
                                        </a>
                                        </div></div>';
                                }
                ?>
                </div>
            </div>
            <div class="col-12 mt-0 mt-lg-5">
                <div class="row justify-content-center">
                    <button class="btn btn-outline-green"><a href="<?=$url?>news">Daha çox</a></button>
                </div>
            </div>
        </div>
        <div class="w-100 video bg-light py-5">
            <div class="col-12 mb-4 mb-lg-4">
                <h3 class="h3-weight">video</h3>
                <h2 class="header-group">Zaqatala tv</h2>
            </div>
            <div class="col-12">
                <div class="row px-3">
                    <div class="video-player col-12 col-lg-7 col-xl-8 bg-white">
                        <div class="row h-100 align-items-center justify-content-center">
                        <?php
                            $sql = "SELECT * FROM `zaqatalatv` WHERE `status` = 1 ORDER BY `date` DESC";
                            $query = mysqli_query($conn, $sql);
                            $zaqatalatv = mysqli_fetch_assoc($query);
                            echo '<video src="media/video/'.$zaqatalatv['video'].'" class="col-12 h-100 col-lg-11" controls></video>';
                        ?>
                            
                        </div>
                    </div>
                    <div class="playlist col-12 mt-3 mt-lg-0 col-lg-5 col-xl-4 p-4 bg-white">
                        <?php
                            $sql = "SELECT * FROM `zaqatalatv` WHERE `status` = 1";
                            $query = mysqli_query($conn, $sql);
                            
                            while($zaqatalatv = mysqli_fetch_assoc($query)){
                                echo "<div class='row border p-2 mb-3'>
                                    <video src='media/video/".$zaqatalatv['video']."' class='col-5 p-0'></video>
                                    <p class='m-0 p-3 col-7'>".$zaqatalatv['basliq']."</p>
                                </div>";
                            }
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 fotoalbom px-lg-0 img-full bg-white py-5 ">
            <div class="col-12">
                <h3 class="h3-weight col-12">KLUB</h3>
                <h2 class="header-group col-12">Fotoalbom</h2>
            </div>

            <div class="col-12 p-0">
                <div id="slides" class="col-12">
                    <div class="glide">
                        <div class="glide__track mb-lg-4" data-glide-el="track">
                            <ul class="glide__slides">
                                <?php
                                    $sql = "SELECT * FROM `galeri` WHERE `status` = 1 LIMIT 6";
                                    $query = mysqli_query($conn, $sql);
                                    $count = mysqli_num_rows($query);
                                    while($galeri = mysqli_fetch_assoc($query)){
                                        echo "<li class='glide__slide'><img src='media/albom/".$galeri['image']."' alt='".$galeri['image']."' /><span class='view-span'
                                        aria-label='media/albom/".$galeri['image']."'>&#x26F6</span></li>";
                                    }
                                
                                ?>
                            </ul>
                        </div>

                        <div class="glide__bullets" data-glide-el="controls[nav]">
                            <?php
                                for($i = 0; $i < $count; $i++){
                                    echo '<button class="glide__bullet" data-glide-dir="='.$i.'"></button>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-lg-4">
                <div class="row justify-content-center">
                    <button class="btn btn-outline-green "><a href="<?=$url?>galeri">Daha çox</a></button>
                </div>
            </div>



        </div>

        <div class="col-12 komanda py-5 bg-light">
            <div class="col-12 mb-5">
                <h3 class="h3-weight">Komanda</h3>
                <h2 class="header-group">Oyunçular</h2>
            </div>

            <div id="slides-staff" class="col-12">
                <div class="glide">
                    <div class="glide__track" data-glide-el="track">
                        <ul class="glide__slides">
                            <?php
                                $sql = "SELECT * FROM `team` WHERE `status` = 1 AND `movqe` != 'doctor' AND `movqe` != 'admin' AND `movqe` != 'trainer' LIMIT 6";
                                $query = mysqli_query($conn, $sql);
                                    
                                while($team = mysqli_fetch_assoc($query)){
                                    echo "<li class='glide__slide'>

                                    <img class='card-img-top' src='media/staff/".$team['movqe']."/".$team['avatar']."' alt=".$team['movqe']."/".$team['avatar'].">
                                    <div class='card-div'>
                                        <ul>
                                            <li><span>".$team['nomre']."</span></li>
                                            <li><span></span></li>
                                            <li><a href='index.php?page=team&player=".$team['id']."'><span>".$team['name']."</span></a></li>
                                        </ul>
                                    </div>
                                </li>";
                                }
                                
                            ?>
                        </ul>
                    </div>

                    <div class="glide__arrows" data-glide-el="controls">
                        <button class="glide__arrow glide__arrow--left" data-glide-dir="<"><</button>
                                <button class="glide__arrow glide__arrow--right" data-glide-dir=">">></button>
                    </div>

                </div>
            </div>



            <div class="col-12 mt-3 mt-lg-4">
                <div class="row justify-content-center">
                    <button class="btn btn-outline-green"><a href="<?=$url?>team">Daha çox</a></button>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
// GLIDE
function glideSize() {
    if ($(window).outerWidth() < 576) {
        new Glide('.komanda .glide', {
            type: 'carousel',
            startAt: 0,
            perView: 1,
            focusAt: "center",
            animationDuration: 800,
            autoplay: 3000,
            hoverpause: false,
        }).mount()
        new Glide('.fotoalbom .glide', {
            type: 'carousel',
            startAt: 0,
            perView: 1,
            focusAt: "center",
            animationDuration: 600,
            autoplay: 3000,
            hoverpause: false,
        }).mount()
    } else if ($(window).outerWidth() > 575 && $(window).outerWidth() < 768) {
        new Glide('.komanda .glide', {
            type: 'carousel',
            startAt: 0,
            perView: 2,
            focusAt: "center",
            animationDuration: 800,
            autoplay: 3000,
            hoverpause: false,
        }).mount()
        new Glide('.fotoalbom .glide', {
            type: 'carousel',
            startAt: 0,
            perView: 1,
            focusAt: "center",
            animationDuration: 600,
            autoplay: 3000,
            hoverpause: false,
        }).mount()
    } else if ($(window).outerWidth() > 767 && $(window).outerWidth() < 992) {
        new Glide('.komanda .glide', {
            type: 'carousel',
            startAt: 0,
            perView: 3,
            focusAt: "center",
            animationDuration: 800,
            autoplay: 3000,
            hoverpause: false,
        }).mount()
        new Glide('.fotoalbom .glide', {
            type: 'carousel',
            startAt: 0,
            perView: 2,
            focusAt: "center",
            animationDuration: 600,
            autoplay: 3000,
            hoverpause: false,
        }).mount()
    } else if ($(window).outerWidth() > 991 && $(window).outerWidth() < 1199) {
        new Glide('.komanda .glide', {
            type: 'carousel',
            startAt: 0,
            perView: 4,
            focusAt: "center",
            animationDuration: 800,
            autoplay: 3000,
            hoverpause: false,
        }).mount()
        new Glide('.fotoalbom .glide', {
            type: 'carousel',
            startAt: 0,
            perView: 2,
            focusAt: "center",
            animationDuration: 600,
            autoplay: 3000,
            hoverpause: false,
        }).mount()
    } else {
        new Glide('.fotoalbom .glide', {
            type: 'carousel',
            startAt: 0,
            perView: 2,
            focusAt: "center",
            animationDuration: 600,
            autoplay: 3000,
            hoverpause: false,
        }).mount()

        new Glide('.komanda .glide', {
            type: 'carousel',
            startAt: 0,
            perView: 5,
            focusAt: "center",
            animationDuration: 800,
            autoplay: 3000,
            hoverpause: false,
        }).mount()
    }
}
glideSize()
window.addEventListener("resize", event => {
    glideSize()
})
// GLIDE
</script>