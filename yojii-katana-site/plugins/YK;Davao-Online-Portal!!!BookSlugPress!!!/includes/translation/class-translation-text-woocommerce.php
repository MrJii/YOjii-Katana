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


    if (!class_exists('DOPBSPTranslationTextWooCommerce')){
        class DOPBSPTranslationTextWooCommerce{
            /*
             * Constructor
             */
            function DOPBSPTranslationTextWooCommerce(){
                /*
                 * Initialize WooCommerce text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'woocommerce'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'woocommerceHelp'));
            }
            
            /*
             * WooCommerce text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function woocommerce($text){
                array_push($text, array('key' => 'PARENT_WOOCOMMERCE',
                                        'parent' => '',
                                        'text' => 'WooCommerce'));
                /*
                 * Back end tab.
                 */
                array_push($text, array('key' => 'WOOCOMMERCE_TAB',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'DOP Module'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_CALENDAR',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Calendar'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_CALENDAR_NO_CALENDARS',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'No calendars.'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_CALENDAR_SELECT',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Select calendar'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_LANGUAGE',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Language'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_POSITION',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Position'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_POSITION_SUMMARY',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Summary'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_POSITION_TABS',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Tabs'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_POSITION_SUMMARY_AND_TABS',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Summary & Tabs'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_ADD_TO_CART',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Use the "Add To Cart" button from'));
                
                /*
                 * Front end.
                 */
                array_push($text, array('key' => 'WOOCOMMERCE_VIEW_AVAILABILITY',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'View availability'));
                array_push($text, array('key' => 'WOOCOMMERCE_TABS',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'Book'));
                array_push($text, array('key' => 'WOOCOMMERCE_PRODUCT_NONE',
                                        'parent' => 'PARENT_WOOCOMMERCE',
                                        'text' => 'No reservation'));
                
                return $text;
            }
            
            /*
             * WooCommerce - Help text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function woocommerceHelp($text){
                array_push($text, array('key' => 'PARENT_WOOCOMMERCE_HELP',
                                        'parent' => '',
                                        'text' => 'WooCommerce - Help'));
                
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_CALENDAR_HELP',
                                        'parent' => 'PARENT_WOOCOMMERCE_HELP',
                                        'text' => 'Select the calendar that you want asociated with this product.'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_LANGUAGE_HELP',
                                        'parent' => 'PARENT_WOOCOMMERCE_HELP',
                                        'text' => 'Select the language for the calendar.'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_POSITION_HELP',
                                        'parent' => 'PARENT_WOOCOMMERCE_HELP',
                                        'text' => 'Select the calendar position. Add it in "product summary", "product tabs" or add the form in "summary" and the calendar in "product tabs".'));
                array_push($text, array('key' => 'WOOCOMMERCE_TAB_ADD_TO_CART_HELP',
                                        'parent' => 'PARENT_WOOCOMMERCE_HELP',
                                        'text' => 'Select to choose to use DOP Module<<single-quote>>s "Add to cart" button, or WooCommerce default button.'));
                
                return $text;
            }
        }
    }