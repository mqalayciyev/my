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
				format: 'jpeg',
				quality: 1,
			}).then(function (response) {
                if(url !== undefined){
                    $.ajax({
                        url: "config.php?query=upload_image_galeri",
                        type: "POST",
                        data: {image: response},
                        success: function (data) {
							location.reload();
                        },
                    });
                }
                else{
                    alert("Change File")
                }
			});
	});
});
