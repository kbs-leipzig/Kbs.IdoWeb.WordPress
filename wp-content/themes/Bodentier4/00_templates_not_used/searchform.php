<form role="search" method="get" class="searchform group" action="<?php echo home_url( '/' ); ?>">
 <label>
 <span class="offscreen"><?php echo _x( 'Suche nach:', 'label' ) ?></span>
 <input type="search" class="search-field"
 placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>"
 value="<?php echo get_search_query() ?>" name="s"
 title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
 </label>
 <!-- input type="text" alt="Submit search query" src="<?php echo get_template_directory_uri(); ?>/images/search-icon.png" !-->
 <input id="rd-navbar-search-form-input" type="text" name="s" autocomplete="off" class="rd-navbar-search-form-input form-control form-control-gray-lightest">
 <button class="mdi mdi-magnify btn icon"></button>
</form>