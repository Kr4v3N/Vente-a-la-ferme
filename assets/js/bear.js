(function ($) {
    'use strict';
	
    // WOW Animation
    var wow = new WOW(
        {
            boxClass: 'wow',      // animated element css class (default is wow)
            animateClass: 'animated', // animation css class (default is animated)
            offset: 0,          // distance to the element when triggering the animation (default is 0)
            mobile: false,       // trigger animations on mobile devices (default is true)
            live: true,       // act on asynchronously loaded content (default is true)
            callback: function (box) {
                // the callback is fired every time an animation is started
                // the argument that is passed in is the DOM node being animated
            },
            scrollContainer: null // optional scroll container selector, otherwise use window
        }
    );
    wow.init();

    // Navigation
    var sections = $('section'),
        nav = $('nav'),
        nav_height = nav.outerHeight();

    $(window).on('scroll', function () {
        var cur_pos = $(this).scrollTop();

        sections.each(function () {
            var top = $(this).offset().top - nav_height,
                bottom = top + $(this).outerHeight();

            if (cur_pos >= top && cur_pos <= bottom) {
                nav.find('a').removeClass('active');
                sections.removeClass('active');

                $(this).addClass('active');
                nav.find('a[href="#' + $(this).attr('id') + '"]').addClass('active');
            }
        });
    });

    nav.find('a.page-link').on('click', function () {
        var $el = $(this),
            id = $el.attr('href');

        $('html, body').animate({
            scrollTop: $(id).offset().top - nav_height
        }, 500);

        return false;
    });

    // owl Carousel for logos
    $("#client-tell").owlCarousel({
        autoPlay: 3000, //Set AutoPlay to 3 seconds
        items: 1,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [980, 1],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1]
    });

    // User registration modal functionality
    $("#btn-show-sign-up").on('click', function () {
        $(".register-forms form").animate({ top: '-100%' });
        $('#sign-in').css({ "opacity": "0" });
    });
	
	// Forgot password animation
    $(".forgot-password").on('click', function () {
        $(".register-forms form").animate({ top: '-200%' });
        $('#sign-in').css({ "opacity": "0" });
        $('#sign-up').css({ "opacity": "0" });
    });
    
	// Form close validation
    $(".form-close").on('click', function () {
        $('.user-resistration').fadeOut();
        $(".register-forms form").animate({ top: '0%' });
        $('#sign-in').css({ "opacity": "1" });
        $('#sign-up').css({ "opacity": "1" });
    });

	// Hide overelay for User Registration animation
    $(".hide-overelay").on('click', function () {
        $('.user-resistration').fadeOut();
        $(".register-forms form").animate({ top: '0%' });
        $('#sign-in').css({ "opacity": "1" });
        $('#sign-up').css({ "opacity": "1" });
    });

	// User registration animation
    $(".sign-in-open").on('click', function () {
        $('.user-resistration').fadeIn();
    });

    //Header functionality
    $('.dropdown').hover(function () {
        $(this).find('.dropdown-menu:not(#stayopen)').stop(true, true).delay(100).fadeIn(300);
    }, function () {
        $(this).find('.dropdown-menu:not(#stayopen)').stop(true, true).delay(100).fadeOut(300);
    });

    //search toggle
    $('.search-open').on('click', function () {
        $('.search-bar').toggleClass('active');
    });

	// PreventDefault a click
    $(".event").on('click', function (event) {
        event.preventDefault();
    });


    // Modal Gallary
    $('.img-zoom').on('click', function () {
        var image = $(this).attr('data-img');
        var modaltitel = $(this).attr('data-title');
        $('#gallary-modal').on('show.bs.modal', function () {
            $(".showimage").attr("src", image);
            $('.modal-title').html(modaltitel);
        });
    });

    // Back to Top
    $('.BackToTop, .page-link-home').on('click', function () {
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
        return false;
    });

    // Project Navigation 
    $('.project li').on('click', function () {
        $('.project li').removeClass('active');
        $(this).addClass('active');
    });

	// Show project details
    $('#showall').on('click', function () {
        $('.project-wrapper').show();
    });

	// Show project wrapper
    $('.showSingle').on('click', function () {
        $('.project-wrapper').hide();
        $('.project' + $(this).attr('target')).fadeIn();
    });

    // Carousel for logo
    $('#clint-logo').owlCarousel({
        autoPlay: 3000
    });

	// Tooggle Icon
    $('.panel-group').on('hidden.bs.collapse', toggleIcon);
    $('.panel-group').on('shown.bs.collapse', toggleIcon);

    // Home Pages Demo
    $("#demos-toggle").on('click', function () {
        $("body").toggleClass("demo-open");
    });
	
	// Sroll to top
	$(window).on('scroll', function () {
		if ($(this).scrollTop() > 100) {
			$('.BackToTop').fadeIn();
		} else {
			$('.BackToTop').fadeOut();
		}
	});
	
	// Website loader
	$(window).on('load', function () {
		$('.loader').fadeOut(500);
	});
	
	// Sticky Active Code
	$(window).on('scroll', function () {
		if ($(window).scrollTop() >= 0) {
			$('header').addClass('fixed-header');
		}
		else {
			$('header').removeClass('fixed-header');
		}
	});
	
	// Page loader
	$(window).on('scroll', function () {
		setTimeout(function () {
			$(".loader-process").fadeOut();
		}, 1000);
	});

})(jQuery);

// Accordion function
function toggleIcon(e) {
    $(e.target)
        .prev('.panel-heading')
        .find(".more-less")
        .toggleClass('glyphicon-plus glyphicon-minus');
}

// contact form by email

$('#contactButton').click(e => {
    e.preventDefault();
    $('#contactForm').slideDown();
    $('#contactButton').slideUp();
})


// Form search autocomplete
import Places from 'places.js'

let inputAddress = document.querySelector('#farmer_address, #farmer_profil_address')
if(inputAddress !== null) {
    let place = Places({
        appId: 'plAC4UOJ1YD3',
        apiKey: '1966b0033b70ff6ecf52e503282fe407',
        container: inputAddress
    })
    place.on('change', e => {
        document.querySelector('#farmer_city, #farmer_profil_city').value = e.suggestion.city
        document.querySelector('#farmer_postalCode, #farmer_profil_postalCode').value = e.suggestion.postcode
        document.querySelector('#farmer_lat, #farmer_profil_lat').value = e.suggestion.latlng.lat
        document.querySelector('#farmer_lng, #farmer_profil_lng').value = e.suggestion.latlng.lng
    })
}


// Map farm

import L from 'leaflet'

let map = document.querySelector('#mapfarm')

let myIcon = L.icon({
    // iconUrl:'/images/farmer.png'
    });

let location = [map.dataset.lat, map.dataset.lng]

map = L.map('mapfarm').setView(location, 13)

let token = 'pk.eyJ1IjoiZ3JhZmlrYXJ0IiwiYSI6ImNqaHoxancyOTBxNXkzcW10MHI3NXZrNjkifQ.yWqQe1qK_RtMA2Z4qABvmg'
L.tileLayer(`https://api.mapbox.com/v4/mapbox.streets/{z}/{x}/{y}.png?access_token=${token}`, {
    maxZoom: 18,
    minZoom: 8,
    attribution: '© <a href="https://www.mapbox.com/feedback/">Mapbox</a> © ' +
        '<a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map)

L.marker(location, {myIcon}).addTo(map)


