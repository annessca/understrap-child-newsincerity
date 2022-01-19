(function($){

	$(document).ready(function () {
	  	$(".owl-carousel").owlCarousel({
		  	center: false,
		    items:1,
		    loop:true,
		    margin:40,
		    nav:true,
		    navText: [
		      "<i class='fa fa-chevron-left'></i>",
		      "<i class='fa fa-chevron-right'></i>"
		    ],
		    responsive:{
		        600:{
		            items:3
		        }
		    }
		});
		$('#category_tabs').tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
		$('.search-container form .field').focusin( function(){
	        	this.placeholder = ''; 
	        });
	  var trigger = $('.hamburger'),

	      overlay = $('.overlay'),
	      searchtrigger = $('.menu-side'),
	      pushtrigger = $('.hamburger-push-menu'),
	      searchbox = $('.search-container'),
	      pushsection = $('.pull-above-section'),
	      inputfocus = $('.search-container form .field '),
	     isClosed = false;

	    trigger.click(function () {

	      hamburger_cross();      

	    });
	    searchtrigger.click(function(){
	    	search_cross();
	    });

	    pushtrigger.click(function(){
	    	pushtrigger_cross();
	    });


	    function hamburger_cross() {



	      if (isClosed == true) {          

	        overlay.hide();

	        trigger.removeClass('is-open');

	        trigger.addClass('is-closed');

	        isClosed = false;

	      } else {   

	        overlay.show();

	        trigger.removeClass('is-closed');

	        trigger.addClass('is-open');

	        isClosed = true;

	      }

	  }

	  function pushtrigger_cross() {



	      if (isClosed == true) {          

	        pushtrigger.removeClass('is-open');

	        pushtrigger.addClass('is-closed');

	        pushsection.removeClass('is-showing');

	        isClosed = false;

	      } else {   


	        pushtrigger.removeClass('is-closed');

	        pushtrigger.addClass('is-open');
	        pushsection.addClass('is-showing');

	        isClosed = true;

	      }

	  }

	  function search_cross(){
	  	if (isClosed == true) {          


	        searchbox.removeClass('active');
	        searchtrigger.removeClass('active');
	        inputfocus.val(' ');
	        inputfocus.placeholder = 'Search …'; 
	        isClosed = false;

	      } else {   
	        searchtrigger.addClass('active');
	        searchbox.addClass('active');
	        inputfocus.focus();
	        $(inputfocus).on ('blur', function(){
	        	this.placeholder = 'Search …'; 
	        });
	        isClosed = true;

	      }
	  }
	  

	  $('[data-toggle="offcanvas"]').click(function () {

	        $('#page').toggleClass('toggled');

	  });
	  

	});
	/*$('.yikes-easy-mc-error-message, .yikes-easy-mc-success-message').on ('click' , function() {
	  		//console.log('alert');
	  		$('.yikes-easy-mc-success-message, .yikes-easy-mc-error-message').hide('slow');  
	  });*/
	  
	  var ad_img_height = $('.ad_wrapper img').height();
    /*if ($(window).width() < 960) {
	    $(window).scroll(function() {
	        if ($(this).scrollTop() >= 20) {
	            $('.post_share.footer-fixed').addClass('open');
	        }
	        else {
	            $('.post_share.footer-fixed').removeClass('open');
	        }
	    });
	} else {
		$(window).scroll(function() {
	        if ($(this).scrollTop() >= 20) {
	            $('.post_share.footer-fixed').addClass('open');
	        }
	        else {
	            $('.post_share.footer-fixed').removeClass('open');
	        }
	    });
	}*/
	$('.ad_wrapper').hide();
	$(document).ready(function(){
		$('.ad_wrapper').delay(1000).slideDown(200).height( 'auto' );
		//$('.ad_wrapper').;
		var ad_height = $('.ad_wrapper').height();
		$(window).scroll(function() {
	        if ($(this).scrollTop() > ad_height) {
	            $('body').addClass('stickytop');
	        }
	        else {
	            $('body').removeClass('stickytop');
	        }
	    });
	});
	 //$(window).scroll(function() {
	  //  var scroll = $(window).scrollTop();
	   // var top = $('html').offset().top;
	    /*if (scroll === top ) {
	      $('.ad_wrapper').show(100);
	    } else {
	      $('.ad_wrapper').hide(100);
	    }*/
//	}); 
})(jQuery);

