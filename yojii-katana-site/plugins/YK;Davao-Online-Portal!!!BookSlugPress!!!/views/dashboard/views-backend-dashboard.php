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

    if (!class_exists('DOPBSPViewsBackEndDashboard')){
        class DOPBSPViewsBackEndDashboard extends DOPBSPViewsBackEnd{
            /*
             * Constructor
             */
            function DOPBSPViewsBackEndDashboard(){
            }
            
            /*
             * Returns dashboard template.
             * 
             * @param args (array): function arguments
             * 
             * @return dashboard HTML page
             */
            function template($args = array()){
                global $DOPBSP;
                
                $this->getTranslation();
?>            
    <div class="wrap DOPBSP-admin">
        
<!-- 
    Header
-->
        <?php $this->displayHeader($DOPBSP->text('TITLE'), $DOPBSP->text('DASHBOARD_TITLE')); ?>

<!--
    Content
-->
        <div class="dopbsp-main dopbsp-hidden">
<?php
                /*
                 * Dashboard start template.
                 */
                $DOPBSP->views->backend_dashboard_start->template();
                
                /*
                 * Dashboard server template.
                 */
                $DOPBSP->views->backend_dashboard_server->template($args);
?>
        </div>
    </div>       
<?php
            }
        }
    }