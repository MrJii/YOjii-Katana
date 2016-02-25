/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/

var DOPBSPToolsRepairDatabaseText = new function(){
    'use strict';
    
    /*
     * Private variables
     */
    var $ = jQuery.noConflict();
    
    /*
     * Constructor
     */
    this.DOPBSPToolsRepairDatabaseText = function(){
    };
    
    /*
     * Set verify & repair to database & text.
     */
    this.set = function(no){
        DOPBSP.toggleMessages('active', DOPBSP.text('TOOLS_REPAIR_DATABASE_TEXT_REPAIRING', 'Verifying and repairing the database & the text ...'));
        
        $.post(ajaxurl, {action: 'dopbsp_tools_repair_database_text_set',
                         dopbsp_repair_database_text: true}, function(data){
            DOPBSP.toggleMessages('active', DOPBSP.text('TOOLS_REPAIR_DATABASE_TEXT_SUCCESS', 'The database & the text have been verified and repaired. The page will redirect shortly to Dashboard.'));

            setTimeout(function(){
                window.location.href = $.trim(data);
            }, 300);
        }).fail(function(data){
            DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
        });
    };
    
    return this.DOPBSPToolsRepairDatabaseText();
};