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


    if (!class_exists('DOPBSPWooCommerceOrder')){
        class DOPBSPWooCommerceOrder extends DOPBSPWooCommerce{
            /*
             * Constructor
             */
            function DOPBSPWooCommerceOrder(){
                /*
                 * Add order item meta.
                 */
                add_action('woocommerce_add_order_item_meta', array(&$this, 'set'), 10, 3);
            }
            
            /*
             * Set order item meta (Details, Extras, Discount).
             * 
             * @param item_id (integer): order item ID
             * @param values (object): order item data (not received from WC)
             * @param cart_item_key (object): cart item key from which the order item is created (not received from WC)
             */
            function set($item_id,
                         $values,
                         $cart_item_key){            
                global $wpdb;
                global $DOPBSP;
                
                $reservation_data = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->woocommerce.' WHERE variation_id='.wc_get_order_item_meta($item_id, '_variation_id'));
                
                if ($reservation_data){
                    $reservation = json_decode($reservation_data->data);
                    $reservation->currency = $reservation_data->currency;
                    $reservation->item_id = $item_id;

                    $calendar = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->calendars.' WHERE id='.$reservation_data->calendar_id);
                    $settings_calendar = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->settings_calendar.' WHERE calendar_id='.$reservation_data->calendar_id);
                    
                    $DOPBSP->classes->translation->set($reservation_data->language,
                                                                  false);

                    /*
                     * Display details data.
                     */
                    wc_add_order_item_meta($item_id, 
                                           $DOPBSP->text('RESERVATIONS_RESERVATION_DETAILS_TITLE'), 
                                           $this->getDetails($reservation,
                                                             $calendar,
                                                             $settings_calendar));

                    /*
                     * Display extra data.
                     */
                    if ($settings_calendar->extra != 0){
                        wc_add_order_item_meta($item_id,
                                               $DOPBSP->text('EXTRAS_FRONT_END_TITLE'), 
                                               $this->getExtras($reservation,
                                                                $settings_calendar));
                    }

                    /*
                     * Display discount data.
                     */
                    if ($settings_calendar->discount != 0){
                        wc_add_order_item_meta($item_id, 
                                               $DOPBSP->text('DISCOUNTS_FRONT_END_TITLE'), 
                                               $this->getDiscount($reservation,
                                                                  $settings_calendar));
                    }
                }
            }
        }
    }