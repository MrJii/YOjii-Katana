<?php
/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/


    if (!class_exists('DOPBSPFrontEndForms')){
        class DOPBSPFrontEndForms extends DOPBSPFrontEnd{
            /*
             * Constructor.
             */
            function DOPBSPFrontEndForms(){
            }
            
            /*
             * Get selected form.
             * 
             * @param id (integer): form ID
             * @param language (string): selected language
             * 
             * @return data array
             */
            function get($id,
                         $language = DOPBSP_CONFIG_TRANSLATION_DEFAULT_LANGUAGE){
                global $wpdb;
                global $DOPBSP;
                
                $fields = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->forms_fields.' WHERE form_id='.$id.' ORDER BY position');
                
                foreach ($fields as $field){
                    $field->translation = $DOPBSP->classes->translation->decodeJSON($field->translation,
                                                                                    $language);
                    
                    if ($field->type == 'select'){
                        $options = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->forms_fields_options.' WHERE field_id='.$field->id.' ORDER BY position');
                        
                        foreach ($options as $option){
                            $option->translation = $DOPBSP->classes->translation->decodeJSON($option->translation,
                                                                                             $language);
                        }
                        $field->options = $options;
                    }
                }
                
                return array('data' => array('form' => $fields,
                                             'id' => $id),
                             'text' => array('checked' => $DOPBSP->text('FORMS_FORM_FIELD_TYPE_CHECKBOX_CHECKED_LABEL'),
                                             'invalidEmail' => $DOPBSP->text('FORMS_FRONT_END_INVALID_EMAIL'),
                                             'required' => $DOPBSP->text('FORMS_FRONT_END_REQUIRED'),
                                             'title' => $DOPBSP->text('FORMS_FRONT_END_TITLE'),
                                             'unchecked' => $DOPBSP->text('FORMS_FORM_FIELD_TYPE_CHECKBOX_UNCHECKED_LABEL')));
            }
        }
    }