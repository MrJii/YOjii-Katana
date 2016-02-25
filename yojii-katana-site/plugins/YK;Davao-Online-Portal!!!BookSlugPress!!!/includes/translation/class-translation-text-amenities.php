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


    if (!class_exists('DOPBSPTranslationTextAmenities')){
        class DOPBSPTranslationTextAmenities{
            /*
             * Constructor
             */
            function DOPBSPTranslationTextAmenities(){
                /*
                 * Initialize amenities text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'amenities'));
            }

            /*
             * Amenities text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function amenities($text){
                array_push($text, array('key' => 'PARENT_AMENITIES',
                                        'parent' => '',
                                        'text' => 'Amenities'));
                
                array_push($text, array('key' => 'AMENITIES_TITLE',
                                        'parent' => 'PARENT_AMENITIES',
                                        'text' => 'Amenities'));
                
                return $text;
            }
        }
    }