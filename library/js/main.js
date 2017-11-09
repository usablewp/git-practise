// Avoid `console` errors in browsers that lack a console.
(function($) {
  var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}(jQuery));

// Place any jQuery/helper plugins in here.
;(function($){

  /* -----------------------------------------------------------------*/
  /* Flexslider
  /* -----------------------------------------------------------------*/
  $(window).load(function() {
    $('.flexslider').flexslider({
      pauseOnHover: true,
      animation:'fade',
      controlNav: true,
      directionNav: false,
    });
  });

  /* -----------------------------------------------------------------*/
  /* Off Canvas Navigation
  /* -----------------------------------------------------------------*/
  var controller = new slidebars();
  controller.init();
  $( '.mobile-menu-toggle, .sb-close' ).on( 'click', function ( event ) {
    // Stop default action and bubbling
    event.stopPropagation();
    event.preventDefault();

    // Toggle the Slidebar with id 'id-1'
    controller.toggle( 'id-3' );
  } );

  if (window.matchMedia("(max-width: 1019px)").matches) {
    var main_header_height = $('#main-header').outerHeight();
    $('.sb-slidebar').css({ 'top': main_header_height + 25 + 'px' });
  }

  /* ------------------------------------------------------*/
  /* Adding fitvid
  /* ------------------------------------------------------*/
  $('.page-wrapper').fitVids();

  /* -----------------------------------------------------------------*/
  /* Mobile Submenu Toggle
  /* -----------------------------------------------------------------*/
  $('.mobile-menu').find('.menu-item-has-children').children('a').on('click',function(e){
      e.preventDefault();
      $(this).next().slideToggle(300);
  });

  /* -----------------------------------------------------------------*/
  /* Activate accessible superfish
  /* -----------------------------------------------------------------*/
  $('#main-header').find('.menu').superfish({
      smoothHeight	: true,
      delay			: 600,                        // one second delay on mouseout
      animation		: {
          opacity :'show',
          height  :'show'
      },  										  // fade-in and slide-down animation
      speed			: 'fast',                     // faster animation speed
      autoArrows		: false                       // disable generation of arrow mark-up
  });

  /* -----------------------------------------------------------------*/
  /* matchHeight
  /* -----------------------------------------------------------------*/
  $('.two-column-whistles .plain-whistle,.more-articles.type-1 .related-article-container').matchHeight();

  /* -----------------------------------------------------------------*/
  /* Slick Carousel
  /* -----------------------------------------------------------------*/
  $('.slick-carousel').slick();

  /* -----------------------------------------------------------------*/
  /* Reach Us form mobile toggle functionality
  /* -----------------------------------------------------------------*/
  $('.reachus:not(.diabetes-clinics-link)').click(function(){
    $('.reachus-form-mobile').slideToggle();
  });

  /* -----------------------------------------------------------------*/
  /* Magnific Popup
  /* -----------------------------------------------------------------*/

  $('.two-column-gallery').each(function() { // the containers for all your galleries
    	$(this).magnificPopup({
	        delegate	: 'a', // the selector for gallery item
	        type		: 'image',
	        gallery		: {
	          	enabled : true
	        }
	    });
	});

  $('.nf-popup a').magnificPopup({
		type		: 'inline',
		preloader	: false,
		focus		: '#name',
		removalDelay: 300,
		// When elemened is focused, some mobile browsers in some cases zoom in
		// It looks not nice, so we disable it:
		callbacks: {
			beforeOpen: function() {
				this.st.mainClass = this.st.el.attr('data-effect');
				if($(window).width() < 700) {
					this.st.focus = false;
				} else {
					this.st.focus = '#name';
				}
			}
		}
	});
  /* -----------------------------------------------------------------*/
  /* Waypoints
  /* -----------------------------------------------------------------*/
  /*if( $( "#main-header" ).hasClass( "logo-with-menu" ) ){
    var sticky = new Waypoint.Sticky({
      element: $('.logo-with-menu')[0]
    });
  }*/

  /* -----------------------------------------------------------------*/
  /* Our Locations & Our Doctors Functionality
  /* -----------------------------------------------------------------*/

  locationFilter = function ( clinicCityClass, clinicLocationClass, parentContainer, useDefault, useSlug ) {

        $(clinicCityClass).change(function(){
             var citySelect = $(this),
                city = citySelect.val(),
                locationSelect = citySelect.parents(parentContainer).find(clinicLocationClass);
                locationSelect.empty().append('<option>Loading Locations...</option>');
            if(city != "default") {

                $.ajax({
                    type: 'POST',
                    url: ajax_object.ajax_url,
                    data: { clinicCity : city, action: 'get_location_name', useSlug: useSlug },
                    success: function(data){
                        locationSelect.empty();
                        locationSelect.append('<option value="">Select Your Area</option>')
                        var options = $.parseJSON(data);
                        for(i=0;i<options.length;i++){
                            var selectedLocation = locationSelect.data('selected')
                            var selected = '';
                            if( selectedLocation === options[i].value ){
                              var selected = 'selected';
                            }
                            locationSelect.append('<option value="'+options[i].value+'"'+ selected +'>'+options[i].text+'</option>');
                        }
                        locationSelect.removeAttr('disabled');
                    }
                });

            }

        });

  }

  doctorFilter = function ( locationSelectClass ) {
        jQuery('<div/>', {
            id: 'doctors-available',
        }).appendTo('#field_3_5').hide();
        $( '#input_3_4' ).change(function(){
          $( '#doctors-available' ).empty();
        });
        $(locationSelectClass).change(function(){
             $( '#doctors-available' ).html('Loading Doctors....').show();
             var locationSelect = $(this),
                location = locationSelect.val();
            if(location != "") {
                $.ajax({
                    type: 'POST',
                    url: ajax_object.ajax_url,
                    data: { location : location, action: 'get_doctors_list'},
                    success: function(data){
                        var options = $.parseJSON(data);
                        var html = '';
                        html += '<table>';
                        for( var i = 0; i < options.length; i++ ){
                            html += '<tr>';
                            html += '<th>';
                            html += options[i].name;
                            html += '</th>';
                            html += '<td>';
                            html += '<ul>';
                            html += options[i].data;
                            html += '</ul>';
                            html += '</td>';
                            html += '</tr>';
                        }

                        html += '</table>';
                        $('#doctors-available').html(html);
                    }
                });

            }

        });

  }

  if( $('body').hasClass('page-template-book-an-appointment') ){
      locationFilter('.clinic-city select', '.clinic-location select', 'form', true, false);
      doctorFilter( '#input_3_5' );
  }

  if( $('body').hasClass('page-template-our-locations') ){
    $(window).bind("pageshow", function() {
      $( '#filter-city' ).trigger('change');
    });
      locationFilter('#filter-city', '#filter-location', '.filter-container', true, true);
      $("#display-locations").click(function() {
            var filter_city;
            var filter_location;
            if(filter_city = jQuery("#filter-city").val()) {
                if(filter_location = jQuery("#filter-location").val()) {
                    window.location.href = ajax_object.our_locations_link + filter_city + '/' + filter_location;
                }
                else {
                    window.location.href = ajax_object.our_locations_link + filter_city;
                }
            }
        });
  }

  if( $('body').hasClass('page-template-diabetes-specialists') ){
    $(window).bind("pageshow", function() {
      $( '#filter-city' ).trigger('change');
    });
      locationFilter('#filter-city', '#filter-location', '.filter-container', true, true);
      $("#display-doctors").click(function() {
            var filter_city;
            var filter_location;
            if(filter_city = jQuery("#filter-city").val()) {
                if(filter_location = jQuery("#filter-location").val()) {
                    window.location.href = ajax_object.diabetes_specialist_link + filter_location;
                } else{
                    window.location.href = ajax_object.diabetes_specialist_link + filter_city;
                }
            }
        });
  }

  $(document).bind('gform_post_render', function(event, form_id){
    if(form_id == 3) {
        locationFilter('.clinic-city select', '.clinic-location select', 'form');
    }
  });

  $('[data-toggle="popover"]').popover();

  /* -----------------------------------------------------------------*/
  /* Ticker Hide & Show
  /* -----------------------------------------------------------------*/

  $('#ticker').find('a').click( function( e ){
    e.preventDefault();
    $(this).addClass('hide-me');
    $('#footer #enquire-now').toggle('slide');
  });
  $('.close-form').click( function( e ){
    e.preventDefault();
    $('#ticker a').removeClass('hide-me');
    $('#footer #enquire-now').toggle('slide');
  });

})(jQuery);
