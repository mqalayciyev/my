<div class="col-md-9">
    <div class="card card-primary card-outline">
        <div class="card-header clearfix">
            <?php
                        $typeObj = array("inbox" => "Gələnlər qutusu", "sent" => "Göndərildi", "archive" => "Arxiv", "trash" => "Zibil qutusu");
                        $type = (isset($_GET['s'])) ? $_GET['s'] : "inbox";
                        $type = $typeObj[$type];
                    ?>
            <h3 class="card-title float-left"><?=$type?></h3>

            <div class="card-tools float-right">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Search Mail">
                    <div class="input-group-append">
                        <div class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
            <div class="mailbox-controls">
                <!-- Check all button -->
                <button id="check-all-list" type="button" class="btn btn-default btn checkbox-toggle">
                    <i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                    <button type="button" class="btn-trash btn btn-default btn-sm">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    <?php
                                if(isset($_GET['s']) && ($_GET['s'] == "trash" || $_GET['s'] == "archive")){
                                    echo '<button type="button" class="btn-folder btn btn-default btn-sm">
                                            <i class="fas fa-folder"></i>
                                        </button>';
                                }
                                else{
                                    echo '<button type="button" class="btn-archive btn btn-default btn-sm">
                                            <i class="fas fa-archive"></i>
                                        </button>';
                                }
                            ?>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn-reload btn btn-default btn-sm">
                    <i class="fas fa-sync-alt"></i>
                </button>
                <div class="float-right">
                    1-50/200
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
            </div>
            <div class="table-responsive mailbox-messages">
                <table class="table table-hover table-striped">
                    <tbody>
                        <?php
                                $type = (isset($_GET['s'])) ? $_GET['s'] : "inbox";
                                $sql = "SELECT * FROM mail WHERE `type` = '$type' ORDER BY `tarix` DESC";
                                $query = mysqli_query($conn, $sql);
                                echo (mysqli_num_rows($query) == 0) ? "<h2 class='px-3 m-0'>Boş</h2>" : null;
                                while($res = mysqli_fetch_assoc($query)){
                                    
                                    $text = $res['text'];
                                    $status = $res['status'];
                                    $text = substr($text, 0, 30) . "...";
                                    $date = date_create($res['tarix']);
                                    $date = date_format($date, "d-m-Y H:i:s");
                                    $font_weight = ($status == 0) ? "bold" : "normal";
                                    if($res['type'] == "inbox" || $res['type'] == "sent"){
                                        $td = '<td title="Arxiv" class="mailbox-star"><a href="config.php?query=mail_type&url=inbox&type=archive&id='.$res['id'].'"><i class="fas fa-archive"></i></a>
                                        </td>';
                                    }
                                    else{
                                        $td = null;
                                    }
                                    echo '<tr>
                                    <td>
                                        <div class="icheck-primary">
                                            <input type="checkbox" name="mail-check" value="" id="'.$res['id'].'">
                                            <label for="'.$res['id'].'"></label>
                                        </div>
                                    </td>
                                    '.$td.'
                                    <td class="mailbox-name" style="font-weight: '.$font_weight.'"><a href="admin.php?page=mail&q=readmail&id='.$res['id'].'">'.$res['name'].'</a></td>
                                    <td class="mailbox-subject" style="font-weight: '.$font_weight.'">'.$text.'</td>
                                    <td class="mailbox-attachment"></td>
                                    <td class="mailbox-date">'.$date.'</td>
                                </tr>';
                                }
                                ?>
                    </tbody>
                </table>
                <!-- /.table -->
            </div>
            <!-- /.mail-box-messages -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer p-0">
            <div class="mailbox-controls">
                <!-- Check all button -->
                <button type="button" class="btn btn-default btn-sm checkbox-toggle">
                    <i class="far fa-square"></i>
                </button>
                <div class="btn-group">
                    <button type="button" class="btn-trash btn btn-default btn-sm">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    <?php
                                if(isset($_GET['s']) && ($_GET['s'] == "trash" || $_GET['s'] == "archive")){
                                    echo '<button type="button" class="btn-folder btn btn-default btn-sm">
                                            <i class="fas fa-folder"></i>
                                        </button>';
                                }
                                else{
                                    echo '<button type="button" class="btn-archive btn btn-default btn-sm">
                                            <i class="fas fa-archive"></i>
                                        </button>';
                                }
                            ?>
                </div>
                <!-- /.btn-group -->
                <button type="button" class="btn-reload btn btn-default btn-sm">
                    <i class="fas fa-sync-alt"></i>
                </button>
                <div class="float-right">
                    1-50/200
                    <div class="btn-group">
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <!-- /.btn-group -->
                </div>
                <!-- /.float-right -->
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>