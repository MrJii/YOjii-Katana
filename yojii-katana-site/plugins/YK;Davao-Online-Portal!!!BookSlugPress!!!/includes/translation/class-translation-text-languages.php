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


    if (!class_exists('DOPBSPTranslationTextLanguages')){
        class DOPBSPTranslationTextLanguages{
            /*
             * Constructor
             */
            function DOPBSPTranslationTextLanguages(){
                /*
                 * Initialize languages text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'languages'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'languagesHelp'));
            }
            
            /*
             * Languages text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function languages($text){
                array_push($text, array('key' => 'PARENT_LANGUAGES',
                                        'parent' => '',
                                        'text' => 'Languages'));
                
                array_push($text, array('key' => 'LANGUAGES_MANAGE',
                                        'parent' => 'PARENT_LANGUAGES',
                                        'text' => 'Manage languages'));
                array_push($text, array('key' => 'LANGUAGES_LOADED',
                                        'parent' => 'PARENT_LANGUAGES',
                                        'text' => 'Languages have been loaded.'));
                array_push($text, array('key' => 'LANGUAGES_SETTING',
                                        'parent' => 'PARENT_LANGUAGES',
                                        'text' => 'The language is being configured ...'));
                array_push($text, array('key' => 'LANGUAGES_SET_SUCCESS',
                                        'parent' => 'PARENT_LANGUAGES',
                                        'text' => 'The language has been added. The page will refresh shortly.'));
                array_push($text, array('key' => 'LANGUAGES_REMOVE_CONFIGURATION',
                                        'parent' => 'PARENT_LANGUAGES',
                                        'text' => 'Are you sure you want to remove this language? Data will be deleted only when you reset the translation!'));
                array_push($text, array('key' => 'LANGUAGES_REMOVING',
                                        'parent' => 'PARENT_LANGUAGES',
                                        'text' => 'The language is being removed ...'));
                array_push($text, array('key' => 'LANGUAGES_REMOVE_SUCCESS',
                                        'parent' => 'PARENT_LANGUAGES',
                                        'text' => 'The language has been removed. The page will refresh shortly.'));
                
                return $text;
            }            
            
            /*
             * Languages - Help text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function languagesHelp($text){
                array_push($text, array('key' => 'PARENT_LANGUAGES_HELP',
                                        'parent' => '',
                                        'text' => 'Languages - Help'));
                
                array_push($text, array('key' => 'LANGUAGES_HELP',
                                        'parent' => 'PARENT_LANGUAGES_HELP',
                                        'text' => 'If you need to use more language with the plugin go to "Manage langauges" section and enable them.'));
                
                return $text;
            }
        }
    }