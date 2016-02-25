/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/

var DOPBSPTools = new function(){
    'use strict';
    
    /*
     * Private variables.
     */
    var $ = jQuery.noConflict();
        
    /*
     * Constructor
     */
    this.DOPBSPTools = function(){
    };
    
    /*
     * Display tools.
     */
    this.display = function(){
        $('.DOPBSP-admin .dopbsp-main').css('display', 'block');
    };
    
    /*
     * Toggle buttons on tools page.
     * 
     * @param button (String): button class
     */
    this.toggle = function(button){
        /*
         * Clear previous content.
         */
        DOPBSP.clearColumns(2);  

        /*
         * Set buttons.
         */           
        $('#DOPBSP-column1 .dopbsp-tools-item.dopbsp-repair-calendars-settings').removeClass('dopbsp-selected');
        $('#DOPBSP-column1 .dopbsp-tools-item.dopbsp-repair-database-text').removeClass('dopbsp-selected');
        
        $('#DOPBSP-column1 .dopbsp-tools-item.dopbsp-'+button).addClass('dopbsp-selected');
    };
    
    return this.DOPBSPTools();
};