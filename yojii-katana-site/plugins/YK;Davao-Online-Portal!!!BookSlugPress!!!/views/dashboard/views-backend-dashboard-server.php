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

    if (!class_exists('DOPBSPViewsBackEndDashboardServer')){
        class DOPBSPViewsBackEndDashboardServer extends DOPBSPViewsBackEndDashboard{
            /*
             * Constructor
             */
            function DOPBSPViewsBackEndDashboardServer(){
            }
            
            /*
             * Returns dashboard system template.
             * 
             * @param args (array): function arguments
             *                      * server (array): server data
             * 
             * 
             * @return dashboard system HTML template
             */
            function template($args = array()){
                global $DOPBSP;
                
                $server = $args['server'];
?>
            <section class="dopbsp-content-wrapper dopbsp-responsive-hidden" >
                <div class="dopbsp-box-header dopbsp-hide">
                    <h3><?php echo $DOPBSP->text('DASHBOARD_SERVER_TITLE'); ?></h3>
                    <a href="javascript:DOPBSP.toggleBox('server')" id="DOPBSP-box-button-server" class="dopbsp-button"></a>
                </div>
                <div id="DOPBSP-box-server" class="dopbsp-box-wrapper">
                    <table id="DOPBSP-server" class="dopbsp-info-table">
                        <colgroup>
                            <col />
                            <col />
                            <col />
                            <col />
                        </colgroup>
                        <thead>
                            <tr>
                                <th></th>
                                <th><?php echo $DOPBSP->text('DASHBOARD_SERVER_REQUIRED'); ?></th>
                                <th><?php echo $DOPBSP->text('DASHBOARD_SERVER_AVAILABLE'); ?></th>
                                <th><?php echo $DOPBSP->text('DASHBOARD_SERVER_STATUS'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
<?php
                for ($i=0; $i<count($server); $i++){
?>
                            <tr class="<?php echo $i%2 == 0 ? 'dopbsp-odd':'dopbsp-even'; ?>">
                                <td><?php echo $server[$i]['title']; ?></td>
                                <td><?php echo $server[$i]['required']; ?></td>
                                <td><?php echo $server[$i]['available']; ?></td>
                                <td><span class="dopbsp-icon <?php echo $server[$i]['icon']; ?>"></span></td>
                            </tr>
<?php
                }
?>
                        </tbody>
                    </table>
                </div>
            </section>
<?php
            }
        }
    }