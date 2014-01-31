(function($){ //create closure so we can safely use $ as alias for jQuery
$(document).ready(function(){
	var exampleOptions = {
	  speed: 'normal'
	}
	var example = $('#menu').superfish(exampleOptions);
});
})(jQuery);
$(document).ready(function(){

/* $( "a.selsearch" ).click(function() {
  $(this).next('#multipleareas').css("display", "block").delay(300).fadeIn(300);
}, function() {
   $(this).next('#multipleareas').css("display", "none").fadeOut(10);
}); */
 
$('.selsearch').click(function(e){
  e.preventDefault(); //to prevent default action of link tag
  $(this).next('#multipleareas').slideToggle(100);
});

$('.inpselsearch').keyup(function(e){
	var str=$(this).val().toLowerCase();
	
	$('#multipleareas').show();
	$('.majorArealis').hide();
	if(str.length>=1) {
	
	//console.log('I AM HERE');
		$('.commencheck').each(function(index,value){
			var id1=$(this).attr('id').toLowerCase();
			
			if(id1.substring(0,str.length)==str) {
				$(this).parent().show();
			}
		});
	}
});

$('.commencheck').click(function(){
	//var thisCheck = $(this);
	if ($(this).is(':checked'))
	{
		//alert($(this).attr('id'));
	}
	else
	{
		//alert('unchecked');
	}
});
/* $( "div.selsearchholder" ).hover(function() {
  $(this).find('#multipleareas').delay(300).fadeIn(300);
}, function() {
   $(this).find('#multipleareas').fadeOut(10);
});
*/


/*$( ".maincat" ).hover(function() {
  $(this).children('div.submenu').delay(300).fadeIn(300);
}, function() {
  $(this).children('div.submenu').fadeOut(10);
});
*/
$("a.advsearch").click(function(){
	$("#advancesearchbox").slideToggle("fast");
	//$(this).toggleClass("active"); return false;
});

$( "div.cityholder" ).hover(function() {
  $(this).find('#cities').delay(300).fadeIn(300);
}, function() {
   $(this).find('#cities').fadeOut(10);
});

$("a.city").click(function(){
	$("#cities").slideToggle(300);
	$(this).toggleClass("selsearchactive"); return false;
	
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
/* $(".signininline").colorbox({inline:true,});
$(".signupinline").colorbox({inline:true,});
$(".verificationinline").colorbox({inline:true,}); */

//$(".shotlogininline").colorbox({inline:true, maxWidth: '75%', width:"auto"});

$('.shotlogininline').colorbox({ inline:true, 
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
$(function() { $( "#pinger" ).tabs(); }); });


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
	$(function() { $( "#mostview" ).tabs(); });
	$(function() { $( "#preview" ).tabs(); });

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
			// $(this).find('#multipleareas').delay(400).fadeIn(10);
		} else {
			$('.default').removeClass("fixed");
		}
	});


$( "div.mainnavdropholder" ).hover(function() {
  $(this).find('#innernavigation').delay(300).fadeIn(300);
  $( "body" ).append( "<div id='boxoverlay'></div>" );
}, function() {
   $(this).find('#innernavigation').fadeOut(10);
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

/////
	
// Inner pages left menu
$("#leftaccordion h3.sorttitle").click(function () {
	$(this).next(".sortbox").toggle();
	$(this).addClass("sorttitlehide");
});
});