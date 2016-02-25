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


    if (!class_exists('DOPBSPPaymentGateways')){
        class DOPBSPPaymentGateways{
            /*
             * Private variables.
             */
            private $payment_gateways = array();
            
            /*
             * Constructor
             */
            function DOPBSPPaymentGateways(){
                add_action('init', array(&$this, 'init'));
            }
            
            /*
             * Set payment gateways classes.
             */
            function init(){
                /*
                 * Initialize payment gateways classes.
                 */
                $this->payment_gateways = apply_filters('dopbsp_filter_payment_gateways', $this->payment_gateways);
                sort($this->payment_gateways);
            }
            
            /*
             * Get payment gateways.
             * 
             * @return list of payment gateways
             */
            function get(){
                return $this->payment_gateways;
            }
        }
    }