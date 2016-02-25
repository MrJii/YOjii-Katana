/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/


var DOPBSPLanguages = new function(){
    'use strict';
    
    /*
     * Private variables
     */
    var $ = jQuery.noConflict();

    /*
     * Constructor
     */
    this.DOPBSPLanguages = function(){
    };
    
    /*
     * Display languages.
     */
    this.display = function(){
        $('.DOPBSP-admin .dopbsp-main').css('display', 'block');
        $('#DOPBSP-translation-manage-translation').css('display', 'block');
        $('#DOPBSP-translation-manage-language').css('display', 'none');
        $('#DOPBSP-translation-manage-text-group').css('display', 'none');
        $('#DOPBSP-translation-manage-search').css('display', 'none');
        $('#DOPBSP-translation-manage-languages').css('display', 'none');
        $('#DOPBSP-translation-reset').css('display', 'none');
        $('#DOPBSP-translation-check').css('display', 'none');
        
        DOPBSP.toggleMessages('active', DOPBSP.text('MESSAGES_LOADING'));
        $('#DOPBSP-translation-content').html('');

        $.post(ajaxurl, {action: 'dopbsp_languages_display'}, function(data){
            $('#DOPBSP-translation-content').html(data);
            DOPBSP.toggleMessages('success', DOPBSP.text('LANGUAGES_LOADED'));
        }).fail(function(data){
            DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
        });
    };
    
    return this.DOPBSPLanguages();
};