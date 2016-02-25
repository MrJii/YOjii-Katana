/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/


var DOPBSPExtraGroupItems = new function(){
    'use strict';
    
    /*
     * Private variables
     */
    var $ = jQuery.noConflict();
    
    /*
     * Constructor
     */
    this.DOPBSPExtraGroupItems = function(){
    };
    
    /*
     * Initialize extra group items sort.
     */
    this.init = function(){
        $('#DOPBSP-extra-groups .dopbsp-items').sortable({handle: '.dopbsp-handle',
                                                          opacity: 0.75,
                                                          placeholder: 'dopbsp-placeholder',
                                                          update: function(e, ui){
                                                                var ids = new Array();

                                                                DOPBSP.toggleMessages('active-info', DOPBSP.text('MESSAGES_SAVING'));

                                                                $('#'+e.target.id+' li.dopbsp-group-item-wrapper').each(function(){
                                                                    if (!$(this).hasClass('dopbsp-placeholder')){
                                                                        ids.push($(this).attr('id').split('DOPBSP-extra-group-item-')[1]);
                                                                    }
                                                                });

                                                                $.post(ajaxurl, {action: 'dopbsp_extra_group_items_sort',
                                                                                 ids: ids.join(',')}, function(data){
                                                                    DOPBSP.toggleMessages('success', DOPBSP.text('MESSAGES_SAVING_SUCCESS'));
                                                                }).fail(function(data){
                                                                    DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
                                                                });
                                                          }});
    };
    
    return this.DOPBSPExtraGroupItems();
};