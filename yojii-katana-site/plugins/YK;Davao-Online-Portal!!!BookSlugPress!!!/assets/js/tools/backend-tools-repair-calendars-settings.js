/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/

var DOPBSPToolsRepairCalendarsSettings = new function(){
    'use strict';
    
    /*
     * Private variables
     */
    var $ = jQuery.noConflict(),
    calendars = new Array();
    

    /*
     * Constructor
     */
    this.DOPBSPToolsRepairCalendarsSettings = function(){
    };
    
    /*
     * Initialize calendars settings repair.
     */
    this.init = function(){
        DOPBSP.toggleMessages('active', DOPBSP.text('TOOLS_REPAIR_CALENDARS_SETTINGS_REPAIRING'));
        
        $.post(ajaxurl, {action: 'dopbsp_tools_repair_calendars_settings_display'}, function(data){
            $('#DOPBSP-column2 .dopbsp-column-content').html($.trim(data));
            
            $.post(ajaxurl, {action: 'dopbsp_tools_repair_calendars_settings_get'}, function(data){
                calendars = $.trim(data).split(',');
                DOPBSPToolsRepairCalendarsSettings.set(0);
            }).fail(function(data){
                DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
            });
        }).fail(function(data){
            DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
        });
    };
    
    /*
     * Set repair to calendar settings.
     * 
     * @param no (Number): calendars array index
     */
    this.set = function(no){
        $.post(ajaxurl, {action: 'dopbsp_tools_repair_calendars_settings_set',
                         id: calendars[no],
                         no: no}, function(data){
            $('#DOPBSP-tools-repair-calendars-settings tbody').append(data);
            
            if (no < calendars.length-1){
                DOPBSPToolsRepairCalendarsSettings.set(no+1);
            }
            else{
                DOPBSP.toggleMessages('success', DOPBSP.text('TOOLS_REPAIR_CALENDARS_SETTINGS_SUCCESS'));
            }
        }).fail(function(data){
            DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
        });
    };
    
    return this.DOPBSPToolsRepairCalendarsSettings();
};