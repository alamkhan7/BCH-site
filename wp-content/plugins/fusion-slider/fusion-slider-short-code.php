<?php
add_shortcode( 'FSL', 'FusionSliderShortCode' );
function FusionSliderShortCode( $Id ) {
    ob_start();
	
	/**
	 * Load All Image Slider Custom Post Type
	 */
	$CPT_Name = "fsl_slider";
	$AllGalleries = array( 'post_id' => $Id['id'], 'post_type' => $CPT_Name, 'orderby' => 'ASC');
	$loop = new WP_Query( $AllGalleries );

	while ( $loop->have_posts() ) : $loop->the_post();
	
	/**
     * Load Saved Slider Settings
     */
    if(!isset($AllGalleries['post_id'])) {
        $AllGalleries['post_id'] = "";		
    } else {
		$FSL_Id = $AllGalleries['post_id'];
		$FSL_Settings = fsl_get_gallery_value($FSL_Id);
		if(count($FSL_Settings)) {
			$fsl_type  			= $FSL_Settings['fsl_type'];
			$fsl_fullWidth	   	= $FSL_Settings['fsl_fullWidth'];
			$fsl_width 			= $FSL_Settings['fsl_width'];
			$fsl_height 		= $FSL_Settings['fsl_height'];
			$fsl_links      	= $FSL_Settings['fsl_links'];
			$fsl_arrowcolor     = $FSL_Settings['fsl_arrowcolor'];
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
			$fsl_center	   		= $FSL_Settings['fsl_center'];
			$fsl_autoPlay       = $FSL_Settings['fsl_autoPlay'];
			$fsl_random      	= $FSL_Settings['fsl_random'] ;
			$fsl_hoverPause     = $FSL_Settings['fsl_hoverPause'];
			$fsl_delay          = $FSL_Settings['fsl_delay'];
			$fsl_animationSpeed = $FSL_Settings['fsl_animationSpeed'];
			$fsl_customCss      = $FSL_Settings['fsl_customCss'];
		}
	}
	
	require('inc/responsive-slider.php');
	
	return ob_get_clean();
	endwhile;
}
?>