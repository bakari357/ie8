//------------------------------
//Picker
//------------------------------

jQuery(function() {
"use strict";
	jQuery( "#datepicker,#datepicker2,#datepicker3,#datepicker4,#datepicker5,#datepicker6,#datepicker7,#datepicker8" ).datepicker();
});


//------------------------------
//Custom Select
//------------------------------
jQuery(document).ready(function(){
"use strict";
	jQuery('.mySelectBoxClass').customSelect();

	/* -OR- set a custom class name for the stylable element */
	//jQuery('.mySelectBoxClass').customSelect({customClass:'mySelectBoxClass'});
});

function mySelectUpdate(){
"use strict";
	setTimeout(function (){
		jQuery('.mySelectBoxClass').trigger('update');
	}, 200);
}

jQuery(window).resize(function() {
	mySelectUpdate();
});


//------------------------------
//CaroufredSell
//------------------------------
jQuery(document).ready(function(jQuery){
"use strict";
	jQuery("#foo").carouFredSel({
		width: "100%",
		height: 240,
		items: {
			visible: 5,
			minimum: 1,
			start: 2
		},
		scroll: {
			items: 1,
			easing: "easeInOutQuad",
			duration: 500,
			pauseOnHover: true
		},
		auto: false,
		prev: {
			button: "#prev_btn",
			key: "left"
		},
		next: {
			button: "#next_btn",
			key: "right"
		},				
		swipe: true
	});
		jQuery("#menu_foo1").carouFredSel({
		width: "100%",
		height: 240,
		items: {
			visible: 5,
			minimum: 1,
			start: 2
		},
		scroll: {
			items: 1,
			easing: "easeInOutQuad",
			duration: 500,
			pauseOnHover: true
		},
		auto: false,
		prev: {
			button: "#menuprev_btn1",
			key: "left"
		},
		next: {
			button: "#menunext_btn1",
			key: "right"
		},				
		swipe: true
	});
	jQuery("#homefoo4").carouFredSel({
		width: "100%",
		height: 240,
		items: {
			visible: 5,
			minimum: 1,
			start: 2
		},
		scroll: {
			items: 1,
			easing: "easeInOutQuad",
			duration: 500,
			pauseOnHover: true
		},
		auto: false,
		prev: {
			button: "#homeprev_btn4",
			key: "left"
		},
		next: {
			button: "#homenext_btn4",
			key: "right"
		},				
		swipe: true
	});
	jQuery("#shomefoo4").carouFredSel({
		width: "100%",
		height: 250,
		items: {
			visible: 4,
			minimum: 1,
			start: 2
		},
		scroll: {
			items: 1,
			easing: "easeInOutQuad",
			duration: 500,
			pauseOnHover: true
		},
		auto: false,
		prev: {
			button: "#shomeprev_btn4",
			key: "left"
		},
		next: {
			button: "#shomenext_btn4",
			key: "right"
		},				
		swipe: true
	});
		jQuery("#menu_foo1").carouFredSel({
		width: "100%",
		height: 240,
		items: {
			visible: 5,
			minimum: 1,
			start: 2
		},
		scroll: {
			items: 1,
			easing: "easeInOutQuad",
			duration: 500,
			pauseOnHover: true
		},
		auto: false,
		prev: {
			button: "#menuprev_btn1",
			key: "left"
		},
		next: {
			button: "#menunext_btn1",
			key: "right"
		},				
		swipe: true
	});
	
	jQuery("#hot_foo1").carouFredSel({
		width: "100%",
		height: 240,
		items: {
			visible: 5,
			minimum: 1,
			start: 2
		},
		scroll: {
			items: 1,
			easing: "easeInOutQuad",
			duration: 500,
			pauseOnHover: true
		},
		auto: false,
		prev: {
			button: "#hotprev_btn1",
			key: "left"
		},
		next: {
			button: "#hotnext_btn1",
			key: "right"
		},				
		swipe: true
	});

	jQuery("#artistfoo2").carouFredSel({
		width: "100%",
		height: 240,
		items: {
			visible: 5,
			minimum: 1,
			start: 2
		},
		scroll: {
			items: 1,
			easing: "easeInOutQuad",
			duration: 500,
			pauseOnHover: true
		},
		auto: false,
		prev: {
			button: "#artistprev_btn2",
			key: "left"
		},
		next: {
			button: "#artistnext_btn2",
			key: "right"
		},				
		swipe: true
	});	
	jQuery("#foo2").carouFredSel({
		width: "100%",
		height: 240,
		items: {
			visible: 5,
			minimum: 1,
			start: 2
		},
		scroll: {
			items: 1,
			easing: "easeInOutQuad",
			duration: 500,
			pauseOnHover: true
		},
		auto: false,
		prev: {
			button: "#prev_btn2",
			key: "left"
		},
		next: {
			button: "#next_btn2",
			key: "right"
		},				
		swipe: true
	});
	
	jQuery("#foo1").carouFredSel({
		width: "100%",
		height: 240,
		items: {
			visible: 5,
			minimum: 1,
			start: 2
		},
		scroll: {
			items: 1,
			easing: "easeInOutQuad",
			duration: 500,
			pauseOnHover: true
		},
		auto: false,
		prev: {
			button: "#prev_btn1",
			key: "left"
		},
		next: {
			button: "#next_btn1",
			key: "right"
		},				
		swipe: true
	});

	
	
jQuery("#foo3").carouFredSel({
		width: "100%",
		items: {
			visible: 5,
			minimum: 1,
			start: 2
		},
		scroll: {
			items: 1,
			easing: "easeInOutQuad",
			duration: 500,
			pauseOnHover: true
		},
		auto: false,
		prev: {
			button: "#prev_btn3",
			key: "left"
		},
		next: {
			button: "#next_btn3",
			key: "right"
		},				
		swipe: true
	});
	
	
	
	jQuery("#foo5").carouFredSel({
		width: "100%",
		height: 240,
		items: {
			visible: 5,
			minimum: 1,
			start: 2
		},
		scroll: {
			items: 1,
			easing: "easeInOutQuad",
			duration: 500,
			pauseOnHover: true
		},
		auto: false,				
		prev: {
			button: "#prev_btn5",
			key: "left"
		},
		next: {
			button: "#next_btn5",
			key: "right"
		},				
		swipe: true
	});
	
	jQuery("#foo6").carouFredSel({
		width: "100%",
		height: 240,
		items: {
			visible: 5,
			minimum: 1,
			start: 2
		},
		scroll: {
			items: 1,
			easing: "easeInOutQuad",
			duration: 500,
			pauseOnHover: true
		},
		auto: false,				
		prev: {
			button: "#prev_btn6",
			key: "left"
		},
		next: {
			button: "#next_btn6",
			key: "right"
		},				
		swipe: true
	});
	

});



//------------------------------
//Add rooms
//------------------------------
		function addroom2(){
		"use strict";
			jQuery('.room2').addClass('block');
			jQuery('.room2').removeClass('none');
			jQuery('.addroom1').removeClass('block');
			jQuery('.addroom1').addClass('none');
			
		}
		function removeroom2(){
		"use strict";
			jQuery('.room2').addClass('none');
			jQuery('.room2').removeClass('block');
			
			jQuery('.addroom1').removeClass('none');
			jQuery('.addroom1').addClass('block');
		}
		function addroom3(){
		"use strict";
			jQuery('.room3').addClass('block');
			jQuery('.room3').removeClass('none');
			
			jQuery('.addroom2').removeClass('block');
			jQuery('.addroom2').addClass('none');
		}
		function removeroom3(){
		"use strict";
			jQuery('.room3').addClass('none');
			jQuery('.room3').removeClass('block');
			
			jQuery('.addroom2').removeClass('none');
			jQuery('.addroom2').addClass('block');			
		}
	

	
	
	
//------------------------------
//Nice Scroll
//------------------------------
		jQuery(document).ready(function() {
		"use strict";
			var nice = jQuery("html").niceScroll({
				cursorcolor:"#ccc",
				cursorborder :"0px solid #fff",			
				railpadding:{top:0,right:0,left:0,bottom:0},
				cursorwidth:"5px",
				cursorborderradius:"0px",
				cursoropacitymin:0,
				cursoropacitymax:0.7,
				boxzoom:true,
				autohidemode:false
			});  
			
			jQuery("#air").niceScroll({horizrailenabled:false});
			jQuery("#hotel").niceScroll({horizrailenabled:false});
			jQuery("#car").niceScroll({horizrailenabled:false});
			jQuery("#vacations").niceScroll({horizrailenabled:false});
			

			jQuery('html').addClass('no-overflow-y');
			
		});
	
	
	
	
//------------------------------
//Slider parallax effect
//------------------------------
	
jQuery(document).ready(function(jQuery){
"use strict";
var jQueryscrollTop;
var jQueryheaderheight;
var jQueryloggedin = false;
	
if(jQueryloggedin == false){
  jQueryheaderheight = jQuery('.navbar-wrapper2').height() - 20;
} else {
  jQueryheaderheight = jQuery('.navbar-wrapper2').height() + 100;
}


jQuery(window).scroll(function(){
"use strict";
  var jQueryiw = jQuery('body').innerWidth();
  jQueryscrollTop = jQuery(window).scrollTop();	   
	  if ( jQueryiw < 992 ) {
	 
	  }
	  else{
	   jQuery('.navbar-wrapper2').css({'min-height' : 0-(jQueryscrollTop/2) +'px'});
	  }

  //jQuery(".sboxpurple").css({'opacity' : 1-(jQueryscrollTop/300)});
  jQuery(".scrolleffect").css({'top': ((- jQueryscrollTop / 5)+ jQueryheaderheight) + 7  + 'px' });
  jQuery(".tp-leftarrow").css({'left' : 20-(jQueryscrollTop/2) +'px'});
  jQuery(".tp-rightarrow").css({'right' : 20-(jQueryscrollTop/2) +'px'});
});

});
	
	
	
//------------------------------
//SCROLL ANIMATIONS
//------------------------------	

	jQuery(window).scroll(function(){       
	"use strict";	
		var jQueryiw = jQuery('body').innerWidth();
		
		if(jQuery(window).scrollTop() != 0){
			jQuery('.mtnav').stop().animate({top: '-9px'}, 500);
			jQuery('.logo').stop().animate({width: '100px'}, 100);

		}       
		else {
			 if ( jQueryiw < 992 ) {
			  }
			  else{
			   jQuery('.mtnav').stop().animate({top: '-9px'}, 500);
			  }
			
			
			jQuery('.logo').stop().animate({width: '120px'}, 100);		
	
		}
		
		
		//Social
		if(jQuery(window).scrollTop() >= 300){
			jQuery('.social1').stop().animate({top:'0px'}, 100);
			
			setTimeout(function (){
				jQuery('.social2').stop().animate({top:'0px'}, 100);
			}, 100);
			
			setTimeout(function (){
				jQuery('.social3').stop().animate({top:'0px'}, 100);
			}, 200);
			
			setTimeout(function (){
				jQuery('.social4').stop().animate({top:'0px'}, 100);
			}, 300);
			
			setTimeout(function (){
				jQuery('.gotop').stop().animate({top:'0px'}, 200);
			}, 400);				
			
		}       
		else {
			setTimeout(function (){
				jQuery('.gotop').stop().animate({top:'100px'}, 200);
			}, 400);	
			setTimeout(function (){
				jQuery('.social4').stop().animate({top:'-120px'}, 100);				
			}, 300);
			setTimeout(function (){
				jQuery('.social3').stop().animate({top:'-120px'}, 100);		
			}, 200);	
			setTimeout(function (){
			jQuery('.social2').stop().animate({top:'-120px'}, 100);		
			}, 100);	

			jQuery('.social1').stop().animate({top:'-120px'}, 100);			

		}
		
		
	});	
	
	
	
	
	
	
//------------------------------
//ROLLOVER
//------------------------------
	
var theSide = 'marginLeft';
var options = {};
options[theSide] = jQuery('.one').width()/2-15;
jQuery(".one")
	.mouseenter(function() {
		jQuery(".mhover", this).addClass( "block" );
		jQuery(".mhover", this).removeClass( "none" );
		jQuery(".icon", this).stop().animate(options, 100);
	})
jQuery(".one").mouseleave(function() {
		jQuery(".mhover", this).addClass( "none" );
		jQuery(".mhover", this).removeClass( "block" );
		jQuery(".icon", this).stop().animate({marginLeft:"0px"}, 100);
	});



