  jQuery(document).ready(function($) {

      var $adminBar = $('#wpadminbar'),
          $header = $('header');

      if ($adminBar) {
          $('.menu-wrapper,.sticky-navigation').css({ 'top': $adminBar.height() + 'px' });
      }

      $('.hamburger').click(function() {
          $('.menu-wrapper').toggleClass('visible');
          $(this).toggleClass('is-active');

      });

      /* hide sticky navigation on tablets or more little sizes*/
      if ($(window).width() < 780 || $(window).scrollTop() < $header.outerHeight(true)) { $('.sticky-navigation').css({ 'display': 'none' }) }

      /* adjust sticky bar and button Up */
      $(window).on('resize', function() {
          var $container = $(this);
          adjustStickyBar($container);
          showButtonUp($container);
      })

      $(window).on('scroll', function() {
          var $container = $(this);
          adjustStickyBar($container);
          showButtonUp($container);

      });

      $('.button-up').on('click', function() {
          $('html,body').animate({ scrollTop: 0 }, 500);
      });

      $('.sticky-navigation .search-form input[type="button"]').on('click', function() {
          $('.sticky-navigation .search-form input[type="search"]').toggleClass('visible');
          if ($('.sticky-navigation .search-form input[type="search"]').hasClass('visible')) {
              $('.sticky-navigation .search-form input[type="search"]').focus();
          } else {
              $('.sticky-navigation .search-form input[type="search"]').unfocus();
          }

      });

      function adjustStickyBar(container) {
          var $top = container.scrollTop();
          if (container.width() > 780) {
              if ($top >= $header.outerHeight(true)) {
                  $('.sticky-navigation').fadeIn();
              } else {
                  $('.sticky-navigation').fadeOut();
              }
          }
      }

      function showButtonUp(container) {
          var $top = container.scrollTop();
          if ($top > 400) {
              $('.button-up').addClass('visible');
          } else {
              $('.button-up').removeClass('visible');
          }
      }

  });