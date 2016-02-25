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


    if (!class_exists('DOPBSPTranslationTextAddons')){
        class DOPBSPTranslationTextAddons{
            /*
             * Constructor
             */
            function DOPBSPTranslationTextAddons(){
                /*
                 * Initialize addons text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'addons'));
            }

            /*
             * Addons text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function addons($text){
                array_push($text, array('key' => 'PARENT_ADDONS',
                                        'parent' => '',
                                        'text' => 'Addons'));
                
                array_push($text, array('key' => 'ADDONS_TITLE',
                                        'parent' => 'PARENT_ADDONS',
                                        'text' => 'Addons'));
                
                return $text;
            }
        }
    }