/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/


var DOPBSPLocations = new function(){
    'use strict';
    
    /*
     * Private variables.
     */
    var $ = jQuery.noConflict();
    
    /*
     * Display locations list.
     */
    this.DOPBSPLocations = function(){
    };
    
    /*
     * Initialize Google Maps before display.
     */
    this.init = function(){
        if (typeof google !== 'object' 
                || typeof google.maps !== 'object'){
            var script = document.createElement('script');

            script.type = 'text/JavaScript';
            script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&callback=DOPBSPLocations.display';

            $('body').append(script);
        }
        else{
            DOPBSPLocations.display();
        }
    }

    /*
     * Display locations list.
     */
    this.display = function(){
        DOPBSP.clearColumns(1);
        DOPBSP.toggleMessages('active', DOPBSP.text('MESSAGES_LOADING'));

        $.post(ajaxurl, {action: 'dopbsp_locations_display'}, function(data){
            $('#DOPBSP-column1 .dopbsp-column-content').html(data);
            $('.DOPBSP-admin .dopbsp-main').css('display', 'block');
            DOPBSP.toggleMessages('success', DOPBSP.text('LOCATIONS_LOAD_SUCCESS'));
        }).fail(function(data){
            DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
        });
    };
    
    return this.DOPBSPLocations();
};