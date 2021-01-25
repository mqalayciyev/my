$(document).ready(() => {
	var resize = $("#file #image_demo").croppie({
		viewport: { width: 600, height: 350, type: "" },
		boundary: { width: 610, height: 360 },
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
	var or = 2;
	$("#file .vanilla-rotate").on("click", function (ev) {
		resize.croppie("bind", {
			url: url,
			orientation: or,
		});
		if (or == 8) {
			or = 2;
		} else {
			or = or + 1;
		}
    });
    $("#file").find("#cancel").on("click", () => {
        url = undefined
    })

	$("#file .crop_image").click(function (event) {
		resize.croppie("result", {
				type: "canvas",
                size: {width: 1920, height: 1080},
				format: 'jpg',
				quality: 1,
			}).then(function (response) {
                const text = $("#file").find("textarea[name='text']").val()
				const action = $("#file").find("input[name='query']").val()
				const id = $("#file").find("input[name='id']").val()
				if(action === "edit"){
					if(text !== "" && text !== undefined){
						if(url !== undefined){
							$.ajax({
								url: "config.php",
								type: "POST",
								data: {query: "edit_about_info", id: id, text: text, image: response },
								success: function (data) {
									location.href = "admin.php?page=about";
								},
							});
						}
						else{
							$.ajax({
								url: "config.php",
								type: "POST",
								data: {query: "edit_about_info", id: id, text: text, image: "" },
								success: function (data) {
									location.href = "admin.php?page=about";
								},
							});
						}
						
					}
					else{
						alert("Mətn daxil edin ! ! !");
					}
				}
				else{
					if(url !== undefined && text !== "" && text !== undefined){
						$.ajax({
							url: "config.php",
							type: "POST",
							data: {query: "add_about_info", text: text, image: response },
							success: function (data) {
								location.href = "admin.php?page=about";
							},
						});
					}
					else{
						alert("Şəkil və ya Mətn daxil edin ! ! !");
					}
				}
			});
	});
});

function rotateIMG(id, event){
	const img = event.target.nextElementSibling;
	let rotate = ""
	if(img.style.transform == "rotateY(0deg)"){
		rotate = "180deg"
		img.style.transform = "rotateY("+rotate+")"
	}
	else{
		rotate = "0deg"
		img.style.transform = "rotateY("+rotate+")"
	}
	$.ajax({
		url: "config.php",
		type: "GET",
		data: {query: "edit_about_image_rotate", id, rotate},
		success: function (data) {
			console.log(data);
		},
	});
}
