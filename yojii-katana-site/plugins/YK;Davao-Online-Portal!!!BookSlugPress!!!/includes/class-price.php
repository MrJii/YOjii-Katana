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


    if (!class_exists('DOPBSPPrice')){
        class DOPBSPPrice{
            /*
             * Constructor
             */
            function DOPBSPPrice(){
            }
            /*
             * Display price with currency in set format.
             * 
             * @param price (float): price value
             * @param currency (string): currency sign
             * @param position (string): currency position
             * 
             * @return price with currency
             */
            function set($price,
                         $currency,
                         $position = 'before'){
                global $DOPBSP;
                
                $price_displayed = '';
                $price = $DOPBSP->classes->prototypes->getWithDecimals(abs($price), 2);
                
                switch ($position){
                    case 'after':
                        $price_displayed =  $price.$currency;
                        break;
                    case 'after_with_space':
                        $price_displayed =  $price.' '.$currency;
                        break;
                    case 'before_with_space':
                        $price_displayed =  $currency.' '.$price;
                        break;
                    default:
                        $price_displayed = $currency.$price;
                }
                
                return $price_displayed;
            }
        }
    }