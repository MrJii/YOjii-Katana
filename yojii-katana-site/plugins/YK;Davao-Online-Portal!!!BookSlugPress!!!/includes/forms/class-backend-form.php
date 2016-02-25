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


    if (!class_exists('DOPBSPBackEndForm')){
        class DOPBSPBackEndForm extends DOPBSPBackEndForms{
            /*
             * Constructor
             */
            function DOPBSPBackEndForm(){
            }
            
            /*
             * Add a form.
             */
            function add(){
                global $wpdb;
                global $DOPBSP;
                                
                $wpdb->insert($DOPBSP->tables->forms, array('user_id' => wp_get_current_user()->ID,
                                                            'name' => $DOPBSP->text('FORMS_ADD_FORM_NAME'))); 
                echo $DOPBSP->classes->backend_forms->display();

            	die();
            }
            
            /*
             * Prints out the form.
             * 
             * @post id (integer): form ID
             * @post language (string): form current editing language
             * 
             * @return form HTML
             */
            function display(){
                global $DOPBSP;
                
                $id = $_POST['id'];
                $language = $_POST['language'];
                
                $DOPBSP->views->backend_form->template(array('id' => $id,
                                                     'language' => $language));
                $DOPBSP->views->backend_form_fields->template(array('id' => $id,
                                                            'language' => $language));
                
                die();
            }
            
            /*
             * Edit form fields.
             * 
             * @post id (integer): form ID
             * @post field (string): form field
             * @post value (string): field new value
             */
            function edit(){
                global $wpdb;  
                global $DOPBSP;
                
                $wpdb->update($DOPBSP->tables->forms, array($_POST['field'] => $_POST['value']), 
                                                      array('id' => $_POST['id']));
                
            	die();
            }
            
            /*
             * Delete form.
             * 
             * @post id (integer): form ID
             * 
             * @return number of forms left
             */
            function delete(){
                global $wpdb;
                global $DOPBSP;
                
                $id = $_POST['id'];

                /*
                 * Delete form.
                 */
                $wpdb->delete($DOPBSP->tables->forms, array('id' => $id));
                
                /*
                 * Delete form fields.
                 */
                $fields = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$DOPBSP->tables->forms_fields.' WHERE form_id=%d', 
                                                            $id));
                $wpdb->delete($DOPBSP->tables->forms_fields, array('form_id' => $id));
                
                /*
                 * Delete form fields select options.
                 */
                foreach($fields as $field){
                    $wpdb->delete($DOPBSP->tables->forms_fields_options, array('field_id' => $field->id));
                }
                
                $forms = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->forms.' ORDER BY id DESC');
                
                echo $wpdb->num_rows;

            	die();
            }
        }
    }