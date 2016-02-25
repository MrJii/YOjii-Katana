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


    if (!class_exists('DOPBSPBackEndShortcodes')){
        class DOPBSPBackEndShortcodes extends DOPBSPBackEnd{
            /*
             * Constructor
             */
            function DOPBSPBackEndShortcodes(){
                add_action('init', array (&$this, 'initShortcodes'));
            }

            /*
             * Initialize shortcodes in TinyMCE editor.
             */
            function initShortcodes(){
                if (!current_user_can('edit_posts') 
                        && !current_user_can('edit_pages')){
                    return;
                }

                if (get_user_option('rich_editing') == 'true'){
                    add_action('admin_head', array (&$this, 'setData'));
                    add_filter('mce_external_plugins', array (&$this, 'initTinyMCEPlugin'), 5);
                    add_filter('mce_buttons', array (&$this, 'setTinyMCEButton'), 5);
                }
            }

            /*
             * Set data for shortcodes in TinyMCE editor.
             * 
             * @return HTML data
             */
            function setData(){
                global $wpdb;
                global $DOPBSP;
                
                $calendars_list = array();
                $languages_list = array();

                $calendars = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->calendars.' WHERE user_id='.wp_get_current_user()->ID.' ORDER BY id');
                $languages = $DOPBSP->classes->languages->languages;
                $selected_language = '';
                $selected_language = $selected_language == '' ? $DOPBSP->classes->backend_language->get():$selected_language;
                $enabled_languages = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->languages.' WHERE enabled="true"');
                
                foreach ($calendars as $calendar){
                    array_push($calendars_list, $calendar->id.';;'.$calendar->name);
                }

                foreach ($enabled_languages as $enabled_language){
                    array_push($languages_list, $enabled_language->code.';;'.$enabled_language->name);
                }
                
                $dopbsp_path = plugin_dir_url(__FILE__);
                $dopbsp_path = str_replace('includes/shortcodes/', '', $dopbsp_path);
                
                echo '<script type="text/JavaScript">'.
                     '    var DOPBSP_tinyMCE_data = "'.$DOPBSP->text('TINYMCE_ADD').';;;;;'.implode(';;;', $calendars_list).';;;;;'.$DOPBSP->text('TINYMCE_CALENDAR').';;;;;'.$DOPBSP->text('TINYMCE_SELECT_CALENDAR').';;;;;'.$DOPBSP->text('TINYMCE_LANGUAGE').';;;;;'.$DOPBSP->text('TINYMCE_SELECT_LANGUAGE').';;;;;'.implode(';;;', $languages_list).'",'.
                     '        DOPBSP_PATH = "'.$dopbsp_path.'",'.
                     '        DOPBSP_language = "'.$selected_language.'",'.
                     '        WP_version = "'.get_bloginfo("version").'";'. 
                     '</script>';
            }

            /*
             * Initialize TinyMCE editor plugin.
             * 
             * @param plugin_array (array): list of plugins for TinyMCE editor
             * 
             * @return modified TinyMCE editor plugins list
             */
            function initTinyMCEPlugin($plugin_array){
                global $DOPBSP;
                
                $plugin_array['DOPBSP'] =  $DOPBSP->paths->url.'assets/js/shortcodes/backend-shortcodes.js';
                
                return $plugin_array;
            }

            /*
             * Set button for TinyMCE editor.
             * 
             * @param buttons (array): list of TinyMCE editor buttons
             * 
             * @return modified TinyMCE editor buttons list
             */
            function setTinyMCEButton($buttons){
                array_push($buttons, '', 'DOPBSP');
                
                return $buttons;
            }
        }
    }