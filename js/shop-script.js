$("#input_search").bind('textchange', function(){
	var input_search = $("#input_search").val();

	if(input_search.length > 0){
		$.ajax({
			type: "POST",
			url: "include/search.php",
			data: "text=" + input_search,
			dataType: "html",
			cache: false,
			success: function(data){
				if (data > '') {
					$("#result_search").show.html(data);
				}
				else{
					$("result_search").hide();
				}
			}
		})
	}else
	{
		$("result_search").hide();
	}
})




var touch = $('#touch-menu');
var menu = $('.nav');
var wid = $(window).width();
var target = this.hash, $target = $(target);
var top_show = 150;
var delay = 1000;

$(document).ready(function(){
	$(window).scroll(function(){
		if ($(this).scrollTop() > top_show)
			$("#top").fadeIn();
		else
			$("#top").fadeOut();
	});
	$("#top").click(function(){
		$("body, html").animate({scrollTop: 0}, delay);
	});

	$('a[href^="#"]').bind('click.smoothscroll',function (e) {
		e.preventDefault();
				 
		var target = this.hash,
		$target = $(target);
				 
		$('html, body').stop().animate({'scrollTop': $target.offset().top}, 
		500, 'swing', function () {
			window.location.hash = target;
		});
	});

	$(window).resize(function(){
		var wid = $(window).width();
	});

	$('.carousel').carousel()
	$('.carousel').css("margin-bottom","0px")
			
	if(wid <= 768)
	{
		$(".btn-group-vertical").hide();
		$("#catalog").css("display", "inline-block");
		$("#catalog").click(function(){
			$(".btn-group-vertical").slideToggle("slow");
		});
	}
	else
	{
		$("#catalog").css("display", "none");
		$(".btn-group-vertical").show();
	}
			
	if(wid <= 680)
	{	
		$("#touch-menu").click(function(){
			$("#menu_list").slideToggle("#menu_list")
		});
	}

	if(wid <= 600)
	{
		$(".catalog").removeClass("col-xs-4");
		$(".catalog").addClass("col-xs-12");
		$("#pay div img").removeClass("col-xs-3");
		$("#pay div img").addClass("col-xs-6");
	}	
});