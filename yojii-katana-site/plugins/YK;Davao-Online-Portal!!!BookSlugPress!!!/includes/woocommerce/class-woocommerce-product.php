<?php
/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/


    if (!class_exists('DOPBSPWooCommerceProduct')){
        class DOPBSPWooCommerceProduct extends DOPBSPWooCommerce{
            /*
             * Constructor.
             */
            function DOPBSPWooCommerceProduct(){
                /*
                 * Add calendar in product summary.
                 */
                add_filter('woocommerce_single_product_summary', array(&$this, 'summary'), 25);
                
                /*
                 * Add calendar in product tab.
                 */
                add_filter('woocommerce_product_tabs', array(&$this, 'tab'));
                
                /*
                 * Delete price.
                 */
                add_filter('woocommerce_variable_price_html', array(&$this, 'deletePrice'), 10);
                add_filter('woocommerce_grouped_price_html', array(&$this, 'deletePrice'), 10);
                add_filter('woocommerce_variable_sale_price_html', array(&$this, 'deletePrice'), 10);
            }
            
            /*
             * Add booking calendar in product summary section.
             * 
             * @return sidebar HTML or calendar shortcode
             */
            function summary(){
                global $post;
	
                $dopbsp_woocommerce_options = array('calendar' => get_post_meta($post->ID, 'dopbsp_woocommerce_calendar', true),
                                                    'language' => get_post_meta($post->ID, 'dopbsp_woocommerce_language', true) == '' ? 'en':get_post_meta($post->ID, 'dopbsp_woocommerce_language', true),
                                                    'position' => get_post_meta($post->ID, 'dopbsp_woocommerce_position', true) == '' ? 'summary':get_post_meta($post->ID, 'dopbsp_woocommerce_position', true),
                                                    'add_to_cart' => get_post_meta($post->ID, 'dopbsp_woocommerce_add_to_cart', true) == '' ? 'false':get_post_meta($post->ID, 'dopbsp_woocommerce_add_to_cart', true));
                    
                if ($dopbsp_woocommerce_options['calendar'] != '' 
                        && $dopbsp_woocommerce_options['calendar'] != '0'){
                    /*
                     * Add all calendar.
                     */
                    if ($dopbsp_woocommerce_options['position'] == 'summary'){
                        echo do_shortcode('[dopbsp id='.$dopbsp_woocommerce_options['calendar'].' lang='.$dopbsp_woocommerce_options['language'].' woocommerce=true woocommerce_product_id='.$post->ID.' woocommerce_position='.$dopbsp_woocommerce_options['position'].' woocommerce_add_to_cart='.$dopbsp_woocommerce_options['add_to_cart'].']');
                    }
                
                    /*
                     * Add only sidebar.
                     */    
                    if ($dopbsp_woocommerce_options['position'] == 'summary-tabs'){
                        echo '<div class="DOPBSPCalendar-sidebar" id="DOPBSPCalendar-outer-sidebar'.$dopbsp_woocommerce_options['calendar'].'"></div>';
                    }
                }
            }
            
            /*
             * Add booking calendar in product tab section.
             * 
             * @return tab object
             */
            function tab(){
		global $post;
                global $DOPBSP;
                
		$tab = array();
	
                $dopbsp_woocommerce_options = array('calendar' => get_post_meta($post->ID, 'dopbsp_woocommerce_calendar', true),
                                                    'language' => get_post_meta($post->ID, 'dopbsp_woocommerce_language', true) == '' ? 'en':get_post_meta($post->ID, 'dopbsp_woocommerce_language', true),
                                                    'position' => get_post_meta($post->ID, 'dopbsp_woocommerce_position', true) == '' ? 'summary':get_post_meta($post->ID, 'dopbsp_woocommerce_position', true),
                                                    'add_to_cart' => get_post_meta($post->ID, 'dopbsp_woocommerce_add_to_cart', true) == '' ? 'false':get_post_meta($post->ID, 'dopbsp_woocommerce_add_to_cart', true));
                
                if ($dopbsp_woocommerce_options['calendar'] != '' 
                        && $dopbsp_woocommerce_options['calendar'] != '0' 
                        && ($dopbsp_woocommerce_options['position'] == 'tabs' 
                                || $dopbsp_woocommerce_options['position'] == 'summary-tabs')){
                    $DOPBSP->classes->translation->set($dopbsp_woocommerce_options['language'],
                                                                  false);
                    
                    $tab['booking-system'] = array('title' => $DOPBSP->text('WOOCOMMERCE_TABS'),
                                                   'priority' => 1,
                                                   'callback' => array($this, 'tabContent'));
                    return $tab;
                }
            }
            
            /*
             * Add booking calendar in product tab section.
             * 
             * @return calendar shortcode
             */
            function tabContent(){
                global $post;
	
                $dopbsp_woocommerce_options = array('calendar' => get_post_meta($post->ID, 'dopbsp_woocommerce_calendar', true),
                                                    'language' => get_post_meta($post->ID, 'dopbsp_woocommerce_language', true) == '' ? 'en':get_post_meta($post->ID, 'dopbsp_woocommerce_language', true),
                                                    'position' => get_post_meta($post->ID, 'dopbsp_woocommerce_position', true) == '' ? 'summary':get_post_meta($post->ID, 'dopbsp_woocommerce_position', true),
                                                    'add_to_cart' => get_post_meta($post->ID, 'dopbsp_woocommerce_add_to_cart', true) == '' ? 'false':get_post_meta($post->ID, 'dopbsp_woocommerce_add_to_cart', true));
                    
                echo do_shortcode('[dopbsp id='.$dopbsp_woocommerce_options['calendar'].' lang='.$dopbsp_woocommerce_options['language'].' woocommerce=true woocommerce_product_id='.$post->ID.' woocommerce_position='.$dopbsp_woocommerce_options['position'].' woocommerce_add_to_cart='.$dopbsp_woocommerce_options['add_to_cart'].']');
            }
            
            
            /*
             * Delete the price displayed on product page by default.
             * 
             * @param price (integer): current price
             * 
             * @return false
             */
            function deletePrice($price){
                return false;
            }
        }
    }