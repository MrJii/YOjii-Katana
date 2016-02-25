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


    if (!class_exists('DOPBSPFrontEndRules')){
        class DOPBSPFrontEndRules extends DOPBSPFrontEnd{
            /*
             * Constructor.
             */
            function DOPBSPFrontEndRules(){
            }
            
            /*
             * Get selected rule.
             * 
             * @param id (integer): rule ID
             * 
             * @return data array
             */
            function get($id){
                global $wpdb;
                global $DOPBSP;
                
                $rule = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->rules.' WHERE id='.$id.' ORDER BY id');
                
                return array('data' => array('rule' => $rule,
                                             'id' => $id),
                             'text' => array('maxTimeLapseDaysWarning' => $DOPBSP->text('RULES_FRONT_END_MAX_TIME_LAPSE_DAYS_WARNING'),
                                             'maxTimeLapseHoursWarning' => $DOPBSP->text('RULES_FRONT_END_MAX_TIME_LAPSE_HOURS_WARNING'),
                                             'minTimeLapseDaysWarning' => $DOPBSP->text('RULES_FRONT_END_MIN_TIME_LAPSE_DAYS_WARNING'),
                                             'minTimeLapseHoursWarning' => $DOPBSP->text('RULES_FRONT_END_MIN_TIME_LAPSE_HOURS_WARNING')));
            }
        }
    }