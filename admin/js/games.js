$(document).ready(() => {
	var resize = $("#file #image_demo").croppie({
		viewport: { width: 150, height: 150, type: "" },
		boundary: { width: 160, height: 160 },
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
			resize
				.croppie("bind", {
					url: event.target.result,
				})
				.then(function () {
					console.log("jQuery bind complete");
				});
		};
		reader.readAsDataURL(this.files[0]);
	});

	$("#file")
		.find("#cancel")
		.on("click", () => {
			url = undefined;
		});

	$("#file .crop_image").click(function (event) {
		resize
			.croppie("result", {
				type: "canvas",
				size: "original",
				format: "jpg",
				quality: 2,
			})
			.then(function (response) {});
	});

	/// FILE - 2
	var resize_2 = $("#file_2 #image_demo").croppie({
		viewport: { width: 150, height: 150 },
		boundary: { width: 160, height: 160 },
		showZoomer: true,
		enableResize: false,
		enableOrientation: true,
		mouseWheelZoom: "ctrl",
	});
	var url_2;
	$("#file_2 #upload_image").on("change", function () {
		var reader = new FileReader();

		reader.onload = function (event) {
			url_2 = event.target.result;
			resize_2
				.croppie("bind", {
					url: event.target.result,
				})
				.then(function () {
					console.log("jQuery bind complete");
				});
		};
		reader.readAsDataURL(this.files[0]);
	});

	$("#cancel").on("click", () => {
        url = undefined
        url_2 = undefined
	})

	$("#save").click(function (event) {
        event.preventDefault()
        const action = $("input[name='query']").val()
        const id = $("input[name='id']").val()
        if(action == "edit"){
            const team_1_qol = $("input[name='team_1_qol']").val()
            const team_2_qol = $("input[name='team_2_qol']").val()
            if(url !== undefined && url_2 !== undefined){
                resize.croppie("result", {
                    type: "canvas",
                    size: {width: 1080, height: 1080},
                    format: "jpg",
                    quality: 1,
                }).then(function (response_1) {
                    resize_2.croppie("result", {
                        type: "canvas",
                        size: {width: 1080, height: 1080},
                        format: "jpg",
                        quality: 1,
                    }).then(function (response_2) {
                        const oyun = $("input[name='oyun']").val()
                        const stadion = $("input[name='stadion']").val()
                        const date = $("input[name='date']").val()
                        const gorus = $("select[name='gorus']").val()
                        const komanda_1 = $("input[name='komanda-1']").val()
                        const komanda_2 = $("input[name='komanda-2']").val()
                        $.ajax({
                            url: "config.php",
                            type: "POST",
                            data: {query: "edit_games", id, oyun, stadion, date, gorus, komanda_1, team_1_qol: team_1_qol, komanda_2, team_2_qol: team_2_qol, logo_1: response_1, logo_2: response_2},
                            success: function(data){
                                console.log(data);
                                if(data == "null"){
                                    alert("Bütün xanaları doldurun.")
                                }
                                if(data == "Success"){
                                    location.reload();
                                }
                            }
                        })
                    });
                });
            }
            else{
                const oyun = $("input[name='oyun']").val()
                const stadion = $("input[name='stadion']").val()
                const date = $("input[name='date']").val()
                const gorus = $("select[name='gorus']").val()
                const komanda_1 = $("input[name='komanda-1']").val()
                const komanda_2 = $("input[name='komanda-2']").val()
                $.ajax({
                    url: "config.php",
                    type: "POST",
                    data: {query: "edit_games", id, oyun, stadion, date, gorus, komanda_1, team_1_qol, komanda_2, team_2_qol,  logo_1: "", logo_2: ""},
                    success: function(data){
                        console.log(data);
                        if(data == "null"){
                            alert("Bütün xanaları doldurun.")
                        }
                        if(data == "Success"){
                            location.reload();
                        }
                    }
                })
            }
        }
        else{
            if(url !== undefined && url_2 !== undefined){
                resize.croppie("result", {
                    type: "canvas",
                    size: "original",
                    format: "jpg",
                    quality: 2,
                }).then(function (response_1) {
                    resize_2.croppie("result", {
                        type: "canvas",
                        size: "original",
                        format: "jpg",
                        quality: 2,
                    }).then(function (response_2) {
                        const oyun = $("input[name='oyun']").val()
                        const stadion = $("input[name='stadion']").val()
                        const date = $("input[name='date']").val()
                        const gorus = $("select[name='gorus']").val()
                        const komanda_1 = $("input[name='komanda-1']").val()
                        const komanda_2 = $("input[name='komanda-2']").val()
                        $.ajax({
                            url: "config.php",
                            type: "POST",
                            data: {query: "add_games", oyun, stadion, date, gorus, komanda_1, komanda_2, logo_1: response_1, logo_2: response_2},
                            success: function(data){
                                console.log(data);
                                if(data == "null"){
                                    alert("Bütün xanaları doldurun.")
                                }
                                if(data == "Success"){
                                    location.reload();
                                }
                            }
                        })
                    });
                });
            }
            else{
                alert("Komanda Logoları seçilməyib")
            }
        }
	});
});
