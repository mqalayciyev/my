<div class="col-12 p-3">
    <div class="row">
        <div class="col-12">
            <div class="info-box border row w-25 p-2 bg-white">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <?php
                    $sql = "SELECT * FROM `visitors`";
                    $count = mysqli_num_rows(mysqli_query($conn, $sql));
                ?>
                <div class="info-box-content">
                    <span class="info-box-text">Ziyarətçilər</span>
                    <span class="info-box-number"><?=$count?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        
        <!-- /.info-box -->
    </div>
</div>