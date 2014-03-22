(function($){ //create closure so we can safely use $ as alias for jQuery
$(document).ready(function(){
	var exampleOptions = {
	  speed: 'normal'
	}
	var example = $('#menu').superfish(exampleOptions);
});
})(jQuery);

$(document).delegate("a.selsearch", "click", function(e) {
	//$(this).next('#multipleareas').show(100);
        $(this).next('#multipleareas').slideToggle('slow');
        $(this).toggleClass("selsearchup");
	$("body").append("<div id='multiclosebox'></div>");
	return false;
});

$(document).on("click", "#multiclosebox", function(e) {
	$("#multipleareas:has(div)").hide(100);
	$(this).hide(10);
return false;
});

$(document).delegate("a.city", "click", function(e) {
$(this).next('#cities').show(100);
	$("body").append("<div id='citiesclosebox'></div>");
	return false;
});

$(document).on("click", "#citiesclosebox", function(e) {
	$("#cities:has(div)").hide(100);
	$(this).hide(10);
return false;
});


$(document).ready(function(){

$("a.advsearch").click(function(){
	$("#advancesearchbox").slideToggle("fast");
	//$(this).toggleClass("active"); return false;
});

$( "#stickfooteritem li" ).hover(function() {
  $(this).find('.sctabitem').delay(300).fadeIn(300);
}, function() {
   $(this).find('.sctabitem').fadeOut(10);
});

$( "a.stickitemclose" ).click(function() {
  $(this).parent('.stickitem').hide('slow');
});

//Lightbox
$('.trackorderline').colorbox({ inline:true, 
    onComplete : function() { 
       $(this).colorbox.resize();
    }    
});

$('.savedsearch').colorbox({ inline:true, 
    onComplete : function() { 
       $(this).colorbox.resize(); 
    }    
});
$('.wishlist').colorbox({ inline:true, 
    onComplete : function() { 
       $(this).colorbox.resize(); 
    }    
});
$('.prodpinger').colorbox({ inline:true, 
    onComplete : function() { 
       $(this).colorbox.resize(); 
    }    
});
$('.storepinger').colorbox({ inline:true, 
    onComplete : function() { 
       $(this).colorbox.resize(); 
    }    
});
$('.signininline').colorbox({ inline:true, 
    onComplete : function() { 
       $(this).colorbox.resize(); 
    }    
});

$('.signupinline').colorbox({ inline:true, 
    onComplete : function() { 
       $(this).colorbox.resize(); 
    }    
});

$('.verificationinline').colorbox({ inline:true, 
    onComplete : function() { 
       $(this).colorbox.resize(); 
    }    
});



//Tabs
$(function() { $( "#pinger" ).tabs(); }); 
});
$(function() { $( "#preview" ).tabs(); });
$(function() { $( "#gallery" ).tabs(); });

$(function(){
  $('#arrivals').slides({
	  preload: true,
	  effect: 'fade',
	  generateNextPrev: false,
	  pagination: true,
	  play: 3000,
	  generatePagination: true, 
  });
});


$(function(){
  $('#offers').slides({
	  preload: true,
	  effect: 'fade',
	  generateNextPrev: false,
	  pagination: true,
	  play: 4000,
	  generatePagination: true, 
  });
});


$(function(){
  $('#storeday').slides({
	  preload: true,
	  effect: 'fade',
	  generateNextPrev: false,
	  pagination: true,
	  play: 5000,
	  generatePagination: true, 
  });
});

$(window).load(function () {
	$(".scroll").customScrollbar();
	//$(".cityscroll").customScrollbar1();
	/*$(function() { $( "#mostview" ).tabs(); });
	//$(function() { $( "#preview" ).tabs(); });*/

$('.marquee-with-options').marquee({
	speed: 30000,
	gap: 0,
	delayBeforeStart: 0,
	direction: 'left',
	duplicated: true,
	pauseOnHover: true,
});
});

//Fixed Menu
$(function(){
	var menu = $('#header'),
	pos = menu.offset();
	$(window).scroll(function(){
		if ($(this).scrollTop() > 20) {
			$('.default').addClass("fixed").fadeIn();
                        $('#stickfooter').show();
			// $(this).find('#multipleareas').delay(400).fadeIn(10);
		} else {
			$('.default').removeClass("fixed");
                        $('#stickfooter').hide();
		}
	});
        

$( "div.mainnavdropholder" ).hover(function() {
  $(this).find('#innernavigation').show(500);
  $( "body" ).append( "<div id='boxoverlay'></div>" );
}, function() {
   $(this).find('#innernavigation').hide();
   $( "#boxoverlay" ).remove();
   return false;
});

$( "a.prodsubarrow" ).click(function() {
  $(this).next('.pdetailsexpand').slideToggle();
  $(this).css("display", 'none');
}, function() {
$( "a.prodsubarrowd" ).click(function() {
  $(this).next('.pdetailsexpand').slideUp();

   });
});


$("a.prodsubarrow").click(function() {
	$(this).next('.pdetailsexpand').slideToggle();
	$(this).css("display", 'none');
	$(this).prev().css("display", 'block');
});

$("a.prodsubarrowd").click(function() {
	$(this).next().next('.pdetailsexpand').slideToggle();
	$(this).css("display", 'none');
	$(this).next().css("display", 'block');
});

	
// Inner pages left menu
$("#leftaccordion h3.sorttitle").click(function () {
	$(this).next(".sortbox").toggle();
	$(this).toggleClass("sorttitlehide");
});



});


$(document).ready(function() {
    var $divView = $('div.mapview');
    var innerHeight = $divView.removeClass('mapview').height();
    $divView.addClass('mapview');
	 $('div.mapslide').removeClass("mapslideactive");
    $('div.mapslide').click(function() {
		$('div.mapview').animate({
          height: (($divView.height() === 10)? innerHeight  : "10px")		  
        }, 500);
		$(this).toggleClass("mapslideup");
        return false;
    });
});
$(document).ready(function (){
    $('#compare').change(function (){
        if($('#compare').is(":checked"))
        {
            $("#compare_label").text('Remove to Product Compare'); 
            $("#compare_label").css('color','red');
        }
        else
        {
            $("#compare_label").text('Add to Product Compare'); 
            $("#compare_label").css('color','black');
        }
       
    });
    $('#sto_compare').change(function (){
        if($('#sto_compare').is(":checked"))
        {
            $("#sto_compare_label").text('Remove To Store Compare'); 
            $("#sto_compare_label").css('color','red');
        }
        else
        {
            $("#sto_compare_label").text('Add To Store Compare'); 
            $("#sto_compare_label").css('color','black');
        }
       
    });
    $('#wishlist').change(function (){
        if($('#wishlist').is(":checked"))
        {
            $("#wishlist_label").text('Remove to Wishlist'); 
            $("#wishlist_label").css('color','red');
        }
        else
        {
            $("#wishlist_label").text('Add to Wishlist'); 
            $("#wishlist_label").css('color','black');
        }
       
    });
    $('#propinger').change(function (){
        if($('#propinger').is(":checked"))
        {
            $("#propinger_label").text('Remove to Product Pinger'); 
            $("#propinger_label").css('color','red');
        }
        else
        {
            $("#propinger_label").text('Add to Product Pinger'); 
            $("#propinger_label").css('color','black');
        }
       
    });
    $('#email_no').click(function (){
            /*$("#email_text").fadeIn(300); 
            $("#id_text").fadeOut(300);*/
            $("#email_text1").slideDown(500); 
            $("#id_text1").slideUp(500);
    });
    $('#order_id').click(function (){
            /*$("#id_text").fadeIn(300); 
            $("#email_text").fadeOut(300);*/ 
            $("#id_text1").slideDown(500); 
            $("#email_text1").slideUp(500); 
    });
    /*$('#li_cart').hover(function (){
       $('#cart').css('background','#000'); 
    });
    $('#li_cart').mouseout(function (){
       $('#cart').css('background','#B4B4B4'); 
    });*/
   /* $('#li_address').hover(function (){
       $('#address').css('background','#000'); 
    });
    $('#li_address').mouseout(function (){
       $('#address').css('background','#B4B4B4'); 
    });
    $('#li_summary').hover(function (){
       $('#summary').css('background','#000'); 
    });
    $('#li_summary').mouseout(function (){
       $('#summary').css('background','#B4B4B4'); 
    });
    $('#li_payment').hover(function (){
       $('#payment').css('background','#000'); 
    });
    $('#li_payment').mouseout(function (){
       $('#payment').css('background','#B4B4B4'); 
    });*/
});
$(document).ready(function (){
   var string=$('#review_line').text();
   var line="";
   if(string.length>250)
       {
           line=string.slice(0,250);
           $('#review_line').text(line+"...");
       }
       else{
            $('#review_line').text(string);
       }
       //alert(string+"1234567890"+line);
     
     $('#fullreview').click(function (){
            $('#review_line').text(string);
         $('#fullreview').hide();
     });
});
$(document).ready(function (){
   $('.remove_cof').colorbox({ inline:true, 
    onComplete : function() { 
       $(this).colorbox.resize();
    }    
}); 
$('.update_lk').colorbox({ inline:true, 
    onComplete : function() { 
       $(this).colorbox.resize();
    }    
}); 
$('.review_or').colorbox({ inline:true, 
    onComplete : function() { 
       $(this).colorbox.resize();
    }    
}); 
$('.deleteproreview').colorbox({ inline:true, 
    onComplete : function() { 
       $(this).colorbox.resize();
    }    
}); 
$('.editproreview').colorbox({ inline:true, 
    onComplete : function() { 
       $(this).colorbox.resize();
    }    
});
$('.bargain_req').colorbox({ inline:true, 
    onComplete : function() { 
       $(this).colorbox.resize();
    }    
});
});
$(document).ready(function (){
    $('li#savelist1').hover(function (){
        $(this).children('div#removesave').slideDown(90); 
    },function (){
       $(this).children('div#removesave').slideUp(90);
        return false;
    });
    $('div#productlisting1').hover(function (){
        $(this).children('div#removewish').slideDown(90); 
    },function (){
       $(this).children('div#removewish').slideUp(90);
        return false;
    });
    $('div#bargainlist').hover(function (){
        $(this).children('div#bargainlistdiv').slideDown(90); 
    },function (){
       $(this).children('div#bargainlistdiv').slideUp(90);
        return false;
    });
    $('li#productli1').hover(function (){
        $(this).children('div#productlidiv').slideDown(90); 
    },function (){
       $(this).children('div#productlidiv').slideUp(90);
        return false;
    });
});
$(document).ready(function(){
//Home Banner
$( "a.removesavelist" ).click(function() {
 $(this).parents("li.savedlist").hide(100);
});
$(function(){
  $('#homeslides').slides({
	  preload: true,
	  effect: 'slide',
	  generateNextPrev: false,
	  pagination: true,
	  generatePagination: true, 
  });
});
$(function() { 
		$("#preview").tabs(); 
	});
        $( "a.removewishlist" ).click(function() {
 $(this).parents("div.productlisting").hide(100);
});
$( "a.removebargain" ).click(function() {
 $(this).parents("div.proddbox").hide(100);
});
$( "a.removeprodlink" ).click(function() {
 $(this).parents("li.productli").hide(100);
});
});
$(function() {
		$( "#from" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
			onClose: function( selectedDate ) {
				$( "#to" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#to" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			numberOfMonths: 1,
			onClose: function( selectedDate ) {
				$( "#from" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
});
$(function() {
		$( "#slider-range" ).slider({
			range: true,
			min: 0,
			max: 100000,
			values: [ 5000, 10000 ],
			slide: function( event, ui ) {
				$( "#amount_f" ).text( "Rs " + ui.values[ 0 ]);
                                $( "#amount_t" ).text("Rs " + ui.values[ 1 ] );
			}
		});
		$( "#amount_f" ).text( "Rs " + $( "#slider-range" ).slider( "values", 0 ));
		$( "#amount_t" ).text("Rs" + $( "#slider-range" ).slider( "values", 1 ) );
	});