<?php
/**
 * Load saved settings for fusion slider
 */
$PostId = $post->ID;
$FSL_Settings = fsl_get_gallery_value($PostId);
if($FSL_Settings['fsl_type']) {
	$fsl_type  			= $FSL_Settings['fsl_type'];
	$fsl_width 			= $FSL_Settings['fsl_width'];
	$fsl_height 		= $FSL_Settings['fsl_height'];
	$fsl_links      	= $FSL_Settings['fsl_links'];
	$fsl_arrowcolor		= $FSL_Settings['fsl_arrowcolor'];
	$fsl_prevText       = $FSL_Settings['fsl_prevText'];
	$fsl_nextText       = $FSL_Settings['fsl_nextText'];
	$fsl_navigation     = $FSL_Settings['fsl_navigation'];
	$fsl_textstyle     	= $FSL_Settings['fsl_textstyle'];
	$fsl_tbgcolor		= $FSL_Settings['fsl_tfontstyle']['bgcolor'];
	$fsl_tfontfamily	= $FSL_Settings['fsl_tfontstyle']['fontfamily'];
	$fsl_tfontcolor		= $FSL_Settings['fsl_tfontstyle']['color'];
	$fsl_tfontsize		= $FSL_Settings['fsl_tfontstyle']['size'];
	$fsl_tlineheight	= $FSL_Settings['fsl_tfontstyle']['lineheight'];
	$fsl_tspacetop		= $FSL_Settings['fsl_tspacetop'];
	$fsl_tspaceleft		= $FSL_Settings['fsl_tspaceleft'];
	$fsl_dbgcolor		= $FSL_Settings['fsl_dfontstyle']['bgcolor'];
	$fsl_dfontfamily	= $FSL_Settings['fsl_dfontstyle']['fontfamily'];
	$fsl_dfontcolor		= $FSL_Settings['fsl_dfontstyle']['color'];
	$fsl_dfontsize		= $FSL_Settings['fsl_dfontstyle']['size'];
	$fsl_dlineheight	= $FSL_Settings['fsl_dfontstyle']['lineheight'];
	$fsl_dspacetop		= $FSL_Settings['fsl_dspacetop'];
	$fsl_dspaceleft		= $FSL_Settings['fsl_dspaceleft'];
	$fsl_textalign		= $FSL_Settings['fsl_textalign'];
	$fsl_fullWidth	   	= $FSL_Settings['fsl_fullWidth'];
	$fsl_center	   		= $FSL_Settings['fsl_center'];
	$fsl_autoPlay       = $FSL_Settings['fsl_autoPlay'];
	$fsl_random      	= $FSL_Settings['fsl_random'] ;
	$fsl_hoverPause     = $FSL_Settings['fsl_hoverPause'];
	$fsl_delay          = $FSL_Settings['fsl_delay'];
	$fsl_animationSpeed = $FSL_Settings['fsl_animationSpeed'];
	$fsl_customCss     =  $FSL_Settings['fsl_customCss'];	
}
?>
<style>
.webhuntslider p{
	line-height:0px;
}

.fontoptions.section.colm.colm6 {
    margin-bottom: 6px !important;
}
</style>
<script>
jQuery(document).ready(function(){
	
	// Enable next option on uncheck parant check box (Page Load)
	toggleNextRow(jQuery(".webhuntslider .showNextWhenUnchecked"));
	
	// Enable or disabled slider Title Settins
	sliderTitle("<?php echo $fsl_textstyle; ?>");
	jQuery( "input[name=fsl_textstyle]" ).change(function() {
		sliderTitle(jQuery(this).val());
	});
	
	// Enable next option on uncheck parant check box
	jQuery(".webhuntslider .showNextWhenUnchecked").on("change", function() {
		toggleNextRow(jQuery(this));
	});
});

// Funtion to enable or disabled slider Title Settins
function sliderTitle(value) {
	if(value == "two"){
		jQuery('.titleSettings').parents('.frm-row').hide(200);
		jQuery( ".titlespace" ).css( "display", "none" );
		jQuery(".textAlign").parents('.frm-row').show();
	}else{
		jQuery('.titleSettings').parents('.frm-row').show(200);
		jQuery( ".titlespace" ).css( "display", "block" );
		jQuery(".textAlign").parents('.frm-row').hide();
	}
}

// child option visible we parant option unchecked
var toggleNextRow = function(checkbox) {		
	if(checkbox.is(':checked') && checkbox.is(':visible')){
		checkbox.parent().parent().parent().next(".frm-row").hide();
	} else {
		checkbox.parent().parent().parent().next(".frm-row").show();
	}
}
</script>
<input type="hidden" id="wl_action" name="wl_action" value="wl-save-settings">
<body class="woodbg">

	<div class="smart-wrap">
    	<div class="smart-forms smart-container wrap-1">

        	<div class="form-header header-primary">
            	<h4><?php _e('Slider Gallery Settings','FSL_TEXT_DOMAIN')?></h4>
            </div><!-- end .form-header section -->

            <form method="post" action="" id="form-ui">
            	<div class="form-body webhuntslider">

                    <div class="spacer-b30">
                    	<div class="tagline"><span><?php _e('Transition and layout Settings','FSL_TEXT_DOMAIN'); ?> </span></div><!-- .tagline -->
                    </div>

					<div class="frm-row"><!-- Slider Type Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Slider Type','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm6">
                            <label class="field select">
                                <select name="fsl_type" class="select-slider">
                                    <optgroup label="Select Slider Type">
										<option class="select-slider" value="responsive" <?php if($fsl_type == 'responsive') echo "selected=selected"; ?>><?php _e('Responsive Slides','FSL_TEXT_DOMAIN')?></option>
										<option disabled><?php _e('Flex Slider One(Avaliable in PRO Version)','FSL_TEXT_DOMAIN')?></option>
										<option disabled><?php _e('Flex Slider Two(Avaliable in PRO Version)','FSL_TEXT_DOMAIN')?></option>
										<option disabled><?php _e('Jssor Image Slider (Avaliable in PRO Version)','FSL_TEXT_DOMAIN')?></option>
										<option disabled><?php _e('Carousel Slider (Avaliable in PRO Version)','FSL_TEXT_DOMAIN')?>
										<option disabled><?php _e('Elastic Slider (Avaliable in PRO Version)','FSL_TEXT_DOMAIN')?></option>
										<option disabled><?php _e('Nivo Slider (Avaliable in PRO Version)','FSL_TEXT_DOMAIN')?></option>
									</optgroup>
                                </select>
                                <i class="arrow double"></i>
                            </label>
                        </div>
                    </div><!-- End of "Slider Type" Section -->
					
					<div class="frm-row"><!-- "Stretch" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Stretch (width)','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm6">
                            <label class="field option block">
								<input type="hidden" name="fsl_fullWidth" value="false">
								<input class="options elastic showNextWhenUnchecked" type="checkbox" name="fsl_fullWidth"  value="true" <?php if($fsl_fullWidth == 'true' ) { echo "checked"; } ?>>
								<span class="checkbox"></span><?php _e('100% wide output','FSL_TEXT_DOMAIN'); ?>
								<p class="small-text fine-grey"> <?php _e('Uncheck this option to enable Slider Width Option','FSL_TEXT_DOMAIN'); ?>. </p>
							</label>
                        </div>
                    </div><!-- End of "Stretch" Section -->
					
					<div class="frm-row"><!-- "Slider Width" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Slider Width','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm3">
                            <label class="field append-icon">
                                <input class="gui-input options responsive width" type="number" min="0" max="9999" step="1" name="fsl_width" value="<?php echo $fsl_width; ?>">
                                <label class="field-icon">px </label>  
                            </label>
                        </div>
                    </div><!-- End of "Slider Width" Section -->
					
					<div class="frm-row"><!-- "Slider Height" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Slider Height','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm3">
                            <label class="field append-icon">
                                <input class="gui-input options responsive height" type="number" min="0" max="9999" step="1" name="fsl_height" value="<?php echo $fsl_height; ?>">
                                <label class="field-icon">px </label>  
                            </label>
                        </div>
                    </div><!-- End of "Slider Height" Section -->
					
					<div class="spacer-b10">&nbsp;</div>
                    <div class="spacer-t20 spacer-b40">
                    	<div class="tagline"><span> <?php _e('Arrows and Navigation settings','FSL_TEXT_DOMAIN'); ?> </span></div>
                    </div>
					
					<div class="frm-row"><!-- "Arrows" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Arrows','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm6">
                            <label class="field option block">
								<input type="hidden" name="fsl_links" value="false">
								<input class="options responsive" type="checkbox" name="fsl_links"  value="true" <?php if($fsl_links == 'true' ) { echo "checked"; } ?>>
								<span class="checkbox"></span>
							</label>
                        </div>
                    </div><!-- End of "Arrows" Section -->
					
					<div class="frm-row"><!-- "Arrow Color" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Arrow Color','FSL_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_arrowcolor" value="#ffffff" <?php if($fsl_arrowcolor == '#ffffff' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('White','FSL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_arrowcolor" value="#ec0b0b" <?php if($fsl_arrowcolor == '#ec0b0b' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Red','FSL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_arrowcolor" value="#31a3dd" <?php if($fsl_arrowcolor == '#31a3dd' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Blue','FSL_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of "Arrow Color" Section -->
					
					<div class="frm-row"><!-- "Previous text" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Previous Text','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm4">
                            <label class="field append-icon">
                                <input type="text" name="fsl_prevText" class="gui-input options responsive" value="<?php echo $fsl_prevText; ?>">
                            </label>
                        </div>
                    </div><!-- End of "Previous text" Section -->
					
					<div class="frm-row"><!-- "Next text" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Next Text','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm4">
                            <label class="field append-icon">
                                <input class="gui-input options responsive" type="text" name="fsl_nextText" value="<?php echo $fsl_nextText; ?>">
                            </label>
                        </div>
                    </div><!-- End of "Next text" Section -->

					<div class="frm-row"><!-- "Navigation" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Navigation','FSL_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input type="radio" name="fsl_navigation" value="false" <?php if($fsl_navigation == 'false' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Hidden','FSL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input type="radio" name="fsl_navigation" value="true" <?php if($fsl_navigation == 'true' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Dots','FSL_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of "Navigation" Section -->
					 
					<div class="spacer-b10">&nbsp;</div>
                    <div class="spacer-t20 spacer-b40">
                    	<div class="tagline"><span> <?php _e('Typography Options','FSL_TEXT_DOMAIN'); ?> </span></div>
                    </div>
					
					<div class="frm-row"><!-- "Text Display Style" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Text Display Style','FSL_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6" style="margin-bottom: 2px;">
							<div class="option-group field">
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_textstyle" value="one" <?php if($fsl_textstyle == 'one' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Style One','FSL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_textstyle" value="two" <?php if($fsl_textstyle == 'two' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Style Two','FSL_TEXT_DOMAIN'); ?>
								</label>
								<p class="small-text fine-grey" style="margin-top: 14px;"> <?php _e('Note:- With <b>Style Two</b> Only Slider Description will Work.','FSL_TEXT_DOMAIN'); ?>. </p>
							</div>
						</div>
					 </div><!-- End of "Text Display Style" Section -->
					 
					<div class="frm-row"><!-- "Title Background Color" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Title Backgound Color','FSL_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input class="options responsive titleSettings" type="radio" name="fsl_tbgcolor" value="#000000" <?php if($fsl_tbgcolor == '#000000' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Black','FSL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_tbgcolor" value="#ec0b0b" <?php if($fsl_tbgcolor == '#ec0b0b' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Red','FSL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_tbgcolor" value="#31a3dd" <?php if($fsl_tbgcolor == '#31a3dd' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Blue','FSL_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of "Title Background Color" Section -->
					
					<div class="frm-row"><!-- Slider Title "Font Family" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Title Font Family','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm6">
                            <label class="field select">
                                <select name="fsl_tfontfamily" class="options responsive titleSettings">
                                    <optgroup label="Default Fonts">
										<option value="Arial" <?php selected($fsl_tfontfamily, 'Arial' ); ?>>Arial</option>
										<option value="Arial Black" <?php selected($fsl_tfontfamily, 'Arial Black' ); ?>>Arial Black</option>
										<option value="Bookman Old Style" <?php selected($fsl_tfontfamily, 'Bookman Old Style' ); ?>>Bookman Old Style</option>
										<option value="Comic Sans MS" <?php selected($fsl_tfontfamily, 'Comic Sans MS' ); ?>>Comic Sans MS</option>
										<option value="Courier" <?php selected($fsl_tfontfamily, 'Courier' ); ?>>Courier</option>
										<option value="Garamond" <?php selected($fsl_tfontfamily, 'Garamond' ); ?>>Garamond</option>
										<option value="Georgia" <?php selected($fsl_tfontfamily, 'Georgia' ); ?>>Georgia</option>
										<option value="Impact" <?php selected($fsl_tfontfamily, 'Impact' ); ?>>Impact</option>
										<option value="Lucida Console" <?php selected($fsl_tfontfamily, 'Lucida Console' ); ?>>Lucida Console</option>
										<option value="Lucida Sans Unicode" <?php selected($fsl_tfontfamily, 'Lucida Sans Unicode' ); ?>>Lucida Sans Unicode</option>
										<option value="MS Sans Serif" <?php selected($fsl_tfontfamily, 'MS Sans Serif' ); ?>>MS Sans Serif</option>
										<option value="MS Serif" <?php selected($fsl_tfontfamily, 'MS Serif' ); ?>>MS Serif</option>
										<option value="Palatino Linotype" <?php selected($fsl_tfontfamily, 'Palatino Linotype' ); ?>>Palatino Linotype</option>
										<option value="Tahoma" <?php selected($fsl_tfontfamily, 'Tahoma' ); ?>>Tahoma</option>
										<option value="Times New Roman" <?php selected($fsl_tfontfamily, 'Times New Roman' ); ?>>Times New Roman</option>
										<option value="Trebuchet MS" <?php selected($fsl_tfontfamily, 'Trebuchet MS' ); ?>>Trebuchet MS</option>							
										<option value="Verdana" <?php selected($fsl_tfontfamily, 'Verdana' ); ?>>Verdana</option>
									</optgroup>
								</select>
                                <i class="arrow double"></i>
                            </label>
                        </div> <!-- End of Slider Title "Font Family" Option -->
                    </div>
					
					<div class="frm-row"><!-- "Title Font Color" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Title Font Color','FSL_TEXT_DOMAIN'); ?>:</label>
						<div class="titleSettings section colm colm6">
							<div class="option-group field" style="padding-top: 0px;">
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_tfontcolor" value="#000000" <?php if($fsl_tfontcolor == '#000000' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Black','FSL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_tfontcolor" value="#ffffff" <?php if($fsl_tfontcolor == '#ffffff' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('White','FSL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_tfontcolor" value="#ec0b0b" <?php if($fsl_tfontcolor == '#ec0b0b' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Red','FSL_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of "Title Font Color" Section -->
					
					<div class="frm-row">
                    	<label class="field-label colm colm4 align-left" Style="padding-top: 30px;"><?php _e('Title Size & Line Height','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm3"><!-- "Title Font Size" Section -->
							<p class="small-text fine-grey"> <?php _e('Title Font Size','FSL_TEXT_DOMAIN'); ?> </p>
                            <label class="field append-icon">
                                <input class="gui-input options responsive titleSettings" type="number" name="fsl_tfontsize" min="10" max="99" step="1" value="<?php echo $fsl_tfontsize; ?>">
                                <label class="field-icon">px </label>  
                            </label>
                        </div>
						<div class="section colm colm3"><!-- "Title Line Height" Section -->
							<p class="small-text fine-grey"> <?php _e('Title Line Height','FSL_TEXT_DOMAIN'); ?> </p>
                            <label class="field append-icon">
                                <input class="gui-input options responsive titleSettings" type="number" name="fsl_tlineheight" min="10" max="99" step="1" value="<?php echo $fsl_tlineheight; ?>">
                                <label class="field-icon">px </label>  
                            </label>
                        </div>
                    </div><!-- End of the Section -->
					
					<div class="frm-row">
                    	<label class="field-label colm colm4 align-left" Style="padding-top: 30px;"><?php _e('Title Spacing (Top & Left)','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm3"><!-- "Spacing for Top" Section -->
							<p class="small-text fine-grey"> <?php _e('Spacing for Top','FSL_TEXT_DOMAIN'); ?> </p>
                            <label class="field append-icon">
                                <input class="gui-input options responsive titleSettings" type="number" name="fsl_tspacetop" min="1" max="99" step="1" value="<?php echo $fsl_tspacetop; ?>">
                                <label class="field-icon">% </label>  
                            </label>
                        </div>
						<div class="section colm colm3"><!-- "Spacing for Left" Section -->
							<p class="small-text fine-grey"> <?php _e('Spacing for Left','FSL_TEXT_DOMAIN'); ?> </p>
                            <label class="field append-icon">
                                <input class="gui-input options responsive titleSettings" type="number" name="fsl_tspaceleft" min="1" max="99" step="1" value="<?php echo $fsl_tspaceleft; ?>">
                                <label class="field-icon">% </label>  
                            </label>
                        </div>
                    </div><!-- End of the Section -->
					
					<div class="spacer-t10 titlespace">&nbsp;</div>
					 
					<div class="frm-row"><!-- "Description Background Color" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Desc. Background Color','FSL_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field">
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_dbgcolor" value="#000000" <?php if($fsl_dbgcolor == '#000000' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Black','FSL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_dbgcolor" value="#ec0b0b" <?php if($fsl_dbgcolor == '#ec0b0b' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Red','FSL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_dbgcolor" value="#31a3dd" <?php if($fsl_dbgcolor == '#31a3dd' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Blue','FSL_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of "Description Background Color" Section -->
					
					<div class="frm-row"><!-- Description Font Family Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Description Font Family','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm6">
                            <label class="field select">
                                <select name="fsl_dfontfamily" class="options responsive">
                                    <optgroup label="Default Fonts">
										<option value="Arial" <?php selected($fsl_dfontfamily, 'Arial' ); ?>>Arial</option>
										<option value="Arial Black" <?php selected($fsl_dfontfamily, 'Arial Black' ); ?>>Arial Black</option>
										<option value="Bookman Old Style" <?php selected($fsl_dfontfamily, 'Bookman Old Style' ); ?>>Bookman Old Style</option>
										<option value="Comic Sans MS" <?php selected($fsl_dfontfamily, 'Comic Sans MS' ); ?>>Comic Sans MS</option>
										<option value="Courier" <?php selected($fsl_dfontfamily, 'Courier' ); ?>>Courier</option>
										<option value="Garamond" <?php selected($fsl_dfontfamily, 'Garamond' ); ?>>Garamond</option>
										<option value="Georgia" <?php selected($fsl_dfontfamily, 'Georgia' ); ?>>Georgia</option>
										<option value="Impact" <?php selected($fsl_dfontfamily, 'Impact' ); ?>>Impact</option>
										<option value="Lucida Console" <?php selected($fsl_dfontfamily, 'Lucida Console' ); ?>>Lucida Console</option>
										<option value="Lucida Sans Unicode" <?php selected($fsl_dfontfamily, 'Lucida Sans Unicode' ); ?>>Lucida Sans Unicode</option>
										<option value="MS Sans Serif" <?php selected($fsl_dfontfamily, 'MS Sans Serif' ); ?>>MS Sans Serif</option>
										<option value="MS Serif" <?php selected($fsl_dfontfamily, 'MS Serif' ); ?>>MS Serif</option>
										<option value="Palatino Linotype" <?php selected($fsl_dfontfamily, 'Palatino Linotype' ); ?>>Palatino Linotype</option>
										<option value="Tahoma" <?php selected($fsl_dfontfamily, 'Tahoma' ); ?>>Tahoma</option>
										<option value="Times New Roman" <?php selected($fsl_dfontfamily, 'Times New Roman' ); ?>>Times New Roman</option>
										<option value="Trebuchet MS" <?php selected($fsl_dfontfamily, 'Trebuchet MS' ); ?>>Trebuchet MS</option>							
										<option value="Verdana" <?php selected($fsl_dfontfamily, 'Verdana' ); ?>>Verdana</option>
									</optgroup>
								</select>
                                <i class="arrow double"></i>
                            </label>
                        </div> <!-- End of "Description Font Family" Option -->
                    </div>
					
					<div class="frm-row"><!-- "Description Font Color" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Description Font Color','FSL_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6">
							<div class="option-group field" style="padding-top: 0px;">
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_dfontcolor" value="#000000" <?php if($fsl_dfontcolor == '#000000' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Black','FSL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_dfontcolor" value="#ffffff" <?php if($fsl_dfontcolor == '#ffffff' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('White','FSL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_dfontcolor" value="#ec0b0b" <?php if($fsl_dfontcolor == '#ec0b0b' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Red','FSL_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of "Description Font Color" Section -->
					
					<div class="frm-row">
                    	<label class="field-label colm colm4 align-left" Style="padding-top: 30px;"><?php _e('Desc. Size & Line Height','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm3"><!-- "Description Font Size" Section -->
							<p class="small-text fine-grey"> <?php _e('Description Font Size','FSL_TEXT_DOMAIN'); ?> </p>
                            <label class="field append-icon">
                                <input class="gui-input options responsive" type="number" name="fsl_dfontsize" min="10" max="99" step="1" value="<?php echo $fsl_dfontsize; ?>">
                                <label class="field-icon">px </label>  
                            </label>
                        </div>
						<div class="section colm colm3"><!-- "Description Line Height" Section -->
							<p class="small-text fine-grey"> <?php _e('Description Line Height','FSL_TEXT_DOMAIN'); ?> </p>
                            <label class="field append-icon">
                                <input class="gui-input options responsive" type="number" name="fsl_dlineheight" min="10" max="99" step="1" value="<?php echo $fsl_dlineheight; ?>">
                                <label class="field-icon">px </label>  
                            </label>
                        </div>
                    </div><!-- End of the Section -->
					
					<div class="frm-row">
                    	<label class="field-label colm colm4 align-left" Style="padding-top: 30px;"><?php _e('Desc. Spacing (Top & Left)','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm3"><!-- "Spacing for Top" Section -->
							<p class="small-text fine-grey"> <?php _e('Spacing for Top','FSL_TEXT_DOMAIN'); ?> </p>
                            <label class="field append-icon">
                                <input class="gui-input options responsive titleSettings" type="number" name="fsl_dspacetop" min="1" max="99" step="1" value="<?php echo $fsl_dspacetop; ?>">
                                <label class="field-icon">% </label>  
                            </label>
                        </div>
						<div class="section colm colm3"><!-- "Spacing for Left" Section -->
							<p class="small-text fine-grey"> <?php _e('Spacing for Left','FSL_TEXT_DOMAIN'); ?> </p>
                            <label class="field append-icon">
                                <input class="gui-input options responsive titleSettings" type="number" name="fsl_dspaceleft" min="1" max="99" step="1" value="<?php echo $fsl_dspaceleft; ?>">
                                <label class="field-icon">% </label>  
                            </label>
                        </div>
                    </div><!-- End of the Section -->
					
					<div class="frm-row"><!-- "Text Align" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Text Align','FSL_TEXT_DOMAIN'); ?>:</label>
						<div class="section colm colm6 textAlign">
							<div class="option-group field">
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_textalign" value="left" <?php if($fsl_textalign == 'left' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Left','FSL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_textalign" value="right" <?php if($fsl_textalign == 'right' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Right','FSL_TEXT_DOMAIN'); ?>
								</label>
								<label class="option">
									<input class="options responsive" type="radio" name="fsl_textalign" value="center" <?php if($fsl_textalign == 'center' ) { echo "checked"; } ?>>
									<span class="radio"></span> <?php _e('Center','FSL_TEXT_DOMAIN'); ?>
								</label>
							</div>
						</div>
					 </div><!-- End of "Text Align" Section -->
					
					<div class="spacer-b10">&nbsp;</div>
                    <div class="spacer-t20 spacer-b40">
                    	<div class="tagline"><span> <?php _e('Feature Options','FSL_TEXT_DOMAIN'); ?> </span></div>
                    </div>
					 
					<div class="frm-row">
						<label class="field-label colm colm2 align-left"></label>
                    	<label class="field-label colm colm2 align-left" style="padding-top: 6px;"><?php _e('Center Align','FSL_TEXT_DOMAIN'); ?>:</label><!-- "Center align" Section -->
                        <div class="section colm colm2">
                            <label class="field option block">
								<input type="hidden" name="fsl_center" value="false">
								<input class="options responsive" type="checkbox" name="fsl_center"  value="true" <?php if($fsl_center == 'true' ) { echo "checked"; } ?>>
								<span class="checkbox"></span>
							</label>
                        </div><!-- End of "Center align" Section -->
						<label class="field-label colm colm2 align-left" style="padding-top: 6px;"><?php _e('Auto Play','FSL_TEXT_DOMAIN'); ?>:</label><!-- "Auto Play" Section -->
                        <div class="section colm colm2">
                            <label class="field option block">
								<input type="hidden" name="fsl_autoPlay" value="false">
								<input class="options responsive" type="checkbox" name="fsl_autoPlay"  value="true" <?php if($fsl_autoPlay == 'true' ) { echo "checked"; } ?>>
								<span class="checkbox"></span>
							</label>
                        </div><!-- End of "Auto Play" Section -->
                    </div>
					
					<div class="frm-row">
						<label class="field-label colm colm2 align-left"></label>
                    	<label class="field-label colm colm2 align-left" style="padding-top: 6px;"><?php _e('Random','FSL_TEXT_DOMAIN'); ?>:</label><!-- "Random" Section -->
                        <div class="section colm colm2">
                            <label class="field option block">
								<input type="hidden" name="fsl_random" value="false">
								<input class="options responsive" type="checkbox" name="fsl_random"  value="true" <?php if($fsl_random == 'true' ) { echo "checked"; } ?>>
								<span class="checkbox"></span>
							</label>
                        </div><!-- End of "Random" Section -->
						<label class="field-label colm colm2 align-left" style="padding-top: 6px;"><?php _e('Hover Pause','FSL_TEXT_DOMAIN'); ?>:</label><!-- "Hover Pause" Section -->
                        <div class="section colm colm2">
                            <label class="field option block">
								<input type="hidden" name="fsl_hoverPause" value="false">
								<input class="options responsive" type="checkbox" name="fsl_hoverPause" value="true" <?php if($fsl_hoverPause == 'true' ) { echo "checked"; } ?>>
								<span class="checkbox"></span>
							</label>
                        </div><!-- End of "Hover Pause" Section -->
                    </div>
					
					<div class="spacer-b10">&nbsp;</div>
                    <div class="spacer-t20 spacer-b40">
                    	<div class="tagline"><span> <?php _e('Advanced Settings Options','FSL_TEXT_DOMAIN'); ?> </span></div>
                    </div>
					
					<div class="frm-row"><!-- "Slide delay" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Slide Delay','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm3">
                            <label class="field append-icon">
                                <input class="gui-input options responsive" type="number" name="fsl_delay" min="500" max="10000" step="100" value="<?php echo $fsl_delay; ?>">
                                <label class="field-icon">px </label>  
                            </label>
                        </div>
                    </div><!-- End of "Slide Delay" Section -->
					
					<div class="frm-row"><!-- "Animation Speed" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Animation Speed','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm3">
                            <label class="field append-icon">
                                <input class="gui-input options responsive" type="number" name="fsl_animationSpeed" min="0" max="2000" step="100" value="<?php echo $fsl_animationSpeed; ?>">
                                <label class="field-icon">px </label>  
                            </label>
                        </div>
                    </div><!-- End of "Animation Speed" Section -->

					<div class="spacer-b10">&nbsp;</div>
                    <div class="spacer-t20 spacer-b40">
                    	<div class="tagline"><span> <?php _e('Custom Css Editor','FSL_TEXT_DOMAIN'); ?> </span></div>
                    </div>
					
					<div class="frm-row"> <!-- "Custom CSS" Section -->
                    	<label class="field-label colm colm4 align-left"><?php _e('Custom CSS','FSL_TEXT_DOMAIN'); ?>:</label>
                        <div class="section colm colm8">
							<label class="field">
								<textarea class="gui-textarea" name="fsl_customCss" placeholder="Put Your CSS Code Here"><?php echo $fsl_customCss; ?></textarea>
								<span class="field-icon"><i class="fa fa-comments"></i></span>
								<span class="input-hint">
									<strong><?php _e('Note','FSL_TEXT_DOMAIN'); ?>:</strong> <?php _e('Please do not use','FSL_TEXT_DOMAIN'); ?> <b><?php _e('Style','FSL_TEXT_DOMAIN'); ?></b> <?php _e('tag with Custom CSS','FSL_TEXT_DOMAIN'); ?>.
								</span>
							</label>
						</div>
					</div>	<!-- End of "Custom CSS" Section -->

				</div>
			</form>
		</div>
	</div>
</body>
