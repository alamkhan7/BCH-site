<?php 
	if($fsl_fullWidth == "true"){
		$fsl_width = "100%";
	}else{
		$fsl_width = $fsl_width.'px';
	}
?>
<style>
	#futionslider_<?php echo $FSL_Id; ?> a.rslides_nav:hover{
		color: <?php echo $fsl_arrowcolor; ?>;
	}
	
	#futionslider_<?php echo $FSL_Id; ?> .rslides .caption{
		font-family: '<?php echo $fsl_dfontfamily; ?>';
		text-align: <?php echo $fsl_textalign; ?>;
		font-size: <?php echo $fsl_dfontsize; ?>px;
		color: <?php echo $fsl_dfontcolor; ?>;
		line-height: <?php echo $fsl_dlineheight; ?>px;
		background: <?php echo $fsl_dbgcolor; ?>;
		opacity: 0.8;
	}
	
	#futionslider_<?php echo $FSL_Id; ?> .rp-title{
		background: <?php echo $fsl_tbgcolor; ?>;
		opacity: 0.8;
		font-family: '<?php echo $fsl_tfontfamily; ?>';
		font-size: <?php echo $fsl_tfontsize; ?>px;
		color: <?php echo $fsl_tfontcolor; ?>;
		line-height: <?php echo $fsl_tlineheight; ?>px;
		top: <?php echo $fsl_tspacetop; ?>%;
		margin-left: <?php echo $fsl_tspaceleft; ?>%;
	}
	
	#futionslider_<?php echo $FSL_Id; ?> .rp-description{
		background: <?php echo $fsl_dbgcolor; ?>;
		opacity: 0.8;
		font-family: '<?php echo $fsl_dfontfamily; ?>';
		font-size: <?php echo $fsl_dfontsize; ?>px;
		color: <?php echo $fsl_dfontcolor; ?>;
		line-height: <?php echo $fsl_dlineheight; ?>px;
		top: <?php echo $fsl_dspacetop; ?>%;
		margin-left: <?php echo $fsl_dspaceleft; ?>%;
	}
	
	<?php
	if( $fsl_center== "true"){ ?>
		#slider_<?php echo $FSL_Id; ?>{
			text-align:center;
		}
	<?php
	}
	if($fsl_navigation == "true"){ ?>
		#slider_<?php echo $FSL_Id; ?>{
			margin-bottom: 10px;
		}
	<?php }
	echo $fsl_customCss; 
?>
</style>
<?php
echo '<div id="slider_'. $FSL_Id .'" class="fslider_mb">';
	echo '<div class="fusionslider" id="futionslider_'. $FSL_Id .'" style="max-width:'. $fsl_width .'; max-height:'. $fsl_height .'px; display: inline-block;">';
		echo '<ul class="rslides" id="rslides_'. $FSL_Id .'">';

			$FSL_AllPhotosDetails = unserialize(get_post_meta( $FSL_Id, 'FSL_all_photos_details', true));
			$TotalImages =  get_post_meta( $FSL_Id, 'FSL_total_images_count', true );
			if($TotalImages  && $fsl_textstyle == "one" ) {
				foreach($FSL_AllPhotosDetails as $FSL_SinglePhotoDetails) {
					$title = esc_attr( $FSL_SinglePhotoDetails['FSL_image_label'] );
					$alt = esc_attr( $FSL_SinglePhotoDetails['FSL_image_alt'] );
					$gallery_image = esc_url( $FSL_SinglePhotoDetails['FSL_gallery_image'] );
					$link = esc_url( $FSL_SinglePhotoDetails['FSL_external_link'] );
					$description = stripslashes(esc_attr($FSL_SinglePhotoDetails['FSL_image_descp']));
					
					echo "<li>";
						if($link == ''){ 
							echo '<img src="'. $gallery_image .'" alt="'. $alt .'" style="height:' .$fsl_height. 'px" >';
							if( $title != "" ){ 
								echo '<div class="rp-title rp-layer rp-padding">'. $title .'</div>';
							} 
							if( $description != "" ){ 
								echo '<div class="rp-description rp-layer rp-padding">'. $description .'</div>';
							}
						}else { 
							echo "<a href='". $link ."' target='_blank'>";
								echo '<img src="'. $gallery_image .'" alt="'. $alt .'" style="height:' .$fsl_height. 'px" >';
								if( $title != "" ){ 
									echo '<div class="rp-title rp-layer rp-padding">'. $title .'</div>';
								} 
								if( $description != "" ){ 
									echo '<div class="rp-description rp-layer rp-padding">'. $description .'</div>';
								}
							echo "</a>";
						} 
					echo "</li>";
				}
			} elseif($TotalImages  && $fsl_textstyle == "two" ) {
				foreach($FSL_AllPhotosDetails as $FSL_SinglePhotoDetails) {
					$title = esc_attr( $FSL_SinglePhotoDetails['FSL_image_label'] );
					$alt = esc_attr( $FSL_SinglePhotoDetails['FSL_image_alt'] );
					$gallery_image = esc_url( $FSL_SinglePhotoDetails['FSL_gallery_image'] );
					$link = esc_url( $FSL_SinglePhotoDetails['FSL_external_link'] );
					$description = stripslashes(esc_attr($FSL_SinglePhotoDetails['FSL_image_descp']));
					
					echo "<li>";
						if($link == ''){ 
							echo '<img src="'. $gallery_image .'" alt="'. $alt .'" style="height:' .$fsl_height. 'px" >';
							if($description != ""){ 
								echo "<p class='caption'>". $description ."</p>";
							} 
						}else { 
							echo "<a href='". $link ."' target='_blank'>";
							echo '<img src="'. $gallery_image .'" alt="'. $alt .'" style="height:' .$fsl_height. 'px" >';
							if($description != ""){ 
								echo "<p class='caption'>" .$description. "</p>";
							}
							echo "</a>";
						} 
					echo "</li>";
				}
			}
		echo '</ul>';
	echo '</div>';
echo '</div>';	
?>
<script>
	jQuery(window).load(function(){
      jQuery("#rslides_<?php echo $FSL_Id; ?>").responsiveSlides({
		auto: <?php echo $fsl_autoPlay; ?>,           // Boolean: Animate automatically, true or false
		speed: <?php echo $fsl_animationSpeed; ?>,   // Integer: Speed of the transition, in milliseconds
		timeout: <?php echo $fsl_delay; ?>,          // Integer: Time between slide transitions, in milliseconds
		pager: <?php echo $fsl_navigation; ?>,       // Boolean: Show pager, true or false
		nav: <?php echo $fsl_links; ?>,             // Boolean: Show navigation, true or false
		random: <?php echo $fsl_random; ?>,         // Boolean: Randomize the order of the slides, true or false
		pause: <?php echo $fsl_hoverPause; ?>,      // Boolean: Pause on hover, true or false
		pauseControls: true,    // Boolean: Pause when hovering controls, true or false
		prevText: "<?php echo $fsl_prevText; ?>",   // String: Text for the "previous" button
		nextText: "<?php echo $fsl_nextText; ?>",       // String: Text for the "next" button
		navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
		manualControls: "",     // Selector: Declare custom pager navigation
		namespace: "rslides",   // String: Change the default namespace used
      });
    });
</script>