/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/

var DOPBSPSettingsNotifications = new function(){
    'use strict';
    
    /*
     * Private variables
     */
    var $ = jQuery.noConflict();

    /*
     * Constructor
     */
    this.DOPBSPSettingsNotifications = function(){
    };
    
    /*
     * Display notifications settings.
     * 
     * @param id (Number): calendar ID
     */
    this.display = function(id){
        DOPBSP.toggleMessages('active', DOPBSP.text('MESSAGES_LOADING'));
        DOPBSPSettings.toggle(id, 'notifications');

        $.post(ajaxurl, {action: 'dopbsp_settings_notifications_display',
                         id: id}, function(data){
            DOPBSP.toggleMessages('success', DOPBSP.text('MESSAGES_LOADING_SUCCESS'));
            $('#DOPBSP-column2 .dopbsp-column-content').html(data);
        }).fail(function(data){
            DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
        });
    };
    
    /*
     * Test notification method.
     * 
     * @param id (Number): calendar ID
     */
    this.test = function(id){
        DOPBSP.toggleMessages('active', DOPBSP.text('SETTINGS_NOTIFICATIONS_TEST_SENDING'));
        
        $.post(ajaxurl, {action: 'dopbsp_settings_notifications_test',
                         id: id,
                         method: $('#DOPBSP-settings-notifications-test-method').val(),
                         email: $('#DOPBSP-settings-notifications-test-email').val()}, function(data){
            data = $.trim(data);
                         
            if (data === 'success'){
                DOPBSP.toggleMessages('success', DOPBSP.text('SETTINGS_NOTIFICATIONS_TEST_SUCCESS'));
            }             
            else{
                DOPBSP.toggleMessages('error', data);
            }
        }).fail(function(data){
            DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
        });
    };
    
    return this.DOPBSPSettingsNotifications();
};