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


    if (!class_exists('DOPBSPTranslationTextWidgets')){
        class DOPBSPTranslationTextWidgets{
            /*
             * Constructor
             */
            function DOPBSPTranslationTextWidgets(){
                /*
                 * Initialize widgets text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'widget'));
            }
            
            /*
             * Widget text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function widget($text){
                array_push($text, array('key' => 'PARENT_WIDGET',
                                        'parent' => '',
                                        'text' => 'Widget'));
                
                array_push($text, array('key' => 'WIDGET_TITLE',
                                        'parent' => 'PARENT_WIDGET',
                                        'text' => 'DOP Module'));
                array_push($text, array('key' => 'WIDGET_DESCRIPTION',
                                        'parent' => 'PARENT_WIDGET',
                                        'text' => 'Select option you want to appear in the widget and ID(s) of the calendar(s).'));
                array_push($text, array('key' => 'WIDGET_TITLE_LABEL',
                                        'parent' => 'PARENT_WIDGET',
                                        'text' => 'Title:'));
                array_push($text, array('key' => 'WIDGET_SELECTION_LABEL',
                                        'parent' => 'PARENT_WIDGET',
                                        'text' => 'Select action:'));
                array_push($text, array('key' => 'WIDGET_SELECTION_ADD_CALENDAR',
                                        'parent' => 'PARENT_WIDGET',
                                        'text' => 'Add room'));
                array_push($text, array('key' => 'WIDGET_SELECTION_ADD_SIDEBAR',
                                        'parent' => 'PARENT_WIDGET',
                                        'text' => 'Add calendar sidebar'));
                array_push($text, array('key' => 'WIDGET_ID_LABEL',
                                        'parent' => 'PARENT_WIDGET',
                                        'text' => 'Select calendar ID:'));
                array_push($text, array('key' => 'WIDGET_NO_CALENDARS',
                                        'parent' => 'PARENT_WIDGET',
                                        'text' => 'No calendars.'));
                array_push($text, array('key' => 'WIDGET_LANGUAGE_LABEL',
                                        'parent' => 'PARENT_WIDGET',
                                        'text' => 'Select language:'));
                
                return $text;
            }
        }
    }