<?php
$id = $_GET['id'];
mysqli_query($conn, "UPDATE `mail` SET `status` = 1 WHERE `id` = '$id'");
$sql = "SELECT * FROM mail WHERE `id` = '$id'";
$res = mysqli_fetch_assoc(mysqli_query($conn, $sql));
$ay_arr = ['Yanvar', 'Fevral', 'Mart', 'Aprel', 'May', 'İyun', 'İyul', 'Avqust', 'Sentyabr', 'Oktyabr', 'Noyabr', 'Dekabr'];

$name = $res['name'];
$email = $res['email'];
$date = date_create($res['tarix']);
$date = date_format($date, "d-m-Y H:i:s");
$date = explode(" ", $date);
$time = $date[1];
$date = $date[0];
$date = explode("-", $date);
$day = trim($date[0], "0");
$month = $ay_arr[trim($date[1], "0")-1];
$year = $date[2];
$date = $day . " " .$month. " " .$year. " " . $time;
$text = $res['text'];


?>

<div class="col-md-9">
    <div class="card card-primary card-outline">
        <div class="card-header">
            <h3 class="card-title"><?=$name?></h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="mailbox-read-info m-0 p-3">
                <h6 class="m-0 p-0">From: <?=$email?>
                    <span class="mailbox-read-time float-right"><?=$date?></span>
                </h6>
            </div>
            <hr>
            <!-- /.mailbox-read-info -->
            <div class="mailbox-read-message p-3">
                <p><?=$text?></p>
            </div>
            <!-- /.mailbox-read-message -->
        </div>
        <!-- /.card-footer -->
        <div class="card-footer">
            <div class="float-right">
                <button type="button" class="btn btn-default"><i class="fas fa-reply"></i> Reply</button>
                <!-- <button type="button" class="btn btn-default"><i class="fas fa-share"></i> Forward</button> -->
            </div>
            <button type="button" class="btn btn-default"><i class="far fa-trash-alt"></i> Delete</button>
            <!-- <button type="button" class="btn btn-default"><i class="fas fa-print"></i> Print</button> -->
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
</div>