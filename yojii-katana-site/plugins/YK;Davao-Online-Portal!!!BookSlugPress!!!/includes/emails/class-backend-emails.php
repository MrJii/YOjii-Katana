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


    if (!class_exists('DOPBSPBackEndEmails')){
        class DOPBSPBackEndEmails extends DOPBSPBackEnd{
            /*
             * Constructor
             */
            function DOPBSPBackEndEmails(){
            }
        
            /*
             * Prints out the emails page.
             * 
             * @return HTML page
             */
            function view(){
                global $DOPBSP;
                
                $DOPBSP->views->backend_emails->template();
            }
                
            /*
             * Display emails list.
             * 
             * @return emails list HTML
             */      
            function display(){
                global $wpdb;
                global $DOPBSP;
                                    
                $html = array();
                
                $emails = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->emails.' WHERE user_id='.wp_get_current_user()->ID.' OR user_id=0 ORDER BY id DESC');
                
                /* 
                 * Create emails list HTML.
                 */
                array_push($html, '<ul>');
                
                if ($wpdb->num_rows != 0){
                    if ($emails){
                        foreach ($emails as $email){
                            array_push($html, $this->listItem($email));
                        }
                    }
                }
                else{
                    array_push($html, '<li class="dopbsp-no-data">'.$DOPBSP->text('EMAILS_NO_EMAILS').'</li>');
                }
                array_push($html, '</ul>');
                
                echo implode('', $html);
                
            	die();                
            }
            
            /*
             * Returns emails list item HTML.
             * 
             * @param email (object): email data
             * 
             * @return email list item HTML
             */
            function listItem($email){
                global $DOPBSP;
                
                $html = array();
                $user = get_userdata($email->user_id); // Get data about the user who created the emails.
                
                array_push($html, '<li class="dopbsp-item" id="DOPBSP-email-ID-'.$email->id.'" onclick="DOPBSPEmail.display('.$email->id.')">');
                array_push($html, ' <div class="dopbsp-header">');
                
                /*
                 * Display email ID.
                 */
                array_push($html, '     <span class="dopbsp-id">ID: '.$email->id.'</span>');
                
                /*
                 * Display data about the user who created the email.
                 */
                if ($email->user_id > 0){
                    array_push($html, '     <span class="dopbsp-header-item dopbsp-avatar">'.get_avatar($email->user_id, 17));
                    array_push($html, '         <span class="dopbsp-info">'.$DOPBSP->text('EMAILS_CREATED_BY').': '.$user->data->display_name.'</span>');
                    array_push($html, '         <br class="dopbsp-clear" />');
                    array_push($html, '     </span>');
                }
                array_push($html, '     <br class="dopbsp-clear" />');
                array_push($html, ' </div>');
                array_push($html, ' <div class="dopbsp-name">'.($email->name == '' ? '&nbsp;':$email->name).'</div>');
                array_push($html, '</li>');
                
                return implode('', $html);
            }
        }
    }