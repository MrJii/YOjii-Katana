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


    if (!class_exists('DOPBSPTranslationTextCustomPosts')){
        class DOPBSPTranslationTextCustomPosts{
            /*
             * Constructor
             */
            function DOPBSPTranslationTextCustomPosts(){
                /*
                 * Initialize custom posts text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'customPosts'));
            }
            
            /*
             * Custom posts text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function customPosts($text){
                array_push($text, array('key' => 'PARENT_CUSTOM_POSTS',
                                        'parent' => '',
                                        'text' => 'Custom posts'));
                
                array_push($text, array('key' => 'CUSTOM_POSTS',
                                        'parent' => 'PARENT_CUSTOM_POSTS',
                                        'text' => 'Publish Custom Room'));
                array_push($text, array('key' => 'CUSTOM_POSTS_ADD_ALL',
                                        'parent' => 'PARENT_CUSTOM_POSTS',
                                        'text' => 'Posts'));
                array_push($text, array('key' => 'CUSTOM_POSTS_ADD',
                                        'parent' => 'PARENT_CUSTOM_POSTS',
                                        'text' => 'Add new Room custom post'));
                array_push($text, array('key' => 'CUSTOM_POSTS_EDIT',
                                        'parent' => 'PARENT_CUSTOM_POSTS',
                                        'text' => 'Edit Room custom post'));
                array_push($text, array('key' => 'CUSTOM_POSTS_BOOKING_SYSTEM',
                                        'parent' => 'PARENT_CUSTOM_POSTS',
                                        'text' => 'DOP Module'));
                
                return $text;
            }
        }
    }