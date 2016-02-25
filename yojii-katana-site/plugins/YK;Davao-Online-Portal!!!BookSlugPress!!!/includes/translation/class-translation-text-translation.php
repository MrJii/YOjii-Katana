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


    if (!class_exists('DOPBSPTranslationTextTranslation')){
        class DOPBSPTranslationTextTranslation{
            /*
             * Constructor
             */
            function DOPBSPTranslationTextTranslation(){
                /*
                 * Initialize translation text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'translation'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'translationHelp'));
            }
            
            /*
             * Translation text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function translation($text){
                array_push($text, array('key' => 'PARENT_TRANSLATION',
                                        'parent' => '',
                                        'text' => 'YOJii Translator'));
                
                array_push($text, array('key' => 'TRANSLATION_TITLE',
                                        'parent' => 'PARENT_TRANSLATION',
                                        'text' => 'YOJii Translator'));
                array_push($text, array('key' => 'TRANSLATION_SUBMIT',
                                        'parent' => 'PARENT_TRANSLATION',
                                        'text' => 'Manage YOJii Translator'));
                array_push($text, array('key' => 'TRANSLATION_LOADED',
                                        'parent' => 'PARENT_TRANSLATION',
                                        'text' => 'YOJii Translation has been loaded.'));
                array_push($text, array('key' => 'TRANSLATION_LANGUAGE',
                                        'parent' => 'PARENT_TRANSLATION',
                                        'text' => 'Select language'));
                array_push($text, array('key' => 'TRANSLATION_TEXT_GROUP',
                                        'parent' => 'PARENT_TRANSLATION',
                                        'text' => 'Select text group'));
                array_push($text, array('key' => 'TRANSLATION_TEXT_GROUP_ALL',
                                        'parent' => 'PARENT_TRANSLATION',
                                        'text' => 'All'));
                array_push($text, array('key' => 'TRANSLATION_SEARCH',
                                        'parent' => 'PARENT_TRANSLATION',
                                        'text' => 'Search'));
                
                array_push($text, array('key' => 'TRANSLATION_RESET',
                                        'parent' => 'PARENT_TRANSLATION',
                                        'text' => 'Reset YOJii Translator'));
                array_push($text, array('key' => 'TRANSLATION_RESET_CONFIRMATION',
                                        'parent' => 'PARENT_TRANSLATION',
                                        'text' => 'Are you sure you want to reset all translation data? All your modifications are going to be overwritten.'));
                array_push($text, array('key' => 'TRANSLATION_RESETING',
                                        'parent' => 'PARENT_TRANSLATION',
                                        'text' => 'YOJii Translation is resetting ...'));
                array_push($text, array('key' => 'TRANSLATION_RESET_SUCCESS',
                                        'parent' => 'PARENT_TRANSLATION',
                                        'text' => 'The YOJii Translation has reset. The page will refresh shortly.'));
                
                return $text;
            }            
            
            /*
             * Translation - Help text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function translationHelp($text){
                array_push($text, array('key' => 'PARENT_TRANSLATION_HELP',
                                        'parent' => '',
                                        'text' => 'Translation - Help'));
                
                array_push($text, array('key' => 'TRANSLATION_HELP',
                                        'parent' => 'PARENT_TRANSLATION_HELP',
                                        'text' => 'Select the language & text group you want to translate.'));
                array_push($text, array('key' => 'TRANSLATION_SEARCH_HELP',
                                        'parent' => 'PARENT_TRANSLATION_HELP',
                                        'text' => 'Use the search field to look & display the text you want.'));
                array_push($text, array('key' => 'TRANSLATION_RESET_HELP',
                                        'parent' => 'PARENT_TRANSLATION_HELP',
                                        'text' => 'If you want to use the translation that came with the plugin click "Reset translation" button. Note that all your modifications will be overwritten.'));
                
                return $text;
            }
        }
    }