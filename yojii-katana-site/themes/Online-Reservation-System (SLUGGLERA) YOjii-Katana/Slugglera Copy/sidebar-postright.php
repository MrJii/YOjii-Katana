<?php
/**
 * @package   jihadC_Framework
 * @author    YO Jii Had Saaduddin <saaduddinj@gmail.com>
 * @license   GPL-2.0+
 * @module	slugglera
 * @link      https://github.com/MrJii?tab=activity
 * @copyright 2014-2016 SOFTWARE7.0
 */
 if( is_active_sidebar( 'displayed_everywhere' ) ) {
	 dynamic_sidebar('displayed_everywhere');
	 }
	 if ( is_active_sidebar( 'page_right_sidebar' ) ){
	 dynamic_sidebar( 'page_right_sidebar' );
	 }
	 elseif( is_active_sidebar( 'default_sidebar' ) ) {
	 dynamic_sidebar('default_sidebar');
	 }