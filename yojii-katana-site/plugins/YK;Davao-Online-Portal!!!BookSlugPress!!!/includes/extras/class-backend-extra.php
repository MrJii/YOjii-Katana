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


    if (!class_exists('DOPBSPBackEndExtra')){
        class DOPBSPBackEndExtra extends DOPBSPBackEndExtras{
            /*
             * Constructor
             */
            function DOPBSPBackEndExtra(){
            }
            
            /*
             * Add a extra.
             */
            function add(){
                global $wpdb;
                global $DOPBSP;
                                
                $wpdb->insert($DOPBSP->tables->extras, array('user_id' => wp_get_current_user()->ID,
                                                             'name' => $DOPBSP->text('EXTRAS_ADD_EXTRA_NAME'))); 
                echo $DOPBSP->classes->backend_extras->display();

            	die();
            }
            
            /*
             * Prints out the extra.
             * 
             * @post id (integer): extra ID
             * @post language (string): extra current editing language
             * 
             * @return extra HTML
             */
            function display(){
                global $DOPBSP;
                
                $id = $_POST['id'];
                $language = $_POST['language'];
                
                $DOPBSP->views->backend_extra->template(array('id' => $id,
                                                              'language' => $language));
                $DOPBSP->views->backend_extra_groups->template(array('id' => $id,
                                                                     'language' => $language));
                
                die();
            }
            
            /*
             * Edit extra fields.
             * 
             * @post id (integer): extra ID
             * @post field (string): extra field
             * @post value (string): group new value
             */
            function edit(){
                global $wpdb; 
                global $DOPBSP; 
                
                $wpdb->update($DOPBSP->tables->extras, array($_POST['field'] => $_POST['value']), 
                                                       array('id' => $_POST['id']));
                
            	die();
            }
            
            /*
             * Delete extra.
             * 
             * @post id (integer): extra ID
             * 
             * @return number of extras left
             */
            function delete(){
                global $wpdb;
                global $DOPBSP;
                
                $id = $_POST['id'];

                /*
                 * Delete extra.
                 */
                $wpdb->delete($DOPBSP->tables->extras, array('id' => $id));
                
                /*
                 * Delete extra groups.
                 */
                $groups = $wpdb->get_results($wpdb->prepare('SELECT * FROM '.$DOPBSP->tables->extras_groups.' WHERE extra_id=%d', 
                                                            $id));
                $wpdb->delete($DOPBSP->tables->extras_groups, array('extra_id' => $id));
                
                /*
                 * Delete extra groups items.
                 */
                foreach($groups as $group){
                    $wpdb->delete($DOPBSP->tables->extras_groups_items, array('group_id' => $group->id));
                }
                
                $extras = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->extras.' ORDER BY id DESC');
                
                echo $wpdb->num_rows;

            	die();
            }
        }
    }