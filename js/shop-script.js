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

		$("#title a").css("display", "inline-block");
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

	$("#input_search").bind('textchange', function(){
		var input_search = $("#input_search").val();

		if(input_search.length > 0){
			$.ajax({
				type: "POST",
				url: "/include/search.php",
				data: "text=" + input_search,
				dataType: "html",
				cache: false,
				success: function(data){
					if (data > '') {
						$("#result-search").show().html(data);
					}
					else{
						$("#result-search").hide();
					}
				}
			});
		}else
		{
			$("#result-search").hide();
		}
	})

	function loadcart(){
		$.ajax({
			type: "POST",
			url: "/include/loadcart.php",
			dataType: "html",
			cache: false,
			success: function(data){
				if (data == "0"){
					$("#cart > a").html("Корзина пуста");
				}
				else{
					$("#cart > a").html(data);
				}
			}
		});
	}

	$(".count_deduct").click(function(){
		var cart_id = $(this).attr("cart_id");

		$.ajax({
			type: "POST",
			url: "/include/count_deduct.php",
			data: "id="+cart_id,
			dataType: "html",
			cache: false,
			success: function(data){
				$("#input_id"+cart_id).val(data);
				loadcart();

				// Переменная с ценой продукта
				var priceproduct = $("#product"+cart_id).attr("price");
				// Цену умножаем на количество
				result_total = Number(priceproduct, 2, '.', '') * Number(data, 2, '.', '');

				$("#product"+cart_id).html(result_total+"&#8364;");

				result_price();
			}
		});
	});

	$(".count_addition").click(function(){
		var cart_id = $(this).attr("cart_id");

		$.ajax({
			type: "POST",
			url: "/include/count_addition.php",
			data: "id="+cart_id,
			dataType: "html",
			cache: false,
			success: function(data){
				$("#input_id"+cart_id).val(data);
				loadcart();

				// Переменная с ценой продукта
				var priceproduct = $("#product"+cart_id).attr("price");
				// Цену умножаем на количество
				result_total = Number(priceproduct, 2, '.', '') * Number(data, 2, '.', '');

				$("#product"+cart_id).html(result_total+"&#8364;");

				result_price();
			}
		});
	});

	$(".cart_count").keypress(function(e){
		var chr = getChar(e);
		e.which = e.which || e.keyCode;

		if (e.which == 8 || e.which == 9 || e.which == 13 || e.which == 46 || 
		(e.which > 34 && e.which < 38) || e.which == 39 || (e.which > 47 && e.which < 58) || 
		(e.which > 95 && e.which < 105) || (e.ctrlKey === true && e.which == 65) || 
		(e.ctrlKey === true && e.which == 67) && e.shiftKey === false){
			
			if(chr < '0' || chr > '9'){
				return false;
			}

			var cart_id = $(this).attr("cart_id");
			var incount = $("#input_id"+cart_id).val();

			$.ajax({
				type: "POST",
				url: "/include/count_input.php",
				data: "id="+cart_id+"&count="+incount,
				dataType: "html",
				cache: false,
				success: function(data){
					$("#input_id"+cart_id).val(data);
					loadcart();

					// Переменная с ценой продукта
					var priceproduct = $("#product"+cart_id).attr("price");
					// Цену умножаем на количество
					result_total = Number(priceproduct, 2, '.', '') * Number(data, 2, '.', '');

					$("#product"+cart_id).html(result_total+"&#8364;");

					result_price();
				}
			});
		}
		else{
			e.preventDefault();			
		}
	});

	// event.type должен быть keypress
	function getChar(event) {
	  if (event.which == null) { // IE
	    if (event.keyCode < 32) return null; // спец. символ
	    return String.fromCharCode(event.keyCode)
	  }

	  if (event.which != 0 && event.charCode != 0) { // все кроме IE
	    if (event.which < 32) return null; // спец. символ
	    return String.fromCharCode(event.which); // остальные
	  }

	  return null; // спец. символ
	}
	
	function result_price(){
		$.ajax({
			type: "POST",
			url: "/include/result_price.php",
			dataType: "html",
			cache: false,
			success: function(data){
				$("#result_price > strong").html(data);
			}
		});
	}
});