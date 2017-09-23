<div class="search-form">
	<form action="<?php echo esc_url(home_url('/')); ?>" method="get" role="search">
	  <div class="input-group">
		<input type="search" name="s" id="s" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('Search here','icare'); ?>&hellip;" class="form-control serch_input">
		<span class="input-group-btn">
		<button type="submit" id="searchsubmit" class="btn btn-colored btn-theme-colored btn-xs m-zero font-fourteen search_btn"><i class="fa fa-search"></i></button>
		</span>
	  </div>
	</form>
  </div>