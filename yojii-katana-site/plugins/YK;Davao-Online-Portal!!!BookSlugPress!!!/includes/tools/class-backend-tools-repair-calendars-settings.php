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

    if (!class_exists('DOPBSPBackEndToolsRepairCalendarsSettings')){
        class DOPBSPBackEndToolsRepairCalendarsSettings extends DOPBSPBackEndTools{
            /*
             * Constructor
             */
            function DOPBSPBackEndToolsRepairCalendarsSettings(){
            }
            
            /*
             * Display repair calendars settings.
             * 
             * @return repair calendars settings HTML
             */
            function display(){
                global $DOPBSP;
                
                $DOPBSP->views->backend_tools_repair_calendars_settings->template();
                
                die();
            }
            
            /*
             * Get calendars list.
             * 
             * @return a string with all calendars IDs
             */
            function get(){
                global $wpdb;
                global $DOPBSP;
                
                /*
                 * Rename calendar settings table.
                 */
                $DOPBSP->classes->database->updateRename();
                
                $calendars_list = array();
                
                /*
                 * Repair calendars settings.
                 */
                $calendars = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->calendars.' ORDER BY id');
                
                foreach ($calendars as $calendar){
                    array_push($calendars_list, $calendar->id);
                }
                
                echo implode(',', $calendars_list);
                
                $this->set();
                
                die();
            }
            
            /*
             * Repair settings for each calendar.
             * 
             * @post id (integer): calendar ID
             * @post no (integer): calendar position
             * 
             * @return status HTML
             */
            function set(){
                global $wpdb;
                global $DOPBSP;
                
                $id = isset($_POST['id']) ? $_POST['id']:0;
                $no = isset($_POST['no']) ? $_POST['no']:0;
                
                $html = array();
                
                $calendar = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->calendars.' WHERE id='.$id);
                $settings_calendar = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->settings_calendar.' WHERE calendar_id='.$id);
                
                array_push($html, '<tr class="dopbsp-'.($no%2 == 0 ? 'odd':'even').'">');
                
                if ($id != 0){
                    array_push($html, ' <td>ID: '.$id.' - '.$calendar->name.'</td>');
                }

                if ($wpdb->num_rows == 0){
                    $wpdb->insert($DOPBSP->tables->settings_calendar, array('calendar_id' => $id,
                                                                             'hours_definitions' => '[{"value": "00:00"}]'));
                    $settings_id = $wpdb->insert_id;

                    $wpdb->insert($DOPBSP->tables->settings_notifications, array('id' => $settings_id,
                                                                                 'calendar_id' => $id));
                    $wpdb->insert($DOPBSP->tables->settings_payment, array('id' => $settings_id,
                                                                           'calendar_id' => $id));
                    
                    array_push($html, ' <td><span class="dopbsp-icon dopbsp-success"></span>'.$DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_REPAIRED').'</td>');
                    array_push($html, ' <td><span class="dopbsp-icon dopbsp-success"></span>'.$DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_REPAIRED').'</td>');
                    array_push($html, ' <td><span class="dopbsp-icon dopbsp-success"></span>'.$DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_REPAIRED').'</td>');
                }
                else{
                    array_push($html, ' <td><span class="dopbsp-icon dopbsp-none"></span>'.$DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_UNCHANGED').'</td>');
                    
                    /*
                     * Update notifications settings.
                     */
                    $settings_notifications = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->settings_notifications.' WHERE id='.$settings_calendar->id.' AND calendar_id='.$id);

                    if ($wpdb->num_rows == 0){
                        $wpdb->insert($DOPBSP->tables->settings_notifications, array('id' => $settings_calendar->id,
                                                                                     'calendar_id' => $id,
                                                                                     'email' => isset($settings_calendar->notifications_email) ? $settings_calendar->notifications_email:DOPBSP_CONFIG_DATABASE_SETTINGS_NOTIFICATIONS_DEFAULT_EMAIL,
                                                                                     'smtp_host_name' => isset($settings_calendar->smtp_host_name) ? $settings_calendar->smtp_host_name:DOPBSP_CONFIG_DATABASE_SETTINGS_NOTIFICATIONS_DEFAULT_SMTP_HOST_NAME,
                                                                                     'smtp_host_port' => isset($settings_calendar->smtp_host_port) ? $settings_calendar->smtp_host_port:DOPBSP_CONFIG_DATABASE_SETTINGS_NOTIFICATIONS_DEFAULT_SMTP_HOST_PORT,
                                                                                     'smtp_ssl' => isset($settings_calendar->smtp_ssl) ? $settings_calendar->smtp_ssl:DOPBSP_CONFIG_DATABASE_SETTINGS_NOTIFICATIONS_DEFAULT_SMTP_SSL,
                                                                                     'smtp_user' => isset($settings_calendar->smtp_user) ? $settings_calendar->smtp_user:DOPBSP_CONFIG_DATABASE_SETTINGS_NOTIFICATIONS_DEFAULT_SMTP_USER,
                                                                                     'smtp_password' => isset($settings_calendar->smtp_password) ? $settings_calendar->smtp_password:DOPBSP_CONFIG_DATABASE_SETTINGS_NOTIFICATIONS_DEFAULT_SMTP_PASSWORD));
                        array_push($html, ' <td><span class="dopbsp-icon dopbsp-success"></span>'.$DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_REPAIRED').'</td>');
                    }
                    else{
                        array_push($html, ' <td><span class="dopbsp-icon dopbsp-none"></span>'.$DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_UNCHANGED').'</td>');
                    }

                    /*
                     * Update payment settings.
                     */
                    $settings_payment = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->settings_payment.' WHERE id='.$settings_calendar->id.' AND calendar_id='.$id);

                    if ($wpdb->num_rows == 0){
                        $wpdb->insert($DOPBSP->tables->settings_payment, array('id' => $settings_calendar->id,
                                                                               'calendar_id' => $id,
                                                                               'arrival_enabled' => isset($settings_calendar->payment_arrival_enabled) ? $settings_calendar->payment_arrival_enabled:DOPBSP_CONFIG_DATABASE_SETTINGS_PAYMENT_DEFAULT_ARRIVAL_ENABLED,
                                                                               'arrival_with_approval_enabled' => isset($settings_calendar->instant_booking) ? $settings_calendar->instant_booking:DOPBSP_CONFIG_DATABASE_SETTINGS_PAYMENT_DEFAULT_ARRIVAL_WITH_APPROVAL_ENABLED,
                                                                               'paypal_enabled' => isset($settings_calendar->payment_paypal_enabled) ? $settings_calendar->payment_paypal_enabled:DOPBSP_CONFIG_DATABASE_SETTINGS_PAYMENT_DEFAULT_PAYPAL_ENABLED,
                                                                               'paypal_username' => isset($settings_calendar->payment_paypal_username) ? $settings_calendar->payment_paypal_username:DOPBSP_CONFIG_DATABASE_SETTINGS_PAYMENT_DEFAULT_PAYPAL_USERNAME,
                                                                               'paypal_password' => isset($settings_calendar->payment_paypal_password) ? $settings_calendar->payment_paypal_password:DOPBSP_CONFIG_DATABASE_SETTINGS_PAYMENT_DEFAULT_PAYPAL_PASSWORD,
                                                                               'paypal_signature' => isset($settings_calendar->payment_paypal_signature) ? $settings_calendar->payment_paypal_signature:DOPBSP_CONFIG_DATABASE_SETTINGS_PAYMENT_DEFAULT_PAYPAL_SIGNATURE,
                                                                               'paypal_credit_card' => isset($settings_calendar->payment_paypal_credit_card) ? $settings_calendar->payment_paypal_credit_card:DOPBSP_CONFIG_DATABASE_SETTINGS_PAYMENT_DEFAULT_PAYPAL_CREDIT_CARD,
                                                                               'paypal_sandbox_enabled' => isset($settings_calendar->payment_paypal_sandbox_enabled) ? $settings_calendar->payment_paypal_sandbox_enabled:DOPBSP_CONFIG_DATABASE_SETTINGS_PAYMENT_DEFAULT_PAYPAL_SANDBOX_ENABLED));
                        array_push($html, ' <td><span class="dopbsp-icon dopbsp-success"></span>'.$DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_REPAIRED').'</td>');
                    }
                    else{
                        array_push($html, ' <td><span class="dopbsp-icon dopbsp-none"></span>'.$DOPBSP->text('TOOLS_REPAIR_CALENDARS_SETTINGS_UNCHANGED').'</td>');
                    }
                }
                array_push($html, '</tr>');
                
                if ($id != 0){
                    echo implode('', $html);
                }
                
                die();
            }
        }
    }