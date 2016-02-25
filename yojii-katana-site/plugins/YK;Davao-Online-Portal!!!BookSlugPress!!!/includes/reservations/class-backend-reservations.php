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


    if (!class_exists('DOPBSPBackEndReservations')){
        class DOPBSPBackEndReservations extends DOPBSPBackEnd{
            /*
             * Constructor.
             */
            function DOPBSPBackEndReservations(){
            }

            /*
             * Prints out the reservations page.
             * 
             * @return HTML page
             */        
            function view(){
                global $DOPBSP;
                
                /*
                 * Check if reservations have expired each time you open the reservations page.
                 */
                $this->clean();
                
                /*
                 * Display reservations template.
                 */
                $DOPBSP->views->backend_reservations->template();
            }
            
            /*
             * Set reservations status to expired if check out day has passed.
             */
            function clean(){
                global $wpdb;
                global $DOPBSP;
                
                $wpdb->query('DELETE FROM '.$DOPBSP->tables->reservations. ' WHERE token <> "" AND ((check_out < \''.date('Y-m-d').'\' AND check_out <> \'\') OR (check_in < \''.date('Y-m-d').'\' AND check_out = \'\'))');
                $wpdb->query('UPDATE '.$DOPBSP->tables->reservations.' SET status="expired" WHERE status <> "expired" AND ((check_out < \''.date('Y-m-d').'\' AND check_out <> \'\') OR (check_in < \''.date('Y-m-d').'\' AND check_out = \'\'))');
            }
        }
    }