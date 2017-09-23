var $   = window.jQuery;
    api = wp.customize || {};

window.BxExtensions = {

	/**
	 * Setting up some variables
	 *
	 * @type {Object}
	 */
	v : {
		panel    : 'businessx_panel__sections',
		admin    : bxext_widgets_customizer.admin_url,
		icons    : bxext_widgets_customizer.icons,
		sections : bxext_widgets_customizer.sections,
		sections_position : bxext_widgets_customizer.sections_position,
		msgs     : bxext_widgets_customizer.msgs,
		actions  : $( '#customize-header-actions' ),
	},

	/**
	 * Initiazlie BxExtensions
	 *
	 * @return {Mixed}
	 */
	init : function() {
		var self = this;

		self.initFirstViewModal()
		self.initSortableSections();
		self.backup();
	},

	/**
	 * Make the front page sections sortable in our panel
	 *
	 * @return {jQueryUI.Sortable}
	 */
	initSortableSections : function() {
		var self = this,
		    list = $( self.panelSections() );

		list.sortable({
			helper : 'clone',
			items  : '> li.control-section:not(.cannot-expand)',
			cancel : 'li.ui-sortable-handle.open',
			delay  : 150,
			axis   : 'y',
			create : function( event, ui ) {
				/**
				 * When the sortable list is created make sure we have the right positions.
				 * Also, in case we add a new section via plugin.
				 */
				var sections = self.sectionsArray(),
				    array1   = sections,
				    array2   = self.v.sections_position,
				    is_same  = array1.length == array2.length && array1.every( function( element, index ) {
						return element === array2[ index ];
					});

				if( ! is_same ) {
					self.setSectionsPosition( sections );
				}
			},
			update : function( event, ui ) {
				// If a sections is moved, save position in a theme mod
				list.find( '.bx_drag_and_spinner' ).show();
				self.setSectionsPosition( self.sectionsArray() );

				$( '.wp-full-overlay-sidebar-content' ).scrollTop( 0 );
			},
		});
	},

	/**
	 * Panel handle DOM element
	 *
	 * @return {DOMnode}
	 */
	panelHandle : function() {
		return api.panel( this.v.panel ).container.get( 0 );
	},

	/**
	 * Return all the sections in our Front Page panel
	 *
	 * @return {DOMnode}
	 */
	panelSections : function() {
		return api.panel( this.v.panel ).contentContainer;
	},

	/**
	 * Convert our sections name to a more friendly format
	 * and add them into an array
	 *
	 * @return {Array} [description]
	 */
	sectionsArray : function() {
		var self  = this,
		    list  = self.panelSections();
		    items = $( list ).sortable( 'toArray' );

		for( var i = 0; i < items.length; i++ ) {
			items[ i ] = items[ i ].replace( 'accordion-section-', '' );
		}
		return items;
	},

	/**
	 * When a section is sorted and ajax is done refresh
	 * the previewer and remove the spinner preloader
	 *
	 * @return {Void}
	 */
	ifAjaxIsDone : function() {
		var self = this,
		    list = $( self.panelSections() );

		$.each( self.sectionsArray(), function( key, value ) {
			api.section( value ).priority( key );
		});

		list.find( '.bx_drag_and_spinner' ).hide();

		api.previewer.refresh();
	},

	/**
	 * Sets the sections position so we can remember them. Adds them
	 * into a theme mode via ajax
	 *
	 * @param  {Array} sections An array of sections with their position updated
	 * @return {Void}
	 */
	setSectionsPosition : function( sections ) {
		var self = this;

		$.ajax({
			url      : ajaxurl,
			type     : 'post',
			dataType : 'json',
			data     : {
				action: 'businessx_extensions_sections_position',
				n_sections: bxext_customizer_nonces.n_sections,
				items: sections
			}
		})
		.done( function( data ) {
			self.ifAjaxIsDone();
		});
	},

	/**
	 * Backup sections and widgets position
	 * @return {Mixed}
	 */
	backup : function() {
		var self    = this,
		    actions = self.v.actions,
		    msgs    = self.v.msgs,
		    _doc    = $( document ),
		    save    = actions.find( '.save' );

		// Add backup button
		actions.prepend(
			'<a href="#" class="customize-controls-close bx-backup-sections"><span class="bx-backup-pulse"></span><span class="bx-backup-bubble">' + msgs.bk_bubble + '</span></a>'
		);

		// When the backup button is clicked do this action via ajax
		_doc.on( 'click', '.bx-backup-sections', function( e ) {
			e.preventDefault();

			if( save.is( ':disabled' ) === true ) {
				$.ajax({
					url      : ajaxurl,
					type     : 'post',
					dataType : 'json',
					data     : {
						action: 'businessx_extensions_sections_bk',
						n_sections_bk: bxext_customizer_nonces.n_sections_bk,
					}
				})
				.done( function( data ) {
					$( '.bx-backup-pulse' ).hide();
					alert( msgs.bk_success );
					_doc.trigger( 'bx-backup-success' );
				});
			} else {
				alert( msgs.bk_fail );
			}
		});

		// When widgets are added or updated display pulse
		_doc.on( 'widget-added widget-updated', function( e ) {
			$( '.bx-backup-pulse' ).show();
		});

		// Restore backup when a button is clicked
		_doc.on( 'click', '.bx-restore-sections', function( e ) {
			e.preventDefault();

			if( save.is(':disabled') === true ) {
				$.ajax({
					url      : ajaxurl,
					type     : 'post',
					dataType : 'json',
					data     : {
						action: 'businessx_extensions_sections_rt',
						n_sections_rt: bxext_customizer_nonces.n_sections_rt,
					}
				})
				.done( function( data ) {
					alert( msgs.bk_restore_success );
					location.reload(true);
				});
			} else {
				alert( msgs.bk_fail );
			}
		});
	},

	/**
	 * Setup for Front Page with cusom template
	 * @return {Void}
	 */
	initFirstViewModal : function() {
		// Check if the modal window is ready or exists
		if( $( '#businessx-frontpage-modal' ).length > 0 ) {
			window.tb_show( bxext_frontpage_vars.modal_title, '#TB_inline?width=570&height=330&inlineId=businessx-frontpage-modal' );
			$( '#TB_window' ).css( 'z-index', '500002').addClass( 'bxext-stp-modal-window' );
			$( '#TB_overlay' ).css( 'z-index', '500001' ).addClass( 'bxext-stp-modal-overlay' );
			$( '#TB_overlay.bxext-stp-modal-overlay' ).off( 'click' );
		}

		// Insert front page on user action
		$( '#bxext-insert-frontpage' ).on( 'click', function( event ) {
			$.ajax({
				url      : ajaxurl,
				type     : 'post',
				dataType : 'json',
				data     : {
					action: 'bxext_create_frontpage',
					bxext_create_frontpage: bxext_customizer_nonces.bxext_create_frontpage,
				}
			})
			.done( function( data ) {
				window.tb_remove();
				location.reload( true );
			});
		});

		// Use `.bxext-stp-modal-window #TB_closeWindowButton` to dismiss on X click
		$( '#bxext-dismiss-frontpage' ).on( 'click', function( event ) {
			$.ajax({
				url      : ajaxurl,
				type     : 'post',
				dataType : 'json',
				data     : {
					action: 'bxext_dismiss_create_frontpage',
					bxext_create_frontpage: bxext_customizer_nonces.bxext_dismiss_create_frontpage,
				}
			})
			.done( function( data ) {
				window.tb_remove();
				location.reload( true );
			});
		});
	}

}

/**
 * Let the magic begin
 */
$( document ).ready( function( $ ) {
	var bxextensions = window.BxExtensions;

	/**
	 * Init Businessx Pro Customizer Class
	 */
	bxextensions.init();
});
