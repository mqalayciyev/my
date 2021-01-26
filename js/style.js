const div = document.getElementsByClassName("loading")[0].firstElementChild;
const search = document.getElementsByClassName("loading")[0].firstElementChild;

div.style.height = window.innerHeight + "px";
search.style.height = window.innerHeight + "px";
window.onresize = function () {
	div.style.height = window.innerHeight + "px";
	search.style.height = window.innerHeight + "px";
};



$(document).ready(function () {
	// FUNCTIONS
	let navH = 0;
	if ($(".navbar-menu").css("display") == "block") {
		navH = $(".navbar-menu")
			.find(".align-items-center")
			.css("height")
			.split("px")[0];
	} else {
		navH = $(".navbar").css("height").split("px")[0];
	}
	// --------------------------------------------------------------------------------
	let idC = document.cookie.split("id=")[1];

	function scrollTeamPage(x) {
		let url = location.href.search("team");
		let url2 = location.href.search("player");
		if (url != -1 && url2 == -1) {
			if (x != undefined && x != "") {
				let navbarHeight = navH;
				let scrollTo = $("#" + x).offset().top;

				if (x == "about") {
					$(window).scrollTop(0);
				} else {
					$(window).scrollTop(scrollTo - navbarHeight);
				}
				document.cookie =
					"id=dsfdfv; expires=Thu, 01 Jan 1070 00:00:00 UTC; path=/;";
				idC = undefined;
			}
		}
	}
	// -------------------------------------------------------------------------------------
	function imgList() {
		var keyValue = "";
		$.ajax({ 
			async: false,
			type: "POST", 
			url: "inc/data.php", 
			data: "query=header",
			success: function (response) { 
				keyValue = response;
			}
			
		}); 
		return keyValue; 
	}
	let image_list = $.parseJSON(imgList());
	let carousel_inner = $("#carouselExampleCaptions").find(".carousel-inner");
	let div = ""
	let active = "active";
	for(let i = 0; i<image_list.length; i++){
		div += `<div class="carousel-item ${active} w-100 h-100" style="background: url('media/header/${image_list[i]}')"></div>`;
		active = null
	}
	$(carousel_inner).html(div)
	$("#carouselExampleCaptions")
		.find(".carousel-inner")
		.find(".carousel-item")
		.css("background-repeat", "no-repeat")
		.css("background-position-x", "center")
		.css("background-position-y", "30%")
		.css("background-size", "cover")

	// -------------------------------------------------------------------------------------
	function imgView() {
		$("#img-view").css("width", window.innerWidth + "px");
		$("#img-view").css("height", window.innerHeight);
		$("#img-view")
			.find("img")
			.css("max-height", window.innerHeight + "px");
	}
	// -------------------------------------------------------------------------------------
	let galeriArr = [];
	if (location.href.search(/page=galeri/gi) != "-1") {
		galeriArr = $(".galeri").find("img");
	} else if (location.href.search(/page=team&player/gi) != "-1") {
		galeriArr = $("#staff-info").find(".img-full").find("img");
	} else {
		galeriArr = $(".home")
			.find(".img-full")
			.find(".glide__slide")
			.find("img");
	}
	let imgArr = [];
	for (let i = 0; i < galeriArr.length; i++) {
		imgArr.push(galeriArr[i].src.split("media/albom/")[1]);
	}

	function imgHide() {
		$("#img-view").click(function (event) {
			let curImg = $("#img-view")
				.find(".image-div")
				.attr("src")
				.split("media/albom/")[1];
			let curImgIn = imgArr.indexOf(curImg);
			if (event.target.tagName == "IMG") {
				if (curImgIn == imgArr.length - 1) {
					curImgIn = 0;
				} else {
					curImgIn = curImgIn + 1;
				}
				$("#img-view")
					.find(".image-div")
					.attr("src", "media/albom/" + imgArr[curImgIn]);
			} else if (event.target.id == "prev") {
				if (curImgIn == 0) {
					curImgIn = imgArr.length - 1;
				} else {
					curImgIn = curImgIn - 1;
				}
				$("#img-view")
					.find(".image-div")
					.attr("src", "media/albom/" + imgArr[curImgIn]);
			} else if (event.target.id == "next") {
				if (curImgIn == imgArr.length - 1) {
					curImgIn = 0;
				} else {
					curImgIn = curImgIn + 1;
				}
				$("#img-view")
					.find(".image-div")
					.attr("src", "media/albom/" + imgArr[curImgIn]);
			} else {
				$("#img-view").css("display", "none");
				$("body").css("overflow", "auto");
			}
		});
	}
	// -------------------------------------------------------------------------------------
	function imgShow() {
		$(".galeri")
			.find(".img-full")
			.find("img")
			.click(function (event) {
				console.log(event.target.parentElement.classList[1]);
				if (
					event.target.classList[0] != undefined ||
					event.target.parentElement.classList[1] ==
						"glide__slide--active"
				) {
					let img = event.target.src.split("media/albom/")[1];
					$("#img-view")
						.find("img")
						.attr("src", "media/albom/" + img);
					$("#img-view").css("display", "flex");
					$("body").css("overflow", "hidden");
				}
			});
		$("#staff-info")
			.find(".img-full")
			.find("img")
			.click(function (event) {
				let img = event.target.src.split("media/albom/")[1];
				$("#img-view")
					.find("img")
					.attr("src", "media/albom/" + img);
				$("#img-view").css("display", "flex");
				$("body").css("overflow", "hidden");
			});
		$(".fotoalbom")
			.find(".view-span")
			.click(function (event) {
				if (event.target.classList == "view-span") {
					let img = event.target.ariaLabel.split("media/albom/")[1];
					$("#img-view")
						.find("img")
						.attr("src", "media/albom/" + img);
					$("#img-view").css("display", "flex");
					$("body").css("overflow", "hidden");
				}
			});
	}
	// -------------------------------------------------------------------------------------

	function rightNavbar() {
		if ($(".navbar-menu").css("display") == "block") {
			navH = $(".navbar-menu")
				.find(".align-items-center")
				.css("height")
				.split("px")[0];
		} else {
			navH = $(".navbar").css("height").split("px")[0];
		}
		let rNav = $("#right-navbar");

		let winH = $(window).innerHeight() - navH;
		rNav.css("top", navH + "px").css("height", winH + "px");
	}
	// -------------------------------------------------------------------------------------
	let sliderItem = $(".header-div");
	let notFound = $(".not-found");
	let windowH = "";

	function imgSize() {
		windowH = $(window).innerHeight();
		let footer = $(".footer").css("height").split("px")[0];
		sliderItem.css("height", "" + (windowH - navH) + "px");
		notFound.css("height", "" + (windowH - navH - footer) + "px");
	}
	// -------------------------------------------------------------------------------------
	function footerMargin() {
		let marginBottom = $(".footer").css("height");
		$(".context-div").css("margin-bottom", marginBottom);
	}

	// -------------------------------------------------------------------------------------

	// FUNCTIONS

	// CALLBACK FUNCTIONS
	rightNavbar();
	imgSize();
	imgView();
	imgHide();
	imgShow();
	footerMargin();
	// CALLBACK FUNCTIONS

	// WINDOW EVENTS

	$(".navbar")
		.find("#navbarUl")
		.find("li")
		.find(".dropdown-menu")
		.find("a")
		.click(function () {
			if ($(this).attr("aria-label") != undefined) {
				let id = $(this).attr("aria-label");
				document.cookie =
					"id=" +
					id +
					"; expires=Thu, 01 Jan 2070 00:00:00 UTC; path=/;";
				scrollTeamPage(id);
			}
		});
	// --------------------------------------------------------------------------

	$("#right-navbar")
		.find("p")
		.find("span")
		.click(function () {
			let x = $(this).attr("aria-label");
			scrollTeamPage(x);
		});
	// --------------------------------------------------------------------------

	$("#navbarUl")
		.find("li:last-child")
		.find("span")
		.click(function () {
			$(".search").css("display", "block");
		});
	$(".navbar-menu")
		.find("span")
		.click(function () {
			$(".search").css("display", "block");
		});
	// --------------------------------------------------------------------------

	$(".search").click(function (event) {
		if ($(event.target).hasClass("hide-div")) {
			$(".search").css("display", "none");
		}
	});
	$("#header").click(function (event) {
		if ($(window).outerWidth() < 992) {
			if ($(event.target).hasClass("hide")) {
				$(".navbar").css("display", "none");
			}
		}
	});
	$(".navbar-open").click(function () {
		$(".navbar").css("display", "flex");
		$("body").css("overflow", "none");
	});
	// --------------------------------------------------------------------------
	$("#right-navbar")
		.find("strong")
		.click(function () {
			console.log($("#right-navbar").css("width"));
			if ($("#right-navbar").css("width") !== "200px") {
				$("#right-navbar").css("width", "200px");
				$("#right-navbar").find(".row").css("visibility", "visible");
				$("#right-navbar").find("strong").html("<");
				$("#right-navbar").find("strong").attr("title", "Bağla");
			} else {
				$("#right-navbar").css("width", "0px");
				$("#right-navbar").find(".row").css("visibility", "hidden");
				$("#right-navbar").find("strong").html(">");
				$("#right-navbar").find("strong").attr("title", "Aç");
			}
		});
	$(".home")
		.find(".video")
		.find(".playlist")
		.find("video")
		.click((event) => {
			$(".video")
				.find(".video-player")
				.find("video")
				.attr("src", event.target.src);
		});
	// ---------------------------------------------------------------------------------

	// CLICK EVENTS

	// WINDOW EVENTS
	$(window).resize(function () {
		scrollTeamPage();
		rightNavbar();
		imgSize();
		imgView();
		footerMargin();
		if ($(window).outerWidth() > 992) {
			$(".navbar").css("display", "flex");
		} else {
			$(".navbar").css("display", "none");
		}
	});

	$(window).click(function (event) {
		let url = location.href.search("team");
		let url2 = location.href.search("player");
		if (url != -1 && url2 == -1) {
			let rNC = [];
			let rNC2 = [];
			$("#right-navbar").find("strong");
			for (
				let i = 0;
				i < $("#right-navbar").children()[1].children.length;
				i++
			) {
				rNC.push($("#right-navbar").children()[1].children[i]);
				rNC2.push(
					$("#right-navbar").children()[1].children[i].children[0]
				);
			}
			if (
				$(event.target)[0] != $("#right-navbar").find("strong")[0] &&
				rNC.indexOf($(event.target)[0]) == -1 &&
				rNC2.indexOf($(event.target)[0]) == -1
			) {
				if (
					$("#right-navbar").find(".row").css("visibility") ==
					"visible"
				) {
					$("#right-navbar").find(".row").css("visibility", "hidden");
					$("#right-navbar").css("width", "0px");
					$("#right-navbar").find("strong").attr("title", "Aç");
					$("#right-navbar").find("strong").html(">");
				}
			}
		}
	});

	$(window).scroll(function () {
		let url = location.href.search("team");
		let url2 = location.href.search("player");
		if (url != -1 && url2 == -1) {
			if (
				$(window).scrollTop() < $("#staff").offset().top - 100 ||
				$(window).scrollTop() >
					$("#stadium").offset().top - $("#right-navbar").height()
			) {
				$("#right-navbar")
					.css("transition", "none")
					.css("visibility", "hidden");
				$("#right-navbar").find("strong").css("transition", "none");
				$("#right-navbar").find(".row").css("display", "none");
			} else {
				$("#right-navbar")
					.css("visibility", "visible")
					.css("transition", "all 1s");
				$("#right-navbar").find("strong").css("transition", "all 1s");
				$("#right-navbar").find(".row").css("display", "flex");
			}
		}
		
		if ($(window).outerWidth() > 991) {
			if (
				$(window).scrollTop() >=
				$(".navbar").css("height").split("px")[0]
			) {
				$(".navbar")
					.css("transition", "all 0.3s")
					.css("background-color", "#028b30")
					.css("box-shadow", "-1px 2px 8px #00000077");
			} else {
				$(".navbar")
					.css("background-color", "transparent")
					.css("box-shadow", "none");
			}
		} else if ($(window).outerWidth() < 992) {
			if (
				$(window).scrollTop() >=
				$("#header").find(".logo.col-12").css("height").split("px")[0]
			) {
				$(".navbar-menu")
					.css("position", "fixed")
					.css("top", "0")
					.css("z-index", "1")
					.css("transition", "all 0.3s")
					.css("background-color", "#028b30")
					.css("box-shadow", "-1px 2px 8px #00000077");
				$(".navbar-menu").find(".logo").css("display", "none");
				$(".navbar-menu")
					.find(".align-items-center")
					.css("display", "flex");
			} else {
				$(".navbar-menu")
					.css("position", "relative")
					.css("background-color", "transparent")
					.css("box-shadow", "none");
				$(".navbar-menu").find(".logo").css("display", "block");
				$(".navbar-menu")
					.find(".align-items-center")
					.css("display", "none");
			}
		}
	});
	// WINDOW EVENTS

	// SEND AJAX REQUEST
	if(location.href.search("page") == -1){
		$.ajax({
			type: "POST",
			url: "inc/data.php",
			data: "query=turnir",
			success: function (gelen) {
				// HOME
				$(".home").find(".coming-last-game").find(".tour-table").find(".t").append(gelen);
				$(".home").find(".coming-last-game").find(".tour-table").find("tr:last").remove();
				$(".home").find(".coming-last-game").find(".tour-table").find("tr").find("td:eq(7)").remove();
				$(".home").find(".coming-last-game").find(".tour-table").find("tr:first").find("td:first").html("");
				$(".home").find(".coming-last-game").find(".tour-table").find("#game_links").html("").removeAttr("href");
				$(".home").find(".coming-last-game").find(".tour-table").find("tr").find("td:eq(6)").remove();
				$(".home").find(".coming-last-game").find(".tour-table").find("tr").find("td:eq(5)").remove();
				$(".home").find(".coming-last-game").find(".tour-table").find("table").find("td").css("border", "0").css("font-weight", "bold").css("background-color", "").css("font-size", "20px");
				$(".home").find(".coming-last-game").find(".tour-table").find("table").css("width", "100%").css("min-width", "500px");
				$(".home").find(".coming-last-game").find(".tour-table").find("table").css("cursor", "default");
				$(".home").find(".coming-last-game").find(".tour-table").find("table").find("tr:not(':first')").css("cursor", "default");
				// HOME
			}
		});
	}
	else if(location.href.search("team") != -1 && location.href.search("player") == -1){
		$.ajax({
			type: "POST",
			url: "inc/data.php",
			data: "query=turnir",
			success: function (gelen) {
				// TOURTABLE
				$("#tournament").find("div").append(gelen);
				$("#tournament").find("div").find("#game_links").removeAttr("href");
				$("#tournament").find("div").find("tr:last").remove();
				$("#tournament").find("div").find("table").find("tbody").css("border", "2px solid slategrey").css("border-radius", "5px");
				$("#tournament").find("div").find("tr:first").css("background-color", "#06c446");
				$("#tournament").find("div").find("table").css("width", "100%").css("min-width", "640px").css("border-collapse", "collapse");
				$("#tournament").find("div").find("table").find("td").css("font-size", "25px").css("border", "1px solid slategrey").css("background-color", "");
				$("#tournament").find("div").find("table").css("cursor", "default");
				$("#tournament").find("div").find("table").find("tr:not(':first')").css("cursor", "pointer");
				$("#tournament").find("div").find("table").find("tr:not(:contains('Zaqatala')):not(:first)").hover(
					function (event) {
							$(this).attr("class", "alert alert-info");
						},
						function () {
							$(this).removeAttr("class", "alert alert-info");
						}
				);
				$("#tournament").find("div").find("table").find("tr").find("td:contains('Zaqatala')").parent().attr("class", "alert-success");
				// TOURTABLE
			}
		});
	}
	

	
	$(".loading").css("display", "none");


	if (location.href.indexOf("page=team") && idC != undefined) {
		scrollTeamPage(idC);
	}
});
