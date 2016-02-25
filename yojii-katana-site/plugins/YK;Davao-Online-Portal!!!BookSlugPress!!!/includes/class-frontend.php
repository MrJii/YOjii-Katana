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

    if (!class_exists('DOPBSPFrontEnd')){
        class DOPBSPFrontEnd{
            /*
             * Constructor
             */
            function DOPBSPFrontEnd(){
                add_action('wp_enqueue_scripts', array(&$this, 'addStyles'));
                add_action('wp_enqueue_scripts', array(&$this, 'addScripts'));
                
                add_shortcode('dopbsp', array(&$this, 'shortcode'));
            }
            
            /*
             * Add plugin's CSS files.
             */
            function addStyles(){
                global $DOPBSP;
                
                /*
                 * Register styles.
                 */
                wp_register_style('DOPBSP-css-dopselect', $DOPBSP->paths->url.'libraries/css/jquery.dop.Select.css');

                /*
                 * Enqueue styles.
                 */
                wp_enqueue_style('DOPBSP-css-dopselect');
            }
            
            /*
             * Add plugin's JavaScript files.
             */
            function addScripts(){
                global $DOPBSP;
                
                wp_register_script('DOP-js-jquery-dopselect', $DOPBSP->paths->url.'libraries/js/jquery.dop.Select.js', array('jquery'), false, true);
                
                wp_register_script('DOPBSP-js-frontend-calendar', $DOPBSP->paths->url.'assets/js/jquery.dop.frontend.BSPCalendar.js', array('jquery'), false, true);
                wp_register_script('DOPBSP-js-frontend-search', $DOPBSP->paths->url.'assets/js/jquery.dop.frontend.BSPSearch.js', array('jquery'), false, true);

                /*
                 *  Enqueue JavaScript.
                 */
                if (!wp_script_is('jquery', 'queue')){
                    wp_enqueue_script('jquery');
                }
                
                if (!wp_script_is('jquery-ui-datepicker', 'queue')){
                    wp_enqueue_script('jquery-ui-datepicker');
                }
                
                if (!wp_script_is('jquery-ui-slider', 'queue')){
                    wp_enqueue_script('jquery-ui-slider');
                }
                
                wp_enqueue_script('DOP-js-jquery-dopselect');
                
                wp_enqueue_script('DOPBSP-js-frontend-calendar');
                wp_enqueue_script('DOPBSP-js-frontend-search');
            }

            /*
             * Initialize shortcode.
             * 
             * @param atts (array): shortcode attributes
             */
            function shortcode($atts){
                global $DOPBSP;
                
                extract(shortcode_atts(array('class' => 'dopbsp'), $atts));
                                
                if (!array_key_exists('item', $atts)){
                    $atts['item'] = 'calendar';
                }
                                
                if (!array_key_exists('id', $atts)){
                    $atts['id'] = 1;
                }
                                
                if (!array_key_exists('lang', $atts)){
                    $atts['lang'] = DOPBSP_CONFIG_TRANSLATION_DEFAULT_LANGUAGE;
                }
                                
                if (!array_key_exists('woocommerce', $atts)){
                    $atts['woocommerce'] = 'false';
                }
                                
                if (!array_key_exists('woocommerce_add_to_cart', $atts)){
                    $atts['woocommerce_add_to_cart'] = 'false';
                }
                                
                if (!array_key_exists('woocommerce_position', $atts)){
                    $atts['woocommerce_position'] = 'summary';
                }
                                
                if (!array_key_exists('woocommerce_product_id', $atts)){
                    $atts['woocommerce_product_id'] = 0;
                }
                
                switch ($atts['item']){
                    case 'search':
                        $content = $DOPBSP->classes->frontend_search->display($atts);
                        break;
                    default:
                        $content = $DOPBSP->classes->frontend_calendar->display($atts);
                }
                
                return $content;
            }
        }
    }