/* eslint-disable no-console */

(function ($) {
  "use strict";
  /**
   * Global Variables
   */
  const isMobile = {
    Android: function () {
      return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function () {
      return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function () {
      return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function () {
      return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function () {
      return navigator.userAgent.match(/IEMobile/i);
    },
    any: function () {
      return (
        isMobile.Android() ||
        isMobile.BlackBerry() ||
        isMobile.iOS() ||
        isMobile.Opera() ||
        isMobile.Windows()
      );
    },
  };
  /**
   * Returns a function, that, as long as it continues to be invoked, will not
   * be triggered. The function will be called after it stops being called for
   * N milliseconds. If `immediate` is passed, trigger the function on the
   * leading edge, instead of the trailing.
   * @param {fn} func - function to debounce
   * @param {number} wait - time to wait
   * @param {bool} immediate
   * @returns {Function}
   */
  const debounce = function (func, wait, immediate) {
    let timeout;
    let waitTime = wait || 100;
    return function () {
      let context = this,
        args = arguments;
      clearTimeout(timeout);
      timeout = setTimeout(function () {
        timeout = null;
        if (!immediate) {
          func.apply(context, args);
        }
      }, waitTime);
      if (immediate && !timeout) {
        func.apply(context, args);
      }
    };
  };
  /**
   * Collection of useful site functions
   * @type {{init: init, smoothScroll: smoothScroll}}
   */
  const siteFunctions = {
    init: function () {
      siteFunctions.smoothScroll();
    },
    /**
     * Smooth Scroll function for anchor clicks
     */
    smoothScroll: function () {
      $('a[href*="#"]').click(function () {
        let target = $(this.hash);
        if (
          location.pathname.replace(/^\//, "") ===
            this.pathname.replace(/^\//, "") &&
          location.hostname === this.hostname
        ) {
          target = target.length
            ? target
            : $("[name=" + this.hash.slice(1) + "]");
          if (target.length) {
            $("html, body")
              .stop()
              .animate(
                {
                  scrollTop: target.offset().top - 75,
                },
                1000
              );
            return false;
          }
        }
      });
    },
  };

  const siteHeader = {
    init: function () {},
    /**
     * Handle on scroll header functionality
     */
    scrollChange: function () {
      let $body = $("body");
      $(document).scrollTop() > 50
        ? $body.addClass("scroll")
        : $body.removeClass("scroll"); //jshint ignore:line
    },
  };

  const siteMenu = {
    prevent: false,
    init: function () {
      /**
       * Toggle menu with clicking on hamburger menu and overlay
       */
      $("#menu-button, .m-overlay").click(function (e) {
        e.preventDefault();
        siteMenu.toggle();
      });
    },
    toggle: function () {
      if (!siteMenu.prevent) {
        $("body").toggleClass("m-open");
        siteMenu.prevent = !siteMenu.prevent;

        setTimeout(function () {
          siteMenu.prevent = !siteMenu.prevent;
        }, 400);
      }
    },
  };

  const BlogPostCarousel = {
    prevent: false,
    init: function () {},
  };

  

  $(document).ready(function () {
    siteFunctions.init();
    siteMenu.init();

    // var themeBaseUrl = ajax_object.themeUrl;
    // var animationPath = themeBaseUrl + '/src/scripts/src/data/looped-animation.json';

    // var lottieAnimation = lottie.loadAnimation({
    //   container: document.getElementById('animation-wrapper'),
    //   //path: 'wp-content/themes/ftheme/src/scripts/src/data/looped-animation.json',
    //   path: animationPath,
    //   renderer: 'svg',
    //   loop: true,
    //   autoplay: true,
    //   name: 'Home Hero Animation'
    // });

    // lottieAnimation.play();

    (function MobileMenuHandler() {
      console.log("here");
      let hamburgerButton = document.querySelector(".burger");
      let closeButton = document.querySelector(".close-button");
      let body = document.getElementsByTagName("body")[0];
      hamburgerButton.addEventListener("click", () => {
        body.classList.toggle("mobile-menu-active");
      });
      closeButton.addEventListener("click", () => {
        body.classList.remove("mobile-menu-active");
      });
    })();

    (function swiperControls() {
      const swiper = new Swiper("#items-wrapper", {
        navigation: {
          prevEl: "#button-previous",
          nextEl: "#button-next",
        },
        pagination: {
          el: ".swiper-pagination",
          bulletClass: "bullet",
          bulletActiveClass: "active",
          clickable: true,
        },
        spaceBetween: 20,
        breakpoints: {
          768: {
            slidesPerView: 2,
            slidesPerGroup: 2,
          },
          1024: {
            slidesPerView: 2,
            slidesPerGroup: 2,
            spaceBetween: 30,
          },
          1330: {
            slidesPerView: 3,
            slidesPerGroup: 3,
            spaceBetween: 30,
          },
        },
        loop: true,
        watchSlidesProgress: true,
      });
    })();

    (function TypewriterEffects() {
      const app = document.getElementById("typewriter");
      let strings = document.querySelectorAll(".typewriter-text");
      let stringsArray = [];
      strings.forEach((string) => {
        stringsArray.push(string.innerText);
      });

      let customNodeCreator = function (character) {
        return document.createTextNode(character);
      };

      let typewriter = new Typewriter(app, {
        strings: stringsArray,
        loop: true,
        delay: 75,
        autoStart: true,
      });
    })();

    (function teamSelect() {
      let selectButtons = document.querySelectorAll(".select .filter");
      selectButtons.forEach((select) => {
        select.addEventListener("click", (e) => {
          let buttonElem = e.target.closest(".filter");
          buttonElem.classList.toggle("filter-open");
          let buttonElemOptions = buttonElem.nextElementSibling;
          let activeOpions = document.querySelectorAll(
            ".select .items-wrapper"
          );
          activeOpions.forEach((option) => {
            if ((option.style.display = "flex")) {
              option.style.display = "none";
            }
          });
          if (buttonElem.classList.contains("filter-open")) {
            buttonElemOptions.style.display = "flex";
            let childrenElems = buttonElemOptions.children;
            var arr = [].slice.call(childrenElems);
            arr.forEach((elem) => {
              elem.addEventListener("click", (e) => {
                let buttonName =
                  e.target.closest(".items-wrapper").previousElementSibling
                    .children[0];
                    
                buttonName.innerText = e.target.innerText;
                activeOpions.forEach((option) => {
                  if ((option.style.display = "flex")) {
                    option.style.display = "none";
                  }
                });
                selectButtons.forEach((select) => {
                  select.closest(".filter").classList.remove("filter-open");
                });
              });
            });
          }
        });
      });
    })();

    (function testimonialsSlider() {
      const partnersSlider = new Swiper('.partners-slider', {
        slidesPerView: 1,
        spaceBetween: 30,
        speed: 750,
        effect: "fade",
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        //autoplay: false,
        pagination: {
          el: '.tabs-wrapper',
          clickable: true,
          bulletActiveClass: 'bullet-active',
          bulletClass: 'tab',
          renderBullet: function(index, className) {
              return '<button class="' + className + '"><span class="bullet"></span><div class="progress-circle wrapper animate"><svg class="circle" viewBox="0 0 58 58"><circle class="animated-circle" fill-opacity="0" stroke-width="5" stroke-dashoffset="0" stroke-dasharray="100" cx="29" cy="29" r="27"></circle></svg><div class="inner">'+ (index + 1) +'</div></div></button>';
          },
        },
      });  
    })();
    
    (function teamFilters() {
      $(".select.wrapper.filter-team .items-wrapper button.item").click(function () {

        var team_container = $('.team-members-list');
        var team_members = team_container.children('.team-member-card');
  
        var selectedTerm = $(this).val();
  
        team_members.each(function() {
          var element = $(this);
          var team = element.data('target-team');
  
          if (team.includes(selectedTerm) || selectedTerm === 'all') {
            element.removeClass('hide-team-member-team');
          } else {
            element.addClass('hide-team-member-team');
          }
        });
  
        var numberOfVisibleElements = team_members.filter(":visible").length;
        if( numberOfVisibleElements == 0) {
          $('.no-matches').removeClass('hidden');
        } else {
          $('.no-matches').addClass('hidden');
        }
      });
  
      $(".select.wrapper.filter-role .items-wrapper button.item").click(function () {
        
        var team_container = $('.team-members-list');
        var team_members = team_container.children('.team-member-card');
  
        var selectedTerm = $(this).val();
  
        team_members.each(function() {
          var element = $(this);
          var team = element.data('target-role');
  
          if (team.includes(selectedTerm) || selectedTerm === 'all') {
            element.removeClass('hide-team-member-role');
          } else {
            element.addClass('hide-team-member-role');
          }
        });
  
        var numberOfVisibleElements = team_members.filter(":visible").length;
  
        if( numberOfVisibleElements == 0) {
          $('.no-matches').removeClass('hidden');
        } else {
          $('.no-matches').addClass('hidden');
        }
      });
    })();

    (function clientFilters() {
      $(".select.wrapper.filter-industry .items-wrapper button.item").click(function () {

        var client_container = $('.client-members-list');
        var client_members = client_container.children('.client-member-card');
  
        var selectedTerm = $(this).val();
  
        client_members.each(function() {
          var element = $(this);
          var client = element.data('industry');
  
          if (client.includes(selectedTerm) || selectedTerm === 'all') {
            element.removeClass('hide-client-member-industry');
          } else {
            element.addClass('hide-client-member-industry');
          }
        });
  
        var numberOfVisibleElements = client_members.filter(":visible").length;
        if( numberOfVisibleElements == 0) {
          $('.no-matches').removeClass('hidden');
        } else {
          $('.no-matches').addClass('hidden');
        }
      });
  
      $(".select.wrapper.filter-infrastructure .items-wrapper button.item").click(function () {
        
        var client_container = $('.client-members-list');
        var client_members = client_container.children('.client-member-card');
  
        var selectedTerm = $(this).val();
  
        client_members.each(function() {
          var element = $(this);
          var client = element.data('infrastructure');
  
          if (client.includes(selectedTerm) || selectedTerm === 'all') {
            element.removeClass('hide-client-member-infrastructure');
          } else {
            element.addClass('hide-client-member-infrastructure');
          }
        });
  
        var numberOfVisibleElements = client_members.filter(":visible").length;
  
        if( numberOfVisibleElements == 0) {
          $('.no-matches').removeClass('hidden');
        } else {
          $('.no-matches').addClass('hidden');
        }
      });

      $(".select.wrapper.filter-technology .items-wrapper button.item").click(function () {
        
        var client_container = $('.client-members-list');
        var client_members = client_container.children('.client-member-card');
  
        var selectedTerm = $(this).val();
  
        client_members.each(function() {
          var element = $(this);
          var client = element.data('technology');
  
          if (client.includes(selectedTerm) || selectedTerm === 'all') {
            element.removeClass('hide-client-member-technology');
          } else {
            element.addClass('hide-client-member-technology');
          }
        });
  
        var numberOfVisibleElements = client_members.filter(":visible").length;
  
        if( numberOfVisibleElements == 0) {
          $('.no-matches').removeClass('hidden');
        } else {
          $('.no-matches').addClass('hidden');
        }
      });
    })();

    var nextLink = $('.pagination .next');
    var prevLink = $('.pagination .previous');

    $('.post-filter').on('click', function (e) {
      e.preventDefault();

      var category = $(this).data('category');
      $('.post-filter').removeClass('active');
      $(this).addClass('active');

      var pageElement = $('#page-element a');
      prevLink.hide();

      $.ajax({
        url: ajax_object.ajax_url,
        type: 'POST',
        data: {
          action: 'filter_posts',
          category: category,
          page: 1
        },
        success: function (response) {
          pageElement.text(1);
          $('.items-wrapper.has-banner').html(response.html);
          if(response.max_pages < 2) {
            nextLink.hide();
          } else {
            nextLink.show();
          }
        },
      });
    });

    $(nextLink).on('click', function(e) {
      e.preventDefault();

      var pageElement = $('#page-element a');
      var page = parseInt(pageElement.text(), 10);
      page++;
      var category = $('.post-filter.active').data('category');

      if(page > 1) {
        prevLink.show();
      }

      $.ajax({
        url: ajax_object.ajax_url,
        type: 'post',
        data: {
          action: 'ajax_pagination',
          page: page,
          category: category
        },
        success: function( response ) {
          pageElement.text(page);
          $('.items-wrapper.has-banner').html(response.html);
          $('html, body').animate({ scrollTop: 0 }, 'slow');

          if(page == response.max_pages) {
            $(nextLink).hide();
          }
        }
      })
    });

    $(prevLink).on('click', function(e) {
      e.preventDefault();

      var pageElement = $('#page-element a');
      var page = parseInt(pageElement.text(), 10);
      console.log(page);
      page--;
      var category = $('.post-filter.active').data('category');

      if(page <= 1) {
        $(this).hide();
      } 

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'post',
            data: {
                action: 'ajax_pagination',
                page: page,
                category: category,
            },
            success: function(response) {
                pageElement.text(page);
                $('.items-wrapper.has-banner').html(response.html);
                $('html, body').animate({ scrollTop: 0 }, 'slow');
            }
        });
    })

    $(window).scroll(
      debounce(function () {
        siteHeader.scrollChange();
      })
    );
  });

  $(window).on("load", function () {
    
    var themeBaseUrl = ajax_object.themeUrl;
    var initialAnimationPath = themeBaseUrl + '/src/scripts/src/data/initial-animation.json';
    var loopedAnimationPath = themeBaseUrl + '/src/scripts/src/data/looped-animation.json';

    var initialAnimation = lottie.loadAnimation({
      container: document.querySelector('.animation-initial'),
      path: initialAnimationPath,
      renderer: 'svg',
      loop: false,
      autoplay: true,
      name: 'Home Hero Animation'
    });

    var loopAnimation = lottie.loadAnimation({
      container: document.querySelector('.animation-loop'),
      path: loopedAnimationPath,
      renderer: 'svg',
      loop: true,
      autoplay: true,
      name: 'Home Hero Animation'
    });

    initialAnimation.addEventListener('complete', function() {
      // Function to execute when the animation completes
      stopAndHideAnimation();
    });
  
    function stopAndHideAnimation() {
      // Stop the animation
      initialAnimation.stop();
  
      // Hide the container
      $('.animation-loop').removeClass('hidden');
      $('.animation-initial').addClass('hidden');
    }

    
    
  });
})(jQuery);
