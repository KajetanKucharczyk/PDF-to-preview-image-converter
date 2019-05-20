function kajtek_widget_manuals(){
//INSTRUKCJE -> PHP read.php
	$.ajax({
		type: "POST",
		url: "/f/kajtek/instrukcje/read.php",
		data: {c: $("#product_reference").attr("x").toUpperCase(), r: $("#product_reference > span").html()},
		async: true,
	}).done(function(data){
		//BRAK
		if(data == 0){
			//USUWANIE POLA
			$(".manual-preview").remove();
		}else{
			//DEKODOWANIE JSONA
			objekt = JSON.parse(data);
			ilosc = objekt[objekt.length - 2];
			for(i = 0; i < ilosc; i++){
				$(".manual-pages").append("<span><img class='manual-image'' src='" + objekt[i] + "' /></span>");
			}
			//CSS
			if(ilosc == 4){
				$(".manual-image").eq(0).css({
					"width": "calc(25%)",
					"border": "1px solid #c7c7c7",
					"border-right": "0px",
					"border-top-left-radius": "5px"
				})
				$(".manual-image").eq(1).css({
					"width": "calc(25%)",
					"border": "1px solid #c7c7c7",
					"border-right": "0px"
				})
				$(".manual-image").eq(2).css({
					"width": "calc(25%)",
					"border": "1px solid #c7c7c7",
					"border-right": "0px"
				})
				$(".manual-image").eq(3).css({
					"border": "1px solid #c7c7c7",
					"width": "calc(25% + 1px)",
					"border-right": "1px solid #c7c7c7",
					"border-top-right-radius": "5px",
					"margin-left": "-1px"
				})
			}
			if(ilosc == 3){
				$(".manual-image").eq(0).css({
					"width": "calc(100% / 3)",
					"border": "1px solid #c7c7c7",
					"border-right": "0px",
					"border-top-left-radius": "5px"
				})
				$(".manual-image").eq(1).css({
					"width": "calc(100% / 3)",
					"border": "1px solid #c7c7c7",
					"border-right": "0px"
				})
				$(".manual-image").eq(2).css({
					"border": "1px solid #c7c7c7",
					"width": "calc(100% / 3 + 1px)",
					"border-right": "1px solid #c7c7c7",
					"border-top-right-radius": "5px",
					"margin-left": "-1px"
				})
			}
			if(ilosc == 2){
				$(".manual-image").eq(0).css({
					"width": "calc(50%)",
					"border": "1px solid #c7c7c7",
					"border-right": "0px",
					"border-top-left-radius": "5px"
				})
				$(".manual-image").eq(1).css({
					"border": "1px solid #c7c7c7",
					"width": "calc(50% + 1px)",
					"border-right": "1px solid #c7c7c7",
					"border-top-right-radius": "5px",
					"margin-left": "-1px"
				})
			}
			if(ilosc == 1){
				$(".manual-image").eq(0).css({
					"width": "calc(100%)",
					"border": "1px solid #c7c7c7",
					"border-top-left-radius": "5px",
					"border-top-right-radius": "5px"
				})
			}
			if(ilosc == 0){
				$(".manual-text").css({
					"border-top": "1px solid #c7c7c7",
					"border-radius": "5px",
					"width": "calc(100% + 2px)",
					"margin-top": "50px",
					"box-shadow": "0px 1px 5px #c7c7c7"
				})
				$(".manual-text").parent().css({
					"margin-top": "50px",
					"border": "0px"
				});
				$(".manual-text").parent().parent().css({
					"margin-bottom": "50px"
	
				});
			}
			//KLIKANIE
			$(".manual").click(function(){
				window.open(objekt[objekt.length - 1],'_blank');
			})
			//CSS + RESIZE
			kajtek_widget_manuals_resize();
		}
	});
}
function kajtek_widget_manuals_resize(){
	ilosc = $(".manual-image").length;
	//MOBILE DETECTION
	if($(window).width() < 753 ||  /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){		
		if(ilosc == 4){
			$(".manual-image").eq(0).css({
				"width": "calc(50%)",
				"border": "1px solid #c7c7c7",
				"border-right": "0px",
				"border-top-left-radius": "5px"
			})
			$(".manual-image").eq(1).css({
				"border": "1px solid #c7c7c7",
				"width": "calc(50% + 1px)",
				"border-right": "1px solid #c7c7c7",
				"border-top-right-radius": "5px",
				"margin-left": "-1px"
			})
			$(".manual-image").eq(2).css({
				"display": "none"
			})
			$(".manual-image").eq(3).css({
				"display": "none"
			})
		}
		if(ilosc == 3){
			$(".manual-image").eq(0).css({
				"width": "calc(50%)",
				"border": "1px solid #c7c7c7",
				"border-right": "0px",
				"border-top-left-radius": "5px"
			})
			$(".manual-image").eq(1).css({
				"border": "1px solid #c7c7c7",
				"width": "calc(50% + 1px)",
				"border-right": "1px solid #c7c7c7",
				"border-top-right-radius": "5px",
				"margin-left": "-1px"
			})
			$(".manual-image").eq(2).css({
				"display": "none"
			})
			$(".manual-image").eq(3).css({
				"display": "none"
			})	
		}			
	}else{
		if(ilosc == 4){
			$(".manual-image").eq(0).css({
				"width": "calc(25%)",
				"border": "1px solid #c7c7c7",
				"border-right": "0px",
				"border-top-left-radius": "5px"
			})
			$(".manual-image").eq(1).css({
				"width": "calc(25%)",
				"border": "1px solid #c7c7c7",
				"border-right": "0px",
				"margin-left": "0px"
			})
			$(".manual-image").eq(2).css({
				"display": ""
			})
			$(".manual-image").eq(3).css({
				"display": ""
			})
		}
		if(ilosc == 3){
			$(".manual-image").eq(0).css({
				"width": "calc(100% / 3)",
				"border": "1px solid #c7c7c7",
				"border-right": "0px",
				"border-top-left-radius": "5px"
			})
			$(".manual-image").eq(1).css({
				"width": "calc(100% / 3)",
				"border": "1px solid #c7c7c7",
				"border-right": "0px",
				"margin-left": "0px"
			})
			$(".manual-image").eq(2).css({
				"display": ""
			})
		}
	}
}
function kajtek_widget_manuals_translate(){
	if(window.location.href.split("/")[3] == "en"){
		//WIDGET MANUALS
		$("#widget_manuals").html($("#widget_manuals").html().replace("Instrukcja", "Manual"));
		$("#widget_manuals").html($("#widget_manuals").html().replace("Pobierz instrukcję w formacie .pdf", "Download manual in .pdf format"));
	}else{
		//WIDGET MANUALS
		$("#widget_manuals").html($("#widget_manuals").html().replace("Manual", "Instrukcja"));
		$("#widget_manuals").html($("#widget_manuals").html().replace("Download manual in .pdf format", "Pobierz instrukcję w formacie .pdf"));
	}
}