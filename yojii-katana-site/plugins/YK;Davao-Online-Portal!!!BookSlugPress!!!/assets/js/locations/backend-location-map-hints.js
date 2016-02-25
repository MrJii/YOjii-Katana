/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/


var DOPBSPLocationMapHints = new function(){
    'use strict';
    
    /*
     * Private variables.
     */
    var $ = jQuery.noConflict();

    /*
     * Public variables
     */
    this.hintsRequestTimeout;
    
    /*
     * Constructor
     */
    this.DOPBSPLocationMapHints = function(){
    };
    
    /*
     * Display address hints.
     */
    this.display = function(){
        var service = new google.maps.places.AutocompleteService(null,
                                                                 {types: ['cities']});
                                                                 
        this.hintsRequestTimeout !== undefined ? clearTimeout(this.hintsRequestTimeout):'';
        
        $('#DOPBSP-location-address-hints').css('display','block')
                                           .html('<li class="dopbsp-loader-wrapper"><span class="dopbsp-loader-content"></span></li>');
        
        this.hintsRequestTimeout = setTimeout(function(){
            clearTimeout(this.hintsRequestTimeout);
            
            service.getPlacePredictions({input: $('#DOPBSP-location-address').val()}, function(predictions, status){
                var html = new Array();
                
                if (predictions !== null){
                    for( var i=0; i<predictions.length; i++){
                        html.push('<li>');
                        html.push('    <input type="hidden" value="'+predictions[i]['description']+'" />');
                        html.push('    <span class="dopbsp-icon"></span>');
                        html.push(predictions[i]['description']);
                        html.push('</li>');
                        
                        if (i === 0){
                            DOPBSPLocationMap.set(predictions[i]['description'],
                                                  'address',
                                                  false);
                        }
                    }

                    $('#DOPBSP-location-address-hints').css('display','block')
                                                       .html(html.join(''));
                    DOPBSPLocationMapHints.init();
                }
                else{
                    DOPBSPLocationMapHints.clear();
                }
            });
        }, 600);
    };
    
    /*
     * Initialize hints events.
     */
    this.init = function(){
        $('#DOPBSP-location-address-hints li').unbind('click');
        $('#DOPBSP-location-address-hints li').bind('click', function(){
            var value = $(this).find('input[type="hidden"]').val();
            
            DOPBSPLocationMap.set(value,
                                  'address');
        });
    };
    
    /*
     * Clear hints.
     */
    this.clear = function(){
        $('#DOPBSP-location-address-hints').css('display', 'none')
                                           .html('<li></li>');
    };

    return this.DOPBSPLocationMapHints();
};