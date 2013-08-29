<?php

if (!function_exists('comicpress_sandbox_body_class')) {
	add_action('customize_register', 'comicpress_customize_register');
	add_action('customize_preview_init', 'comicpress_customize_preview_js');
	add_action('wp_head', 'comicpress_customize_wp_head');
	add_filter('body_class', 'comicpress_customize_body_class');
}

function comicpress_customize_body_class($classes = array()){
	$classes[] = 'scheme-'.get_theme_mod('comicpress-customize-select-scheme', 'none');
	if (get_theme_mod('comicpress-customize-checkbox-rounded', false)) $classes[] = 'rounded-posts';
	if (function_exists('ceo_pluginfo') && get_theme_mod('comicpress-customize-comic-in-column', false)) $classes[] = 'cnc';
	return $classes;
}

function comicpress_customize_register( $wp_customize ) {
	$wp_customize->remove_section('colors');
	$wp_customize->remove_section('title_tagline');
	$wp_customize->add_section('comicpress-scheme-options' , array('title' => __('Options','comicpress'), 'priority' => 10));	
//	$wp_customize->add_section('comicpress-background-colors' , array('title' => __('Background Colors','comicpress')));
	$wp_customize->add_section('colors' , array('title' => __('Background Colors','comicpress'), 'description' => __('some description here','comicpress'), 'priority' => 20));
	$wp_customize->add_section('comicpress-text-colors' , array('title' => __('Text Colors','comicpress'), 'priority' => 30));	
	$wp_customize->add_section('comicpress-link-colors' , array('title' => __('Link Colors','comicpress'), 'priority' => 40));
	$wp_customize->add_section('comicpress-logo-options', array('title' => __('Logo','comicpress'), 'priority' => 50));
	$css_array = array(
			// Background Colors
			array('slug' => 'page_background', 'label' => '#page', 'section' => 'colors', 'priority' => 1),
			array('slug' => 'header_background', 'label' => '#header', 'section' => 'colors'),
			array('slug' => 'menubar_background', 'label' => '#menubar-wrapper', 'section' => 'colors'),
			array('slug' => 'menubar_submenu_background', 'label' => '.menu ul li ul li a', 'section' => 'colors'),
			array('slug' => 'menubar_mouseover_background', 'label' => '.menu ul li a:hover', 'section' => 'colors'),
			array('slug' => 'breadcrumb_background', 'label' => '#breadcrumb-wrapper', 'section' => 'colors'),
			array('slug' => 'content_wrapper_background', 'label' => '#content-wrapper', 'section' => 'colors'),
			array('slug' => 'subcontent_wrapper_background', 'label' => '#subcontent-wrapper', 'section' => 'colors'),
			array('slug' => 'narrowcolumn_widecolumn_background', 'label' => '.narrowcolumn/.widecolumn', 'section' => 'colors'),
			array('slug' => 'post_page_navigation_background', 'label' => '.uentry, #comment-wrapper, #wp-paginav', 'section' => 'colors'),
			array('slug' => 'post_info_background', 'label' => '.post-info', 'section' => 'colors'),
			array('slug' => 'comment_background', 'label' => '.comment, #comment-wrapper #wp-paginav', 'section' => 'colors'),
			array('slug' => 'comment_meta_data_background', 'label' => '.comment-meta-data', 'section' => 'colors'),
			array('slug' => 'bypostauthor_background', 'label' => '.bypostauthor', 'section' => 'colors'),
			array('slug' => 'bypostauthor_meta_data_background', 'label' => '.bypostauthor .comment-meta-data', 'section' => 'colors'),
			array('slug' => 'footer_background', 'label' => '#footer', 'section' => 'colors'),
			// Text Colors 
			array('slug' => 'content_text_color', 'label' => 'body', 'section' => 'comicpress-text-colors'),
			array('slug' => 'header_textcolor', 'label' => '#header', 'section' => 'comicpress-text-colors'),
			array('slug' => 'breadcrumb_textcolor', 'label' => '#breadcrumb-wrapper', 'section' => 'comicpress-text-colors'),
			array('slug' => 'lrsidebar_widgettitle_textcolor', 'label' => 'h2.widget-title', 'section' => 'comicpress-text-colors'),
			array('slug' => 'lrsidebar_textcolor', 'label' => '.sidebar', 'section' => 'comicpress-text-colors'),
			array('slug' => 'posttitle_textcolor', 'label' => 'h2.post-title', 'section' => 'comicpress-text-colors'),
			array('slug' => 'pagetitle_textcolor', 'label' => 'h2.page-title', 'section' => 'comicpress-text-colors'),
			array('slug' => 'postinfo_textcolor', 'label' => '.post-info', 'section' => 'comicpress-text-colors'),
			array('slug' => 'post_page_navigation_textcolor', 'label' => '.uentry, #comment-wrapper, #wp-paginav', 'section' => 'comicpress-text-colors'),
			array('slug' => 'footer_copyright_textcolor', 'label' => '.footer-text', 'section' => 'comicpress-text-colors'),
			// Link Colors
			array('slug' => 'content_link_color', 'label' => 'body', 'section' => 'comicpress-link-colors'),
			array('slug' => 'header_title_acolor', 'label' => '#header h1 a', 'section' => 'comicpress-link-colors'),
			array('slug' => 'header_title_hcolor', 'label' => '#header h1 a:hover', 'section' => 'comicpress-link-colors'),
			array('slug' => 'menubar_top_acolor', 'label' => '.menu ul li a:link, .menu ul li a:visited, .mininav-prev a, .mininav-next a', 'section' => 'comicpress-link-colors'),
			array('slug' => 'menubar_hcolor', 'label' => '.menu ul li a:hover, .menu ul li a.selected, .menu ul li ul li a:hover', 'section' => 'comicpress-link-colors'),
			array('slug' => 'menubar_sub_acolor', 'label' => '.menu ul li ul li a:link, .menu ul li ul li a:visited', 'section' => 'comicpress-link-colors'),
			array('slug' => 'breadcrumb_acolor', 'label' => '.breadcrumbs a', 'section' => 'comicpress-link-colors'),
			array('slug' => 'breadcrumb_hcolor', 'label' => '.breadcrumbs a:hover', 'section' => 'comicpress-link-colors'),
			array('slug' => 'sidebar_acolor', 'label' => '.sidebar .widget a', 'section' => 'comicpress-link-colors'),
			array('slug' => 'sidebar_hcolor', 'label' => '.sidebar .widget a:hover', 'section' => 'comicpress-link-colors'),
			array('slug' => 'postpagenav_acolor', 'label' => '.entry a, .blognav a, #paginav a', 'section' => 'comicpress-link-colors'),
			array('slug' => 'postpagenav_hcolor', 'label' => '.entry a:hover, .blognav a:hover, #paginav a:hover', 'section' => 'comicpress-link-colors'),
			array('slug' => 'footer_copyright_acolor', 'label' => '.footer-text a', 'section' => 'comicpress-link-colors'),
			array('slug' => 'footer_copyright_hcolor', 'label' => '.footer-text a:hover', 'section' => 'comicpress-link-colors'),
			);
	// Additions for CE
	if (function_exists('ceo_pluginfo')) {
		$css_array[] = array('slug' => 'comic_wrap_background', 'label' => '#comic-wrap', 'section' => 'colors');
		$css_array[] = array('slug' => 'comic_wrap_textcolor', 'label' => '#comic-wrap', 'section' => 'comicpress-text-colors');
		$css_array[] = array('slug' => 'comic_nav_background', 'label' => 'table#comic-nav-wrapper', 'section' => 'colors');
	}
	$priority_value = 1;
	foreach ($css_array as $setinfo) {
		$setinfo_register_name = 'comicpress-customize['.$setinfo['slug'].']';
		$wp_customize->add_setting($setinfo_register_name, array('default' => false));
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$setinfo['slug'], 
					array('label' => $setinfo['label'], 'section' => $setinfo['section'], 'settings' => $setinfo_register_name, 'priority' => $priority_value)
					)
				);
		$priority_value++;
	}
	
	$wp_customize->add_setting( 'comicpress-customize-select-scheme', array('default' => 'none'));
	$wp_customize->add_control( 'comicpress-customize-select-scheme-control' , array(
				'label' => __('Choose a default scheme.','comicpress'),
				'settings' => 'comicpress-customize-select-scheme',
				'section' => 'comicpress-scheme-options',
				'type' => 'select',
				'choices' => array(
					'none' => 'No Scheme',
					'boxed' => 'Boxed',
					'sandy' => 'Sandy',
					'mecha' => 'Mecha',
					'ceasel' => 'CEasel'
					)
				)); 
	
	$wp_customize->add_setting( 'comicpress-customize-checkbox-rounded', array('default' => false));
	$wp_customize->add_control( 'comicpress-customize-checkbox-rounded-control', array(
				'settings' => 'comicpress-customize-checkbox-rounded',
				'label'    => __( 'Rounded corners on Post/Page Navigation Sections','comicpress'),
				'section'  => 'comicpress-scheme-options',
				'type'     => 'checkbox'
				));
				
	$wp_customize->add_setting( 'comicpress-customize[logo]', array('default' => ''));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'comicpress-customize-logo-image', array('label' => __( 'Logo', 'themeslug' ), 'section'  => 'comicpress-logo-options', 'settings' => 'comicpress-customize[logo]')));

	if (function_exists('ceo_pluginfo')) {
		$wp_customize->add_setting( 'comicpress-customize-comic-in-column', array('default' => false));
		$wp_customize->add_control( 'comicpress-customize-comic-in-column-control', array(
					'settings' => 'comicpress-customize-comic-in-column',
					'label'    => __('Put the Comic in the content column?','comicpress'),
					'section'  => 'comicpress-scheme-options',
					'type'     => 'checkbox'
					));
	}
}

function comicpress_customize_preview_js() {
	//	wp_enqueue_script( 'comicpress-boxed-customizer', get_stylesheet_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}

function comicpress_customize_wp_head() {
	$important = '';
	$settings_array = array(
			// background colors
			array('slug' => 'page_background', 'element' => '#page', 'style' => 'background-color', 'default' => '', 'important' => false),
			array('slug' => 'header_background', 'element' => '#header', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'menubar_background', 'element' => '#menubar-wrapper', 'style' => 'background-color', 'default' => '#000000',  'important' => false),
			array('slug' => 'menubar_submenu_background', 'element' => '.menu ul li ul li a', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'menubar_mouseover_background', 'element' => '.menu ul li a:hover, .menu ul li a.selected', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'breadcrumb_background', 'element' => '#breadcrumb-wrapper', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'content_wrapper_background', 'element' => '#content-wrapper', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'subcontent_wrapper_background', 'element' => '#subcontent-wrapper', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'narrowcolumn_widecolumn_background', 'element' => '.narrowcolumn, .widecolumn', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'post_page_navigation_background', 'element' => '.uentry, #comment-wrapper, #wp-paginav, .blognav', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'post_info_background', 'element' => '.post-info', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'comment_background', 'element' => '.comment, #comment-wrapper #wp-paginav', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'comment_meta_data_background', 'element' => '.comment-meta-data', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'bypostauthor_background', 'element' => '.bypostauthor', 'style' => 'background-color', 'default' => '',  'important' => true),
			array('slug' => 'bypostauthor_meta_data_background', 'element' => '.bypostauthor .comment-meta-data', 'style' => 'background-color', 'default' => '',  'important' => false),
			array('slug' => 'footer_background', 'element' => '#footer', 'style' => 'background-color', 'default' => '',  'important' => false),
			// text colors
			array('slug' => 'content_text_color', 'element' => 'body', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'header_textcolor', 'element' => '#header', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'breadcrumb_textcolor', 'element' => '#breadcrumb-wrapper', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'lrsidebar_widgettitle_textcolor', 'element' => 'h2.widget-title', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'lrsidebar_textcolor', 'element' => '.sidebar', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'posttitle_textcolor', 'element' => 'h2.post-title', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'pagetitle_textcolor', 'element' => 'h2.page-title', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'postinfo_textcolor', 'element' => '.post-info', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'post_page_navigation_textcolor', 'element' => '.uentry, #comment-wrapper, #wp-paginav', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'footer_copyright_textcolor', 'element' => '.footer-text', 'style' => 'color', 'default' => '',  'important' => false),
			// link colors
			array('slug' => 'content_link_color', 'element' => 'a:link, a:visited', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'header_title_acolor', 'element' => '#header h1 a:link, #header h1 a:visited', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'header_title_hcolor', 'element' => '#header h1 a:hover', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'menubar_top_acolor', 'element' => '.menu ul li a:link, .menu ul li a:visited, .mininav-prev a, .mininav-next a', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'menubar_hcolor', 'element' => '.menu ul li a:hover, .menu ul li a.selected, .menu ul li ul li a:hover', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'menubar_sub_acolor', 'element' => '.menu ul li ul li a:link, .menu ul li ul li a:visited', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'breadcrumb_acolor', 'element' => '.breadcrumbs a', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'breadcrumb_hcolor', 'element' => '.breadcrumbs a:hover', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'sidebar_acolor', 'element' => '.sidebar .widget a', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'sidebar_hcolor', 'element' => '.sidebar .widget a:hover', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'postpagenav_acolor', 'element' => '.entry a, .blognav a, #paginav a', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'postpagenav_hcolor', 'element' => '.entry a:hover, .blognav a:hover, #paginav a:hover', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'footer_copyright_acolor', 'element' => '.footer-text a', 'style' => 'color', 'default' => '',  'important' => false),
			array('slug' => 'footer_copyright_hcolor', 'element' => '.footer-text a:hover, .blognav a:hover, #paginav a:hover', 'style' => 'color', 'default' => '',  'important' => false),
			);
	if (function_exists('ceo_pluginfo')) {
		$settings_array[] = array('slug' => 'comic_wrap_background', 'element' => '#comic-wrap', 'style' => 'background-color', 'default' => '',  'important' => true);
		$settings_array[] = array('slug' => 'comic_wrap_textcolor', 'element' => '#comic-wrap', 'style' => 'color', 'default' => '',  'important' => true);
		$settings_array[] = array('slug' => 'comic_nav_background', 'element' => 'table#comic-nav-wrapper', 'style' => 'background-color', 'default' => '',  'important' => true);
	}
	$output = '';
	$style_output = '';
	foreach ($settings_array as $setting) {
		$customize = get_theme_mod('comicpress-customize');
		if (empty($customize)) return;
		if (!empty($customize) && isset($customize[$setting['slug']])) $content = $customize[$setting['slug']];
		if (empty($content)) $content = $setting['default'];
		$important = ($setting['important']) ? '!important' : '';
		if (!empty($content)) $style_output .= $setting['element'].' { '.$setting['style'].': '.$content.$important.'; } ';
	}
	if (!empty($style_output)) {
		$output = '<style type="text/css">'."\r\n";
		$output .= $style_output;
		$output .= "\r\n</style>\r\n";
		echo $output;
	}
}