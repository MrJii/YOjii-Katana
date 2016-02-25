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


    if (!class_exists('DOPBSPFrontEndOrder')){
        class DOPBSPFrontEndOrder extends DOPBSPFrontEnd{
            /*
             * Constructor.
             */
            function DOPBSPFrontEndOrder(){
            }
            
            /*
             * Get order.
             * 
             * @param settings (object): calendar settings
             * @param settings_payment (object): payment settings
             * 
             * @return data array
             */
            function get($settings,
                         $settings_payment){
                global $DOPBSP;
                
                $payment_gateways = array();
                
                $pg_list = $DOPBSP->classes->payment_gateways->get();
                
                for ($i=0; $i<count($pg_list); $i++){
                    $pg_id = $pg_list[$i];
                    $enabled_field = $pg_id.'_enabled';
                    
                    if ($settings_payment->$enabled_field == 'true'){
                        $payment_gateways[$pg_id] = array('data' => array('card' => apply_filters('dopbsp_filter_payment_gateways_'.$pg_id.'_order_card', array()),
                                                                          'token' => apply_filters('dopbsp_filter_payment_gateways_'.$pg_id.'_order_token', array(), $settings_payment->calendar_id)),
                                                          'id' => $pg_id,
                                                          'text' => array('cancel' => $DOPBSP->text('ORDER_PAYMENT_GATEWAYS_'.strtoupper($pg_id).'_CANCEL'),
                                                                          'card_expiration_date' => $DOPBSP->text('ORDER_PAYMENT_GATEWAYS_'.strtoupper($pg_id).'_CARD_EXPIRATION_DATE'),
                                                                          'card_name' => $DOPBSP->text('ORDER_PAYMENT_GATEWAYS_'.strtoupper($pg_id).'_CARD_NAME'),
                                                                          'card_number' => $DOPBSP->text('ORDER_PAYMENT_GATEWAYS_'.strtoupper($pg_id).'_CARD_NUMBER'),
                                                                          'card_security_code' => $DOPBSP->text('ORDER_PAYMENT_GATEWAYS_'.strtoupper($pg_id).'_CARD_SECURITY_CODE'),
                                                                          'card_title' => $DOPBSP->text('ORDER_PAYMENT_GATEWAYS_'.strtoupper($pg_id).'_CARD_TITLE'),
                                                                          'error' => $DOPBSP->text('ORDER_PAYMENT_GATEWAYS_'.strtoupper($pg_id).'_ERROR'),
                                                                          'label' => $DOPBSP->text('ORDER_PAYMENT_GATEWAYS_'.strtoupper($pg_id)),
                                                                          'success' => $DOPBSP->text('ORDER_PAYMENT_GATEWAYS_'.strtoupper($pg_id).'_SUCCESS'),
                                                                          'title' => $DOPBSP->text('ORDER_PAYMENT_METHOD_'.strtoupper($pg_id))));
                    }
                }
                
                return array('data' => array('paymentArrival' => $settings_payment->arrival_enabled == 'true' ? true:false,
                                             'paymentArrivalWithApproval' => $settings_payment->arrival_with_approval_enabled == 'true' ? true:false,
                                             'paymentGateways' => $payment_gateways,
                                             'redirect' => $settings_payment->redirect,
                                             'termsAndConditions' => $settings->terms_and_conditions_enabled == 'true' ? true:false,
                                             'termsAndConditionsLink' => $settings->terms_and_conditions_link),
                             'text' => array('book' => $DOPBSP->text('ORDER_BOOK'),
                                             'paymentArrival' => $DOPBSP->text('ORDER_PAYMENT_ARRIVAL'),
                                             'paymentArrivalWithApproval' => $DOPBSP->text('ORDER_PAYMENT_ARRIVAL_WITH_APPROVAL'),
                                             'paymentArrivalSuccess' => $DOPBSP->text('ORDER_PAYMENT_ARRIVAL_SUCCESS'),
                                             'paymentArrivalWithApprovalSuccess' => $DOPBSP->text('ORDER_PAYMENT_ARRIVAL_WITH_APPROVAL_SUCCESS'),
                                             'paymentMethod' => $DOPBSP->text('ORDER_PAYMENT_METHOD'),
                                             'paymentMethodNone' => $DOPBSP->text('ORDER_PAYMENT_METHOD_NONE'),
                                             'paymentMethodArrival' => $DOPBSP->text('ORDER_PAYMENT_METHOD_ARRIVAL'),
                                             'paymentMethodTransactionID' => $DOPBSP->text('ORDER_PAYMENT_METHOD_TRANSACTION_ID'),
                                             'paymentMethodWooCommerce' => $DOPBSP->text('ORDER_PAYMENT_METHOD_WOOCOMMERCE'),
                                             'paymentMethodWooCommerceOrderID' => $DOPBSP->text('ORDER_PAYMENT_METHOD_WOOCOMMERCE_ORDER_ID'),
                                             'success' => $DOPBSP->text('RESERVATIONS_RESERVATION_ADD_SUCCESS'),
                                             'termsAndConditions' => $DOPBSP->text('ORDER_TERMS_AND_CONDITIONS'),
                                             'termsAndConditionsInvalid' => $DOPBSP->text('ORDER_TERMS_AND_CONDITIONS_INVALID'),
                                             'title' => $DOPBSP->text('ORDER_TITLE'),
                                             'unavailable' => $DOPBSP->text('ORDER_UNAVAILABLE'),
                                             'unavailableCoupon' => $DOPBSP->text('ORDER_UNAVAILABLE_COUPON')));
            }
        }
    }