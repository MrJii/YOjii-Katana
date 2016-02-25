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

    if (!class_exists('DOPBSPBackEndForms')){
        class DOPBSPBackEndForms extends DOPBSPBackEnd{
            /*
             * Constructor
             */
            function DOPBSPBackEndForms(){
            }
        
            /*
             * Prints out the forms page.
             * 
             * @return HTML page
             */
            function view(){
                global $DOPBSP;
                
                $DOPBSP->views->backend_forms->template();
            }
                
            /*
             * Display forms list.
             * 
             * @return forms list HTML
             */      
            function display(){
                global $wpdb;
                global $DOPBSP;
                                    
                $html = array();
                
                $forms = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->forms.' WHERE user_id='.wp_get_current_user()->ID.' OR user_id=0 ORDER BY id DESC');
                
                /* 
                 * Create forms list HTML.
                 */
                array_push($html, '<ul>');
                
                if ($wpdb->num_rows != 0){
                    if ($forms){
                        foreach ($forms as $form){
                            array_push($html, $this->listItem($form));
                        }
                    }
                }
                else{
                    array_push($html, '<li class="dopbsp-no-data">'.$DOPBSP->text('NO_FORMS').'</li>');
                }
                array_push($html, '</ul>');
                
                echo implode('', $html);
                
            	die();                
            }
            
            /*
             * Returns forms list item HTML.
             * 
             * @param form (object): form data
             * 
             * @return form list item HTML
             */
            function listItem($form){
                global $DOPBSP;
                
                $html = array();
                $user = get_userdata($form->user_id); // Get data about the user who created the form.
                
                array_push($html, '<li class="dopbsp-item" id="DOPBSP-form-ID-'.$form->id.'" onclick="DOPBSPForm.display('.$form->id.')">');
                array_push($html, ' <div class="dopbsp-header">');
                
                /*
                 * Display form ID.
                 */
                array_push($html, '     <span class="dopbsp-id">ID: '.$form->id.'</span>');
                
                /*
                 * Display data about the user who created the form.
                 */
                if ($form->user_id > 0){
                    array_push($html, '     <span class="dopbsp-header-item dopbsp-avatar">'.get_avatar($form->user_id, 17));
                    array_push($html, '         <span class="dopbsp-info">'.$DOPBSP->text('FORMS_CREATED_BY').': '.$user->data->display_name.'</span>');
                    array_push($html, '         <br class="dopbsp-clear" />');
                    array_push($html, '     </span>');
                }
                array_push($html, '     <br class="dopbsp-clear" />');
                array_push($html, ' </div>');
                array_push($html, ' <div class="dopbsp-name">'.($form->name == '' ? '&nbsp;':$form->name).'</div>');
                array_push($html, '</li>');
                
                return implode('', $html);
            }
        }
    }