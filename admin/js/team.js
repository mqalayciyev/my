$(document).ready(() => {
	var resize = $("#file #image_demo").croppie({
		viewport: { width: 280, height: 390, type: "" },
		boundary: { width: 300, height: 410 },
		showZoomer: true,
		enableResize: false,
		enableOrientation: true,
		mouseWheelZoom: "ctrl",
	});
	var url;
	$("#file #upload_image").on("change", function () {
		var reader = new FileReader();

		reader.onload = function (event) {
			url = event.target.result;
			resize.croppie("bind", {
					url: event.target.result,
				}).then(function () {
					console.log("jQuery bind complete");
				});
		};
		reader.readAsDataURL(this.files[0]);
	});

	$("#file").find("#cancel").on("click", () => {
        url = undefined
	})
	
	$("#file .crop_image").click(function (event) {
		resize.croppie("result", {
				type: "canvas",
				size: {width: 1300, height: 1920},
				format: "jpg",
				quality: 1,
			}).then(function (response) {
				const action = $("#file").find("input[name='query']").val()
				const id = $("#file").find("input[name='id']").val()
				const movqe = $("#file").find("select[name='position']").val()
				const name = $("#file").find("input[name='name']").val()
				const number = $("#file").find("input[name='number']").val()
				const date = $("#file").find("input[name='date']").val()
				const country = $("#file").find("input[name='country']").val()
				const facebook = $("#file").find("input[name='facebook']").val()
				const instagram = $("#file").find("input[name='instagram']").val()
				const twitter = $("#file").find("input[name='twitter']").val()
				const youtube = $("#file").find("input[name='youtube']").val()
				if(action === "edit"){
					if(movqe.length > 0 && name.length > 0){
						if(url !== undefined){
							$.ajax({
								url: "config.php",
								type: "POST",
								data: {query: "edit_team", id, name, movqe, number, date, country, facebook, instagram, twitter, youtube, image: response },
								success: function (data) {
									location.href = "admin.php?page=team";

								},
							});
						}
						else{
							$.ajax({
								url: "config.php",
								type: "POST",
								data: {query: "edit_team", id, name, movqe, number, date, country, facebook, instagram, twitter, youtube, image: "" },
								success: function (data) {
									location.href = "admin.php?page=team";

								},
							});
						}
						
					}
					else{
						alert("Oyunçu adı və mövqeyi boş ola bilməz ! ! !");
					}
				}
				else{
					if(url !== undefined && movqe.length > 0 && name.length > 0){
						$.ajax({
							url: "config.php",
							type: "POST",
							data: {query: "add_team", name, movqe, number, date, country, facebook, instagram, twitter, youtube, image: response },
							success: function (data) {
								location.href = "admin.php?page=team";

							},
						});
					}
					else if(url === undefined && movqe.length > 0 && name.length > 0){
						$.ajax({
							url: "config.php",
							type: "POST",
							data: {query: "add_team", name, movqe, number, date, country, facebook, instagram, twitter, youtube, image: "" },
							success: function (data) {
								location.href = "admin.php?page=team";
							},
						});
					}
					else{
						alert("Xanaları doldurun ! ! !");
					}
				}
			});
	});
});
