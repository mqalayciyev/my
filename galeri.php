<?php

if(!isset($_GET['page']) && $_GET['page'] !== "galeri"){
    header("Location: index.php?page=galeri");
}

?>
<div class="col-12 galeri  py-5">
    

    
        <?php
            $imagePerPage = 10;
            $images = [];
            $sql = "SELECT * FROM galeri WHERE `status`=1";
            $query = mysqli_query($conn, $sql);
            while($response = mysqli_fetch_assoc($query)){
                array_push($images, $response['image']);
            }

            $currentPage = (isset($_GET['p'])) ? $_GET['p'] : 1;

            $indexOfLastImage = $currentPage * $imagePerPage;
            $indexOfFirstImage = $indexOfLastImage - $imagePerPage;
            
            $currentImages = array_slice($images, $indexOfFirstImage, $imagePerPage);
            $totalPagesNum = ceil(count($images)/$imagePerPage);
            if(count($currentImages) > 0){
                echo '<div class="col-12 p-1">
                        <h2 class="header-group header-group-small my-4">Fotoalbom</h2>
                    </div>';
                echo '<div class="img-full card-columns pt-2 pb-4 px-0">';
                for($i = 0; $i < count($currentImages); $i++){
                    echo '<div class="card">
                            <img class="card-img-top img-fluid" src="media/albom/'.$currentImages[$i].'" alt="'.$currentImages[$i].'">
                        </div>';
                }
                echo '</div>';
            }
            else{
                require "404.php";
            }
            
        ?>
    
    <div class="col-12 <?php echo (count($currentImages) == 0) ? "d-none" : null ?>">
        <div class="row justify-content-center">
            <nav aria-label="...">
                <ul class="pagination">
                    <?php
                        $prevDisabled = ($currentPage == 1 || count($currentImages) == 0) ? "disabled" : null;
                        $nextDisabled = ($currentPage >= $totalPagesNum) ? "disabled" : null;
                        $prev = $currentPage - 1;
                        $next = $currentPage + 1;
                        echo "<li class='page-item $prevDisabled'><a class='page-link' href='index.php?page=galeri&p=$prev'>Previous</a></li>";
                        for($i = 1; $i <= $totalPagesNum; $i++){
                            $active = ($i == $currentPage) ? "active" : null;
                            echo "<li class='page-item $active'><a class='page-link' href='index.php?page=galeri&p=$i'>$i</a></li>";
                        }
                        echo "<li class='page-item $nextDisabled'><a class='page-link' href='index.php?page=galeri&p=$next'>Next</a></li>";
                    ?>
                </ul>
            </nav>
        </div>
    </div>
    
</div>
<script src="js/scroll.js"></script>