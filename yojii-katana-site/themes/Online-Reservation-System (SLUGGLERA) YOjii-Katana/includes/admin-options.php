<?php
/**
 * @package   jihadC_Framework
 * @author    YO Jii Had Saaduddin <saaduddinj@gmail.com>
 * @license   GPL-2.0+
 * @module	slugglera
 * @link      https://github.com/MrJii?tab=activity
 * @copyright 2014-2016 SOFTWARE7.0
 */
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */

 function jihadcframework_option_name() {

   $themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	return $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function jihadcframework_options() {

	// Background Defaults
	$page_background = array(
		'color' => '',
		'image' => '',
		'repeat' => 'no-repeat',
		'position' => 'top left',
		'attachment'=>'fixed' );

	$options      = array();
	$social_icons = array('fa fa-facebook'=>'facebook',
						  'fa fa-twitter'=>'twitter',
						  'fa fa-youtube'=>'youtube',
						  'fa fa-google-plus'=>'google plus',
						  'fa fa-flickr'=>'flickr',
						  'fa fa-linkedin'=>'linkedin',
						  'fa fa-pinterest'=>'pinterest',
						  'fa fa-tumblr'=>'tumblr',
						  'fa fa-digg'=>'digg',
						  'fa fa-rss'=>'rss',
						 
						  );
   // General
	$options[] = array(
		'name' => __('General Options', 'slugglera'),
		'type' => 'heading');

	
		
	$options[] = array(
		'name' => __('Favicon', 'slugglera'),
		'desc' => sprintf(__('An icon associated with a URL that is variously displayed, as in a browser\'s address bar or next to the site name in a bookmark list. Learn more about <a href="%s" target="_blank">Favicon</a>', 'slugglera'),esc_url("http://en.wikipedia.org/wiki/Favicon")),
		'id' => 'favicon',
		'type' => 'upload');
	
	$options[] = array(
		'name' => __('Global Color', 'slugglera'),
		'id' => 'global_color',
		'std' => '#19cbcf',
		'type' => 'color');
	
	$options[] = array(
		'name' => __('404 Page Content', 'slugglera'),
		'id' => 'page_404_content',
		'std' => '<i class="fa fa-frown-o"></i>
		<p><strong>OOPS!</strong> Can\'t find the page.</p>',
		'type' => 'editor');
		
	$options[] = array(
		'name' => __('Custom CSS', 'slugglera'),
		'desc' => __('The following css code will add to the header before the closing &lt;/head&gt; tag.', 'slugglera'),
		'id' => 'custom_css',
		'std' => '.top-banner-caption h1 {
	font-size: 8em;
}

.top-banner-caption h2 {
	font-size: 5em;
}

@media screen and (max-width: 1024px) {
	.top-banner-caption h1 {
		font-size: 6em;
	}
	.top-banner-caption h2 {
		font-size: 4em;
	}
}

@media screen and (max-width: 768px) {
	.top-banner-caption {
		margin-top: 100px;
	}
	.top-banner-caption h1 {
		font-size: 5em;
	}
	.top-banner-caption h2 {
		font-size: 3em;
	}
}

@media screen and (max-width: 640px) {
	.top-banner-caption h1 {
		font-size: 4em;
	}
	.top-banner-caption h2 {
		font-size: 2em;
	}
}
',
		'type' => 'textarea');

        // Home Page
	    $options[] = array(
		'name' => __('Home Page', 'slugglera'),
		'type' => 'heading');
		
		 $options[] = array(
		'name' => __('Enable Featured Homepage', 'slugglera'),
		'desc' => sprintf(__('Active featured homepage Layout. All sections in the homepage are <a href="%s">widget areas</a>.', 'slugglera'),admin_url("widgets.php")),
		'id' => 'enable_home_page',
		'std' => '0',
		'type' => 'checkbox');
		
		$options[] = array('name' => __('Banner', 'slugglera'),'id' => 'banner_title','type' => 'title');
		
		$options[] = array('name' => __('Image Banner', 'slugglera'),'id' => 'image_banner_group_start','type' => 'start_group','class'=>'group_close');
		
		$banner_image_background = array(
		'color' => '',
		'image' => get_template_directory_uri().'/images/banner.jpg',
		'repeat' => 'no-repeat',
		'position' => 'top left',
		'attachment'=>'fixed' );
		
		$options[] = array('name' => __('Background Image', 'slugglera'),'id' => 'banner_image', 'std' =>$banner_image_background  ,'desc'=>'','type' => 'background');
		$options[] = array('name' => __('Text', 'slugglera'),'id' => 'banner_text',	'std' => '<p style="text-align: center; color:#fff;">- '.__('WEB DEVELOPMENT - SOFTWARE - VIDEO CONTENT', 'slugglera').' -</p>
<h1 style="text-align: center; color:#fff;">&#9733;<span class="highlight">SLUG</span> '.__('GLERA', 'slugglera').' &#9733;</h1>
<h2 style="text-align: center; color:#fff;">'.__('Nice to Meet You', 'slugglera').'</h2>','type' => 'editor');
		$options[] = array('name' => __('Content Padding', 'slugglera'),'id' => 'banner_content_padding', 'std' => '140px 0','type' => 'text');
		$options[] = array('name' => '','id' => 'image_banner_group_end','type' => 'end_group');
		
		// video background options
		 $options[] = array('name' => __('YouTube Video Background Banner', 'slugglera'),'id' => 'youtube_video_options','type' => 'start_group','class'=>'group_close');
		
		$options[] = array('name' => __('Section Background Video', 'slugglera'),'std' => 'ab0TSkLe-E0','desc' => __('YouTube Video ID', 'slugglera'),'id' => 'section_background_video_0','type' => 'text');
		
		$options[] = array(	'name' => __('Video Controls', 'slugglera'),'desc' => __('Display video control buttons.', 'slugglera'),'id' => 'video_controls','std' => '1','class' => 'mini','options' => array('1'=>'yes','0'=>'no'),'type' => 'select');
		
		$options[] = array('name' => __('Text', 'slugglera'),'id' => 'video_banner_text',	'std' => '<p style="text-align: center; color:#fff;">- '.__('WEB DEVELOPMENT - SOFTWARE - VIDEO CONTENT', 'slugglera').' -</p>
<h1 style="text-align: center; color:#fff;">&#9733;<span class="highlight">SLUG</span> '.__('GLERA', 'slugglera').' &#9733;</h1>
<h2 style="text-align: center; color:#fff;">'.__('Nice to Meet You', 'slugglera').'</h2>','type' => 'editor');
		
		$options[] = array('name' => __('Content Padding', 'slugglera'),'id' => 'video_banner_content_padding', 'std' => '140px 0','type' => 'text');
		$options[] = array('name' => __('Poster', 'slugglera'),'id' => 'vedio_banner_image', 'std' =>''  ,'desc'=>'','type' => 'upload');
		
		$options[] = array('name' => '','id' => 'youtube_video_options_end','type' => 'end_group');
		// end video background options
		
	
			
	    $options[] = array(
		"name" => __('Home Page Banner', 'slugglera'),
		"id" => "home_banner_type",
		"std" => "1",
		"type" => "select",
		"class" => "mini",
		"options" => array('0'=>__('No Banner', 'slugglera'),
						   '1'=>__('Image', 'slugglera'),
						   '2'=>__('Video Background', 'slugglera')
           ) );
		
		 

		
		 $options[] = array(
		'name' => __('NOTE:', 'slugglera'),
		'desc' => sprintf(__('All sections in the homepage are widgets, so, go to Appearance-><a href="%s">Widgets</a> to set the sections content.', 'slugglera'),admin_url("widgets.php")),
		'type' => 'info');
		
		$options[] = array(
		'name' => __('Home Page Sections', 'slugglera'),
		'id' => 'home_page_sections',
		'std' => '{
  "section-widget-area-name":["'.__("Home Page Section","slugglera").' 1","'.__("Home Page Section","slugglera").' 2","'.__("Home Page Section","slugglera").' 3","'.__("Home Page Section","slugglera").' 4","'.__("Home Page Section","slugglera").' 5","'.__("Home Page Section","slugglera").' 6"],
  "section-widget-id":["home-page-section-0","home-page-section-1","home-page-section-2","home-page-slugglera-3","home-page-section-4","home-page-section-5"],
  "list-item-color":["","#eee","","","",""],
  "list-item-image":["","","","","",""],
  "list-item-repeat":["","","","","",""],
  "list-item-position":["","","","","",""],
  "list-item-attachment":["","","","","",""],
  "widget-area-padding":["50","50","50","50","50","50"],
  "widget-area-layout":["boxed","full","full","boxed","full","boxed"],
  "widget-area-column":["4","1","1","1","1","1"],
  "widget-area-column-item":{"home-page-section-0":["3","3","3","3"],
  "home-page-section-1":["12"],"home-page-section-2":["12"],
  "home-page-section-3":["12"],"home-page-section-4":["12"],
  "home-page-section-5":["12"]}}',
		'type' => 'widget-area');
		
		
		// HEADER
		 $options[] = array(
		'name' => __('Header', 'slugglera'),
		'type' => 'heading');
		 
		$options[] = array(
		'name' => __('Upload Logo', 'slugglera'),
		'id' => 'logo',
		'std' => '',
		'type' => 'upload');
		
		
		// FOOTER
	    $options[] = array(
		'name' => __('Footer', 'slugglera'),
		'type' => 'heading');
	
        $options[] = array(
		'name' => __('Enable Footer Widget Area', 'slugglera'),
		'desc' => '',
		'id' => 'enable_footer_widget_area',
		'std' => '0',
		'type' => 'checkbox');
		
		
		
		

		
		//END HOME PAGE SLIDER
		
	return $options;
}

