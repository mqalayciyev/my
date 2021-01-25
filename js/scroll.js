$(document).ready(function(){
    let navH = 0;
	if ($(".navbar-menu").css("display") == "block") {
		navH = $(".navbar-menu")
			.find(".align-items-center")
			.css("height")
			.split("px")[0];
    }
    else {
		navH = $(".navbar").css("height").split("px")[0];
	}
    let navbarHeight = navH;
    if(location.href.search("&cp=") != -1){
        let scrollTo = $("#coming-games").offset().top;
        $(window).scrollTop(scrollTo - navbarHeight);
    }
    else if(location.href.search("&gp=") != -1){
        let scrollTo = $("#games").offset().top;
        $(window).scrollTop(scrollTo - navbarHeight);
    }
    else if(location.href.search("&p=") != -1){
        if(location.href.search("page=news") != -1){
            let scrollTo = $(".news").offset().top;
            $(window).scrollTop(scrollTo - navbarHeight);
        }
        else if(location.href.search("page=galeri") != -1){
            let scrollTo = $(".galeri").offset().top;
            $(window).scrollTop(scrollTo - navbarHeight);
        }
        
    }
})