<?php
/**
 * newp Theme Customizer
 *
 * @package newp
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function newp_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	
	
	//Logo Settings
	$wp_customize->add_section( 'title_tagline' , array(
	    'title'      => __( 'Title, Tagline & Logo', 'newp' ),
	    'priority'   => 30,
	) );
	
	
	//Renaming colors section
	$wp_customize->add_section( 'colors' , array(
	    'title'      => __( 'Theme Skin & Colors', 'newp' ),
	    'priority'   => 30,
	) );
	
	//Replace Header Text Color with, separate colors for Title and Description
	//Override newp_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_setting('header_textcolor');
	$wp_customize->add_setting('newp_site_titlecolor', array(
	    'default'     => '#919191',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'newp_site_titlecolor', array(
			'label' => __('Site Title Color','newp'),
			'section' => 'colors',
			'settings' => 'newp_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('newp_header_desccolor', array(
	    'default'     => '#777',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'newp_header_desccolor', array(
			'label' => __('Site Tagline Color','newp'),
			'section' => 'colors',
			'settings' => 'newp_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	
	//Settings For Logo Area
	
	$wp_customize->add_setting(
		'newp_hide_title_tagline',
		array( 'sanitize_callback' => 'newp_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'newp_hide_title_tagline', array(
		    'settings' => 'newp_hide_title_tagline',
		    'label'    => __( 'Hide Title and Tagline.', 'newp' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'newp_branding_below_logo',
		array( 'sanitize_callback' => 'newp_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'newp_branding_below_logo', array(
		    'settings' => 'newp_branding_below_logo',
		    'label'    => __( 'Display Site Title and Tagline Below the Logo.', 'newp' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		    'active_callback' => 'newp_title_visible'
		)
	);
	
	function newp_title_visible( $control ) {
		$option = $control->manager->get_setting('newp_hide_title_tagline');
	    return $option->value() == false ;
	}
	

	
	// CREATE THE FCA PANEL
	$wp_customize->add_panel( 'newp_fca_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Featured Content Areas','newp'),
	    'description'    => '',
	) );
	
	
	//FEATURED AREA 1
	$wp_customize->add_section(
	    'newp_fc_boxes',
	    array(
	        'title'     => __('Featured Area 1','newp'),
	        'priority'  => 10,
	        'panel'     => 'newp_fca_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'newp_box_enable',
		array( 'sanitize_callback' => 'newp_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'newp_box_enable', array(
		    'settings' => 'newp_box_enable',
		    'label'    => __( 'Enable Featured Area 1.', 'newp' ),
		    'section'  => 'newp_fc_boxes',
		    'type'     => 'checkbox',
		)
	);
	
 
	$wp_customize->add_setting(
		'newp_box_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'newp_box_title', array(
		    'settings' => 'newp_box_title',
		    'label'    => __( 'Title for the Boxes','newp' ),
		    'section'  => 'newp_fc_boxes',
		    'type'     => 'text',
		)
	);
 
 	$wp_customize->add_setting(
	    'newp_box_cat',
	    array( 'sanitize_callback' => 'newp_sanitize_category' )
	);
	
	$wp_customize->add_control(
	    new Newp_WP_Customize_Category_Control(
	        $wp_customize,
	        'newp_box_cat',
	        array(
	            'label'    => __('Category For Square Boxes.','newp'),
	            'settings' => 'newp_box_cat',
	            'section'  => 'newp_fc_boxes'
	        )
	    )
	);
	
	
	// Layout and Design
	$wp_customize->add_panel( 'newp_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','newp'),
	) );
	
	$wp_customize->add_section(
	    'newp_design_options',
	    array(
	        'title'     => __('Blog Layout','newp'),
	        'priority'  => 0,
	        'panel'     => 'newp_design_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'newp_blog_layout',
		array( 'sanitize_callback' => 'newp_sanitize_blog_layout' )
	);
	
	function newp_sanitize_blog_layout( $input ) {
		if ( in_array($input, array('grid','newp') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'newp_blog_layout',array(
				'label' => __('Select Layout','newp'),
				'settings' => 'newp_blog_layout',
				'section'  => 'newp_design_options',
				'type' => 'select',
				'default' => 'newp',
				'choices' => array(
						'grid' => __('Basic Blog Layout','newp'),
						'newp' => __('Newp Default Layout','newp'),
					)
			)
	);
	
	$wp_customize->add_section(
	    'newp_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','newp'),
	        'priority'  => 0,
	        'panel'     => 'newp_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'newp_disable_sidebar',
		array( 'sanitize_callback' => 'newp_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'newp_disable_sidebar', array(
		    'settings' => 'newp_disable_sidebar',
		    'label'    => __( 'Disable Sidebar Everywhere.','newp' ),
		    'section'  => 'newp_sidebar_options',
		    'type'     => 'checkbox',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'newp_disable_sidebar_home',
		array( 'sanitize_callback' => 'newp_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'newp_disable_sidebar_home', array(
		    'settings' => 'newp_disable_sidebar_home',
		    'label'    => __( 'Disable Sidebar on Home/Blog.','newp' ),
		    'section'  => 'newp_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'newp_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'newp_disable_sidebar_front',
		array( 'sanitize_callback' => 'newp_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'newp_disable_sidebar_front', array(
		    'settings' => 'newp_disable_sidebar_front',
		    'label'    => __( 'Disable Sidebar on Front Page.','newp' ),
		    'section'  => 'newp_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'newp_show_sidebar_options',
		    'default'  => false
		)
	);
	
	
	$wp_customize->add_setting(
		'newp_sidebar_width',
		array(
			'default' => 3,
		    'sanitize_callback' => 'newp_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'newp_sidebar_width', array(
		    'settings' => 'newp_sidebar_width',
		    'label'    => __( 'Sidebar Width','newp' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','newp'),
		    'section'  => 'newp_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'newp_show_sidebar_options',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 5,
		        'step'  => 1,
		        'class' => 'sidebar-width-range',
		        'style' => 'color: #0a0',
		    ),
		)
	);
	
	/* Active Callback Function */
	function newp_show_sidebar_options($control) {
	   
	    $option = $control->manager->get_setting('newp_disable_sidebar');
	    return $option->value() == false ;
	    
	}
	
	$wp_customize-> add_section(
    'newp_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','newp'),
    	'description'	=> __('Enter your Own Copyright Text.','newp'),
    	'priority'		=> 11,
    	'panel'			=> 'newp_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'newp_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'newp_footer_text',
	        array(
	            'section' => 'newp_custom_footer',
	            'settings' => 'newp_footer_text',
	            'type' => 'text'
	        )
	);	
	
	$wp_customize->add_section(
	    'newp_typo_options',
	    array(
	        'title'     => __('Google Web Fonts','newp'),
	        'priority'  => 41,
	    )
	);
	
	$font_array = array('Montserrat','Roboto Condensed','Open Sans','Oswald','Slabo','Source Sans Pro');
	$fonts = array_combine($font_array, $font_array);
	
	$wp_customize->add_setting(
		'newp_title_font',
		array(
			'default'=> 'Montserrat',
			'sanitize_callback' => 'newp_sanitize_gfont' 
			)
	);
	
	function newp_sanitize_gfont( $input ) {
		if ( in_array($input, array('Montserrat','Roboto Condensed','Open Sans','Oswald','Slabo','Source Sans Pro') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
		'newp_title_font',array(
				'label' => __('Title','newp'),
				'settings' => 'newp_title_font',
				'section'  => 'newp_typo_options',
				'type' => 'select',
				'choices' => $fonts,
			)
	);
	
	$wp_customize->add_setting(
		'newp_body_font',
			array(	'default'=> 'Source Sans Pro',
					'sanitize_callback' => 'newp_sanitize_gfont' )
	);
	
	$wp_customize->add_control(
		'newp_body_font',array(
				'label' => __('Body','newp'),
				'settings' => 'newp_body_font',
				'section'  => 'newp_typo_options',
				'type' => 'select',
				'choices' => $fonts
			)
	);
	
	
	//Skin	
	$wp_customize->add_setting(
		'newp_skin',
		array(
			'default'=> 'default',
			'sanitize_callback' => 'newp_sanitize_skin' 
			)
	);
	
	$skins = array( 'default' => __('Default(Dark)','newp'),
					'brown' =>  __('Light Brown','newp'),
					'green' => __('Green','newp'),
					'darkbrown' => __('Dark Brown','newp') );
	
	$wp_customize->add_control(
		'newp_skin',array(
				'label' => __('Choose Skin','newp'),
				'description' => __('Default Background Colors for these Skins are: <br />Default: #2f2f2f <br/>Light Brown: #541515 <br/>Green: #4ba851 <br/> Dark Brown: #473432','newp'),				
				'settings' => 'newp_skin',
				'section'  => 'colors',
				'type' => 'select',
				'choices' => $skins,
				'priority' => 1
			)
	);
	
	function newp_sanitize_skin( $input ) {
		if ( in_array($input, array('default','darkbrown','brown','green','grayscale') ) )
			return $input;
		else
			return '';
	}
	
	// Social Icons
	$wp_customize->add_section('newp_social_section', array(
			'title' => __('Social Icons','newp'),
			'priority' => 44 ,
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','newp'),
					'facebook' => __('Facebook','newp'),
					'twitter' => __('Twitter','newp'),
					'google-plus' => __('Google Plus','newp'),
					'instagram' => __('Instagram','newp'),
					'rss' => __('RSS Feeds','newp'),
					'vine' => __('Vine','newp'),
					'vimeo-square' => __('Vimeo','newp'),
					'youtube' => __('Youtube','newp'),
					'flickr' => __('Flickr','newp'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'newp_social_'.$x, array(
				'sanitize_callback' => 'newp_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'newp_social_'.$x, array(
					'settings' => 'newp_social_'.$x,
					'label' => __('Icon ','newp').$x,
					'section' => 'newp_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'newp_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'newp_social_url'.$x, array(
					'settings' => 'newp_social_url'.$x,
					'description' => __('Icon ','newp').$x.__(' Url','newp'),
					'section' => 'newp_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function newp_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube',
					'flickr'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}	
	
	
	/* Sanitization Functions Common to Multiple Settings go Here, Specific Sanitization Functions are defined along with add_setting() */
	function newp_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	
	function newp_sanitize_positive_number( $input ) {
		if ( ($input >= 0) && is_numeric($input) )
			return $input;
		else
			return '';	
	}
	
	function newp_sanitize_category( $input ) {
		if ( term_exists(get_cat_name( $input ), 'category') )
			return $input;
		else 
			return '';	
	}
		
}
add_action( 'customize_register', 'newp_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function newp_customize_preview_js() {
	wp_enqueue_script( 'newp_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'newp_customize_preview_js' );
