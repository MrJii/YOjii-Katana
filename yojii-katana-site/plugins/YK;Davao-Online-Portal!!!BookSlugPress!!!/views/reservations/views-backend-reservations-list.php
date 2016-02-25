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


    if (!class_exists('DOPBSPViewsBackEndReservationsList')){
        class DOPBSPViewsBackEndReservationsList extends DOPBSPViewsBackEndReservations{
            /*
             * Constructor
             */
            function DOPBSPViewsBackEndReservationsList(){
            }
            
            /*
             * Returns reservations template.
             * 
             * @param args (array): function arguments
             *                      * reservations (array): reservations list
             * 
             * @return reservations HTML page
             */
            function template($args = array()){
                global $DOPBSP;
                
                $reservations = $args['reservations'];
?>
                <ul class="dopbsp-reservations-list">
<?php
                /*
                 * Check if reservations exist.
                 */
                if (count($reservations) > 0){
                    foreach ($reservations as $reservation){
                        $DOPBSP->views->backend_reservation->template(array('reservation' => $reservation));
                    }
                }
                else{
?>                    
                    <li class="dopbsp-no-data"><?php echo $DOPBSP->text('RESERVATIONS_NO_RESERVATIONS'); ?></li>
<?php                    
                }
?>
                </ul>    
<?php
            }
        }
    }