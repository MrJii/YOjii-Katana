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


    if (!class_exists('DOPBSPTranslationTextEvents')){
        class DOPBSPTranslationTextEvents{
            /*
             * Constructor
             */
            function DOPBSPTranslationTextEvents(){
                /*
                 * Initialize events text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'events'));
            }

            /*
             * Events text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function events($text){
                array_push($text, array('key' => 'PARENT_EVENTS',
                                        'parent' => '',
                                        'text' => 'Events'));
                
                array_push($text, array('key' => 'EVENTS_TITLE',
                                        'parent' => 'PARENT_EVENTS',
                                        'text' => 'Events'));
                
                return $text;
            }
        }
    }