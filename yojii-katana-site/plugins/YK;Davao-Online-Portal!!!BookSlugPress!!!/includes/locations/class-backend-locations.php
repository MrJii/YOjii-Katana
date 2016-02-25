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


    if (!class_exists('DOPBSPBackEndLocations')){
        class DOPBSPBackEndLocations extends DOPBSPBackEnd{
            /*
             * Constructor
             */
            function DOPBSPBackEndLocations(){
            }
        
            /*
             * Prints out the locations page.
             * 
             * @return HTML page
             */
            function view(){
                global $DOPBSP;
                
                $DOPBSP->views->backend_locations->template();
            }
                
            /*
             * Display locations list.
             * 
             * @return locations list HTML
             */      
            function display(){
                global $wpdb;
                global $DOPBSP;
                                    
                $html = array();
                
                $locations = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->locations.' WHERE user_id='.wp_get_current_user()->ID.' OR user_id=0 ORDER BY id DESC');
                
                /* 
                 * Create locations list HTML.
                 */
                array_push($html, '<ul>');
                
                if ($wpdb->num_rows != 0){
                    if ($locations){
                        foreach ($locations as $location){
                            array_push($html, $this->listItem($location));
                        }
                    }
                }
                else{
                    array_push($html, '<li class="dopbsp-no-data">'.$DOPBSP->text('LOCATIONS_NO_LOCATIONS').'</li>');
                }
                array_push($html, '</ul>');
                
                echo implode('', $html);
                
            	die();                
            }
            
            /*
             * Returns locations list item HTML.
             * 
             * @param location (object): location data
             * 
             * @return location list item HTML
             */
            function listItem($location){
                global $DOPBSP;
                
                $html = array();
                $user = get_userdata($location->user_id); // Get data about the user who created the locations.
                
                array_push($html, '<li class="dopbsp-item" id="DOPBSP-location-ID-'.$location->id.'" onclick="DOPBSPLocation.display('.$location->id.')">');
                array_push($html, ' <div class="dopbsp-header">');
                
                /*
                 * Display location ID.
                 */
                array_push($html, '     <span class="dopbsp-id">ID: '.$location->id.'</span>');
                
                /*
                 * Display data about the user who created the location.
                 */
                if ($location->user_id > 0){
                    array_push($html, '     <span class="dopbsp-header-item dopbsp-avatar">'.get_avatar($location->user_id, 17));
                    array_push($html, '         <span class="dopbsp-info">'.$DOPBSP->text('LOCATIONS_CREATED_BY').': '.$user->data->display_name.'</span>');
                    array_push($html, '         <br class="dopbsp-clear" />');
                    array_push($html, '     </span>');
                }
                array_push($html, '     <br class="dopbsp-clear" />');
                array_push($html, ' </div>');
                array_push($html, ' <div class="dopbsp-name">'.($location->name == '' ? '&nbsp;':$location->name).'</div>');
                array_push($html, '</li>');
                
                return implode('', $html);
            }
        }
    }