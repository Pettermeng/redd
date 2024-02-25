//$ = jQuery.noConflict();
	
	var ls_curr_slider = [];

	//initial trigger
	jQuery(document).ready(function($){

	//$ = jQuery.noConflict();	

		ls_trigger_sliders(); 

		/*

		to trigger the slider reload on orientation change.
		work in progress.

		jQuery(window).on('resize orientationchange', function() {

			for (var i = 0; i < ls_curr_slider.length; i++) {

				ls_curr_slider[i].reloadSlider();

			   //console.log(ls_curr_slider[i]);
			}

		});

		*/
		
	});

	//to load after an ajax
	jQuery(document).ajaxSuccess(function($) {

		//ls_trigger_sliders(); 
			
	});





	function ls_trigger_sliders() {

		for (var key in lssliderparam) {			

			 var auto = (lssliderparam[key]['auto'] === 'true');
			 var pause = parseInt(lssliderparam[key]['pause']);
			 var autohover = (lssliderparam[key]['autohover'] === 'true');
			 var ticker = (lssliderparam[key]['ticker'] === 'true');
			 var tickerhover = (lssliderparam[key]['tickerhover'] === 'true');
			 var usecss = (lssliderparam[key]['usecss'] === 'true');
			 var autocontrols = (lssliderparam[key]['autocontrols'] === 'true');
			 var speed = parseInt(lssliderparam[key]['speed']);
			 var slidemargin = parseInt(lssliderparam[key]['slidemargin']);
			 var infiniteloop = (lssliderparam[key]['infiniteloop'] === 'true');
			 var pager = (lssliderparam[key]['pager'] === 'true');
			 var controls = (lssliderparam[key]['controls'] === 'true');
			 var slidewidth = parseFloat(lssliderparam[key]['slidewidth']);
			 var minslides = parseInt(lssliderparam[key]['minslides']);
			 var maxslides = parseInt(lssliderparam[key]['maxslides']);
			 var moveslides = parseInt(lssliderparam[key]['moveslides']);
			 var tmode = lssliderparam[key]['mode']; //options: 'horizontal', 'vertical', 'fade'

			 //fix bug of 1 slider only infinite loop not working
			 //another solution could be adding the slidemargin to 
			 //the slideWidth and align the images in the center
			 if(maxslides==1 && ticker==false){
			 	slidemargin = null;
			 }

			 //remove pager space by setting pager to false for ticker
			 if(ticker == true) {
			 	controls = false;
			 }

			 var sliderDiv = jQuery(lssliderparam[key]['divid']);
			 //sometimes the div is passed wrong, so we built a temp fix here:
			 //if(sliderDiv==false) {
			 	//sliderDiv = $('.lshowcase-wrap-carousel-1');
			 //}

			 //To improve responsive behaviour we force the limit of 1 slide in small viewports
			 if(maxslides==0 && ticker == false) {

			 	var view_width = sliderDiv.parent().width();

			 	if(controls == true ) { view_width = view_width-70; }

				 var slider_real = slidemargin + slidewidth;
				 maxslides = Math.floor(view_width/slider_real);

			 } 
			 
			 if(maxslides==0 && ticker != false) { 
			 	maxslides = 99;
			 }

			sliderDiv.fadeIn('slow');

		    

		    ls_curr_slider[key] = sliderDiv.bxSlider({				
		    auto: auto,		
			pause: pause,
			autoHover: autohover,
			ticker: ticker,
			tickerHover: tickerhover,
			useCSS: usecss,
			autoControls: autocontrols,
			mode: tmode, 
			speed: speed,
			slideMargin: slidemargin,
			infiniteLoop: infiniteloop,
		    pager: pager, 
			controls: controls,
		    slideWidth: slidewidth,
		    minSlides: minslides,
		    maxSlides: maxslides,
		    moveSlides: moveslides,
		    autoDirection: 'next',
		    onSliderLoad: function(currentIndex){ 

		    	var sl = sliderDiv.parent().parent();		    	

		    		var marg = '0 35px';

		    		if(controls == false ) { marg = 'none'; }

				   sl.css({
						margin: marg
						}); 

				   sl.parent().css({
						maxWidth: sl.width()+80
						}); 


		    	

		    }

			});

		} 

		//Use Custom Controls
		if( jQuery('#ls-slider-prev').length )  

		{

			//custom controls
			jQuery("#ls-slider-prev").click(function(){
			    ls_curr_slider[0].goToPrevSlide();
			    ls_curr_slider[1].goToPrevSlide();
			    ls_curr_slider[0].stopAuto();
			    ls_curr_slider[1].stopAuto();
			});

			jQuery("#ls-slider-next").click(function(){
			    ls_curr_slider[0].goToNextSlide();
			    ls_curr_slider[1].goToNextSlide();
			    ls_curr_slider[0].stopAuto();
			    ls_curr_slider[1].stopAuto();
			});

		}

		


	}






