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


    if (!class_exists('DOPBSPBackEndSearch')){
        class DOPBSPBackEndSearch extends DOPBSPBackEndSearches{
            private $views;
            
            /*
             * Constructor
             */
            function DOPBSPBackEndSearch(){
            }
            
            /*
             * Add a search.
             */
            function add(){
                global $wpdb;
                global $DOPBSP;
                
                $wpdb->insert($DOPBSP->tables->searches, array('user_id' => wp_get_current_user()->ID,
                                                               'name' => $DOPBSP->text('SEARCHES_ADD_SEARCH_NAME'))); 
                $search_id = $wpdb->insert_id;
               
                /*
                 * Add search settings.
                 */
                $wpdb->insert($DOPBSP->tables->settings_search, array('search_id' => $search_id,
                                                                      'hours_definitions' => '[{"value": "00:00"},{"value": "01:00"},{"value": "02:00"},{"value": "03:00"},{"value": "04:00"},{"value": "05:00"},{"value": "06:00"},{"value": "07:00"},{"value": "08:00"},{"value": "09:00"},{"value": "10:00"},{"value": "11:00"},{"value": "12:00"},{"value": "13:00"},{"value": "14:00"},{"value": "15:00"},{"value": "16:00"},{"value": "17:00"},{"value": "18:00"},{"value": "19:00"},{"value": "20:00"},{"value": "21:00"},{"value": "22:00"},{"value": "23:00"}]'));
                
                echo $DOPBSP->classes->backend_searches->display();

            	die();
            }
            
            /*
             * Prints out the search.
             * 
             * @post id (integer): search ID
             * @post language (string): search current editing language
             * 
             * @return search HTML
             */
            function display(){
                global $DOPBSP;
                
                $id = $_POST['id'];
                $language = $_POST['language'];
                
                $DOPBSP->views->backend_search->template(array('id' => $id,
                                                               'language' => $language));
                
                die();
            }
            
            /*
             * Edit search fields.
             * 
             * @post id (integer): search ID
             * @post field (string): search field
             * @post value (string): search new value
             */
            function edit(){
                global $wpdb;  
                global $DOPBSP;
                
                $id = $_POST['id'];
                $field = $_POST['field'];
                $value = $_POST['value'];
                
                $wpdb->update($DOPBSP->tables->searches, array($field => $value), 
                                                         array('id' =>$id));
                
            	die();
            }
            
            /*
             * Delete search.
             * 
             * @post id (integer): search ID
             * 
             * @return number of searches left
             */
            function delete(){
                global $wpdb;
                global $DOPBSP;
                
                $id = $_POST['id'];

                /*
                 * Delete search.
                 */
                $wpdb->delete($DOPBSP->tables->searches, array('id' => $id));
                
                /*
                 * Delete search settings.
                 */
                $wpdb->delete($DOPBSP->tables->settings_search, array('search_id' => $id));
                
                /*
                 * Count the number of remaining searches.
                 */
                $searches = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->searches.' ORDER BY id DESC');
                
                echo $wpdb->num_rows;

            	die();
            }
        }
    }