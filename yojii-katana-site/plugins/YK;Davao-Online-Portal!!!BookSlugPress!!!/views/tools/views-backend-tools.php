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

    if (!class_exists('DOPBSPViewsBackEndTools')){
        class DOPBSPViewsBackEndTools extends DOPBSPViewsBackEnd{
            /*
             * Constructor
             */
            function DOPBSPViewsBackEndTools(){
            }
            
            /*
             * Returns tools template.
             * 
             * @return tools HTML page
             */
            function template(){
                global $DOPBSP;
                
                $this->getTranslation();
?>            
    <div class="wrap DOPBSP-admin">
        
<!--
    Header
-->
        <?php $this->displayHeader($DOPBSP->text('TITLE'), $DOPBSP->text('TOOLS_TITLE')); ?>

<!-- 
    Content
-->
        <div class="dopbsp-main">
            <table class="dopbsp-content-wrapper">
                <colgroup>
                    <col id="DOPBSP-col-column1" class="dopbsp-column1" />
                    <col id="DOPBSP-col-column-separator1" class="dopbsp-separator" />
                    <col id="DOPBSP-col-column2" class="dopbsp-column2" />
                </colgroup>
                <tbody>
                    <tr>
                        <td class="dopbsp-column" id="DOPBSP-column1">
                            <div class="dopbsp-column-header">
                                <a href="<?php echo DOPBSP_CONFIG_HELP_DOCUMENTATION_URL; ?>" target="_blank" class="dopbsp-button dopbsp-help"><span class="dopbsp-info dopbsp-help"><?php echo $DOPBSP->text('TOOLS_HELP').'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION'); ?></span></a>
                                <br class="dopbsp-clear" />
                            </div>
                            <div class="dopbsp-column-content">
                                <ul>
                                    <li class="dopbsp-tools-item dopbsp-repair-database-text" onclick="DOPBSPTools.toggle('repair-database-text'); DOPBSP.confirmation('TOOLS_REPAIR_DATABASE_TEXT_CONFIRMATION', 'DOPBSPToolsRepairDatabaseText.set()', 'DOPBSPTools.toggle()', 'Are you sure you want to verify the database & the text and repair them if needed?')">
                                        <div class="dopbsp-icon"></div>
                                        <div class="dopbsp-title"><?php echo $DOPBSP->text('TOOLS_REPAIR_DATABASE_TEXT_TITLE', 'Repair database & text'); ?></div>
                                    </li>
                                    <li class="dopbsp-tools-item dopbsp-repair-calendars-settings" onclick="DOPBSPTools.toggle('repair-calendars-settings'); DOPBSP.confirmation('TOOLS_REPAIR_CALENDARS_SETTINGS_CONFIRMATION', 'DOPBSPToolsRepairCalendarsSettings.init()', 'DOPBSPTools.toggle()')">
                                        <div class="dopbsp-icon"></div>
                                        <div class="dopbsp-title"><?php echo $DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_TITLE'); ?></div>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td id="DOPBSP-column-separator1" class="dopbsp-separator"></td>
                        <td id="DOPBSP-column2" class="dopbsp-column">
                            <div class="dopbsp-column-header">&nbsp;</div>
                            <div class="dopbsp-column-content">&nbsp;</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>       
<?php
            }
        }
    }