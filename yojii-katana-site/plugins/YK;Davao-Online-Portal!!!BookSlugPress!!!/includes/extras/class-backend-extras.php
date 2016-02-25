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


    if (!class_exists('DOPBSPBackEndExtras')){
        class DOPBSPBackEndExtras extends DOPBSPBackEnd{
            /*
             * Constructor
             */
            function DOPBSPBackEndExtras(){
            }
        
            /*
             * Prints out the extras page.
             * 
             * @return HTML page
             */
            function view(){
                global $DOPBSP;
                
                $DOPBSP->views->backend_extras->template();
            }
                
            /*
             * Display extras list.
             * 
             * @return extras list HTML
             */      
            function display(){
                global $wpdb;
                global $DOPBSP;
                                    
                $html = array();
                
                $extras = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->extras.' WHERE user_id='.wp_get_current_user()->ID.' OR user_id=0 ORDER BY id DESC');
                
                /* 
                 * Create extras list HTML.
                 */
                array_push($html, '<ul>');
                
                if ($wpdb->num_rows != 0){
                    if ($extras){
                        foreach ($extras as $extra){
                            array_push($html, $this->listItem($extra));
                        }
                    }
                }
                else{
                    array_push($html, '<li class="dopbsp-no-data">'.$DOPBSP->text('NO_EXTRAS').'</li>');
                }
                array_push($html, '</ul>');
                
                echo implode('', $html);
                
            	die();                
            }
            
            /*
             * Returns extras list item HTML.
             * 
             * @param extra (object): extra data
             * 
             * @return extra list item HTML
             */
            function listItem($extra){
                global $DOPBSP;
                
                $html = array();
                $user = get_userdata($extra->user_id); // Get data about the user who created the extras.
                
                array_push($html, '<li class="dopbsp-item" id="DOPBSP-extra-ID-'.$extra->id.'" onclick="DOPBSPExtra.display('.$extra->id.')">');
                array_push($html, ' <div class="dopbsp-header">');
                
                /*
                 * Display extra ID.
                 */
                array_push($html, '     <span class="dopbsp-id">ID: '.$extra->id.'</span>');
                
                /*
                 * Display data about the user who created the extra.
                 */
                if ($extra->user_id > 0){
                    array_push($html, '     <span class="dopbsp-header-item dopbsp-avatar">'.get_avatar($extra->user_id, 17));
                    array_push($html, '         <span class="dopbsp-info">'.$DOPBSP->text('EXTRAS_CREATED_BY').': '.$user->data->display_name.'</span>');
                    array_push($html, '         <br class="dopbsp-clear" />');
                    array_push($html, '     </span>');
                }
                array_push($html, '     <br class="dopbsp-clear" />');
                array_push($html, ' </div>');
                array_push($html, ' <div class="dopbsp-name">'.($extra->name == '' ? '&nbsp;':$extra->name).'</div>');
                array_push($html, '</li>');
                
                return implode('', $html);
            }
        }
    }