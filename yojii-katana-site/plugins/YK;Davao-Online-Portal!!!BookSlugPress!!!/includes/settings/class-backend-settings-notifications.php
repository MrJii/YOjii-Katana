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


    if (!class_exists('DOPBSPBackEndSettingsNotifications')){
        class DOPBSPBackEndSettingsNotifications extends DOPBSPBackEndSettings{
            /*
             * Constructor
             */
            function DOPBSPBackEndSettingsNotifications(){
            }
            
            /*
             * Display notifications settings.
             * 
             * @post id (integer): calendar ID
             * 
             * @return emails settings HTML
             */
            function display(){
                global $DOPBSP;
                
                $DOPBSP->views->backend_settings_notifications->template(array('id' => $_POST['id']));
                
                die();
            }
        }
    }