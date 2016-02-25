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


    if (!class_exists('DOPBSPFrontEndDiscounts')){
        class DOPBSPFrontEndDiscounts extends DOPBSPFrontEnd{
            /*
             * Constructor.
             */
            function DOPBSPFrontEndDiscounts(){
            }
            
            /*
             * Get selected discount.
             * 
             * @param id (integer): discount ID
             * @param language (string): selected language
             * 
             * @return data array
             */
            function get($id,
                         $language = DOPBSP_CONFIG_TRANSLATION_DEFAULT_LANGUAGE){
                global $wpdb;
                global $DOPBSP;
                
                $discount = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->discounts.' WHERE id='.$id);
                $items = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->discounts_items.' WHERE discount_id='.$id.' ORDER BY position');
                
                foreach ($items as $item){
                    $item->translation = $DOPBSP->classes->translation->decodeJSON($item->translation,
                                                                                   $language);
                    
                    $rules = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->discounts_items_rules.' WHERE discount_item_id='.$item->id.' ORDER BY position');

                    $item->rules = $rules;
                }
                
                return array('data' => array('discount' => $items,
                                             'extras' => isset($discount->extras) && $discount->extras == 'true' ? true:false,
                                             'id' => $id),
                             'text' => array('byDay' => $DOPBSP->text('DISCOUNTS_FRONT_END_BY_DAY'),
                                             'byHour' => $DOPBSP->text('DISCOUNTS_FRONT_END_BY_HOUR'),
                                             'title' => $DOPBSP->text('DISCOUNTS_FRONT_END_TITLE')));
            }
        }
    }