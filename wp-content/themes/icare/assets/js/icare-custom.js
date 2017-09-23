var WEBHUNT = {};
(function($) {
    "use strict";
    /* -------------------------- Declare Variables ------------------------- */
    var $document = $(document);
    var $document_body = $(document.body);
    var $window = $(window);
    var $html = $('html');
    var $body = $('body');
    var $wrapper = $('#wrapper');
    var $header = $('#header');
    var $footer = $('#footer');
    var $sections = $('section');
	$document.ready(function(){ 
        // mobile menu
        jQuery('.wpb-mobile-menu').slicknav({
            prependTo:'.icare-mobile-menu',
            label: '',
            brand:brand.logo
        });
        // hero section moving effect
        var lFollowX = 0,
        lFollowY = 0,
        x = 0,
        y = 0,
        friction = 1 / 30;
        function moveBackground() {
          x += (lFollowX - x) * friction;
          y += (lFollowY - y) * friction;
          
         var translate = 'translate(' + x + 'px, ' + y + 'px) scale(1.1)';
          jQuery('#h_title,#h_subtitle').css({
            '-webit-transform': translate,
            '-moz-transform': translate,
            'transform': translate
          });
          window.requestAnimationFrame(moveBackground);
        }
        jQuery(window).on('mousemove click', function(e) {
          var lMouseX = Math.max(-100, Math.min(100, jQuery(window).width() / 2 - e.clientX));
          var lMouseY = Math.max(-100, Math.min(100, jQuery(window).height() / 2 - e.clientY));
          lFollowX = (20 * lMouseX) / 100; // 100 : 12 = lMouxeX : lFollow
          lFollowY = (10 * lMouseY) / 100;
        });
        moveBackground();
		// add class to comment reply link
		$('.comment-list').find('.comment-reply-link').each(function(){
			$(this).addClass('replay-icon pull-right flip icare-text-colored');
		});
		// Add Table class
		$('.entry-content').find('table').each(function(){
			if(!$(this).hasClass('table')){
				$(this).addClass('table');
			}
		});
		jQuery(".styled-icons li a").css('background', function () {
			return jQuery(this).data('bg-color');
		});
		/* Move comment submit button into parent div */
		$('#comment-form').find('.form-submit').appendTo($('.form-submit').prev());
		$('.widget_recent_entries ul,.widget_categories ul,.widget_archive ul,.widget_meta ul').addClass('list-divider sidebar-widget-list-border list check');
		//$('li.page_item ul, .icare-widget ul#menu-primary-1, ul.sub-menu').addClass('sidebar-widget-list-border');
	});
    WEBHUNT.isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (WEBHUNT.isMobile.Android() || WEBHUNT.isMobile.BlackBerry() || WEBHUNT.isMobile.iOS() || WEBHUNT.isMobile.Opera() || WEBHUNT.isMobile.Windows());
        }
    };
    WEBHUNT.isRTL = {
        check: function() {
            if( $( "html" ).attr("dir") == "rtl" ) {
                return true;
            } else {
                return false;
            }
        }
    };
    WEBHUNT.urlParameter = {
        get: function(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        }
    };
    
    WEBHUNT.initialize = {
        init: function() {
            WEBHUNT.initialize.icare_fitVids();
            WEBHUNT.initialize.icare_equalHeightDivs();
            WEBHUNT.initialize.icare_platformDetect();
            WEBHUNT.initialize.icare_customDataAttributes();
            WEBHUNT.initialize.icare_parallaxBgInit();
            WEBHUNT.initialize.icare_YTPlayer();
            WEBHUNT.initialize.icare_fitVids();
        },
        /* ------------------------------- Platform detect  --------------------- */
        icare_platformDetect: function() {
            if (WEBHUNT.isMobile.any()) {
                $html.addClass("mobile");
            } else {
                $html.addClass("no-mobile");
            }
        },
        /* --------------------------- Home Resize Fullscreen ------------------- */
         icare_resizeFullscreen: function() {
            var windowHeight = $window.height();
            $('.fullscreen').height(windowHeight);
        },
        /* ---------------------------- Wow initialize  ------------------------- */
        icare_wow: function() {
            var wow = new WOW({
                mobile: false // trigger animations on mobile devices (default is true)
            });
            wow.init();
        },
        /* ----------------------------- Fit Vids ------------------------------- */
         icare_fitVids: function() {
            $body.fitVids();
        }, 
        /* ---------------------------- equalHeights ---------------------------- */
        icare_equalHeightDivs: function() {
            
            var $equal_height = $('.equal-height');
            if( $equal_height.length > 0 ) {
                $equal_height.children('div').css('min-height', 'auto');
                $equal_height.equalHeights();
            }
            
            var $equal_height_inner = $('.equal-height-inner');
            if( $equal_height_inner.length > 0 ) {
                $equal_height_inner.children('div').css('min-height', 'auto');
                $equal_height_inner.children('div').children('div').css('min-height', 'auto');
                $equal_height_inner.equalHeights();
                $equal_height_inner.children('div').each(function() {
                    $(this).children('div').css('min-height', $(this).css('min-height'));
                });
            }
        },
        /* ---------------------------------------------------------------------- */
        /* ----------------------- Background image, color ---------------------- */
        /* ---------------------------------------------------------------------- */
        icare_customDataAttributes: function() {
            $('[data-bg-color]').each(function() {
                $(this).css("cssText", "background: " + $(this).data("bg-color") + " !important;");
            });
            $('[data-bg-img]').each(function() {
                $(this).css('background-image', 'url(' + $(this).data("bg-img") + ')');
            });
            $('[data-text-color]').each(function() {
                $(this).css('color', $(this).data("text-color"));
            });
            $('[data-font-size]').each(function() {
                $(this).css('font-size', $(this).data("font-size"));
            });
            $('[data-height]').each(function() {
                $(this).css('height', $(this).data("height"));
            });
            $('[data-border]').each(function() {
                $(this).css('border', $(this).data("border"));
            });
            $('[data-margin-top]').each(function() {
                $(this).css('margin-top', $(this).data("margin-top"));
            });
            $('[data-margin-right]').each(function() {
                $(this).css('margin-right', $(this).data("margin-right"));
            });
            $('[data-margin-bottom]').each(function() {
                $(this).css('margin-bottom', $(this).data("margin-bottom"));
            });
            $('[data-margin-left]').each(function() {
                $(this).css('margin-left', $(this).data("margin-left"));
            });
        },



        /* ---------------------------------------------------------------------- */
        /* -------------------------- Background Parallax ----------------------- */
        /* ---------------------------------------------------------------------- */
        icare_parallaxBgInit: function() {
            if (!WEBHUNT.isMobile.any() && $window.width() >= 800 ) {
                $('.parallax').each(function() {
                    var data_parallax_ratio = ( $(this).data("parallax-ratio") === undefined ) ? '0.5': $(this).data("parallax-ratio");
                    $(this).parallax("50%", data_parallax_ratio);
                });
            } else {
                $('.parallax').addClass("mobile-parallax");
            }
        },
        /* ---------------------------------------------------------------------- */
        /* ----------------------------- Fit Vids ------------------------------- */
        /* ---------------------------------------------------------------------- */
        icare_fitVids: function() {
            $body.fitVids();
        },

        /* ---------------------------------------------------------------------- */
        /* ----------------------------- YT Player for Video -------------------- */
        /* ---------------------------------------------------------------------- */
        icare_YTPlayer: function() {
            var $ytube_player = $(".player");
            if( $ytube_player.length > 0 ) {
                $ytube_player.mb_YTPlayer();
            }
        },
    };
    WEBHUNT.header = {
        init: function() {
            var t = setTimeout(function() {
                WEBHUNT.header.icare_scroolToTopOnClick();
                WEBHUNT.header.icare_scrollToFixed();
            }, 0);
        },
        /* ------------------------------- iCareTop scrollToTop  ------------------------- */
        icare_scroolToTop: function() {
            if ($window.scrollTop() > 400) {
                $('.iCareTop').fadeIn();
            } else {
                $('.iCareTop').fadeOut();
            }
        },
        icare_scroolToTopOnClick: function() {
            $document_body.on('click', '.iCareTop', function(e) {
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });
        },
        /* --------------------------- collapsed menu close on click ------------------ */
        icare_scrollToFixed: function() {
            $('.navbar-scrolltofixed').scrollToFixed();
        },
    };
	
    WEBHUNT.widget = {

        init: function() {

            var t = setTimeout(function() {
                WEBHUNT.widget.icare_progressBar();
                WEBHUNT.widget.icare_funfact();
            }, 0);

        },
        /* ---------------------------------------------------------------------- */
        /* ------------------- progress bar / horizontal skill bar -------------- */
        /* ---------------------------------------------------------------------- */
        icare_progressBar: function() {
            var $progress_bar = $('.progress-bar');
            if( $progress_bar.length > 0 ) {
                $progress_bar.appear();
                $document_body.on('appear', '.progress-bar', function() {
                    var current_item = $(this);
                    if (!current_item.hasClass('appeared')) {
                        var percent = current_item.data('percent');
                        var barcolor = current_item.data('barcolor');
                        current_item.append('<span class="percent">' + percent + '%' + '</span>').css('background-color', barcolor).css('width', percent + '%').addClass('appeared');
                    }
                    
                });
            }
        },

        /* ---------------------------------------------------------------------- */
        /* ------------------------ Funfact Number Counter ---------------------- */
        /* ---------------------------------------------------------------------- */
        icare_funfact: function() {
            var $animate_number = $('.animate-number');
            if( $animate_number.length > 0 ) {
                $animate_number.appear();
                $document_body.on('appear', '.animate-number', function() {
                    $animate_number.each(function() {
                        var current_item = $(this);
                        if (!current_item.hasClass('appeared')) {
                            current_item.animateNumbers(current_item.attr("data-value"), true, parseInt(current_item.attr("data-animation-duration"), 10)).addClass('appeared');
                        }
                    });
                });
            }
        },
    };
    /* ---------- document ready, window load, scroll and resize ------------ */
    //document ready
    WEBHUNT.documentOnReady = {
        init: function() {
            WEBHUNT.initialize.init();
            WEBHUNT.header.init();
            WEBHUNT.slider.init();
            WEBHUNT.widget.init();
            WEBHUNT.windowOnscroll.init();
        }
    };
    //window on load
    WEBHUNT.windowOnLoad = {
        init: function() {
            var t = setTimeout(function() {
                WEBHUNT.initialize.icare_wow();
            }, 0);
            $window.trigger("scroll");
            $window.trigger("resize");
        }
    };
    // slider
    WEBHUNT.slider = {

        init: function() {

            var t = setTimeout(function() {
                WEBHUNT.slider.icare_owlCarousel();
            }, 0);

        },
        /* ---------------------------------------------------------------------- */
        /* -------------------------------- Owl Carousel  ----------------------- */
        /* ---------------------------------------------------------------------- */
        icare_owlCarousel: function(){
            var $owl_carousel_6col = $('.owl-carousel-6col');
            if ( $owl_carousel_6col.length > 0 ) {
                $owl_carousel_6col.each(function() {
                    var data_dots = ( $(this).data("dots") === undefined ) ? false: $(this).data("dots");
                    var data_nav = ( $(this).data("nav")=== undefined ) ? false: $(this).data("nav");
                    var data_duration = ( $(this).data("duration") === undefined ) ? 4000: $(this).data("duration");
                    $(this).owlCarousel({
                        rtl: WEBHUNT.isRTL.check(),
                        autoplay: true,
                        autoplayTimeout: data_duration,
                        loop: true,
                        items: 6,
                        margin: 15,
                        dots: data_dots,
                        nav: data_nav,
                        navText: [
                            '<i class="pe-7s-angle-left"></i>',
                            '<i class="pe-7s-angle-right"></i>'
                        ],
                        responsive: {
                            0: {
                                items: 1,
                                center: false
                            },
                            480: {
                                items: 1,
                                center: false
                            },
                            600: {
                                items: 2,
                                center: false
                            },
                            750: {
                                items: 3,
                                center: false
                            },
                            960: {
                                items: 4
                            },
                            1170: {
                                items: 6
                            },
                            1300: {
                                items: 6
                            }
                        }
                    });
                });
            }
        }
    };
    //window on scroll
    WEBHUNT.windowOnscroll = {
        init: function() {
            $window.on( 'scroll', function(){
                WEBHUNT.header.icare_scroolToTop();
            });
        }
    };
    //window on resize
    WEBHUNT.windowOnResize = {
        init: function() {
            var t = setTimeout(function() {
                WEBHUNT.initialize.icare_equalHeightDivs();
                WEBHUNT.initialize.icare_resizeFullscreen();
            }, 400);
        }
    };
    /* ---------------------------- Call Functions -------------------------- */
    $document.ready(
        WEBHUNT.documentOnReady.init
    );
    $window.on('load',
        WEBHUNT.windowOnLoad.init
    );
    $window.on('resize', 
        WEBHUNT.windowOnResize.init
    );
})(jQuery);