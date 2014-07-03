
// Activate all my use of plugins
jQuery(document).ready(function() {
  // Create functionality to resize slides in proportion to window
  jQuery('#existing-content-menu').sidr({
    name: 'this-charming-menu',
    source: '#custom-side-menu'
  });

  var $inp = jQuery.noConflict();
  var InputSize = function() {
    var contw = $inp('.single-item').find('.slick-slide:not(.slick-cloned)').first().width();
    var desHeight = contw / 4 * 1.75;
    $inp('.single-item').find('.slick-slide').css('height', desHeight);
  }
  $inp(document).ready(function() {
    InputSize();
  });
  $inp(window).resize(function(){
    InputSize();
  });



  jQuery('body').flowtype();

  jQuery('.single-item').slick({
    dots: true,
    infinite: true,
    speed: 700,
    autoplay: true,
    pauseOnHover: false
  });

  jQuery('.single-item-videos').slick({
    centerMode: true,
    centerPadding: '60px',
    slidesToShow: 2,

    responsive: [
      {
        breakpoint: 768,
        settings: {
          arrows: true,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: true,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 1
        }
      }
    ]
  });

});

var FixedHeader = {}, InitializeLightbox = {};

(function($){

  FixedHeader = {
    init: function() {
      FixedHeader.headerHeight = $('#headerwrap').height();
      this.activate();
      $(window).on('scroll', this.activate);
      $(window).on('resize', this.activate);
    },
    activate: function() {
      var $window = $(window),
        scrollTop = $window.scrollTop();
      $('#body-wrap-top').css('paddingTop', Math.floor( $('#headerwrap').height() ));
      if( scrollTop > FixedHeader.headerHeight ) {
        FixedHeader.scrollEnabled();
      } else {
        FixedHeader.scrollDisabled();
      }
    },
    scrollDisabled: function() {
      $('#headerwrap').removeClass('fixed-header');
      $('#header').removeClass('header-on-scroll');
      $('body').removeClass('fixed-header-on');
    },
    scrollEnabled: function() {
      $('#headerwrap').addClass('fixed-header');
      $('#header').addClass('header-on-scroll');
      $('body').addClass('fixed-header-on');
    }
  };

  InitializeLightbox = {
    init: function() {
      $('.youtube-open-video').magnificPopup({
          type: 'iframe'
        });
    }
  }


  FixedHeader.init();
  InitializeLightbox.init();

})(jQuery);

