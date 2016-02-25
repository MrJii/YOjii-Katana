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


    if (!class_exists('DOPBSPBackEndSettings')){
        class DOPBSPBackEndSettings extends DOPBSPBackEnd{
            /*
             * Constructor
             */
            function DOPBSPBackEndSettings(){
            }
        
            /*
             * Prints out the settings page.
             */
            function view(){
                global $DOPBSP;
                
                $DOPBSP->views->backend_settings->template();
            }
            
            /*
             * Edit settings.
             * 
             * @post id (integer): calendar ID
             * @post settings_type (integer): settings type
             * @post field (string): option database field
             * @post value (combined): the value with which the option will be modified
             */
            function set(){
                global $wpdb;
                global $DOPBSP;
                
                $id = $_POST['id'];
                $settings_type = $_POST['settings_type'];
                $field = $_POST['field'];
                $value = $field == 'hours_definitions' ? json_encode($_POST['value']):$_POST['value'];
                
                switch ($settings_type){
                    case 'notifications':
                        $table = $DOPBSP->tables->settings_notifications;
                        break;
                    case 'payment':
                        $table = $DOPBSP->tables->settings_payment;
                        break;
                    case 'search':
                        $table = $DOPBSP->tables->settings_search;
                        break;
                    default:
                        $table = $DOPBSP->tables->settings_calendar;
                }
                
                $wpdb->update($table, array($field => $value), 
                                      array('id' => $id));
                
                die();
            }
        }
    }