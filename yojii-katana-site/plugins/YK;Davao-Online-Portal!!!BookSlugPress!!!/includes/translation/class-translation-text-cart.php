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


    if (!class_exists('DOPBSPTranslationTextCart')){
        class DOPBSPTranslationTextCart{
            /*
             * Constructor
             */
            function DOPBSPTranslationTextCart(){
                /*
                 * Initialize order text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'cart'));
            }

            /*
             * Cart text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function cart($text){
                array_push($text, array('key' => 'PARENT_CART',
                                        'parent' => '',
                                        'text' => 'Cart'));
                
                array_push($text, array('key' => 'CART_TITLE',
                                        'parent' => 'PARENT_CART',
                                        'text' => 'Cart'));
                array_push($text, array('key' => 'CART_IS_EMPTY',
                                        'parent' => 'PARENT_CART',
                                        'text' => 'Cart is empty.'));
                
                array_push($text, array('key' => 'CART_ERROR',
                                        'parent' => 'PARENT_CART',
                                        'text' => 'Error'));
                array_push($text, array('key' => 'CART_UNAVAILABLE',
                                        'parent' => 'PARENT_CART',
                                        'text' => 'The period you selected is not available anymore. Please review your reservations.'));
                array_push($text, array('key' => 'CART_OVERLAP',
                                        'parent' => 'PARENT_CART',
                                        'text' => 'The period you selected will overlap with the ones you already added to cart. Please select another one.'));
                
                return $text;
            }
        }
    }