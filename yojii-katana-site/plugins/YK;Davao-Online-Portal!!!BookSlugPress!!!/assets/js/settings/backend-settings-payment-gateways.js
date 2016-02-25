/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/

var DOPBSPSettingsPaymentGateways = new function(){
    'use strict';
    
    /*
     * Private variables
     */
    var $ = jQuery.noConflict();

    /*
     * Constructor
     */
    this.DOPBSPSettingsPaymentGateways = function(){
    };
    
    /*
     * Display payment gateways settings.
     * 
     * @param id (Number): calendar ID
     */
    this.display = function(id){
        DOPBSP.toggleMessages('active', DOPBSP.text('MESSAGES_LOADING'));
        DOPBSPSettings.toggle(id, 'payments');

        $.post(ajaxurl, {action: 'dopbsp_settings_payment_gateways_display',
                         id: id}, function(data){
            DOPBSP.toggleMessages('success', DOPBSP.text('MESSAGES_LOADING_SUCCESS'));
            $('#DOPBSP-column2 .dopbsp-column-content').html(data);
        }).fail(function(data){
            DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
        });
    };
    
    return this.DOPBSPSettingsPaymentGateways();
};