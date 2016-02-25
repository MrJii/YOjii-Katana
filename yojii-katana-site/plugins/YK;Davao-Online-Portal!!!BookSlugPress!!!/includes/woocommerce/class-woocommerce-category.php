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


    if (!class_exists('DOPBSPWooCommerceCategory')){
        class DOPBSPWooCommerceCategory extends DOPBSPWooCommerce{
            /*
             * Constructor
             */
            function DOPBSPWooCommerceCategory(){
                /*
                 * Remove/add buttons.
                 */
                add_action('init', array(&$this, 'deleteButtons'));
            }
            
            /*
             * Delete products buttons in categories pages.
             */
            function deleteButtons(){
                /*
                 * Remove all buttons.
                 */
                remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
                
                /*
                 * Reinitialize products buttons.
                 */
                add_action('woocommerce_after_shop_loop_item', array(&$this, 'displayButtons'), 11);
            }
            
            /*
             * Display products buttons in categories pages. Add "View availability" for the ones that contain a calendar.
             * 
             * @return button HTML
             */
            function displayButtons(){
                global $post;
                global $product;
                global $DOPBSP;
                
                $dopbsp_woocommerce_options = array('calendar' => get_post_meta($post->ID, 'dopbsp_woocommerce_calendar', true),
                                                    'language' => get_post_meta($post->ID, 'dopbsp_woocommerce_language', true) == '' ? 'en':get_post_meta($post->ID, 'dopbsp_woocommerce_language', true),
                                                    'position' => get_post_meta($post->ID, 'dopbsp_woocommerce_position', true) == '' ? 'summary':get_post_meta($post->ID, 'dopbsp_woocommerce_position', true),
                                                    'add_to_cart' => get_post_meta($post->ID, 'dopbsp_woocommerce_add_to_cart', true) == '' ? 'false':get_post_meta($post->ID, 'dopbsp_woocommerce_add_to_cart', true));
                
                $DOPBSP->classes->translation->set($dopbsp_woocommerce_options['language'],
                                                              false);
                
                if ($dopbsp_woocommerce_options['calendar'] == '' 
                        || $dopbsp_woocommerce_options['calendar'] == 0){
                    /*
                     * Display default buttons.
                     */
                    echo apply_filters('woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
                                                                                    esc_url($product->add_to_cart_url()),
                                                                                    esc_attr($product->id),
                                                                                    esc_attr($product->get_sku()),
                                                                                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button':'',
                                                                                    esc_attr($product->product_type),
                                                                                    esc_html($product->add_to_cart_text())), $product);
                }
                else{
                    /*
                     * Display "View availability" buttons for the products that contain the booking system.
                     */
                    echo apply_filters('woocommerce_loop_add_to_cart_link', sprintf('<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button product_type_%s">%s</a>',
                                                                                    esc_url($product->post->guid),
                                                                                    esc_attr($product->id),
                                                                                    esc_attr($product->get_sku()),
                                                                                    esc_attr($product->product_type),
                                                                                    $DOPBSP->text('WOOCOMMERCE_VIEW_AVAILABILITY')));
                }
            }
        }
    }