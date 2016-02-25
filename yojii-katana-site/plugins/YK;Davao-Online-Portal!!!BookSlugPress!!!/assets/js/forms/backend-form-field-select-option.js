/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/

var DOPBSPFormFieldSelectOption = new function(){
    'use strict';
    
    /*
     * Private variables.
     */
    var $ = jQuery.noConflict();

    /*
     * Public variables
     */
    this.ajaxRequestInProgress;
    this.ajaxRequestTimeout;
    
    /*
     * Constructor
     */
    this.DOPBSPFormFieldSelectOption = function(){
    };
    
    /*
     * Add form field select option.
     * 
     * @param fieldId (Number): field ID
     * @param language (String): form current selected language
     */
    this.add = function(fieldId,
                        language){
        DOPBSP.toggleMessages('active', DOPBSP.text('FORMS_FORM_FIELD_SELECT_ADD_OPTION_ADDING'));
        
        $.post(ajaxurl, {action:'dopbsp_form_field_select_option_add',
                         field_id: fieldId,
                         position: $('#DOPBSP-form-field-select-options-'+fieldId+' li').size()+1,
                         language: language}, function(data){
            $('#DOPBSP-form-field-select-options-'+fieldId).append(data);
            DOPBSPFormField.setSelectPreview(fieldId);
            DOPBSPFormFieldSelectOptions.init();
            
            DOPBSP.toggleMessages('success', DOPBSP.text('FORMS_FORM_FIELD_SELECT_ADD_OPTION_SUCCESS'));
        }).fail(function(data){
            DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
        });
    };

    /*
     * Edit form field select option.
     * 
     * @param id (Number): select option ID
     * @param type (String): field type
     * @param field (String): select option field
     * @param value (String): select option value
     * @param onBlur (Boolean): true if function has been called on blur event
     */
    this.edit = function(id, 
                         type,
                         field,
                         value, 
                         onBlur){
        onBlur = onBlur === undefined ? false:true;
        
        this.ajaxRequestInProgress !== undefined && !onBlur ? this.ajaxRequestInProgress.abort():'';
        this.ajaxRequestTimeout !== undefined ? clearTimeout(this.ajaxRequestTimeout):'';
        
        if (onBlur 
                || type === 'select' 
                || type === 'switch'){
            if (!onBlur){
                DOPBSP.toggleMessages('active-info', DOPBSP.text('MESSAGES_SAVING'));
            }
            
            $.post(ajaxurl, {action: 'dopbsp_form_field_select_option_edit',
                             id: id,
                             field: field,
                             value: value,
                             language: $('#DOPBSP-form-language').val()}, function(data){
                DOPBSPFormField.setSelectPreview(data);
                
                if (!onBlur){
                    DOPBSP.toggleMessages('success', DOPBSP.text('MESSAGES_SAVING_SUCCESS'));
                }
            }).fail(function(data){
                DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
            });
        }
        else{
            DOPBSP.toggleMessages('active-info', DOPBSP.text('MESSAGES_SAVING'));

            this.ajaxRequestTimeout = setTimeout(function(){
                clearTimeout(this.ajaxRequestTimeout);

                this.ajaxRequestInProgress = $.post(ajaxurl, {action: 'dopbsp_form_field_select_option_edit',
                                                              id: id,
                                                              field: field,
                                                              value: value,
                                                              language: $('#DOPBSP-form-language').val()}, function(data){
                    DOPBSPFormField.setSelectPreview(data);
                    DOPBSP.toggleMessages('success', DOPBSP.text('MESSAGES_SAVING_SUCCESS'));
                }).fail(function(data){
                    DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
                });
            }, 600);
        }
    };
    
    /*
     * Delete form field select option.
     * 
     * @param id (Number): select option ID
     */
    this.delete = function(id){
        DOPBSP.toggleMessages('active', DOPBSP.text('FORMS_FORM_FIELD_SELECT_DELETE_OPTION_DELETING'));

        $.post(ajaxurl, {action:'dopbsp_form_field_select_option_delete', 
                         id: id}, function(data){
            $('#DOPBSP-form-field-select-option-'+id).stop(true, true)
                                                     .animate({'opacity':0}, 
                                                     600, function(){
                $(this).remove();
                DOPBSPFormField.setSelectPreview(data);
            });
            DOPBSP.toggleMessages('success', DOPBSP.text('FORMS_FORM_FIELD_SELECT_DELETE_OPTION_SUCCESS'));
        }).fail(function(data){
            DOPBSP.toggleMessages('error', data.status+': '+data.statusText);
        });
    };
    
    return this.DOPBSPFormFieldSelectOption();
};