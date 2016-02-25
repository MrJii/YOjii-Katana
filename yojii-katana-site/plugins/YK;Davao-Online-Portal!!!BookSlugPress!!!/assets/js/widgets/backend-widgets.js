/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/

var DOPBSPWidgets = new function(){
    'use strict';
    
    /*
     * Private variables.
     */
    var $ = jQuery.noConflict();

    /*
     * Constructor
     */
    this.DOPBSPWidgets = function(){
    };
    
    this.display = function(id,
                            selection){
        $('#DOPBSP-widget-id-'+id).css('display', 'none');
        $('#DOPBSP-widget-lang-'+id).css('display', 'none');

        switch (selection){
            case 'calendar':
                $('#DOPBSP-widget-id-'+id).css('display', 'block');
                $('#DOPBSP-widget-lang-'+id).css('display', 'block');
                break;
            case 'sidebar':
                $('#DOPBSP-widget-id-'+id).css('display', 'block');
                break;
        }
    };
    
    return this.DOPBSPWidgets();
};