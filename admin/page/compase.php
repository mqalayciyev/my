<?php
if(!isset($_SESSION["admin"])){
    header("Location: ../index.php");
}

?>
<div class="col-md-9">
    <div class="card card-primary card-outline">
        <form action="config.php" method="post">
            <div class="card-header">
                <h3 class="card-title">Yeni Mesaj Yaradın</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php 
                    if(isset($_SESSION['error'])){
                        echo '<div class="alert alert-danger col-12">'.$_SESSION['error'].'</div>';
                        unset($_SESSION['error']);
                    }
                    elseif(isset($_SESSION['success'])){
                        echo '<div class="alert alert-success col-12">'.$_SESSION['success'].'</div>';
                        unset($_SESSION['success']);
                    }
                    else{
                        echo null;
                    }
                    
                    
                ?>
                <div class="form-group">
                    <input type="hidden" name="query" value="send_mail">
                    <input type="email" required name="to" class="form-control" placeholder="To:">
                </div>
                <div class="form-group">
                    <input type="hidden" name="query" value="send_mail">
                    <input type="email" required name="from" class="form-control" placeholder="Your Email:">
                </div>
                <div class="form-group">
                    <input type="text" required name="subject" class="form-control" placeholder="Subject:">
                </div>
                <div class="form-group">
                    <textarea name="message" required class="form-control" rows="10" placeholder="Message Text"></textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <div class="float-right">
                    <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Göndər</button>
                </div>
                <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Ləğv et</button>
            </div>
        </form>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
</div>

