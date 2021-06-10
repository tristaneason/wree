(function($) {
    'use strict';
    /*meanmenu js for responsive menu for header-layout-1*/
    jQuery('.menu-container').meanmenu({
        meanMenuContainer: '.main-header-wrap',
        meanScreenWidth: "992",
        meanRevealPosition: "right",
    });

    $(document).ready(function() {

    $.extend( true, $.magnificPopup.defaults, {  
      iframe: {
          patterns: {
             youtube: {
                index: 'youtube.com/', 
                id: 'v=', 
                src: 'https://www.youtube.com/embed/%id%?autoplay=1' 
            }
          }
      }
    });

    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,

        fixedContentPos: false
    });
    });
    
     $('#slct').on('change', function(evt){
        var current_val = $(this).val();
        console.log(current_val);
        var sorting_query = $('#sorting-query').val();
        sorting_query = JSON.parse(sorting_query);
        evt.preventDefault();
        jQuery.post(
            education_minimal_script_vars.ajaxurl, 
            {
                'action': 'load_search_results',
                'orderby' : current_val,
                'sorting-query' : sorting_query,
            }, 
            function(response){
                 $('.tab-content').html(response);
            }
        );
    })
    /* back-to-top button */
    jQuery('.back-to-top').hide();
    jQuery('.back-to-top').on("click", function(e) {
        e.preventDefault();
        jQuery('html, body').animate({
            scrollTop: 0
        }, 'slow');
    });

    jQuery(window).scroll(function() {
        var scrollheight = 400;
        if (jQuery(window).scrollTop() > scrollheight) {
            jQuery('.back-to-top').fadeIn();

        } else {
            jQuery('.back-to-top').fadeOut();
        }
    });

    /*featured banner slider*/
    jQuery('.featured-banner').slick({
        slidesToShow: 1,
        dots: false,
        arrows: true
    });

    /*testimonial carousel*/
    jQuery('.testimonial-image').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        asNavFor: '.testimonial-content',
        dots: false,
        arrows: true,
        centerMode: true,
        focusOnSelect: true,
        centerPadding: 0
    });
    jQuery('.testimonial-content').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        dots: false,
        fade: false,
        asNavFor: '.testimonial-image'
    });
    /*team section carousel*/
    jQuery('.our-team').slick({
        dots: false,
        infinite: false,
        speed: 300,
        adaptiveHeight: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: false
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    /*promotion section slider*/
    jQuery('.promo-wrap').slick({
        slidesToShow: 1,
        dots: true,
        arrows: false,
        adaptiveHeight: true
    });
    /*company-info counter js*/
    jQuery('.company-info-count').each(function() {
        jQuery(this).prop('Counter', 0).animate({
             Counter: jQuery(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function(now) {
                jQuery(this).text(Math.ceil(now));
           }
        });
     });
    /*initializing wow.js for animation*/
    new WOW().init({
        offset: 0
    });
    /* for grid-view and list-view of course listing */
    jQuery('.grid-view a').on('click', function() {
        jQuery('.list-view a').removeClass('current');
        jQuery(this).addClass('current');
        jQuery('body').removeClass('list-view-design');
        jQuery('body').addClass('grid-view-design');
    });
    jQuery('.list-view a').on('click', function() {
        jQuery('.grid-view a').removeClass('current');
        jQuery(this).addClass('current');
        jQuery('body').removeClass('grid-view-design');
        jQuery('body').addClass('list-view-design');
    });
    /* enroll section measuring its height and applied it to padding-bottom of body*/
    if (window.innerWidth > 767) {
        /*For enroll section*/
        var height = jQuery('.enroll-section').outerHeight();
        jQuery('body').css({
            'padding-bottom': height
        });
    }
    /*Enquiry Form*/
    jQuery(".enquiry a").on("click", function(){
        jQuery(".enquiry-form").toggleClass("on");
    });
    jQuery(".enquiry-form .close, .form-overlay").on("click", function(){
        jQuery(".enquiry-form").removeClass("on");
    });
    /*JS for header-layout-2 start*/
    //tab js
    jQuery('.header-tab-button ul li').on("click", function() {
        var tab_id = jQuery(this).attr('data-tab');
        jQuery('.header-tab-button ul li').removeClass('current');
        jQuery('.header-tab-content .tab-item').removeClass('current');
        jQuery(this).addClass('current');
        jQuery("#" + tab_id).addClass('current');
    });
    //adding active class to body
    jQuery('.header-tab-button ul li a').on('click', function() {
        jQuery('body').addClass('active');
    });

    //removing active class to body
    jQuery('.overlay , .hgroup-wrap .close').on('click', function() {
        jQuery('body').removeClass('active');
    });

    //appending span for li.menu-item-has-children for toggle
    jQuery(".header-layout-2 .main-navigation ul").find("li.menu-item-has-children").append("<span class='toggle'></span>");

    //toggling icon class to li.menu-item-has-children 
    jQuery(".header-layout-2 .menu-item-has-children  .toggle").on('click', function() {
        jQuery(this).parent().toggleClass("icon");
    });

    //header-layout-2 menu responsive toggle
    jQuery(".header-layout-2  .main-navigation ul.sub-menu").hide();
    jQuery(".header-layout-2  .main-navigation ul > li .toggle").on('click', function() {
        var target = jQuery(this).parent().children(".sub-menu");
        jQuery(target).slideToggle();
    });

    //header-layout tab button on scroll
    function checkPosition() {
        var height = jQuery(".header-layout-2").innerHeight() / 2;
        if (jQuery(window).scrollTop() > height) {
            jQuery('.hgroup-wrap').addClass('scroll');
        } else {
            jQuery('.hgroup-wrap').removeClass('scroll');
        }
    }
    jQuery(window).scroll(function() {
        checkPosition();
    });

    checkPosition();


    /* JS for header-layout-2 end*/


    /*scroll to go down to site-content*/
    jQuery(".scroll-down").on('click', function() {
        jQuery('html, body').animate({
            scrollTop: jQuery(".site-content").offset().top
        }, 1000);
    });

    /*for pop up video*/
    jQuery('.popup-video').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });

    /*----------------
    event section masonary layout
    ----------------*/
    $(window).load(function(){
        var $container = $('.event-wrap');             
        if ( $container.length ) {   
            $container.isotope({                        
                itemSelector : '.event-wrap .post', 
                layoutMode : 'masonry',
                percentPosition: true,
                columnWidth: '.event-wrap .post',
                isFitWidth: true,
            });
            //image loaded
            $container.imagesLoaded().progress( function() {
                $container.isotope('reLayout');
            });

          }     
    });
    /* js-news trickle fot top-notification-bar*/
    var $ticker =  $('.notice-info');
    if( $ticker.length ) {
        jQuery('.notice-info').inewsticker({
            effect: "typing",
            speed: 50,
            delay_after: 1000
        });
    }
})(jQuery);