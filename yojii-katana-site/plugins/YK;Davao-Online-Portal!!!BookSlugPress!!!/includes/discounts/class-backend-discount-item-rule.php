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


    if (!class_exists('DOPBSPBackEndDiscountItemRule')){
        class DOPBSPBackEndDiscountItemRule extends DOPBSPBackEndDiscountItemRules{
            /*
             * Constructor
             */
            function DOPBSPBackEndDiscountItemRule(){
            }
            
            /*
             * Add discount item rule.
             * 
             * @post item_id (integer): item ID
             * @post position (integer): item rule position
             * @post language (string): current item rule language
             * 
             * @return new item HTML
             */
            function add(){
                global $wpdb;
                global $DOPBSP;
                
                $item_id = $_POST['item_id'];
                $position = $_POST['position'];
                $language = $_POST['language'];
                
                $wpdb->insert($DOPBSP->tables->discounts_items_rules, array('discount_item_id' => $item_id,
                                                                            'position' => $position));
                $id = $wpdb->insert_id;
                $rule = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->discounts_items_rules.' WHERE id='.$id);
                
                $DOPBSP->views->backend_discount_item_rule->template(array('rule' => $rule,
                                                                   'language' => $language));
                
                die();
            }
            
            /*
             * Edit discount item rule.
             * 
             * @post id (integer): item rule ID
             * @post field (string): item rule field
             * @post value (string): item rule value
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
                    
                    $item_data = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$DOPBSP->tables->discounts_items_rules.' WHERE id=%d',
                                                               $id));
                    
                    $translation = json_decode($item_data->translation);
                    $translation->$language = $value;
                    
                    $value = json_encode($translation);
                    $field = 'translation';
                }
                        
                $wpdb->update($DOPBSP->tables->discounts_items_rules, array($field => $value), 
                                                                      array('id' => $id));
                
                die();
            }
            
            /*
             * Delete discount item rule.
             * 
             * @post id (integer): item rule ID
             */
            function delete(){
                global $wpdb;
                global $DOPBSP;
                
                $id = $_POST['id'];
                
                $wpdb->delete($DOPBSP->tables->discounts_items_rules, array('id' => $id));
                
                die();
            }
        }
    }