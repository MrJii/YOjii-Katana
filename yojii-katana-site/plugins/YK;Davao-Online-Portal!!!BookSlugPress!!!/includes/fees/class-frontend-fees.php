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


    if (!class_exists('DOPBSPFrontEndFees')){
        class DOPBSPFrontEndFees extends DOPBSPFrontEnd{
            /*
             * Constructor.
             */
            function DOPBSPFrontEndFees(){
            }
            
            /*
             * Get selected fees.
             * 
             * @param ids (string): fees IDs
             * @param language (string): selected language
             * 
             * @return data array
             */
            function get($ids,
                         $language = DOPBSP_CONFIG_TRANSLATION_DEFAULT_LANGUAGE){
                global $wpdb;
                global $DOPBSP;
                
                if ($ids != ''){
                    $where_query = array();
                    $ids_list = explode(',', $ids);

                    foreach ($ids_list as $id){
                        array_push($where_query, 'id='.$id);
                    }

                    $fees = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->fees.' WHERE '.implode(' OR ', $where_query).' ORDER BY id');

                    foreach ($fees as $fee){
                        $fee->translation = $DOPBSP->classes->translation->decodeJSON($fee->translation,
                                                                                      $language);
                    }

                    return array('data' => array('fees' => $fees),
                                 'text' => array('byDay' => $DOPBSP->text('FEES_FRONT_END_BY_DAY'),
                                                 'byHour' => $DOPBSP->text('FEES_FRONT_END_BY_HOUR'),
                                                 'included' => $DOPBSP->text('FEES_FRONT_END_INCLUDED'),
                                                 'title' => $DOPBSP->text('FEES_FRONT_END_TITLE')));
                }
                else{
                    return array('data' => array('fees' => array()),
                                 'text' => array('byDay' => $DOPBSP->text('FEES_FRONT_END_BY_DAY'),
                                                 'byHour' => $DOPBSP->text('FEES_FRONT_END_BY_HOUR'),
                                                 'included' => $DOPBSP->text('FEES_FRONT_END_INCLUDED'),
                                                 'title' => $DOPBSP->text('FEES_FRONT_END_TITLE')));
                }
            }
        }
    }