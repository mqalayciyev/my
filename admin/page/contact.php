<?php

if(!isset($_SESSION["admin"])){
    header("Location: ../index.php");
}

$sql = "SELECT * FROM `contact`";
$response = mysqli_fetch_assoc(mysqli_query($conn, $sql));
$action = "add_contact_info";
$ofis = isset($response["ofis"]) ? $response["ofis"] : "";
$stadion = isset($response["stadium"]) ? $response["stadium"] : "";
$email = isset($response["email"]) ? $response["email"] : "";
$map = isset($response["map"]) ? $response["map"] : "";
$facebook = isset($response["facebook"]) ? $response["facebook"] : "";
$instagram = isset($response["instagram"]) ? $response["instagram"] : "";
$twitter = isset($response["twitter"]) ? $response["twitter"] : "";
$youtube = isset($response["youtube"]) ? $response["youtube"] : "";
$id = isset($response["id"]) ? $response["id"] : "";
if(isset($_GET['query'])){
    $action = "edit_contact_info";
    $ofis_i = $ofis;
    $stadion_i = $stadion;
    $email_i = $email ;
    $map_i = $map;
    $facebook_i = $facebook;
    $instagram_i = $instagram;
    $twitter_i = $twitter;
    $youtube_i = $youtube;
}
else{
    $action = "add_contact_info";
    $ofis_i = null;
    $stadion_i = null;
    $email_i = null ;
    $map_i = null;
    $facebook_i = null;
    $instagram_i = null;
    $twitter_i = null;
    $youtube_i = null;
}

?>
<div id="about" class="row">
    <div class="col-12 py-3 mb-5">
        <h2>Elaqe</h2>
        <div class="row">

            <div class="col-12">
                <?php

                    if(isset($_SESSION['error'])){
                        echo '<div class="alert alert-danger col-12">'.$_SESSION['error'].'</div>';
                        unset($_SESSION['error']);
                    }
                    else if(isset($_SESSION['success'])){
                        echo '<div class="alert alert-success col-12">'.$_SESSION['success'].'</div>';
                        unset($_SESSION['success']);
                    }
                    else{
                        echo null;
                    }


                ?>
            </div>
            <div class="col-12">
                <form method="get" action="config.php">
                    <div class="col-12 border rounded p-3">
                        <input type="hidden" name="query" value="<?=$action?>">
                        <input type="hidden" name="id" value="<?=$id?>">
                        <input type="text" name="ofis" value="<?=$ofis_i?>" class="form-control mb-2"
                            placeholder="Ofis unvani">
                        <input type="text" name="stadion" value="<?=$stadion_i?>" class="form-control mb-2"
                            placeholder="Stadion unvani">
                        <input type="text" name="email" value="<?=$email_i?>" class="form-control mb-2"
                            placeholder="Email adresi">
                        <input type="text" name="map" value="<?=$map_i?>" class="form-control mb-2"
                            placeholder="Xerite">
                        <input type="text" name="facebook" value="<?=$facebook_i?>" placeholder="Facebook" class="form-control mb-2">
                        <input type="text" name="instagram" value="<?=$instagram_i?>" placeholder="Instagram" class="form-control mb-2">
                        <input type="text" name="twitter" value="<?=$twitter_i?>" placeholder="Twitter" class="form-control mb-2">
                        <input type="text" name="youtube" value="<?=$youtube_i?>" placeholder="Youtube" class="form-control mb-2">
                        <button id="save" type="submit" class="btn btn-success">Saxla</button>
                        <button id="cancel" type="reset" class="btn btn-danger"><a
                                style="text-decoration: none; color: white;" href="admin.php?page=contact">Ləğv
                                et</a></button>
                    </div>
                </form>
            </div>
            <div class="col-12 my-3">
                <div class="col-12 border rounded">
                    <div class="row h-100 align-items-center">
                        <div class="col-11 p-3">
                            <p><span>Ofis unavni : </span><?=$ofis?></p>
                            <p><span>Stadion unavni : </span><?=$stadion?></p>
                            <p><span>Email : </span><?=$email?></p>
                            <p><span>Xerite : </span><a href="<?=$map?>"><?=$map?></a></p>
                            <p><span>Facebook : </span><a href="<?=$map?>"><?=$facebook?></a></p>
                            <p><span>Instagram : </span><a href="<?=$map?>"><?=$instagram?></a></p>
                            <p><span>Twitter : </span><a href="<?=$map?>"><?=$twitter?></a></p>
                            <p><span>Youtube : </span><a href="<?=$map?>"><?=$youtube?></a></p>
                        </div>
                        <div class="col-1">
                            <ul class="list-inline row text-center m-0">
                                <li class="w-100 text-justify"><a href="admin.php?page=contact&query=edit"><i
                                            class="fas fa-edit fa-2x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>