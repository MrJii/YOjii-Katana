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

    if (!class_exists('DOPBSPViewsBackEndStaff')){
        class DOPBSPViewsBackEndStaff extends DOPBSPViewsBackEnd{
            /*
             * Constructor
             */
            function DOPBSPViewsBackEndStaff(){
            }
            
            /*
             * Returns staff template.
             * 
             * @return staff HTML page
             */
            function template(){
                global $DOPBSP;
                
                $this->getTranslation();
?>            
    <div class="wrap DOPBSP-admin">
        
<!--
    Header
-->
        <?php $this->displayHeader($DOPBSP->text('TITLE').' - '.$DOPBSP->text('STAFF_TITLE').'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$DOPBSP->text('SOON_TITLE')); ?>

<!-- 
    Content
-->
        <div class="dopbsp-main dopbsp-hidden">
        </div>
    </div>       
<?php
            }
        }
    }