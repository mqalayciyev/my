<?php
if(!isset($_SESSION["admin"])){
    header("Location: ../index.php");
}

?>


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

        <div class="col-12 mt-3">
            <h3>Ziyarətçilər</h3>
            <div class="table-responsive" ng-style="durum && {'max-width': '75vw'}">
                <table class="table table-hover">
                    <thead class="thead-dark border border-dark">
                        <tr>
                            <th>IP</th>
                            <th>HOST</th>
                            <th>TARIYICI</th>
                            <th>GELDIGI ADRES</th>
                            <th>TARAICI DILI</th>
                            <th>SUNUCU PROTOKOLU</th>
                            <th>KARAKTER SETI</th>
                            <th>ISTEK METODU</th>
                            <th>UZOK PORT</th>
                            <th>PROXY IP</th>
                            <th>COOKIE</th>
                            <th>TARIX</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM `visitors`";
                            $query = mysqli_query($conn, $sql);
                            while($res = mysqli_fetch_assoc($query)){
                                echo "<tr>";
                                echo "<td>".$res['ip']."</td>";
                                echo "<td>".$res['host']."</td>";
                                echo "<td>".$res['tarayici']."</td>";
                                echo "<td>".$res['geldigi_adres']."</td>";
                                echo "<td>".$res['tarayici_dili']."</td>";
                                echo "<td>".$res['sunucu_protokolu']."</td>";
                                echo "<td>".$res['karakter_seti']."</td>";
                                echo "<td>".$res['istek_metodu']."</td>";
                                echo "<td>".$res['uzak_port']."</td>";
                                echo "<td>".$res['proxy_ip']."</td>";
                                echo "<td>".$res['cookie']."</td>";
                                echo "<td>".$res['tarix']."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>