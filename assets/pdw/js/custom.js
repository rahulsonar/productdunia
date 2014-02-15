(function($){ //create closure so we can safely use $ as alias for jQuery
$(document).ready(function(){
	var exampleOptions = {
	  speed: 'normal'
	}
	var example = $('#menu').superfish(exampleOptions);
});
})(jQuery);
$(document).ready(function(){
function ArrNoDupe(a) {
    var temp = {};
    for (var i = 0; i < a.length; i++)
        temp[a[i]] = true;
    var r = [];
    for (var k in temp)
        r.push(k);
    return r;
}

/* $( "a.selsearch" ).click(function() {
  $(this).next('#multipleareas').css("display", "block").delay(300).fadeIn(300);
}, function() {
   $(this).next('#multipleareas').css("display", "none").fadeOut(10);
}); */
 
$('.selsearch').click(function(e){
  e.preventDefault(); //to prevent default action of link tag
  $('#multipleareas').slideToggle(100);
  $('#multipleareas2').hide();
});


$('.inpselsearch').keyup(function(e){
	var str=$(this).val().toLowerCase();
	if(str=='') {
		$('.commencheck').removeAttr('checked');
		$('.subareaList').html('');
		var datastring='final_val=';
	$.post('http://localhost/productduniya/index.php/product/savearea',datastring,function(r){ console.log(r); });
	}
	var str2=str.split(',');
	str2=ArrNoDupe(str2);
	str=str2[(str2.length-1)];
	str=str.trim();
	
	$('#multipleareas2').show();
	$('#multipleareas').hide();
	$('#multipleareas2 .majorArealis').hide();
	if(str.length>=1) {
	
	//console.log('I AM HERE');
	var count=0;
		$('#multipleareas2 .commencheck').each(function(index,value){
			var id1=$(this).attr('id').toLowerCase();
			id1=id1.split("_");
			
			if(id1[2].substring(0,str.length)==str) {
				count++;
				$(this).parent().show();
			}
		});
		if(count==0) $('#multipleareas2').hide();
	}
	else {
	$('#multipleareas2').hide();
	}
});
var sub_ids=[];
function checkUncheckFunc(t) {
	var thisId=t.attr('id');
	var thisId1=thisId.split("_");
	
	if(t.is(':checked')) {
	
	$("#majora_"+thisId1[1]+"_"+thisId1[2]).attr('checked','checked');
	$("#all_"+thisId1[1]+"_"+thisId1[2]).attr('checked','checked');
	}
	else
	{
		$("#majora_"+thisId1[1]+"_"+thisId1[2]).removeAttr('checked');
		$("#all_"+thisId1[1]+"_"+thisId1[2]).removeAttr('checked');
	}
	var ids_all=[];
	var all_names=[];
	
	$('.commencheck:checked').each(function(){
		var id=$(this).attr('id');
		var id1=id.split("_");
		if(id1[0]=='sub' && thisId1[1]==id1[1]) {
		sub_ids.push(id1[1]);
		}
		else
		{
			if(id1[0]!='sub') {
			ids_all.push(id1[1]);
			all_names.push(id1[2].trim());
			var index1=sub_ids.indexOf(id1[1]);
			if(index1>-1)
				sub_ids.splice(index1);	
			}
		}
	});
	
	ids_all=ArrNoDupe(ids_all);
	all_names=ArrNoDupe(all_names);
	$('.inpselsearch').val(all_names.join(',')+(all_names!=""?", ":"")).focus();
	
	var datastring='final_val='+ids_all.join(',')+'&sub_ids='+sub_ids.join(',');
	$.post(siteurl+'index.php/product/savearea',datastring,function(r){ 
		$('.subareaList').html(r);
		$('.commencheck').bind('click',function(){
			checkUncheckFunc($(this));
		});
	});
}

$('.commencheck').click(function(){
	
	//var thisId=$(this).attr('id');
	checkUncheckFunc($(this));
	
	
	/*
	//var thisCheck = $(this);
	var id=$(this).parent().attr('id');
	var id2=id.split('_');
	var areaName=$(this).attr('id').replace('all_','');
	var existing=$('.inpselsearch').val();
	var existing1=existing.split(',');
	
	
	existing1.splice(-1,1);
	var ext=existing1.join(',');
	
	var final_val=ext;
	final_val+=(ext=='')?'':', ';
	final_val+=areaName+', ';
	
	if(id.substring(0,4)=='all_') {
		var id1='major_'+id2[1];
		
	}
	else {
		var id1='all_'+id2[1];
	}
	
	
	
	// get ids of all major areas 
	var ids_all=[];
	$('.commencheck:checked').each(function(index){
		ids_all.push($(this).val());
	});
	console.log(ids_all);
	
	if ($(this).is(':checked'))
	{
		var checked=1;
		$('#'+id1+' input').attr('checked','checked');
		if(existing1.indexOf(areaName)<0) {
		$('.inpselsearch').val(final_val);
		}
		$('.chkSAreas').each(function(index){
			var idSArea=$(this).attr('id');
			idS2=idSArea.split("_");
			if(idS2[2]==id2[1]) {
				$(this).attr('checked','checked');
				$(this).parent().show();
			}
		});
		$('.inpselsearch').focus();
	}
	else
	{
		var checked=0;
		$('#'+id1+' input').removeAttr('checked');
		var new1=[];
		
		for(var i=0; i<existing1.length; i++) {
			if(existing1[i].trim()!=areaName.trim()) {
				new1.push(existing1[i]);
			}
		}
		var new2=new1.join(',');
		final_val=new2+(new2!=""?',':'');
		
		$('.inpselsearch').val(final_val);
		$('.inpselsearch').focus();
	}
	var datastring='final_val='+final_val;
	$.post(siteurl+'index.php/product/savearea',datastring,function(r){ console.log(r); });
	*/
	
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