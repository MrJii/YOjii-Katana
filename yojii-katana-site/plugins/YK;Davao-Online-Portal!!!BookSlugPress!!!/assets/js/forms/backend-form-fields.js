/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/

var DOPBSPFormFields = new function(){
    'use strict';
    
    /*
     * Private variables
     */
    var $ = jQuery.noConflict();
    
    /*
     * Constructor
     */
    this.DOPBSPFormFields = function(){
    };
    
    /*
     * Initialize form fields sort.
     */
    this.init = function(){
        $('#DOPBSP-form-fields').sortable({handle: '.dopbsp-handle',
                                           opacity: 0.75,
                                           placeholder: 'dopbsp-placeholder',
                                           update: function(e, ui){
                                                var ids = new Array();
                                                
                                                DOPBSP.toggleMessages('active-info', DOPBSP.text('MESSAGES_SAVING'));
                                                
                                                $('#'+e.target.id+' li.dopbsp-field-wrapper').each(function(){
                                                    if (!$(this).hasClass('dopbsp-placeholder')){
                                                        ids.push($(this).attr('id').split('DOPBSP-form-field-')[1]);
                                                    }
                                                });
                                               
                                                $.post(ajaxurl, {action: 'dopbsp_form_fields_sort',
                                                                 ids: ids.join(',')}, function(data){
                                                    DOPBSP.toggleMessages('success', DOPBSP.text('MESSAGES_SAVING_SUCCESS'));
                                                }).fail(function(data){
                                                    DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
                                                });
                                           }});
    };
    
    return this.DOPBSPFormFields();
};