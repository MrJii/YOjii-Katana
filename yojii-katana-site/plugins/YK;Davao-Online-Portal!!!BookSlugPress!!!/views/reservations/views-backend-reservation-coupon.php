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

    if (!class_exists('DOPBSPViewsBackEndReservationCoupon')){
        class DOPBSPViewsBackEndReservationCoupon extends DOPBSPViewsBackEndReservation{
            /*
             * Constructor
             */
            function DOPBSPViewsBackEndReservationCoupon(){
            }
            
            /*
             * @param args (array): function arguments
             *                      * reservation (object): reservation data
             *                      * settings_calendar (object): calendar settings data
             */
            function template($args = array()){
                global $DOPBSP;
                
                $reservation = $args['reservation'];
                $settings_calendar = $args['settings_calendar'];
                
                $coupon = json_decode(utf8_decode($reservation->coupon));
?>
                <div class="dopbsp-data-module">
                    <div class="dopbsp-data-head"> 
                        <h3><?php echo $DOPBSP->text('COUPONS_FRONT_END_TITLE'); ?></h3>
                    </div>
                    <div class="dopbsp-data-body"> 
<?php
                if ($coupon->id != 0){
                    $value = array();

                    array_push($value, $coupon->code);

                    if ($coupon->price_type != 'fixed' 
                            || $coupon->price_by != 'once'){ 
                        array_push($value, '<br /><span class="dopbsp-info-rule">&#9632;&nbsp;');

                        if ($coupon->price_type == 'fixed'){
                            array_push($value, $coupon->operation.'&nbsp;'.$DOPBSP->classes->price->set($coupon->price,
                                                                                                        $reservation->currency,
                                                                                                        $settings_calendar->currency_position));
                        }
                        else{
                            array_push($value, $coupon->operation.'&nbsp;'.$coupon->price.'%');
                        }

                        if ($coupon->price_by != 'once'){
                            array_push($value, '/'.($settings_calendar->hours_enabled == 'true' ? $DOPBSP->text('COUPONS_FRONT_END_BY_HOUR'):$DOPBSP->text('COUPONS_FRONT_END_BY_DAY')));
                        }
                        array_push($value, '</span>');
                    }

                    $this->displayData($coupon->translation,
                                       implode('', $value));

                    if ($reservation->coupon_price != 0){
                        echo '<br />';
                        $this->displayData($DOPBSP->text('RESERVATIONS_RESERVATION_PAYMENT_PRICE_CHANGE'),
                                           ($reservation->coupon_price > 0 ? '+':'-').
                                                '&nbsp;'.$DOPBSP->classes->price->set($reservation->coupon_price,
                                                                                      $reservation->currency,
                                                                                      $settings_calendar->currency_position),
                                           'dopbsp-price');
                    }
                }
                else{
                    echo '<em>'.$DOPBSP->text('RESERVATIONS_RESERVATION_NO_COUPON').'</em>';
                }
?>
                    </div>
                </div>
<?php
            }
        }
    }