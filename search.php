<?php
if(!isset($_GET['page']) && $_GET['page'] !== "search"){
    header("Location: index.php?page=search&search=&button=search");
}


?>

<div class="col-12 px-0">
    <div id="search" class="">
        <form class="col-12 px-0" action="index.php?page=search" method="get">
            <div class="input-group border border-secondary">
                <input type="hidden" name="page" value="search">
                <input type="search" class="form-control col-12 border-0" name="search" value="<?=$_GET['search']?>" placeholder="Axtarış . . .">
                <div class="input-group-append" style="z-index: 0;">
                    <button type="submit" class="btn btn-outline-dark bg-white border-0 rounded-0" name="button" value="search">
                        <i class="fas fa-search i-text"></i></button>
                </div>
            </div>
        </form>
        <?php
        $search = $_GET['search'];
        $sql = "";
        $count = 0;
        if(trim($search) !== ""){
            $sql = "SELECT * FROM `news` WHERE `status` = 1 AND `basliq` LIKE '%$search%' OR `metn` LIKE '%$search%' OR `tarix` LIKE '%$search%'";
            $query = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($query);
        }
        
        ?>

        <h3 class="my-4"><?=$count?> Nəticə "<?=$_GET['search']?>"</h3>

        <div class="w-100 results">
            <?php
                if(isset($query)){
                    while($res = mysqli_fetch_assoc($query)){
                        $id = $res['id'];
                        $tarix = $res['tarix'];
                        echo '<div class="col-12  my-3">
                        <div class="row bg-white h-100">
                            <div class="col-12 col-xl-3 px-0">
                                <img src="media/news/'.$res['image'].'" class="w-100" alt="'.$res['image'].'">
                            </div>
                            <div class="col-12 col-xl-9 align-self-center">
                                <a href="index.php?page=news&id='.$id.'"><h4>'.$res['basliq'].'</h4></a>
                                <p>'.$res['metn'].'</p>
                                <span>'.$tarix.' | Xəbərlər</span>
        
                            </div>
                        </div>
                    </div>';
                    }
                }
                
            
            ?>

            
            
        </div>
    </div>

</div>