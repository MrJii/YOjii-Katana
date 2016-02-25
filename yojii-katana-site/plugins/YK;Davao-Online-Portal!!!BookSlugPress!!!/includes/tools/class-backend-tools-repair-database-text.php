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


    if (!class_exists('DOPBSPBackEndToolsRepairDatabaseText')){
        class DOPBSPBackEndToolsRepairDatabaseText extends DOPBSPBackEndTools{
            /*
             * Constructor
             */
            function DOPBSPBackEndToolsRepairDatabaseText(){
            }
            
            /*
             * Repair database & text call.
             * 
             * @post dopbsp_repair_database_text (boolean): start signal
             */
            function set(){
                echo admin_url('admin.php?page=dopbsp');
                
                die();
            }
        }
    }