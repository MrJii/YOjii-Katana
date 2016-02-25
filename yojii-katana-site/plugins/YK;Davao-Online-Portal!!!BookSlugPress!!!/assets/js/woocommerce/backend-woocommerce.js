/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/


var DOPBSPWooCommerce = new function(){
    'use strict';
    
    /*
     * Private variables.
     */
    var $ = jQuery.noConflict();
        
    /*
     * Constructor
     */
    this.DOPBSPWooCommerce = function(){
        $(document).ready(function(){
            DOPBSPWooCommerce.set();
        });
    };
    
    /*
     * Set variations.
     */
    this.set = function(){
        $('.woocommerce_variation').each(function(){
            if ($('select[name*="attribute_booking"]', this).val() !== undefined
                    && $('select[name*="attribute_booking"]', this).val().indexOf('reservation-') !== -1){
                $(this).css('display', 'none');
            }
        });
    };
    
    return this.DOPBSPWooCommerce();
};