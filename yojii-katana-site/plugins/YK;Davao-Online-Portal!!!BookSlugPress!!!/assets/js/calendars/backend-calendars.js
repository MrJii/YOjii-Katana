/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/


var DOPBSPCalendars = new function(){
    'use strict';
    
    /*
     * Private variables.
     */
    var $ = jQuery.noConflict();
        
    /*
     * Constructor
     */
    this.DOPBSPCalendars = function(){
    };
    
    /*
     * Display calendars list or initialize custom post calendar.
     */
    this.display = function(){
        var post_id = DOPPrototypes.$_GET('post'),
        action = DOPPrototypes.$_GET('action'),
        id;
    
        DOPBSP.clearColumns(1);
        DOPBSP.toggleMessages('active', DOPBSP.text('MESSAGES_LOADING'));
        
        if (action === 'edit'){
            $('#DOPBSP-col-column1').remove();
            $('#DOPBSP-col-column-separator1').remove();
            $('#DOPBSP-column1').remove();
            $('#DOPBSP-column-separator1').remove();
            
            $.post(ajaxurl, {action: 'dopbsp_custom_posts_get',
                             post_id: post_id}, function(data){

                $('.DOPBSP-admin .dopbsp-main').css('display', 'block');
                DOPBSPCalendar.init($.trim(data));
            }).fail(function(data){
                DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
            });
        }
        else{
            $.post(ajaxurl, {action: 'dopbsp_calendars_display'}, function(data){
                $('#DOPBSP-column1 .dopbsp-column-content').html(data);
                $('.DOPBSP-admin .dopbsp-main').css('display', 'block');
//                DOPBSPCalendar.init(16, 1);
                DOPBSP.toggleMessages('success', DOPBSP.text('CALENDARS_LOAD_SUCCESS'));
            }).fail(function(data){
                DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
            });
        }
    };
    
    return this.DOPBSPCalendars();
};