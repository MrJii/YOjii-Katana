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


    if (!class_exists('DOPBSPTranslationTextCalendars')){
        class DOPBSPTranslationTextCalendars{
            /*
             * Constructor
             */
            function DOPBSPTranslationTextCalendars(){
                /*
                 * Initialize calendars text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'calendars'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'calendarsCalendar'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'calendarsCalendarForm'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'calendarsAddCalendar'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'calendarsEditCalendar'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'calendarsDeleteCalendar'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'calendarsHelp'));
            }

            /*
             * Calendars text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function calendars($text){
                array_push($text, array('key' => 'PARENT_CALENDARS',
                                        'parent' => '',
                                        'text' => 'Rooms'));
                
                array_push($text, array('key' => 'CALENDARS_TITLE',
                                        'parent' => 'PARENT_CALENDARS',
                                        'text' => 'Rooms'));   
                array_push($text, array('key' => 'CALENDARS_CREATED_BY',
                                        'parent' => 'PARENT_CALENDARS',
                                        'text' => 'Created by'));
                array_push($text, array('key' => 'CALENDARS_NO_PENDING_RESERVATIONS',
                                        'parent' => 'PARENT_CALENDARS',
                                        'text' => 'pending reservations'));
                array_push($text, array('key' => 'CALENDARS_NO_APPROVED_RESERVATIONS',
                                        'parent' => 'PARENT_CALENDARS',
                                        'text' => 'approved reservations'));
                array_push($text, array('key' => 'CALENDARS_NO_REJECTED_RESERVATIONS',
                                        'parent' => 'PARENT_CALENDARS',
                                        'text' => 'rejected reservations'));
                array_push($text, array('key' => 'CALENDARS_NO_CANCELED_RESERVATIONS',
                                        'parent' => 'PARENT_CALENDARS',
                                        'text' => 'canceled reservations'));
                array_push($text, array('key' => 'CALENDARS_LOAD_SUCCESS',
                                        'parent' => 'PARENT_CALENDARS',
                                        'text' => 'Rooms list loaded.'));
                array_push($text, array('key' => 'CALENDARS_NO_CALENDARS',
                                        'parent' => 'PARENT_CALENDARS',
                                        'text' => 'No Rooms. Click the above "plus" icon to add a new one.'));
                
                return $text;
            }
            
            /*
             * Calendars - Calendar text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function calendarsCalendar($text){
                array_push($text, array('key' => 'PARENT_CALENDARS_CALENDAR',
                                        'parent' => '',
                                        'text' => 'Rooms - Room'));
                
                array_push($text, array('key' => 'CALENDARS_CALENDAR_LOAD_SUCCESS',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR',
                                        'text' => 'Rooms loaded.'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_SAVING_SUCCESS',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR',
                                        'text' => 'Schedule saved.'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_ADD_MONTH_VIEW',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR',
                                        'text' => 'Add Room schedule view',
                                        'de' => 'Füge monatsansicht hinzu',
                                        'nl' => 'Voeg extra maand toe',
                                        'fr' => 'Ajouter la vue du mois suivant',
                                        'pl' => 'Dodaj widok miesiąca'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_REMOVE_MONTH_VIEW',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR',
                                        'text' => 'Remove view',
                                        'de' => 'Entferne monatsansicht',
                                        'nl' => 'Verwijder extra maand',
                                        'fr' => 'Supprimer la vue du mois suivant',
                                        'pl' => 'Usuń widok miesiąca'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_PREVIOUS_MONTH',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR',
                                        'text' => 'Previous month',
                                        'de' => 'Voriger monat',
                                        'nl' => 'Vorige maand',
                                        'fr' => 'Mois précédent',
                                        'pl' => 'Poprzedni miesiąc'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_NEXT_MONTH',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR',
                                        'text' => 'Next',
                                        'de' => 'Nächster monat',
                                        'nl' => 'Volgende maand',
                                        'fr' => 'Mois suivant',
                                        'pl' => 'Następny miesiąc'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_AVAILABLE_ONE_TEXT',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR',
                                        'text' => 'vacant',
                                        'de' => 'verfügbar',
                                        'nl' => 'beschikbaar',
                                        'fr' => 'disponible',
                                        'pl' => 'dostępne'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_AVAILABLE_TEXT',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR',
                                        'text' => 'vacant',
                                        'de' => 'verfügbar',
                                        'nl' => 'beschikbaar',
                                        'fr' => 'disponible',
                                        'pl' => 'dostępne'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_BOOKED_TEXT',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR',
                                        'text' => 'paid',
                                        'de' => 'belegt',
                                        'nl' => 'bezet',
                                        'fr' => 'réservé',
                                        'pl' => 'zajęte'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_UNAVAILABLE_TEXT',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR',
                                        'text' => 'closed',
                                        'de' => 'nicht verfügbar',
                                        'nl' => 'niet beschikbaar',
                                        'fr' => 'indisponible',
                                        'pl' => 'zajęte'));
                
                return $text;
            }
            
            /*
             * Calendars - Calendar form text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function calendarsCalendarForm($text){
                array_push($text, array('key' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'parent' => '',
                                        'text' => 'Rooms - Room form'));
                
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_DATE_START_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Today'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_DATE_END_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'After'));  
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_HOURS_START_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Time In')); 
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_HOURS_END_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Time Out'));
                
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_SET_DAYS_AVAILABILITY_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Set vacant days'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_SET_HOURS_DEFINITIONS_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Set time details'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_SET_HOURS_AVAILABILITY_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Set vacant time'));
                
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_STATUS_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Status'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_STATUS_AVAILABLE_TEXT',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Vacant'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_STATUS_BOOKED_TEXT',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Paid'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_STATUS_SPECIAL_TEXT',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'VIP'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_STATUS_UNAVAILABLE_TEXT',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Closed'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_PRICE_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Price'));    
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_PROMO_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Promo price'));               
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_AVAILABLE_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Number available'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_HOURS_DEFINITIONS_CHANGE_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Change hours definitions (changing the definitions will overwrite any previous hours data)'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_HOURS_DEFINITIONS_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Hours definitions (hh:mm add one per line). Use only 24 hours format.'));  
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_HOURS_SET_DEFAULT_DATA_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Set default hours values for this day(s). This will overwrite any existing data.')); 
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_HOURS_INFO_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Information (users will see this message)'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_HOURS_NOTES_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Notes (only administrators will see this message)'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_GROUP_DAYS_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Merge date'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_GROUP_HOURS_LABEL',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Merge data'));
                array_push($text, array('key' => 'CALENDARS_CALENDAR_FORM_RESET_CONFIRMATION',
                                        'parent' => 'PARENT_CALENDARS_CALENDAR_FORM',
                                        'text' => 'Are you sure you want to reset the data? If you reset the days, hours data from those days will reset to.'));
                
                return $text;
            }
            
            /*
             * Calendars - Add caledar text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function calendarsAddCalendar($text){
                array_push($text, array('key' => 'PARENT_CALENDARS_ADD_CALENDAR',
                                        'parent' => '',
                                        'text' => 'Rooms - Add Room'));
                
                array_push($text, array('key' => 'CALENDARS_ADD_CALENDAR_NAME',
                                        'parent' => 'PARENT_CALENDARS_ADD_CALENDAR',
                                        'text' => 'New Room'));
                array_push($text, array('key' => 'CALENDARS_ADD_CALENDAR_SUBMIT',
                                        'parent' => 'PARENT_CALENDARS_ADD_CALENDAR',
                                        'text' => 'Add Room'));
                array_push($text, array('key' => 'CALENDARS_ADD_CALENDAR_ADDING',
                                        'parent' => 'PARENT_CALENDARS_ADD_CALENDAR',
                                        'text' => 'Adding a new Room ...'));
                array_push($text, array('key' => 'CALENDARS_ADD_CALENDAR_SUCCESS',
                                        'parent' => 'PARENT_CALENDARS_ADD_CALENDAR',
                                        'text' => 'You have succesfully added a new Room.'));
                
                return $text;
            }
            
            /*
             * Calendars - Edit calendar text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function calendarsEditCalendar($text){
                array_push($text, array('key' => 'PARENT_CALENDARS_EDIT_CALENDAR',
                                        'parent' => '',
                                        'text' => 'Rooms - Edit Room'));
                
                array_push($text, array('key' => 'CALENDARS_EDIT_CALENDAR',
                                        'parent' => 'PARENT_CALENDARS_EDIT_CALENDAR',
                                        'text' => 'Edit Room availability'));
                array_push($text, array('key' => 'CALENDARS_EDIT_CALENDAR_SETTINGS',
                                        'parent' => 'PARENT_CALENDARS_EDIT_CALENDAR',
                                        'text' => 'Edit Room settings'));
                array_push($text, array('key' => 'CALENDARS_EDIT_CALENDAR_NOTIFICATIONS',
                                        'parent' => 'PARENT_CALENDARS_EDIT_CALENDAR',
                                        'text' => 'Edit Room notifications'));
                array_push($text, array('key' => 'CALENDARS_EDIT_CALENDAR_PAYMENT_GATEWAYS',
                                        'parent' => 'PARENT_CALENDARS_EDIT_CALENDAR',
                                        'text' => 'Edit Room payment gateways'));
                array_push($text, array('key' => 'CALENDARS_EDIT_CALENDAR_USERS_PERMISSIONS',
                                        'parent' => 'PARENT_CALENDARS_EDIT_CALENDAR',
                                        'text' => 'Edit users permissions'));
                array_push($text, array('key' => 'CALENDARS_EDIT_CALENDAR_NEW_RESERVATIONS',
                                        'parent' => 'PARENT_CALENDARS_EDIT_CALENDAR',
                                        'text' => 'new reservations'));
                array_push($text, array('key' => 'CALENDARS_EDIT_CALENDAR_DELETE',
                                        'parent' => 'PARENT_CALENDARS_EDIT_CALENDAR',
                                        'text' => 'Delete Room'));
                
                return $text;
            }
            
            /*
             * Calendars - Delete calendar text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function calendarsDeleteCalendar($text){
                array_push($text, array('key' => 'PARENT_CALENDARS_DELETE_CALENDAR',
                                        'parent' => '',
                                        'text' => 'Rooms - Delete Room'));
                
                array_push($text, array('key' => 'CALENDARS_DELETE_CALENDAR_CONFIRMATION',
                                        'parent' => 'PARENT_CALENDARS_DELETE_CALENDAR',
                                        'text' => 'Are you sure you want to delete this Room?'));
                array_push($text, array('key' => 'CALENDARS_DELETE_CALENDAR_DELETING',
                                        'parent' => 'PARENT_CALENDARS_DELETE_CALENDAR',
                                        'text' => 'Deleting Room ...'));
                array_push($text, array('key' => 'CALENDARS_DELETE_CALENDAR_SUCCESS',
                                        'parent' => 'PARENT_CALENDARS_DELETE_CALENDAR',
                                        'text' => 'You have succesfully deleted the Room.'));
                
                return $text;
            }
            
            /*
             * Calendars - Help text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function calendarsHelp($text){
                array_push($text, array('key' => 'PARENT_CALENDARS_HELP',
                                        'parent' => '',
                                        'text' => 'Rooms - Help'));
                
                array_push($text, array('key' => 'CALENDARS_HELP',
                                        'parent' => 'PARENT_CALENDARS_HELP',
                                        'text' => 'Click on a Room item to open the editing area.'));
                
                array_push($text, array('key' => 'CALENDARS_ADD_CALENDAR_HELP',
                                        'parent' => 'PARENT_CALENDARS_HELP',
                                        'text' => 'Click on the "plus" icon to add a Room.'));
                
                array_push($text, array('key' => 'CALENDARS_EDIT_CALENDAR_HELP',
                                        'parent' => 'PARENT_CALENDARS_HELP',
                                        'text' => 'Click on the "Room" icon to edit Room availability. Select the days and hours to edit them.'));
                array_push($text, array('key' => 'CALENDARS_EDIT_CALENDAR_SETTINGS_HELP',
                                        'parent' => 'PARENT_CALENDARS_HELP',
                                        'text' => 'Click on the "gear" icon to edit Room settings.'));
                array_push($text, array('key' => 'CALENDARS_EDIT_CALENDAR_EMAILS_HELP',
                                        'parent' => 'PARENT_CALENDARS_HELP',
                                        'text' => 'Click on the "email" icon to set emails/notifications options.'));
                array_push($text, array('key' => 'CALENDARS_EDIT_CALENDAR_PAYMENT_GATEWAYS_HELP',
                                        'parent' => 'PARENT_CALENDARS_HELP',
                                        'text' => 'Click on the "wallet" icon to set payment options.'));
                array_push($text, array('key' => 'CALENDARS_EDIT_CALENDAR_USERS_HELP',
                                        'parent' => 'PARENT_CALENDARS_HELP',
                                        'text' => 'Click on the "users" icon to set users permissions.'));
                
                array_push($text, array('key' => 'CALENDARS_CALENDAR_NOTIFICATIONS_HELP',
                                        'parent' => 'PARENT_CALENDARS_HELP',
                                        'text' => 'The "bulb" icon notifies you if you have new reservations.'));
                
                return $text;
            }
        }
    }