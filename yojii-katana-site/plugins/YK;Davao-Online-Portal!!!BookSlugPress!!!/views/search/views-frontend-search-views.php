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
    if (!class_exists('DOPBSPViewsFrontEndSearchView')){
        class DOPBSPViewsFrontEndSearchView extends DOPBSPViewsFrontEndSearch{
            /*
             * Constructor
             */
            function DOPBSPViewsFrontEndSearchView(){
            }
            
            /*
             * Returns search view.
             * 
             * @param args (array): function arguments
             *                      * atts (object): shortcode attributes
             *                      * settings_search (object): search settings
             * 
             * @return search view HTML
             */
            function template($args = array()){
                global $DOPBSP;
                
                $atts = $args['atts'];
                $settings_search = $args['settings_search'];
                
                $id = $atts['id'];
                
                $html = array();
                
                array_push($html, '<input type="hidden" name="DOPBSPSearch-view'.$id.'" id="DOPBSPSearch-view'.$id.'" value="'.$settings_search->view_default.'" />');
                
                if ($settings_search->view_list_enabled == 'true'
                        || $settings_search->view_grid_enabled == 'true'
                        || $settings_search->view_map_enabled == 'true'){
                    array_push($html, '<ul class="DOPBSPSearch-view">');

                    if  ($settings_search->view_list_enabled == 'true'){
                        array_push($html, ' <li id="DOPBSPSearch-view-list'.$id.'" class="dopbsp-view-list'.($settings_search->view_default == 'list' ? ' dopbsp-selected':'').'">');
                        array_push($html, '     <span class="dopbsp-info">'.$DOPBSP->text('SEARCH_FRONT_END_VIEW_LIST').'</span>');
                        array_push($html, ' </li>');
                    }

                    if  ($settings_search->view_grid_enabled == 'true'){
                        array_push($html, ' <li id="DOPBSPSearch-view-grid'.$id.'" class="dopbsp-view-grid'.($settings_search->view_default == 'grid' ? ' dopbsp-selected':'').'">');
                        array_push($html, '     <span class="dopbsp-info">'.$DOPBSP->text('SEARCH_FRONT_END_VIEW_GRID').'</span>');
                        array_push($html, ' </li>');
                    }

                    if  ($settings_search->view_map_enabled == 'true'){
                        array_push($html, ' <li id="DOPBSPSearch-view-map'.$id.'" class="dopbsp-view-map'.($settings_search->view_default == 'map' ? ' dopbsp-selected':'').'">');
                        array_push($html, '     <span class="dopbsp-info">'.$DOPBSP->text('SEARCH_FRONT_END_VIEW_MAP').'</span>');
                        array_push($html, ' </li>');
                    }
                    array_push($html, '</ul>');
                }
                
                return implode('', $html);
            }
        }
    }