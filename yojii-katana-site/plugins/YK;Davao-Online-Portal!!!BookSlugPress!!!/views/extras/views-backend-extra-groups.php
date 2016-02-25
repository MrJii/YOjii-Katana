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
    if (!class_exists('DOPBSPViewsBackEndExtraGroups')){
        class DOPBSPViewsBackEndExtraGroups extends DOPBSPViewsBackEndExtra{
            /*
             * Constructor
             */
            function DOPBSPViewsBackEndExtraGroups(){
            }
            
            /*
             * Returns extra groups tempalte.
             * 
             * @param args (array): function arguments
             *                      * id (integer): extra ID
             *                      * language (string): extra language
             * 
             * @return extra groups HTML
             */
            function template($args = array()){
                global $wpdb;
                global $DOPBSP;
                
                $id = $args['id'];
                $language = isset($args['language']) && $args['language'] != '' ? $args['language']:$DOPBSP->classes->backend_language->get();
?>
                <div class="dopbsp-extra-groups-header">
                    <a href="javascript:DOPBSPExtraGroup.add(<?php echo $id; ?>, '<?php echo $language; ?>')" class="dopbsp-button dopbsp-add"><span class="dopbsp-info"><?php echo $DOPBSP->text('EXTRAS_EXTRA_ADD_GROUP_SUBMIT'); ?></span></a>
                    <h3><?php echo $DOPBSP->text('EXTRAS_EXTRA_GROUPS'); ?></h3>
                </div>
                <ul id="DOPBSP-extra-groups" class="dopbsp-extra-groups">
<?php
                $groups = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->extras_groups.' WHERE extra_id='.$id.' ORDER BY position ASC');
                
                if ($wpdb->num_rows > 0){
                    foreach($groups as $group){
                        $DOPBSP->views->backend_extra_group->template(array('group' => $group,
                                                                    'language' => $language));
                    }
                }
?>    
                </ul>
<?php                    
            }
        }
    }