<?php
/**
 * The sidebar containing the main icare-widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package iCare
 */

if ( ! is_active_sidebar( 'sidebar-r' ) ) {
	return;
}?>
<div class="sidebar col-md-3">
	<div class="mt-sm-thirty">
		<?php dynamic_sidebar( 'sidebar-r' ); ?>
	</div>
</div>
