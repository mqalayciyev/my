<?php
if(!isset($_SESSION["admin"])){
    header("Location: ../index.php");
}

?>
<div class="content-wrapper py-3 mb-5">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="admin.php?page=mail&q=compase" class="btn btn-primary btn-block mb-3">Compose</a>

                <div class="card">
                    <div class="card-body p-0">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item active">
                                <a href="admin.php?page=mail&q=maillist" class="nav-link">
                                    <i class="fas fa-inbox"></i> Inbox
                                    <?php
                                        
                                        $sql = "SELECT * FROM mail WHERE `type` = 'inbox' AND `status` = 0";
                                        $query = mysqli_query($conn, $sql);
                                        $count = mysqli_num_rows($query);

                                        echo  ($count != 0) ? '<span class="badge bg-primary text-white float-right">'.$count.'</span>' : null;
                                                                            
                                    ?>
                                    
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="admin.php?page=mail&q=maillist&s=sent" class="nav-link">
                                    <i class="far fa-envelope"></i> Sent
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="admin.php?page=mail&q=maillist&s=archive" class="nav-link">
                                    <i class="fas fa-archive"></i> Archive
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="admin.php?page=mail&q=maillist&s=trash" class="nav-link">
                                    <i class="far fa-trash-alt"></i> Trash
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <!-- /.col -->
            <?php
        
            $q = (isset($_GET['q'])) ? $_GET['q'] : "maillist";
            $q = $q . ".php";
            require $q;
        
        ?>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</div>
</section>
<script src="js/mail.js"></script>