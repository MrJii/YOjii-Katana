/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/


var DOPBSPLanguage = new function(){
    'use strict';
    
    /*
     * Private variables
     */
    var $ = jQuery.noConflict();

    /*
     * Constructor
     */
    this.DOPBSPLanguage = function(){
    };
    
    /*
     * Change back end language.
     */
    this.change = function(){
        DOPBSP.toggleMessages('active', DOPBSP.text('MESSAGES_SAVING'));
        
        $.post(ajaxurl, {action: 'dopbsp_language_change',
                         language: $('#DOPBSP-admin-language').val()}, function(data){
            window.location.reload();
        }).fail(function(data){
            DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
        });
    };

    /*
     * Set language to be used with the plugin.
     * 
     * @param language (String): language code
     */
    this.set = function(language){
        if ($('#DOPBSP-translation-language-'+language).is(':checked')){
            DOPBSPLanguage.enable(language);
        }
        else{
            DOPBSP.confirmation('LANGUAGES_REMOVE_CONFIGURATION', "DOPBSPLanguage.enable('"+language+"')", "$('#DOPBSP-translation-language-"+language+"').attr('checked', 'checked');");
        }
    };
    
    /*
     * Enable/disable a language.
     * 
     * @param language (String): language code
     */
    this.enable = function(language){
        DOPBSP.toggleMessages('active', $('#DOPBSP-translation-language-'+language).is(':checked') ? DOPBSP.text('LANGUAGES_SETTING'):DOPBSP.text('LANGUAGES_REMOVING'));

        $.post(ajaxurl, {action: 'dopbsp_language_enable',
                         language: language,
                         value: $('#DOPBSP-translation-language-'+language).is(':checked') ? 'true':'false'}, function(data){
            DOPBSP.toggleMessages('active', $('#DOPBSP-translation-language-'+language).is(':checked') ? DOPBSP.text('LANGUAGES_SET_SUCCESS'):DOPBSP.text('LANGUAGES_REMOVE_SUCCESS'));
            DOPPrototypes.setCookie('DOPBSP-translation-redirect', 'languages', 1);

            setTimeout(function(){
                window.location.reload();
            }, 2000);
        }).fail(function(data){
            DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
        });
    };
    
    return this.DOPBSPLanguage();
};