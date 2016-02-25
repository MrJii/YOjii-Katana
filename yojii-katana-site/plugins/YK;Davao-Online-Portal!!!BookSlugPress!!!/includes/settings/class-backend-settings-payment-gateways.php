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

    if (!class_exists('DOPBSPBackEndSettingsPaymentGateways')){
        class DOPBSPBackEndSettingsPaymentGateways extends DOPBSPBackEndSettings{
            /*
             * Constructor
             */
            function DOPBSPBackEndSettingsPaymentGateways(){
            }
        
            /*
             * Prints out the payment gateways settings page.
             * 
             * @post id (integer): calendar ID
             * 
             * @return payment gateway settings HTML
             */
            function display(){
                global $DOPBSP;
                
                $DOPBSP->views->backend_settings_payment_gateways->template(array('id' => $_POST['id']));
                
                die();
            }
        }
    }