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

    if (!class_exists('DOPBSPViewsBackEndToolsRepairCalendarsSettings')){
        class DOPBSPViewsBackEndToolsRepairCalendarsSettings extends DOPBSPViewsBackEndTools{
            /*
             * Constructor
             */
            function DOPBSPViewsBackEndToolsRepairCalendarsSettings(){
            }
            
            /*
             * Returns calendars settings template.
             * 
             * @return calendar settings HTML
             */
            function template(){
                global $DOPBSP;
?>
                <table id="DOPBSP-tools-repair-calendars-settings" class="dopbsp-info-table">
                    <colgroup>
                        <col />
                        <col />
                        <col />
                        <col />
                    </colgroup>
                    <thead>
                        <tr>
                            <th><?php echo $DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_CALENDARS'); ?></th>
                            <th><?php echo $DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_SETTINGS_DATABASE'); ?></th>
                            <th><?php echo $DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_NOTIFICATIONS_DATABASE'); ?></th>
                            <th><?php echo $DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_PAYMENT_DATABASE'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
<?php
            }
        }
    }