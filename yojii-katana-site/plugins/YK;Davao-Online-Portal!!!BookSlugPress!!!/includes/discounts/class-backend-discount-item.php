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


    if (!class_exists('DOPBSPBackEndDiscountItem')){
        class DOPBSPBackEndDiscountItem extends DOPBSPBackEndDiscountItems{
            /*
             * Constructor
             */
            function DOPBSPBackEndDiscountItem(){
            }
            
            /*
             * Add discount item.
             * 
             * @post discount_id (integer): discount ID
             * @post position (integer): item position
             * @post language (string): current item language
             * 
             * @return new item HTML
             */
            function add(){
                global $wpdb;
                global $DOPBSP;
                
                $discount_id = $_POST['discount_id'];
                $position = $_POST['position'];
                $language = $_POST['language'];
                
                $wpdb->insert($DOPBSP->tables->discounts_items, array('discount_id' => $discount_id,
                                                                      'position' => $position,
                                                                      'translation' => $DOPBSP->classes->translation->encodeJSON('DISCOUNTS_DISCOUNT_ADD_ITEM_LABEL')));
                $id = $wpdb->insert_id;
                $item = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->discounts_items.' WHERE id='.$id);
                
                $DOPBSP->views->backend_discount_item->template(array('item' => $item,
                                                              'language' => $language));
                
                die();
            }
            
            /*
             * Edit discount item.
             * 
             * @post id (integer): discount item ID
             * @post field (string): discount item field
             * @post value (string): discount item value
             * @post language (string): discount selected language
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
                    
                    $item_data = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$DOPBSP->tables->discounts_items.' WHERE id=%d',
                                                               $id));
                    
                    $translation = json_decode($item_data->translation);
                    $translation->$language = $value;
                    
                    $value = json_encode($translation);
                    $field = 'translation';
                }
                        
                $wpdb->update($DOPBSP->tables->discounts_items, array($field => $value), 
                                                                array('id' =>$id));
                
                die();
            }
            
            /*
             * Delete discount item.
             * 
             * @post id (integer): discount item ID
             */
            function delete(){
                global $wpdb;
                global $DOPBSP;
                
                $id = $_POST['id'];
                
                $wpdb->delete($DOPBSP->tables->discounts_items, array('id' => $id));
                $wpdb->delete($DOPBSP->tables->discounts_items_rules, array('discount_item_id' => $id));
                
                die();
            }
        }
    }