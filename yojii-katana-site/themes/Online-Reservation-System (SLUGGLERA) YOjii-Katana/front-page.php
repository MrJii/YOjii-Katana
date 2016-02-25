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
* The front page template
*
*/
get_header();
global $enable_home_page;
//if ( 'posts' == get_option( 'show_on_front' ) ) {
 //   get_template_part("home");
//} else {
    if( $enable_home_page == "1"){
	get_template_part( 'featured-content' );
	}
	else{
	 get_template_part("home");
	 }
  // }
 
 get_footer();