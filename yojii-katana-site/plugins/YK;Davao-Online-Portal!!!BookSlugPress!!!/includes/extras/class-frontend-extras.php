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


    if (!class_exists('DOPBSPFrontEndExtras')){
        class DOPBSPFrontEndExtras extends DOPBSPFrontEnd{
            /*
             * Constructor.
             */
            function DOPBSPFrontEndExtras(){
            }
            
            /*
             * Get selected extra.
             * 
             * @param id (integer): extra ID
             * @param language (string): selected language
             * 
             * @return data array
             */
            function get($id,
                         $language = DOPBSP_CONFIG_TRANSLATION_DEFAULT_LANGUAGE){
                global $wpdb;
                global $DOPBSP;
                
                /*
                 * Get extra groups.
                 */
                $groups = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->extras_groups.' WHERE extra_id='.$id.' ORDER BY position');
                
                foreach ($groups as $group){
                    $group->translation = $DOPBSP->classes->translation->decodeJSON($group->translation,
                                                                                    $language);
                    
                    $items = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->extras_groups_items.' WHERE group_id='.$group->id.' ORDER BY position');

                    foreach ($items as $item){
                        $item->translation = $DOPBSP->classes->translation->decodeJSON($item->translation,
                                                                                       $language);
                    }
                    $group->group_items = $items;
                }
                
                return array('data' => array('extra' => $groups,
                                             'id' => $id),
                             'text' => array('byDay' => $DOPBSP->text('EXTRAS_FRONT_END_BY_DAY'),
                                             'byHour' => $DOPBSP->text('EXTRAS_FRONT_END_BY_HOUR'),
                                             'invalid' => $DOPBSP->text('EXTRAS_FRONT_END_INVALID'),
                                             'title' => $DOPBSP->text('EXTRAS_FRONT_END_TITLE')));
            }
        }
    }