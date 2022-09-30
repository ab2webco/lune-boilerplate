import $ from 'jquery';

('use strict');

$(() => {

  const url = window.location;
  const urlPath = url.href.replace(url.hash, '').split("/")[3];
  $('.js-menu-item .menu-item').removeClass('active');
  if ($('.js-menu-item .menu-item a[href="' + urlPath + '"]').length > 0) {
    $('.js-menu-item .menu-item a[href="' + urlPath + '"]')
    .parent()
    .addClass('active');
    console.log($('.js-menu-item .menu-item a[href="' + url.pathname + '"]'));
  } else {
    $('.js-menu-item .menu-item a[href="' + url.pathname + '"]')
    .parent()
    .addClass('active');
  }

   /*------------------------------------------
        = FUNCTIONS
    -------------------------------------------*/
    // Check ie and version
    function isIE () {
      var myNav = navigator.userAgent.toLowerCase();
      return (myNav.indexOf('msie') != -1) ? parseInt(myNav.split('msie')[1], 10) : false;
  }


  // Toggle mobile navigation
  function toggleMobileNavigation() {
      var navbar = $(".navigation-holder");
      var openBtn = $(".navbar-header .open-btn");
      var closeBtn = $(".navigation-holder .close-navbar");

      openBtn.on("click", function() {
          if (!navbar.hasClass("slideInn")) {
              navbar.addClass("slideInn");
          }
          return false;
      })

      closeBtn.on("click", function() {
          if (navbar.hasClass("slideInn")) {
              navbar.removeClass("slideInn");
          }
          return false;
      })
  }

  toggleMobileNavigation();


  // Function for toggle a class for small menu
  function toggleClassForSmallNav() {
      var windowWidth = window.innerWidth;
      var mainNav = $("#navbar > ul");

      if (windowWidth <= 991) {
          mainNav.addClass("small-nav");
      } else {
          mainNav.removeClass("small-nav");
      }
  }

  toggleClassForSmallNav();


  // Function for small menu
  function smallNavFunctionality() {
      var windowWidth = window.innerWidth;
      var mainNav = $(".navigation-holder");
      var smallNav = $(".navigation-holder > .small-nav");
      var subMenu = smallNav.find(".sub-menu");
      var megamenu = smallNav.find(".mega-menu");
      var menuItemWidthSubMenu = smallNav.find(".menu-item-has-children > a");

      if (windowWidth <= 991) {
          subMenu.hide();
          megamenu.hide();
          menuItemWidthSubMenu.on("click", function(e) {
              var $this = $(this);
              $this.siblings().slideToggle();
               e.preventDefault();
              e.stopImmediatePropagation();
          })
      } else if (windowWidth > 991) {
          mainNav.find(".sub-menu").show();
          mainNav.find(".mega-menu").show();
      }
  }

  smallNavFunctionality();

   // Hero slider background setting
   function sliderBgSetting() {
    if ($(".hero-slider .slide").length) {
        $(".hero-slider .slide").each(function() {
            var $this = $(this);
            var img = $this.find(".slider-bg").attr("src");

            $this.css({
                backgroundImage: "url("+ img +")",
                backgroundSize: "cover",
                backgroundPosition: "center center"
            })
        });
    }
  }

  //Setting hero slider
  function heroSlider() {
    if ($(".hero-slider").length) {
        $(".hero-slider").slick({
            autoplay: true,
            autoplaySpeed: 12000,
            arrows: true,
            prevArrow: '<button type="button" class="slick-prev">Previous</button>',
            nextArrow: '<button type="button" class="slick-next">Next</button>',
            dots: true,
            fade: true,
            cssEase: 'linear',
            pauseOnHover:true
        });
    }
  }

  //Active Hero slider
  heroSlider();
   /*------------------------------------------
        = TESTIMONIALS SLIDER
    -------------------------------------------*/
    if($(".testimonials-slider".length)) {
      $(".testimonials-slider").owlCarousel({
          mouseDrag: false,
          smartSpeed: 1500,
          margin: 30,
          loop:true,
          items: 1
      });
  }


  /*------------------------------------------
      = PARTNERS SLIDER
  -------------------------------------------*/
  if ($(".partners-slider").length) {
      $(".partners-slider").owlCarousel({
          autoplay:true,
          smartSpeed: 300,
          margin: 30,
          loop:true,
          autoplayHoverPause:true,
          dots: false,
          responsive: {
              0 : {
                  items: 2
              },

              550 : {
                  items: 3
              },

              992 : {
                  items: 4
              },

              1200 : {
                  items: 5
              }
          }
      });
  }


  /*------------------------------------------
      = PARTNERS SLIDER
  -------------------------------------------*/
  if ($(".services-slider").length) {
      $(".services-slider").owlCarousel({
          autoplay:true,
          smartSpeed: 300,
          margin: 30,
          loop:true,
          autoplayHoverPause:true,
          nav: false,
          responsive: {
              0 : {
                  items: 1
              },

              550 : {
                  items: 2
              },

              992 : {
                  items: 3
              },

              1200 : {
                  items: 4
              },

              1600 : {
                  items: 5
              }
          }
      });
  }

  /*------------------------------------------
        = STICKY HEADER
    -------------------------------------------*/

    // Function for clone an element for sticky menu
    function cloneNavForSticyMenu($ele, $newElmClass) {
      $ele.addClass('original').clone().insertAfter($ele).addClass($newElmClass).removeClass('original');
  }

  // clone home style 1 navigation for sticky menu
  if ($('.site-header .navigation').length) {
      cloneNavForSticyMenu($('.site-header .navigation'), "sticky-header");
  }

  var lastScrollTop = '';

  function stickyMenu($targetMenu, $toggleClass) {
      var st = $(window).scrollTop();
      var mainMenuTop = $('.site-header .navigation');

      if ($(window).scrollTop() > 500) {
          if (st > lastScrollTop) {
              // hide sticky menu on scroll down
              $targetMenu.removeClass($toggleClass);

          } else {
              // active sticky menu on scroll up
              $targetMenu.addClass($toggleClass);
          }

      } else {
          $targetMenu.removeClass($toggleClass);
      }

      lastScrollTop = st;
  }


  /*==========================================================================
      WHEN DOCUMENT LOADING
  ==========================================================================*/
      $(window).on('load', function() {

          toggleMobileNavigation();
          sliderBgSetting();
          smallNavFunctionality();

      });



  /*==========================================================================
      WHEN WINDOW SCROLL
  ==========================================================================*/
  $(window).on("scroll", function() {
    console.log("Scroll");
  if ($(".site-header").length) {
          stickyMenu( $('.site-header .navigation'), "sticky-on" );
      }
  });


  /*==========================================================================
      WHEN WINDOW RESIZE
  ==========================================================================*/
  $(window).on("resize", function() {

      toggleClassForSmallNav();

      clearTimeout($.data(this, 'resizeTimer'));
      $.data(this, 'resizeTimer', setTimeout(function() {
          smallNavFunctionality();
      }, 200));

  });
});