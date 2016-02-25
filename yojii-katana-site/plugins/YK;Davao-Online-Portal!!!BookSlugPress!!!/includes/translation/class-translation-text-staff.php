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


    if (!class_exists('DOPBSPTranslationTextStaff')){
        class DOPBSPTranslationTextStaff{
            /*
             * Constructor
             */
            function DOPBSPTranslationTextStaff(){
                /*
                 * Initialize staff text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'staff'));
            }

            /*
             * Staff text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function staff($text){
                array_push($text, array('key' => 'PARENT_STAFF',
                                        'parent' => '',
                                        'text' => 'Staff'));
                
                array_push($text, array('key' => 'STAFF_TITLE',
                                        'parent' => 'PARENT_STAFF',
                                        'text' => 'Staff'));
                
                return $text;
            }
        }
    }