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


    if (!class_exists('DOPBSPBackEndCoupons')){
        class DOPBSPBackEndCoupons extends DOPBSPBackEnd{
            /*
             * Constructor
             */
            function DOPBSPBackEndCoupons(){
            }
        
            /*
             * Prints out the coupons page.
             * 
             * @return HTML page
             */
            function view(){
                global $DOPBSP;
                
                $DOPBSP->views->backend_coupons->template();
            }
                
            /*
             * Display coupons list.
             * 
             * @return coupons list HTML
             */      
            function display(){
                global $wpdb;
                global $DOPBSP;
                                    
                $html = array();
                
                $coupons = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->coupons.' WHERE user_id='.wp_get_current_user()->ID.' OR user_id=0 ORDER BY id DESC');
                
                /* 
                 * Create coupons list HTML.
                 */
                array_push($html, '<ul>');
                
                if ($wpdb->num_rows != 0){
                    if ($coupons){
                        foreach ($coupons as $coupon){
                            array_push($html, $this->listItem($coupon));
                        }
                    }
                }
                else{
                    array_push($html, '<li class="dopbsp-no-data">'.$DOPBSP->text('COUPONS_NO_COUPONS').'</li>');
                }
                array_push($html, '</ul>');
                
                echo implode('', $html);
                
            	die();                
            }
            
            /*
             * Returns coupons list item HTML.
             * 
             * @param coupon (object): coupon data
             * 
             * @return coupon list item HTML
             */
            function listItem($coupon){
                global $DOPBSP;
                
                $html = array();
                $user = get_userdata($coupon->user_id); // Get data about the user who created the coupons.
                
                array_push($html, '<li class="dopbsp-item" id="DOPBSP-coupon-ID-'.$coupon->id.'" onclick="DOPBSPCoupon.display('.$coupon->id.')">');
                array_push($html, ' <div class="dopbsp-header">');
                
                /*
                 * Display coupon ID.
                 */
                array_push($html, '     <span class="dopbsp-id">ID: '.$coupon->id.'</span>');
                
                /*
                 * Display data about the user who created the coupon.
                 */
                if ($coupon->user_id > 0){
                    array_push($html, '     <span class="dopbsp-header-item dopbsp-avatar">'.get_avatar($coupon->user_id, 17));
                    array_push($html, '         <span class="dopbsp-info">'.$DOPBSP->text('COUPONS_CREATED_BY').': '.$user->data->display_name.'</span>');
                    array_push($html, '         <br class="dopbsp-clear" />');
                    array_push($html, '     </span>');
                }
                array_push($html, '     <br class="dopbsp-clear" />');
                array_push($html, ' </div>');
                array_push($html, ' <div class="dopbsp-name">'.($coupon->name == '' ? '&nbsp;':$coupon->name).'</div>');
                array_push($html, '</li>');
                
                return implode('', $html);
            }
        }
    }