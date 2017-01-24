<?php
/* 
**   Custom Modifcations in CSS depending on user settings.
*/

function newp_custom_css_mods() {

	echo "<style id='custom-css-mods'>";
	
	//If Highlighting Nav active item is disabled
	if ( get_theme_mod('newp_disable_active_nav') ) :
		echo "#site-navigation ul .current_page_item > a, #site-navigation ul .current-menu-item > a, #site-navigation ul .current_page_ancestor > a { border:none; background: inherit; }"; 
	endif;
	
	//If Title and Desc is set to Show Below the Logo
	if (  get_theme_mod('newp_branding_below_logo') ) :
		
		echo "#masthead #text-title-desc { display: block; clear: both; } ";
		
	endif;
	
	
	
	if ( get_theme_mod('newp_title_font') ) :
		echo ".title-font, h1, h2, .section-title { font-family: ".esc_html(get_theme_mod('newp_title_font','Roboto Condensed'))."; }";
	endif;
	
	if ( get_theme_mod('newp_body_font') ) :
		echo "body { font-family: ".esc_html(get_theme_mod('newp_body_font','Lato'))."; }";
	endif;
	
	if ( get_theme_mod('newp_site_titlecolor','#919191') ) :
		echo "#masthead h1.site-title a { color: ".esc_html(get_theme_mod('newp_site_titlecolor', '#919191'))."; }";
	endif;
	
	
	if ( get_theme_mod('newp_header_desccolor','#777') ) :
		echo "#masthead h2.site-description { color: ".esc_html(get_theme_mod('newp_header_desccolor','#777'))."; }";
	endif;
	
	if ( get_theme_mod('newp_hide_title_tagline') ) :
		echo "#masthead .site-branding #text-title-desc { display: none; }";
	endif;
	
	echo ".woocommerce ul.products li.product { width: 30.75%; }";
	

	echo "</style>";
}

add_action('wp_head', 'newp_custom_css_mods');