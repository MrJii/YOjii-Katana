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


    if (!class_exists('DOPBSPBackEndFee')){
        class DOPBSPBackEndFee extends DOPBSPBackEndFees{
            private $views;
            
            /*
             * Constructor
             */
            function DOPBSPBackEndFee(){
            }
            
            /*
             * Add a fee.
             */
            function add(){
                global $wpdb;
                global $DOPBSP;
                
                $wpdb->insert($DOPBSP->tables->fees, array('user_id' => wp_get_current_user()->ID,
                                                           'name' => $DOPBSP->text('FEES_ADD_FEE_NAME'),
                                                           'translation' => $DOPBSP->classes->translation->encodeJSON('FEES_ADD_FEE_LABEL'))); 
                
                echo $DOPBSP->classes->backend_fees->display();

            	die();
            }
            
            /*
             * Prints out the fee.
             * 
             * @post id (integer): fee ID
             * @post language (string): fee current editing language
             * 
             * @return fee HTML
             */
            function display(){
                global $DOPBSP;
                
                $id = $_POST['id'];
                $language = $_POST['language'];
                
                $DOPBSP->views->backend_fee->template(array('id' => $id,
                                                    'language' => $language));
                
                die();
            }
            
            /*
             * Edit fee fields.
             * 
             * @post id (integer): fee ID
             * @post field (string): fee field
             * @post value (string): fee new value
             * @post language (string): fee selected language
             */
            function edit(){
                global $wpdb;  
                global $DOPBSP;
                
                $id = $_POST['id'];
                $field = $_POST['field'];
                $value = $_POST['value'];
                $language = $_POST['language'];
                
                if ($field == 'label'){
                    $value = str_replace("\n", '<<new-line>>', $value);
                    $value = str_replace("\'", '<<single-quote>>', $value);
                    $value = utf8_encode($value);
                    
                    $fee_data = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$DOPBSP->tables->fees.' WHERE id=%d', 
                                                              $id));
                    
                    $translation = json_decode($fee_data->translation);
                    $translation->$language = $value;
                    
                    $value = json_encode($translation);
                    $field = 'translation';
                }
                        
                $wpdb->update($DOPBSP->tables->fees, array($field => $value), 
                                                     array('id' =>$id));
                
            	die();
            }
            
            /*
             * Delete fee.
             * 
             * @post id (integer): fee ID
             * 
             * @return number of fees left
             */
            function delete(){
                global $wpdb;
                global $DOPBSP;
                
                $id = $_POST['id'];

                /*
                 * Delete fee.
                 */
                $wpdb->delete($DOPBSP->tables->fees, array('id' => $id));
                $fees = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->fees.' ORDER BY id DESC');
                
                echo $wpdb->num_rows;

            	die();
            }
        }
    }