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


    if (!class_exists('DOPBSPFrontEndReservations')){
        class DOPBSPFrontEndReservations extends DOPBSPFrontEnd{
            /*
             * Constructor.
             */
            function DOPBSPFrontEndReservations(){
            }
            
            /*
             * Get reservation data.
             */
            function get(){
                global $DOPBSP;
                
                return array('data' => array(),
                             'text' => array('buttonApprove' => $DOPBSP->text('RESERVATIONS_RESERVATION_APPROVE'),
                                             'buttonCancel' => $DOPBSP->text('RESERVATIONS_RESERVATION_CANCEL'),
                                             'buttonClose' => $DOPBSP->text('RESERVATIONS_RESERVATION_CLOSE'),
                                             'buttonDelete' => $DOPBSP->text('RESERVATIONS_RESERVATION_DELETE'),
                                             'buttonReject' => $DOPBSP->text('RESERVATIONS_RESERVATION_REJECT'),
                                             'dateCreated' => $DOPBSP->text('RESERVATIONS_RESERVATION_DATE_CREATED'),
                                             'id' => $DOPBSP->text('RESERVATIONS_RESERVATION_ID'),
                                             'instructions' => $DOPBSP->text('RESERVATIONS_RESERVATION_INSTRUCTIONS'),
                                             'language' => $DOPBSP->text('RESERVATIONS_RESERVATION_LANGUAGE'),   
                                             'noExtras' => $DOPBSP->text('RESERVATIONS_RESERVATION_NO_EXTRAS'),   
                                             'noDiscount' => $DOPBSP->text('RESERVATIONS_RESERVATION_NO_DISCOUNT'),
                                             'noCoupon' => $DOPBSP->text('RESERVATIONS_RESERVATION_NO_COUPON'),
                                             'noFees' => $DOPBSP->text('RESERVATIONS_RESERVATION_NO_FEES'),
                                             'noForm' => $DOPBSP->text('RESERVATIONS_RESERVATION_NO_FORM'),
                                             'noFormField' => $DOPBSP->text('RESERVATIONS_RESERVATION_NO_FORM_FIELD'),
                                             'price' => $DOPBSP->text('RESERVATIONS_RESERVATION_FRONT_END_PRICE'),
                                             'priceChange' => $DOPBSP->text('RESERVATIONS_RESERVATION_PAYMENT_PRICE_CHANGE'),
                                             'priceTotal' => $DOPBSP->text('RESERVATIONS_RESERVATION_FRONT_END_TOTAL_PRICE'),   
                                             'selectDays' => $DOPBSP->text('RESERVATIONS_RESERVATION_FRONT_END_SELECT_DAYS'),
                                             'selectHours' => $DOPBSP->text('RESERVATIONS_RESERVATION_FRONT_END_SELECT_HOURS'),
                                             'status' => $DOPBSP->text('RESERVATIONS_RESERVATION_STATUS'),
                                             'statusApproved' => $DOPBSP->text('RESERVATIONS_RESERVATION_STATUS_APPROVED'),
                                             'statusCanceled' => $DOPBSP->text('RESERVATIONS_RESERVATION_STATUS_CANCELED'),
                                             'statusExpired' => $DOPBSP->text('RESERVATIONS_RESERVATION_STATUS_EXPIRED'),
                                             'statusPending' => $DOPBSP->text('RESERVATIONS_RESERVATION_STATUS_PENDING'),
                                             'statusRejected' => $DOPBSP->text('RESERVATIONS_RESERVATION_STATUS_REJECTED'),
                                             'title' => $DOPBSP->text('RESERVATIONS_RESERVATION_FRONT_END_TITLE'),
                                             'titleDetails' => $DOPBSP->text('RESERVATIONS_RESERVATION_DETAILS_TITLE')));
            }
            
            /*
             * Book a reservation.
             * 
             * @post calendar_id (integer): calendar ID
             * @post language (string): selected language
             * @post currency (string): selected currency sign
             * @post currency_code (string): selected currency code
             * @post cart_data (array): list of reservations
             * @post form (object): form data
             * @post payment_method (string): selected payment method
             * @post card_data (array): card data
             * @post token (string): payment token (different for payment gateways)
             * @post page_url (string): page url were the calendar is
             */
            function book(){
                global $wpdb;
                global $DOPBSP;
                    
// HOOK (dopbsp_action_book_before) *************************************** Add action before booking request.
                do_action('dopbsp_action_book_before');

                $calendar_id = $_POST['calendar_id'];
                $language = $_POST['language'];
                $currency = $_POST['currency'];
                $currency_code = $_POST['currency_code'];
                $cart = $_POST['cart_data'];
                $form = $_POST['form'];
                $payment_method = $_POST['payment_method'];
                $token = $_POST['token'];
                
                /*
                 * Verify reservations.
                 */
                $settings_payment = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->settings_payment.' WHERE calendar_id='.$calendar_id);
                
                for ($i=0; $i<count($cart); $i++){
                    $reservation = $cart[$i];
                    
                    if (($payment_method != 'default' 
                                    && $payment_method != 'none')
                            || $settings_payment->arrival_with_approval_enabled == 'true'){
                        /*
                         * Verify reservations availability.
                         */
                        if ($reservation['start_hour'] == ''){
                            if (!$DOPBSP->classes->backend_calendar_schedule->validateDays($calendar_id, $reservation['check_in'], $reservation['check_out'], $reservation['no_items'])){
                                echo 'unavailable';
                                die();
                            }
                        }
                        else{
                            if (!$DOPBSP->classes->backend_calendar_schedule->validateHours($calendar_id, $reservation['check_in'], $reservation['start_hour'], $reservation['end_hour'], $reservation['no_items'])){
                                echo 'unavailable';
                                die();
                            }
                        }
                
                        /*
                         * Verify coupon.
                         */
                        // $coupon = json_decode($reservation['coupon']);
                        $coupon = $reservation['coupon'];
                        
                        if ($coupon['id'] != 0){
                            if (!$DOPBSP->classes->backend_coupon->validate($coupon['id'])){
                                echo 'unavailable-coupon';
                                die();
                            }
                        }
                    }
                }
                
                /*
                 * Set token.
                 */
                if ($payment_method != 'default'
                        && $payment_method != 'none'){
                    $token = $token == '' ? $DOPBSP->classes->prototypes->getRandomString(32):$token;
                }
                else{
                    $token = '';
                }
                $DOPBSP->vars->payment_token = $token;
                
                /*
                 * Add reservations.
                 */
                for ($i=0; $i<count($cart); $i++){
                    $reservation = $cart[$i];
                
                    $reservation_id = $DOPBSP->classes->backend_reservation->add($calendar_id,
                                                                                 $language,
                                                                                 $currency,
                                                                                 $currency_code,
                                                                                 $reservation,
                                                                                 $form,
                                                                                 $payment_method,
                                                                                 $token);
                    
                    if ($payment_method == 'default'
                            || $payment_method == 'none'){
                        if ($settings_payment->arrival_with_approval_enabled == 'true'){
                            $DOPBSP->classes->backend_reservation_notifications->send($reservation_id,
                                                                                      'book_with_approval_admin');
                            $DOPBSP->classes->backend_reservation_notifications->send($reservation_id,
                                                                                      'book_with_approval_user');
                        }
                        else{
                            $DOPBSP->classes->backend_reservation_notifications->send($reservation_id,
                                                                                      'book_admin');
                            $DOPBSP->classes->backend_reservation_notifications->send($reservation_id,
                                                                                      'book_user');
                        }
                    }
                }
                
// HOOK (dopbsp_action_book_payment) *************************************** Add action for payment gateways.
                do_action('dopbsp_action_book_payment');
                
// HOOK (dopbsp_action_book_after) *************************************** Add action after booking request.
                do_action('dopbsp_action_book_after');
                           
                die();
            }
        }
    }