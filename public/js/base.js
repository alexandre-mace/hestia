$(function () {

	$(".multiple-items").slick({
		infinite: true,
		slidesToShow: 3,
		slidesToScroll: 3,
		responsive: [
    {
      breakpoint: 1200,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
        infinite: true
      }
    }
  ]
	});

    $(".single-item").slick({
        dots: true
    });


	$("#nav-icon3").click(function(){
		if($(this).hasClass("open")){
			$("nav").css({"display":"none"});
			$("#nav-icon3").removeClass("open");
		}else{
			$("nav").css({"display":"flex"});
			$("#nav-icon3").addClass("open");
		}
	});

	/* smooth scroll to ids */
    $(".scrollTo").click(function(){
        $("html, body").animate({
            scrollTop: $( $(this).attr("href") ).offset().top
        }, 500);
        return false;
    });

});

/* back-to-top */
var btn = $("#back-to-top");

$(window).scroll(function() {
    if ($(window).scrollTop() > 300) {
        btn.addClass("show");
    } else {
        btn.removeClass("show");
    }
});

btn.on("click", function(e) {
    e.preventDefault();
    $("html, body").animate({scrollTop:0}, "300");
});

$(document).ready(function() {
    $("select").select2();
});