( function( $ ) {
	 wp.customize.bind( 'ready', function() {
        var customize = this;
        sections = wp.customize.panel( 'widgets' ).sections();
        _.each( wp.customize.panel( 'widgets' ).sections(), function ( section ) {
		  if(section.id==="sidebar-widgets-icare-home-service"){
		  section.panel( 'icare_service' );
		}
		});
		$('.linkToControl').on('click',function(e){
			e.preventDefault();
			wp.customize.control( $(this).attr('id') ).focus();
		})
    } );
})( jQuery );

jQuery(document).ready(function($) {
    if ( typeof icare_customizer_settings !== "undefined" ) {
        if (icare_customizer_settings.number_action > 0) {
            $('.control-section-themes h3.accordion-section-title').append('<a class="theme-action-count" href="' + icare_customizer_settings.action_url + '">' + icare_customizer_settings.number_action + '</a>');
        }
    }

    //FontAwesome Icon Control JS
    $('body').on('click', '.icare-icon-list li', function(){
        var icon_class = $(this).find('i').attr('class');
        $(this).addClass('icon-active').siblings().removeClass('icon-active');
        $(this).parent('.icare-icon-list').prev('.icare-selected-icon').children('i').attr('class','').addClass(icon_class);
        $(this).parent('.icare-icon-list').next('input').val(icon_class).trigger('change');
    });

    $('body').on('click', '.icare-selected-icon', function(){
        $(this).next().slideToggle();
    });

    //Switch Control
    $('body').on('click', '.onoffswitch', function(){
        var $this = $(this);
        if($this.hasClass('switch-on')){
            $(this).removeClass('switch-on');
            $this.next('input').val('off').trigger('change')
        }else{
            $(this).addClass('switch-on');
            $this.next('input').val('on').trigger('change')
        }
    });

    // Gallery Control
    $('.upload_gallery_button').click(function(event){
        var current_gallery = $( this ).closest( 'label' );

        if ( event.currentTarget.id === 'clear-gallery' ) {
            //remove value from input
            current_gallery.find( '.gallery_values' ).val( '' ).trigger( 'change' );

            //remove preview images
            current_gallery.find( '.gallery-screenshot' ).html( '' );
            return;
        }

        // Make sure the media gallery API exists
        if ( typeof wp === 'undefined' || !wp.media || !wp.media.gallery ) {
            return;
        }
        event.preventDefault();

        // Activate the media editor
        var val = current_gallery.find( '.gallery_values' ).val();
        var final;

        if ( !val ) {
            final = '[gallery ids="0"]';
        } else {
            final = '[gallery ids="' + val + '"]';
        }
        var frame = wp.media.gallery.edit( final );

        frame.state( 'gallery-edit' ).on(
            'update', function( selection ) {

                //clear screenshot div so we can append new selected images
                current_gallery.find( '.gallery-screenshot' ).html( '' );

                var element, preview_html = '', preview_img;
                var ids = selection.models.map(
                    function( e ) {
                        element = e.toJSON();
                        preview_img = typeof element.sizes.thumbnail !== 'undefined' ? element.sizes.thumbnail.url : element.url;
                        preview_html = "<div class='screen-thumb'><img src='" + preview_img + "'/></div>";
                        current_gallery.find( '.gallery-screenshot' ).append( preview_html );
                        return e.id;
                    }
                );

                current_gallery.find( '.gallery_values' ).val( ids.join( ',' ) ).trigger( 'change' );
            }
        );
        return false;
    });

    //MultiCheck box Control JS
    $( '.customize-control-checkbox-multiple input[type="checkbox"]' ).on( 'change', function() {

            var checkbox_values = $( this ).parents( '.customize-control' ).find( 'input[type="checkbox"]:checked' ).map(
                function() {
                    return $( this ).val();
                }
            ).get().join( ',' );

            $( this ).parents( '.customize-control' ).find( 'input[type="hidden"]' ).val( checkbox_values ).trigger( 'change' );
        
        }
    );

    //Chosen JS
    $(".hs-chosen-select").chosen({
        width: "100%"
    });

    //Scroll to section
    $('body').on('click', '#sub-accordion-panel-icare_home_panel .control-subsection .accordion-section-title', function(event) {
        var section_id = $(this).parent('.control-subsection').attr('id');
        scrollToSection( section_id );
    });
});

function scrollToSection( section_id ){
    var preview_section_id = "icare-home-slider-section";
    var $contents = jQuery('#customize-preview iframe').contents();
    switch ( section_id ) {
        case 'accordion-section-slider':
        preview_section_id = "icare-home-slider-section";
        break;

        case 'accordion-section-icare_about':
        preview_section_id = "icare-home-about-section";
        break;

        case 'accordion-section-icare_features':
        preview_section_id = "icare-home-feature-section";
        break;

        case 'accordion-section-services':
        preview_section_id = "icare-home-service-section";
        break;

        case 'accordion-section-icare_counter_section':
        preview_section_id = "icare-home-funfacts-section";
        break;

        case 'accordion-section-icare_team':
        preview_section_id = "icare-home-team-section";
        break;

        case 'accordion-section-home_blog':
        preview_section_id = "icare-home-blog-section";
        break;

        case 'accordion-section-icare_client_logo':
        preview_section_id = "icare-home-clients-section";
        break;

        case 'accordion-section-calltoaction':
        preview_section_id = "icare-home-cta-section";
        break;
    }

    if( $contents.find('#'+preview_section_id).length > 0 ){
        $contents.find("html, body").animate({
        scrollTop: $contents.find( "#" + preview_section_id ).offset().top
        }, 1000);
    }
}
    // service img or icon show hide
    wp.customize( 'icare_service_img_or_icon1', function( setting ) {
        var setupControl = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'icon' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        var setupControl2 = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'img' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        wp.customize.control( 'icare_service_page_icon1', setupControl );
        wp.customize.control( 'icare_service_page_img1', setupControl2 );
    } );

    wp.customize( 'icare_service_img_or_icon2', function( setting ) {
        var setupControl = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'icon' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        var setupControl2 = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'img' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        wp.customize.control( 'icare_service_page_icon2', setupControl );
        wp.customize.control( 'icare_service_page_img2', setupControl2 );
    } );
    wp.customize( 'icare_service_img_or_icon3', function( setting ) {
        var setupControl = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'icon' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        var setupControl2 = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'img' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        wp.customize.control( 'icare_service_page_icon3', setupControl );
        wp.customize.control( 'icare_service_page_img3', setupControl2 );
    } );
    wp.customize( 'icare_service_img_or_icon4', function( setting ) {
        var setupControl = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'icon' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        var setupControl2 = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'img' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        wp.customize.control( 'icare_service_page_icon4', setupControl );
        wp.customize.control( 'icare_service_page_img4', setupControl2 );
    } );
    wp.customize( 'icare_service_img_or_icon5', function( setting ) {
        var setupControl = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'icon' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        var setupControl2 = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'img' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        wp.customize.control( 'icare_service_page_icon5', setupControl );
        wp.customize.control( 'icare_service_page_img5', setupControl2 );
    } );
    wp.customize( 'icare_service_img_or_icon6', function( setting ) {
        var setupControl = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'icon' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        var setupControl2 = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'img' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        wp.customize.control( 'icare_service_page_icon6', setupControl );
        wp.customize.control( 'icare_service_page_img6', setupControl2 );
    } );

    // feature icon or image show hide control
    wp.customize( 'icare_feature_img_or_icon1', function( setting ) {
        var setupControl = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'icon' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        var setupControl2 = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'img' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        wp.customize.control( 'icare_feature_page_icon1', setupControl );
        wp.customize.control( 'icare_feature_page_img1', setupControl2 );
    } );
    wp.customize( 'icare_feature_img_or_icon2', function( setting ) {
        var setupControl = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'icon' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        var setupControl2 = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'img' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        wp.customize.control( 'icare_feature_page_icon2', setupControl );
        wp.customize.control( 'icare_feature_page_img2', setupControl2 );
    } );
    wp.customize( 'icare_feature_img_or_icon3', function( setting ) {
        var setupControl = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'icon' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        var setupControl2 = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'img' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        wp.customize.control( 'icare_feature_page_icon3', setupControl );
        wp.customize.control( 'icare_feature_page_img3', setupControl2 );
    } );
    wp.customize( 'icare_feature_img_or_icon4', function( setting ) {
        var setupControl = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'icon' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        var setupControl2 = function( control ) {
            var setActiveState, isDisplayed;
            isDisplayed = function() {
                return 'img' == setting.get();
            };
            setActiveState = function() {
                control.active.set( isDisplayed() );
            };
            setActiveState();
            setting.bind( setActiveState );
        };
        wp.customize.control( 'icare_feature_page_icon4', setupControl );
        wp.customize.control( 'icare_feature_page_img4', setupControl2 );
    } );