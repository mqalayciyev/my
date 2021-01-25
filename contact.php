<?php
if(!isset($_GET['page']) && $_GET['page'] !== "contact"){
    header("Location: index.php?page=contact");
}


$sql = "SELECT * FROM `contact`";
$response = mysqli_fetch_assoc(mysqli_query($conn, $sql));
$map = $response['map'];
$ofis = $response['ofis'];
$stadium = $response['stadium'];
$email = $response['email'];

?>

<div class="col-12 contact py-0">
	<div class="row pt-0">
		

		<div class="form-section col-12 col-lg-7">
			<div class="col-12">
				<h2 class="header-group header-group-small mt-5 mb-4">Bizə Yazın</h2>
			</div>			
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
			<div class="col-12 pb-3">
				<form action="inc/data.php" method="POST">
					<input type="hidden" name="query" value="send_mail">
					<div class="row">
						<div class="col-6">
							<label for="name" class="">Adınız Soyadınız</label>
							<input type="text" required name="name" class="form-control mb-3" placeholder="Ad Soyad">
						</div>
						<div class="col-6">
							<label for="email"  class="">Email adresiniz<mask>*</mask></label>
							<input type="email" required name="email" class="form-control mb-3" placeholder="info@zaqatalapfk.com">
						</div>
					</div>
					
					
					<label for="text" class="">Sizə necə kömək edə bilərik?<mask>*</mask></label>
					<textarea required class="form-control" placeholder="Mətin daxil edin.." name="text"></textarea>
					<input type="submit" name="send" value="Göndər" class="btn btn-success col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mt-3 font-weight-bold">
				</form>
				<p class="mt-3">Mesaj göndərərək Gizlilik Siyasətimizi qəbul edirsiniz</p>
				<p><mask>*</mask> Tələb olunan sahə</p>
			</div>
		</div>
		<div class="addresbar col-12 col-lg-5 py-4 py-lg-0">
			<div class="row justify-content-center h-100 align-content-center">
				<div class="col-12 style">
					<div class="row justify-content-center">
						<div class="col-12 col-lg-8">
							<div class="row justify-content-center">
								<div class="address btn-new">
									<span></span><p class="m-0"><i class="fas fa-map-marker-alt"></i></p>
								</div>
							</div>
						<h3 class="col-12 text-center my-2">Zaqatala pfk</h3>
						<p class="col-12 text-center m-0"><?=$ofis?></p>
						</div>
						
					</div>
				</div>

				<div class="col-12 my-5 style">
					<div class="row justify-content-center">
					<div class="col-12 col-lg-8">
							<div class="row justify-content-center">
								<div class="stadium-address btn-new">
									<span></span><p class="m-0"><i class="fas fa-home"></i></p>
								</div>
							</div>
						
						<h3 class="col-12 text-center my-2">Zaqatala pfk Stadionu</h3>
						<p class="col-12 text-center m-0"><?=$stadium?></p>
						</div>
					</div>
				</div>

				<div class="col-12 style">
					<div class="row justify-content-center">
						<div class="col-12 col-lg-8">
							<div class="row justify-content-center">
								<div class="email btn-new">
									<span></span><p class="m-0"><i class="fas fa-envelope"></i></p>
								</div>
							</div>
							<h3 class="col-12 text-center my-2">email</h3>
							<p class="col-12 text-center m-0"><?=$email?></p>
						</div>
						
						
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 px-3 px-lg-5 my-5">
			<div class="row justify-content-center">
				<div class="mapouter col-12 px-0 px-lg-3">
					<div class="gmap_canvas col-12">
						<iframe class="col-12" height="400" id="gmap_canvas" src="<?=$map?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

