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

    if (!class_exists('DOPBSPViews')){
        class DOPBSPViews{
            /*
             * Private variables.
             */
            private $views = array();
            
            /*
             * Constructor
             */
            function DOPBSPViews(){
                $this->set();
                
                add_action('init', array(&$this, 'init'));
            }
            
            /*
             * Initialize view.
             */
            function init(){
                $this->views = apply_filters('dopbsp_filter_views', $this->views);
                
                $this->initViews();
            }
            
            /*
             * Initialize view classes.
             */
            function initViews(){
                $views = $this->views;
                
                for ($i=0; $i<count($views); $i++){
                    if (class_exists($views[$i]['name'])){
                        $this->$views[$i]['key'] = new $views[$i]['name']();
                    }
                }
            }
            
            /*
             * Set view classes.
             */
            function set(){
                /*
                 * Set back end view.
                 */
                array_push($this->views, array('key' => 'backend',
                                               'name' => 'DOPBSPViewsBackEnd'));
                
                /*
                 * Set front end view.
                 */
                array_push($this->views, array('key' => 'frontend',
                                               'name' => 'DOPBSPViewsFrontEnd'));
                
                /*
                 * Set addons view classes.
                 */
                array_push($this->views, array('key' => 'backend_addons',
                                               'name' => 'DOPBSPViewsBackEndAddons'));
                
                /*
                 * Set amenities view classes.
                 */
                array_push($this->views, array('key' => 'backend_amenities',
                                               'name' => 'DOPBSPViewsBackEndAmenities'));
                
                /*
                 * Set calendars view classes.
                 */
                array_push($this->views, array('key' => 'backend_calendars',
                                               'name' => 'DOPBSPViewsBackEndCalendars'));
                
                /*
                 * Set coupons view classes.
                 */
                array_push($this->views, array('key' => 'backend_coupons',
                                               'name' => 'DOPBSPViewsBackEndCoupons'));
                array_push($this->views, array('key' => 'backend_coupon',
                                               'name' => 'DOPBSPViewsBackEndCoupon'));
                
                /*
                 * Set dashboard view classes.
                 */
                array_push($this->views, array('key' => 'backend_dashboard',
                                               'name' => 'DOPBSPViewsBackEndDashboard'));
                array_push($this->views, array('key' => 'backend_dashboard_server',
                                               'name' => 'DOPBSPViewsBackEndDashboardServer'));
                array_push($this->views, array('key' => 'backend_dashboard_start',
                                               'name' => 'DOPBSPViewsBackEndDashboardStart'));
                
                /*
                 * Set discounts view classes.
                 */
                array_push($this->views, array('key' => 'backend_discounts',
                                               'name' => 'DOPBSPViewsBackEndDiscounts'));
                array_push($this->views, array('key' => 'backend_discount',
                                               'name' => 'DOPBSPViewsBackEndDiscount'));
                array_push($this->views, array('key' => 'backend_discount_items',
                                               'name' => 'DOPBSPViewsBackEndDiscountItems'));
                array_push($this->views, array('key' => 'backend_discount_item',
                                               'name' => 'DOPBSPViewsBackEndDiscountItem'));
                array_push($this->views, array('key' => 'backend_discount_item_rule',
                                               'name' => 'DOPBSPViewsBackEndDiscountItemRule'));
                
                /*
                 * Set emails view classes.
                 */
                array_push($this->views, array('key' => 'backend_emails',
                                               'name' => 'DOPBSPViewsBackEndEmails'));
                array_push($this->views, array('key' => 'backend_email',
                                               'name' => 'DOPBSPViewsBackEndEmail'));
                
                /*
                 * Set events view classes.
                 */
                array_push($this->views, array('key' => 'backend_events',
                                               'name' => 'DOPBSPViewsBackEndEvents'));
                
                /*
                 * Set extras view classes.
                 */
                array_push($this->views, array('key' => 'backend_extras',
                                               'name' => 'DOPBSPViewsBackEndExtras'));
                array_push($this->views, array('key' => 'backend_extra',
                                               'name' => 'DOPBSPViewsBackEndExtra'));
                array_push($this->views, array('key' => 'backend_extra_groups',
                                               'name' => 'DOPBSPViewsBackEndExtraGroups'));
                array_push($this->views, array('key' => 'backend_extra_group',
                                               'name' => 'DOPBSPViewsBackEndExtraGroup'));
                array_push($this->views, array('key' => 'backend_extra_group_item',
                                               'name' => 'DOPBSPViewsBackEndExtraGroupItem'));
                
                /*
                 * Set fees view classes.
                 */
                array_push($this->views, array('key' => 'backend_fees',
                                               'name' => 'DOPBSPViewsBackEndFees'));
                array_push($this->views, array('key' => 'backend_fee',
                                               'name' => 'DOPBSPViewsBackEndFee'));
                
                /*
                 * Set forms view classes.
                 */
                array_push($this->views, array('key' => 'backend_forms',
                                               'name' => 'DOPBSPViewsBackEndForms'));
                array_push($this->views, array('key' => 'backend_form',
                                               'name' => 'DOPBSPViewsBackEndForm'));
                array_push($this->views, array('key' => 'backend_form_fields',
                                               'name' => 'DOPBSPViewsBackEndFormFields'));
                array_push($this->views, array('key' => 'backend_form_field',
                                               'name' => 'DOPBSPViewsBackEndFormField'));
                array_push($this->views, array('key' => 'backend_form_field_select_option',
                                               'name' => 'DOPBSPViewsBackEndFormFieldSelectOption'));
                
                /*
                 * Set languages view classes.
                 */
                array_push($this->views, array('key' => 'backend_languages',
                                               'name' => 'DOPBSPViewsBackEndLanguages'));
                
                /*
                 * Set locations view classes.
                 */
                array_push($this->views, array('key' => 'backend_locations',
                                               'name' => 'DOPBSPViewsBackEndLocations'));
                array_push($this->views, array('key' => 'backend_location',
                                               'name' => 'DOPBSPViewsBackEndLocation'));
                
                /*
                 * Set reservations view classes.
                 */
                array_push($this->views, array('key' => 'backend_reservations',
                                               'name' => 'DOPBSPViewsBackEndReservations'));
                array_push($this->views, array('key' => 'backend_reservations_list',
                                               'name' => 'DOPBSPViewsBackEndReservationsList'));
                array_push($this->views, array('key' => 'backend_reservation',
                                               'name' => 'DOPBSPViewsBackEndReservation'));
                array_push($this->views, array('key' => 'backend_reservation_coupon',
                                               'name' => 'DOPBSPViewsBackEndReservationCoupon'));
                array_push($this->views, array('key' => 'backend_reservation_details',
                                               'name' => 'DOPBSPViewsBackEndReservationDetails'));
                array_push($this->views, array('key' => 'backend_reservation_discount',
                                               'name' => 'DOPBSPViewsBackEndReservationDiscount'));
                array_push($this->views, array('key' => 'backend_reservation_extras',
                                               'name' => 'DOPBSPViewsBackEndReservationExtras'));
                array_push($this->views, array('key' => 'backend_reservation_fees',
                                               'name' => 'DOPBSPViewsBackEndReservationFees'));
                array_push($this->views, array('key' => 'backend_reservation_form',
                                               'name' => 'DOPBSPViewsBackEndReservationForm'));
                
                /*
                 * Set reviews view classes.
                 */
                array_push($this->views, array('key' => 'backend_reviews',
                                               'name' => 'DOPBSPViewsBackEndReviews'));
                
                /*
                 * Set rules view classes.
                 */
                array_push($this->views, array('key' => 'backend_rules',
                                               'name' => 'DOPBSPViewsBackEndRules'));
                array_push($this->views, array('key' => 'backend_rule',
                                               'name' => 'DOPBSPViewsBackEndRule'));
                
                /*
                 * Set search view classes.
                 */
                array_push($this->views, array('key' => 'backend_searches',
                                               'name' => 'DOPBSPViewsBackEndSearches'));
                array_push($this->views, array('key' => 'backend_search',
                                               'name' => 'DOPBSPViewsBackEndSearch'));
                array_push($this->views, array('key' => 'frontend_search',
                                               'name' => 'DOPBSPViewsFrontEndSearch'));
                array_push($this->views, array('key' => 'frontend_search_results',
                                               'name' => 'DOPBSPViewsFrontEndSearchResults'));
                array_push($this->views, array('key' => 'frontend_search_results_list',
                                               'name' => 'DOPBSPViewsFrontEndSearchResultsList'));
                array_push($this->views, array('key' => 'frontend_search_results_grid',
                                               'name' => 'DOPBSPViewsFrontEndSearchResultsGrid'));
                array_push($this->views, array('key' => 'frontend_search_sidebar',
                                               'name' => 'DOPBSPViewsFrontEndSearchSidebar'));
                array_push($this->views, array('key' => 'frontend_search_sort',
                                               'name' => 'DOPBSPViewsFrontEndSearchSort'));
                array_push($this->views, array('key' => 'frontend_search_view',
                                               'name' => 'DOPBSPViewsFrontEndSearchView'));
                
                /*
                 * Set settings view classes.
                 */
                array_push($this->views, array('key' => 'backend_settings',
                                               'name' => 'DOPBSPViewsBackEndSettings'));
                array_push($this->views, array('key' => 'backend_settings_calendar',
                                               'name' => 'DOPBSPViewsBackEndSettingsCalendar'));
                array_push($this->views, array('key' => 'backend_settings_notifications',
                                               'name' => 'DOPBSPViewsBackEndSettingsNotifications'));
                array_push($this->views, array('key' => 'backend_settings_payment_gateways',
                                               'name' => 'DOPBSPViewsBackEndSettingsPaymentGateways'));
                array_push($this->views, array('key' => 'backend_settings_search',
                                               'name' => 'DOPBSPViewsBackEndSettingsSearch'));
                array_push($this->views, array('key' => 'backend_settings_users',
                                               'name' => 'DOPBSPViewsBackEndSettingsUsers'));
                
                /*
                 * Set staff view classes.
                 */
                array_push($this->views, array('key' => 'backend_staff',
                                               'name' => 'DOPBSPViewsBackEndStaff'));
                
                /*
                 * Set templates view classes.
                 */
                array_push($this->views, array('key' => 'backend_templates',
                                               'name' => 'DOPBSPViewsBackEndTemplates'));
                
                /*
                 * Set themes view classes.
                 */
                array_push($this->views, array('key' => 'backend_themes',
                                               'name' => 'DOPBSPViewsBackEndThemes'));
                
                /*
                 * Set tools view classes.
                 */
                array_push($this->views, array('key' => 'backend_tools',
                                               'name' => 'DOPBSPViewsBackEndTools'));
                array_push($this->views, array('key' => 'backend_tools_repair_calendars_settings',
                                               'name' => 'DOPBSPViewsBackEndToolsRepairCalendarsSettings'));
                
                /*
                 * Set translation view classes.
                 */
                array_push($this->views, array('key' => 'backend_translation',
                                               'name' => 'DOPBSPViewsBackEndTranslation'));
            }
        }
    }