<?php
if(!isset($_GET['page']) && $_GET['page'] !== "news"){
    header("Location: index.php?page=news");
}

$url ='http://localhost/start/zaqatalapfk/?page=news';

?>



<div class="news col-12 justify-content-center bg-light py-5 px-3">
    <div class="row">    
        <div class="col-12 ">
            
            
                <?php


                    if(!isset($_GET['id'])){
                        
                        $imagePerPage = 10;
                        $images = [];

                        $sql = "SELECT * FROM `news` WHERE `status`=1 ORDER BY `tarix` DESC";
                        $query = mysqli_query($conn, $sql);
                        while($response = mysqli_fetch_assoc($query)){
                            $obj = ["id" => $response['id'], "image" => $response['image'], "etiket" => $response['etiket'], "tarix" => $response['tarix'], "metn" => $response['metn'], "basliq" => $response['basliq'],];
                            array_push($images, $obj);
                        }

                        $currentPage = (isset($_GET['p'])) ? $_GET['p'] : 1;

                        $indexOfLastImage = $currentPage * $imagePerPage;
                        $indexOfFirstImage = $indexOfLastImage - $imagePerPage;
                        
                        $currentImages = array_slice($images, $indexOfFirstImage, $imagePerPage);
                        $totalPagesNum = ceil(count($images)/$imagePerPage);
                        if(count($currentImages) > 0){
                            echo '<h2 class="header-group header-group-small my-4 d-none">Xəbərlər</h2>';
                            echo '<div class="row justify-content-center px-3">';
                            for($i = 0; $i < count($currentImages); $i++){
                                echo "
                                <div class='news-div position-relative mb-4 '>
                                    <a href='$url&id=".$currentImages[$i]['id']."'>
                                    <img src='media/news/".$currentImages[$i]['image']."' class='w-100' alt='".$currentImages[$i]['image']."'>
                                    <div class='col-12 px-4 pt-2'>
                                        <span class='py-1 px-2'>".$currentImages[$i]['etiket']."</span>
                                        <p class='date'><i class='far fa-calendar'></i> <i> ".$currentImages[$i]['tarix']."</i></p>
                                        <h4>".$currentImages[$i]['basliq']."</h4>
                                        <p>".$currentImages[$i]['metn']."</p>
                                    </div>
                                    </a>
                                </div>";
                            }
                            echo '</div>';
                        }
                        else{
                            require "404.php";
                        }
                        $display = (count($currentImages) == 0) ? "d-none" : null;
                        echo '<div class="col-12 '. $display . '">
                                <div class="row justify-content-center">
                                    <nav aria-label="...">
                                        <ul class="pagination">';
                        $prevDisabled = ($currentPage == 1 || count($currentImages) == 0) ? "disabled" : null;
                        $nextDisabled = ($currentPage >= $totalPagesNum) ? "disabled" : null;
                        $prev = $currentPage - 1;
                        $next = $currentPage + 1;
                        echo "<li class='page-item $prevDisabled'><a class='page-link' href='index.php?page=news&p=$prev'>Previous</a></li>";
                        for($i = 1; $i <= $totalPagesNum; $i++){
                            $active = ($i == $currentPage) ? "active" : null;
                            echo "<li class='page-item $active'><a class='page-link' href='index.php?page=news&p=$i'>$i</a></li>";
                        }
                        echo "<li class='page-item $nextDisabled'><a class='page-link' href='index.php?page=news&p=$next'>Next</a></li>";
                                    
                        echo '</ul></nav></div></div>';
                    }
                    else{
                        $sql = "SELECT * FROM `news` WHERE `id`='".$_GET['id']."'";
                        $query = mysqli_query($conn, $sql);
                        if(mysqli_num_rows($query) == 0){
                            require "404.php";
                        }
                        else{
                            $response = mysqli_fetch_assoc($query);
                            echo "<div class='col-12'>
                                            <div class='row'>
                                            <div class='col-12 px-0'>
                                            <p class='col-12 px-0'>
                                            <a href='$url'>Xəbərlər</a> / ".$response['basliq']."
                                            </p>
                                            <div class='row justify-content-center my-3'>
                                            <div class='col-12 px-0'><img class='col-12' src='media/news/".$response['image']."'></div>
                                            
                                            </div>
                                            <h2>".$response['basliq']."</h2>
                                            <p> <i class='far fa-calendar'></i> <i> ".$response['tarix']."</i> <i class='fas fa-eye'></i> <i>".$response['baxis']."</i></p>
                                            <p class='text-justify'>".$response['metn']."</p>
                                            <div class='row justify-content-around mt-5'>";
                            $sql = "SELECT * FROM `news_media` WHERE news='".$_GET['id']."'";
                            $query = mysqli_query($conn, $sql);
                            while($res = mysqli_fetch_assoc($query)){
                                if($res['type'] === "image"){
                                    echo "<div class='col-11 col-lg-5 p-0'>
                                        <img src='media/news/".$res['media']."' alt='".$res['media']."' class='w-100' />
                                    </div>";
                                }
                                else{
                                    echo "<div class='col-11 col-lg-5 p-0'>
                                        <video src='media/news/video/".$res['media']."' class='w-100' controls></video>
                                    </div>";
                                }
                            }
                            echo "</div></div></div></div>";
                        }
                        
                    }

                ?>
        </div>
        
    </div>
</div>
<script src="js/scroll.js"></script>