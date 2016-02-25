<?php /*
YOjii-Katana-Module  Name: BookSlug Press
Version: 2.0
YOjii-Katana-Module  URI: https://github.com/MrJii?tab=activity
Description: Transform your CMS (Content Management System) website into a online booking/reservation system. 
Author: Davao Online Portal -DOP- by YOjii-Katana
Author URI: http://www.facebook.com/YOjii-Katana*/
// ini_set('error_reporting', version_compare(PHP_VERSION,5,'>=') && version_compare(PHP_VERSION,6,'<') ? E_ALL^E_STRICT^E_NOTICE^E_WARNING:E_ALL^E_NOTICE^E_WARNING);

    /*
     * Constants
     */
    define('DOPBSP_DEVELOPMENT_MODE', $_SERVER['SERVER_NAME'] ==  'jiiyo.wordpress.com' ? true:false);
    define('DOPBSP_REPAIR_DATABASE_TEXT', isset($_POST['dopbsp_repair_database_text']) ? true:false);
    
    DOPBSPErrorsHandler::start();
    
    try{
        /*
         * Configuration file
         */
        include_once 'dopbsp-config.php';

        /*
         * Libraries
         */
        include_once 'libraries/php/dop-prototypes.php';
        include_once ABSPATH.WPINC.'/class-phpmailer.php';
        include_once ABSPATH.WPINC.'/class-smtp.php';

        /*
         * Views
         */
        include_once 'views/views.php';

        include_once 'views/views-backend.php';
        include_once 'views/views-frontend.php';

        include_once 'views/addons/views-backend-addons.php';

        include_once 'views/amenities/views-backend-amenities.php';

        include_once 'views/calendars/views-backend-calendars.php';

        include_once 'views/coupons/views-backend-coupons.php';
        include_once 'views/coupons/views-backend-coupon.php';

        include_once 'views/dashboard/views-backend-dashboard.php';
        include_once 'views/dashboard/views-backend-dashboard-server.php';
        include_once 'views/dashboard/views-backend-dashboard-start.php';

        include_once 'views/discounts/views-backend-discounts.php';
        include_once 'views/discounts/views-backend-discount.php';
        include_once 'views/discounts/views-backend-discount-items.php';
        include_once 'views/discounts/views-backend-discount-item.php';
        include_once 'views/discounts/views-backend-discount-item-rule.php';

        include_once 'views/emails/views-backend-emails.php';
        include_once 'views/emails/views-backend-email.php';

        include_once 'views/events/views-backend-events.php';

        include_once 'views/extras/views-backend-extras.php';
        include_once 'views/extras/views-backend-extra.php';
        include_once 'views/extras/views-backend-extra-groups.php';
        include_once 'views/extras/views-backend-extra-group.php';
        include_once 'views/extras/views-backend-extra-group-item.php';

        include_once 'views/fees/views-backend-fees.php';
        include_once 'views/fees/views-backend-fee.php';

        include_once 'views/forms/views-backend-forms.php';
        include_once 'views/forms/views-backend-form.php';
        include_once 'views/forms/views-backend-form-fields.php';
        include_once 'views/forms/views-backend-form-field.php';
        include_once 'views/forms/views-backend-form-field-select-option.php';
        
        include_once 'views/languages/views-backend-languages.php';

        include_once 'views/locations/views-backend-locations.php';
        include_once 'views/locations/views-backend-location.php';

        include_once 'views/reservations/views-backend-reservations.php';
        include_once 'views/reservations/views-backend-reservations-list.php';
        include_once 'views/reservations/views-backend-reservation.php';
        include_once 'views/reservations/views-backend-reservation-coupon.php';
        include_once 'views/reservations/views-backend-reservation-details.php';
        include_once 'views/reservations/views-backend-reservation-discount.php';
        include_once 'views/reservations/views-backend-reservation-extras.php';
        include_once 'views/reservations/views-backend-reservation-fees.php';
        include_once 'views/reservations/views-backend-reservation-form.php';

        include_once 'views/reviews/views-backend-reviews.php';

        include_once 'views/rules/views-backend-rules.php';
        include_once 'views/rules/views-backend-rule.php';

        include_once 'views/search/views-backend-searches.php';
        include_once 'views/search/views-backend-search.php';
        include_once 'views/search/views-frontend-search.php';
        include_once 'views/search/views-frontend-search-results.php';
        include_once 'views/search/views-frontend-search-results-grid.php';
        include_once 'views/search/views-frontend-search-results-list.php';
        include_once 'views/search/views-frontend-search-sidebar.php';
        include_once 'views/search/views-frontend-search-sort.php';
        include_once 'views/search/views-frontend-search-views.php';

        include_once 'views/settings/views-backend-settings.php';
        include_once 'views/settings/views-backend-settings-calendar.php';
        include_once 'views/settings/views-backend-settings-notifications.php';
        include_once 'views/settings/views-backend-settings-payment-gateways.php';
        include_once 'views/settings/views-backend-settings-search.php';
        include_once 'views/settings/views-backend-settings-users.php';

        include_once 'views/staff/views-backend-staff.php';

        include_once 'views/templates/views-backend-templates.php';

        include_once 'views/themes/views-backend-themes.php';

        include_once 'views/tools/views-backend-tools.php';
        include_once 'views/tools/views-backend-tools-repair-calendars-settings.php';

        include_once 'views/translation/views-backend-translation.php';

        /*
         * Classes
         */
        include_once 'includes/class-backend.php';
        include_once 'includes/class-frontend.php';

        include_once 'includes/addons/class-backend-addons.php';

        include_once 'includes/amenities/class-backend-amenities.php';

        include_once 'includes/calendars/class-backend-calendars.php';
        include_once 'includes/calendars/class-backend-calendar.php';
        include_once 'includes/calendars/class-backend-calendar-availability.php';
        include_once 'includes/calendars/class-backend-calendar-schedule.php';
        include_once 'includes/calendars/class-frontend-calendar.php';
        include_once 'includes/calendars/class-frontend-calendar-sidebar.php';

        include_once 'includes/coupons/class-backend-coupons.php';
        include_once 'includes/coupons/class-backend-coupon.php';
        include_once 'includes/coupons/class-frontend-coupons.php';

        include_once 'includes/class-currencies.php';

       // include_once 'includes/custom-posts/class-custom-posts.php';
      //  include_once 'includes/custom-posts/class-custom-posts-loop.php';
     //   include_once 'includes/custom-posts/class-custom-posts-meta.php';

      //  include_once 'includes/dashboard/class-backend-dashboard.php';

        include_once 'includes/class-database.php';

        include_once 'includes/discounts/class-backend-discounts.php';
        include_once 'includes/discounts/class-backend-discount.php';
        include_once 'includes/discounts/class-backend-discount-items.php';
        include_once 'includes/discounts/class-backend-discount-item.php';
        include_once 'includes/discounts/class-backend-discount-item-rules.php';
        include_once 'includes/discounts/class-backend-discount-item-rule.php';
        include_once 'includes/discounts/class-frontend-discounts.php';

        include_once 'includes/emails/class-backend-emails.php';
        include_once 'includes/emails/class-backend-email.php';

        include_once 'includes/events/class-backend-events.php';

        include_once 'includes/extras/class-backend-extras.php';
        include_once 'includes/extras/class-backend-extra.php';
        include_once 'includes/extras/class-backend-extra-groups.php';
        include_once 'includes/extras/class-backend-extra-group.php';
        include_once 'includes/extras/class-backend-extra-group-items.php';
        include_once 'includes/extras/class-backend-extra-group-item.php';
        include_once 'includes/extras/class-frontend-extras.php';

        include_once 'includes/fees/class-backend-fees.php';
        include_once 'includes/fees/class-backend-fee.php';
        include_once 'includes/fees/class-frontend-fees.php';

        include_once 'includes/forms/class-backend-forms.php';
        include_once 'includes/forms/class-backend-form.php';
        include_once 'includes/forms/class-backend-form-fields.php';
        include_once 'includes/forms/class-backend-form-field.php';
        include_once 'includes/forms/class-backend-form-field-select-options.php';
        include_once 'includes/forms/class-backend-form-field-select-option.php';
        include_once 'includes/forms/class-frontend-forms.php';

        include_once 'includes/languages/class-languages.php';
        include_once 'includes/languages/class-backend-languages.php';
        include_once 'includes/languages/class-backend-language.php';

        include_once 'includes/locations/class-backend-locations.php';
        include_once 'includes/locations/class-backend-location.php';

        include_once 'includes/class-notifications.php';

        include_once 'includes/order/class-frontend-order.php';

        include_once 'includes/class-payment-gateways.php';

        include_once 'includes/class-price.php';

        include_once 'includes/reservations/class-backend-reservations.php';
        include_once 'includes/reservations/class-backend-reservations-add.php';
        include_once 'includes/reservations/class-backend-reservations-calendar.php';
        include_once 'includes/reservations/class-backend-reservations-list.php';
        include_once 'includes/reservations/class-backend-reservation.php';
        include_once 'includes/reservations/class-backend-reservation-notifications.php';
        include_once 'includes/reservations/class-frontend-reservations.php';

        include_once 'includes/reviews/class-backend-reviews.php';

        include_once 'includes/rules/class-backend-rules.php';
        include_once 'includes/rules/class-backend-rule.php';
        include_once 'includes/rules/class-frontend-rules.php';

        include_once 'includes/search/class-backend-searches.php';
        include_once 'includes/search/class-backend-search.php';
        include_once 'includes/search/class-frontend-search.php';
        include_once 'includes/search/class-frontend-search-results.php';

        include_once 'includes/settings/class-backend-settings.php';
        include_once 'includes/settings/class-backend-settings-calendar.php';
        include_once 'includes/settings/class-backend-settings-notifications.php';
        include_once 'includes/settings/class-backend-settings-payment-gateways.php';
        include_once 'includes/settings/class-backend-settings-search.php';
        include_once 'includes/settings/class-backend-settings-users.php';

        include_once 'includes/staff/class-backend-staff.php';

        include_once 'includes/shortcodes/class-backend-shortcodes.php';

        include_once 'includes/templates/class-backend-templates.php';

        include_once 'includes/themes/class-backend-themes.php';

        include_once 'includes/tools/class-backend-tools.php';
        include_once 'includes/tools/class-backend-tools-repair-calendars-settings.php';
        include_once 'includes/tools/class-backend-tools-repair-database-text.php';

        include_once 'includes/translation/class-translation-text-addons.php';
        include_once 'includes/translation/class-translation-text-amenities.php';
        include_once 'includes/translation/class-translation-text-calendars.php';
        include_once 'includes/translation/class-translation-text-cart.php';
        include_once 'includes/translation/class-translation-text-coupons.php';
        include_once 'includes/translation/class-translation-text-custom-posts.php';
        include_once 'includes/translation/class-translation-text-dashboard.php';
        include_once 'includes/translation/class-translation-text-discounts.php';
        include_once 'includes/translation/class-translation-text-emails.php';
        include_once 'includes/translation/class-translation-text-events.php';
        include_once 'includes/translation/class-translation-text-extras.php';
        include_once 'includes/translation/class-translation-text-forms.php';
        include_once 'includes/translation/class-translation-text-fees.php';
        include_once 'includes/translation/class-translation-text-general.php';
        include_once 'includes/translation/class-translation-text-languages.php';
        include_once 'includes/translation/class-translation-text-locations.php';
        include_once 'includes/translation/class-translation-text-order.php';
        include_once 'includes/translation/class-translation-text-reservations.php';
        include_once 'includes/translation/class-translation-text-reviews.php';
        include_once 'includes/translation/class-translation-text-rules.php';
        include_once 'includes/translation/class-translation-text-search.php';
        include_once 'includes/translation/class-translation-text-settings.php';
        include_once 'includes/translation/class-translation-text-staff.php';
        include_once 'includes/translation/class-translation-text-templates.php';
        include_once 'includes/translation/class-translation-text-themes.php';
        include_once 'includes/translation/class-translation-text-tools.php';
        include_once 'includes/translation/class-translation-text-translation.php';
        include_once 'includes/translation/class-translation-text-widgets.php';
        include_once 'includes/translation/class-translation-text-woocommerce.php';
        include_once 'includes/translation/class-translation.php';
        include_once 'includes/translation/class-backend-translation.php';

        include_once 'includes/class-widget.php';
        
        /*
         * Addons
         */
       // include_once 'addons/paypal/dopbsp-paypal.php';
    }
    catch(Exception $ex){
        add_action('admin_notices', 'dopbspMissingFiles');
    }
    
    DOPBSPErrorsHandler::finish();
 
    /*
     * WooCommerce classes.
     */
    if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))
            || DOPBSP_CONFIG_WOOCOMMERCE_ENABLE_CODE){
        DOPBSPErrorsHandler::start();

        try{
            include_once 'includes/woocommerce/class-woocommerce.php';
            include_once 'includes/woocommerce/class-woocommerce-cart.php';
            include_once 'includes/woocommerce/class-woocommerce-category.php';
            include_once 'includes/woocommerce/class-woocommerce-order.php';
            include_once 'includes/woocommerce/class-woocommerce-product.php';
            include_once 'includes/woocommerce/class-woocommerce-tab.php';
            include_once 'includes/woocommerce/class-woocommerce-variation.php';
        }
        catch(Exception $ex){
            add_action('admin_notices', 'dopbspMissingFiles');
        }
        
        DOPBSPErrorsHandler::finish();
    }
    
    /*
     * Global classes.
     */
    global $DOPBSP;
    
    /*
     * https://www.facebook.com/groups/FutureDeveloper/ main PHP class.
     */
    if (!class_exists('DOPBSP')){
        class DOPBSP{
            /*
             * Public variables.
             */
            public $classes;
            public $paths;
            public $tables;
            public $vars;
            public $views;
            
            /*
             * Constructor
             */
            function DOPBSP(){
                $this->classes = new stdClass;
                $this->paths = new stdClass;
                $this->tables = new stdClass;
                $this->vars = new stdClass;
                $this->views = new stdClass;
            
                $this->definePaths();
                $this->defineTables();
                
                /*
                 * Initialize plugin classes.
                 */
                $this->initClasses();
                
                if (is_admin() 
                        && !isset($_POST['dopbsp_frontend_ajax_request'])){
                    add_action('admin_menu', array(&$this, 'initBackEnd'));
                    $this->initBackEndAJAX();
                }
                else{
                    $this->initFrontEndAJAX();
                }
                
                /*
                 * Initialize plugin's widget.
                 */
                if (class_exists('DOPBSPWidget')){
                    add_action('widgets_init', create_function('', 'return register_widget("DOPBSPWidget");'));
                }
            }
            
            /*
             * Defines plugin's paths constants.
             */
            function definePaths(){
                /*
                 * Plugin URL.
                 */
                $this->paths->url =  plugin_dir_url(__FILE__);

                /*
                 * Absolute path.
                 */
                $this->paths->abs = str_replace('\\', '/', plugin_dir_path(__FILE__));
            }
            
            /*
             * Defines plugin's tables constants.
             */
            function defineTables(){
                global $wpdb;
                
                /*
                 * Calendars table.
                 */
                $this->tables->calendars = $wpdb->prefix.'dopbsp_calendars';

                /*
                 * Counpons tables.
                 */
                $this->tables->coupons = $wpdb->prefix.'dopbsp_coupons';

                /*
                 * Days table.
                 */
                $this->tables->days = $wpdb->prefix.'dopbsp_days';
                $this->tables->days_available = $wpdb->prefix.'dopbsp_days_available';
                $this->tables->days_unavailable = $wpdb->prefix.'dopbsp_days_unavailable';

                /*
                 * Discounts tables.
                 */
                $this->tables->discounts = $wpdb->prefix.'dopbsp_discounts';
                $this->tables->discounts_items = $wpdb->prefix.'dopbsp_discounts_items';
                $this->tables->discounts_items_rules = $wpdb->prefix.'dopbsp_discounts_items_rules';

                /*
                 * Emails tables.
                 */
                $this->tables->emails = $wpdb->prefix.'dopbsp_emails';
                $this->tables->emails_translation = $wpdb->prefix.'dopbsp_emails_translation';
                
                /*
                 * Extras tables.
                 */
                $this->tables->extras = $wpdb->prefix.'dopbsp_extras';
                $this->tables->extras_groups = $wpdb->prefix.'dopbsp_extras_groups';
                $this->tables->extras_groups_items = $wpdb->prefix.'dopbsp_extras_groups_items';

                /*
                 * Fees tables.
                 */
                $this->tables->fees = $wpdb->prefix.'dopbsp_fees';
                
                /*
                 * Forms tables.
                 */
                $this->tables->forms = $wpdb->prefix.'dopbsp_forms';
                $this->tables->forms_fields = $wpdb->prefix.'dopbsp_forms_fields';
                $this->tables->forms_fields_options = $wpdb->prefix.'dopbsp_forms_select_options';
                
                /*
                 * Languages tables.
                 */
                $this->tables->languages = $wpdb->prefix.'dopbsp_languages';
                
                /*
                 * Locations tables.
                 */
                $this->tables->locations = $wpdb->prefix.'dopbsp_locations';

                /*
                 * Reservations table.
                 */
                $this->tables->reservations = $wpdb->prefix.'dopbsp_reservations';

                /*
                 * Rules tables.
                 */
                $this->tables->rules = $wpdb->prefix.'dopbsp_rules';

                /*
                 * Search table.
                 */
                $this->tables->searches = $wpdb->prefix.'dopbsp_searches';

                /*
                 * Settings table.
                 */
                $this->tables->settings = $wpdb->prefix.'dopbsp_settings';
                $this->tables->settings_calendar = $wpdb->prefix.'dopbsp_settings_calendar';
                $this->tables->settings_notifications = $wpdb->prefix.'dopbsp_settings_notifications';
                $this->tables->settings_payment = $wpdb->prefix.'dopbsp_settings_payment';
                $this->tables->settings_search = $wpdb->prefix.'dopbsp_settings_search';

                /*
                 * Translation tables.
                 */
                $this->tables->translation = $wpdb->prefix.'dopbsp_translation';

                /*
                 * WooCommerce table.
                 */
                $this->tables->woocommerce = $wpdb->prefix.'dopbsp_woocommerce';
            }
            
            /*
             * Initialize PHP classes.
             */
            function initClasses(){
                /*
                 * Initialize views class. This class is the 1st initialized.
                 */
                $this->views = class_exists('DOPBSPViews') ? new DOPBSPViews():'Class does not exist!';
                
                /*
                 *  Initialize DOP prototypes class. This class is the 2nd initialized.
                 */
                $this->classes->prototypes = class_exists('DOPPrototypes') ? new DOPPrototypes():'Class does not exist!';
                
                /*
                 * Initialize database class. This class is the 3rd initialized.
                 */
                $this->classes->database = class_exists('DOPBSPDatabase') ? new DOPBSPDatabase():'Class does not exist!';
    
                /*
                 * Initialize languages class. This class is the 4th initialized.
                 */
                $this->classes->languages = class_exists('DOPBSPLanguages') ? new DOPBSPLanguages():'Class does not exist!';
    
                /*
                 * Initialize translation classes. This class is the 5th initialized in alphabetical order, but main class will last.
                 */
                class_exists('DOPBSPTranslationTextAddons') ? new DOPBSPTranslationTextAddons():'Class does not exist!';
                class_exists('DOPBSPTranslationTextAmenities') ? new DOPBSPTranslationTextAmenities():'Class does not exist!';
                class_exists('DOPBSPTranslationTextCalendars') ? new DOPBSPTranslationTextCalendars():'Class does not exist!';
                class_exists('DOPBSPTranslationTextCart') ? new DOPBSPTranslationTextCart():'Class does not exist!';
                class_exists('DOPBSPTranslationTextCoupons') ? new DOPBSPTranslationTextCoupons():'Class does not exist!';
                class_exists('DOPBSPTranslationTextCustomPosts') ? new DOPBSPTranslationTextCustomPosts():'Class does not exist!';
                class_exists('DOPBSPTranslationTextDashboard') ? new DOPBSPTranslationTextDashboard():'Class does not exist!';
                class_exists('DOPBSPTranslationTextDiscounts') ? new DOPBSPTranslationTextDiscounts():'Class does not exist!';
                class_exists('DOPBSPTranslationTextEmails') ? new DOPBSPTranslationTextEmails():'Class does not exist!';
                class_exists('DOPBSPTranslationTextEvents') ? new DOPBSPTranslationTextEvents():'Class does not exist!';
                class_exists('DOPBSPTranslationTextExtras') ? new DOPBSPTranslationTextExtras():'Class does not exist!';
                class_exists('DOPBSPTranslationTextFees') ? new DOPBSPTranslationTextFees():'Class does not exist!';
                class_exists('DOPBSPTranslationTextForms') ? new DOPBSPTranslationTextForms():'Class does not exist!';
                class_exists('DOPBSPTranslationTextGeneral') ? new DOPBSPTranslationTextGeneral():'Class does not exist!';
                class_exists('DOPBSPTranslationTextLanguages') ? new DOPBSPTranslationTextLanguages():'Class does not exist!';
                class_exists('DOPBSPTranslationTextLocations') ? new DOPBSPTranslationTextLocations():'Class does not exist!';
                class_exists('DOPBSPTranslationTextOrder') ? new DOPBSPTranslationTextOrder():'Class does not exist!';
                class_exists('DOPBSPTranslationTextReservations') ? new DOPBSPTranslationTextReservations():'Class does not exist!';
                class_exists('DOPBSPTranslationTextReviews') ? new DOPBSPTranslationTextReviews():'Class does not exist!';
                class_exists('DOPBSPTranslationTextRules') ? new DOPBSPTranslationTextRules():'Class does not exist!';
                class_exists('DOPBSPTranslationTextSearch') ? new DOPBSPTranslationTextSearch():'Class does not exist!';
                class_exists('DOPBSPTranslationTextSettings') ? new DOPBSPTranslationTextSettings():'Class does not exist!';
                class_exists('DOPBSPTranslationTextStaff') ? new DOPBSPTranslationTextStaff():'Class does not exist!';
                class_exists('DOPBSPTranslationTextTemplates') ? new DOPBSPTranslationTextTemplates():'Class does not exist!';
                class_exists('DOPBSPTranslationTextThemes') ? new DOPBSPTranslationTextThemes():'Class does not exist!';
                class_exists('DOPBSPTranslationTextTools') ? new DOPBSPTranslationTextTools():'Class does not exist!';
                class_exists('DOPBSPTranslationTextTranslation') ? new DOPBSPTranslationTextTranslation():'Class does not exist!';
                class_exists('DOPBSPTranslationTextWidgets') ? new DOPBSPTranslationTextWidgets():'Class does not exist!';
                class_exists('DOPBSPTranslationTextWooCommerce') ? new DOPBSPTranslationTextWooCommerce():'Class does not exist!';
                    
                $this->classes->translation = class_exists('DOPBSPTranslation') ? new DOPBSPTranslation():'Class does not exist!';
    
                /*
                 * Initialize currencies class. This class is the 6th initialized.
                 */
                $this->classes->currencies = class_exists('DOPBSPCurrencies') ? new DOPBSPCurrencies():'Class does not exist!';

                /*
                 * Initialize notifications class. This class is the 7th initialized.
                 */
                $this->classes->notifications = class_exists('DOPBSPNotifications') ? new DOPBSPNotifications():'Class does not exist!';
    
                /*
                 * Initialize back end class. This class is the 8th initialized.
                 */
                $this->classes->backend = class_exists('DOPBSPBackEnd') ? new DOPBSPBackEnd():'Class does not exist!';
                
                /*
                 * Initialize front end class. This class is the 9th initialized.
                 */
                $this->classes->frontend = class_exists('DOPBSPFrontEnd') ? new DOPBSPFrontEnd():'Class does not exist!';
                
                /*
                 * ************************************************************* The rest of the classes are initialized in alphabetical order.
                 */
                /*
                 * Initialize amenities classes.
                 */
                $this->classes->backend_amenities = class_exists('DOPBSPBackEndAmenities') ? new DOPBSPBackEndAmenities():'Class does not exist!';
                
                /*
                 * Initialize addons classes.
                 */
                $this->classes->backend_addons = class_exists('DOPBSPBackEndAddons') ? new DOPBSPBackEndAddons():'Class does not exist!';
                
                /*
                 * Initialize calendars classes.
                 */
                $this->classes->backend_calendars = class_exists('DOPBSPBackEndCalendars') ? new DOPBSPBackEndCalendars():'Class does not exist!';
                $this->classes->backend_calendar = class_exists('DOPBSPBackEndCalendar') ? new DOPBSPBackEndCalendar():'Class does not exist!';
                $this->classes->backend_calendar_availability = class_exists('DOPBSPBackEndCalendarAvailability') ? new DOPBSPBackEndCalendarAvailability():'Class does not exist!';
                $this->classes->backend_calendar_schedule = class_exists('DOPBSPBackEndCalendarSchedule') ? new DOPBSPBackEndCalendarSchedule():'Class does not exist!';
                $this->classes->frontend_calendar = class_exists('DOPBSPFrontEndCalendar') ? new DOPBSPFrontEndCalendar():'Class does not exist!';
                $this->classes->frontend_calendar_sidebar = class_exists('DOPBSPFrontEndCalendarSidebar') ? new DOPBSPFrontEndCalendarSidebar():'Class does not exist!';

                /*
                 * Initialize coupons classes.
                 */
                $this->classes->backend_coupons = class_exists('DOPBSPBackEndCoupons') ? new DOPBSPBackEndCoupons():'Class does not exist!';
                $this->classes->backend_coupon = class_exists('DOPBSPBackEndCoupon') ? new DOPBSPBackEndCoupon():'Class does not exist!';
                $this->classes->frontend_coupons = class_exists('DOPBSPFrontEndCoupons') ? new DOPBSPFrontEndCoupons():'Class does not exist!';

                /*
                 * Initialize custom posts classes.
                 */
                $this->classes->custom_posts = class_exists('DOPBSPCustomPosts') ? new DOPBSPCustomPosts():'Class does not exist!';
                $this->classes->custom_posts_loop = class_exists('DOPBSPCustomPostsLoop') ? new DOPBSPCustomPostsLoop():'Class does not exist!';
                $this->classes->custom_posts_meta = class_exists('DOPBSPCustomPostsMeta') ? new DOPBSPCustomPostsMeta():'Class does not exist!';

                /*
                 * Initialize dashboard classes.
                 */
                $this->classes->backend_dashboard = class_exists('DOPBSPBackEndDashboard') ? new DOPBSPBackEndDashboard():'Class does not exist!';

                /*
                 * Initialize discounts classes.
                 */
                $this->classes->backend_discounts = class_exists('DOPBSPBackEndDiscounts') ? new DOPBSPBackEndDiscounts():'Class does not exist!';
                $this->classes->backend_discount = class_exists('DOPBSPBackEndDiscount') ? new DOPBSPBackEndDiscount():'Class does not exist!';
                $this->classes->backend_discount_items = class_exists('DOPBSPBackEndDiscountItems') ? new DOPBSPBackEndDiscountItems():'Class does not exist!';
                $this->classes->backend_discount_item = class_exists('DOPBSPBackEndDiscountItem') ? new DOPBSPBackEndDiscountItem():'Class does not exist!';
                $this->classes->backend_discount_item_rules = class_exists('DOPBSPBackEndDiscountItemRules') ? new DOPBSPBackEndDiscountItemRules():'Class does not exist!';
                $this->classes->backend_discount_item_rule = class_exists('DOPBSPBackEndDiscountItemRule') ? new DOPBSPBackEndDiscountItemRule():'Class does not exist!';
                $this->classes->frontend_discounts = class_exists('DOPBSPFrontEndDiscounts') ? new DOPBSPFrontEndDiscounts():'Class does not exist!';

                /*
                 * Initialize emails classes.
                 */
                $this->classes->backend_emails = class_exists('DOPBSPBackEndEmails') ? new DOPBSPBackEndEmails():'Class does not exist!';
                $this->classes->backend_email = class_exists('DOPBSPBackEndEmail') ? new DOPBSPBackEndEmail():'Class does not exist!';

                /*
                 * Initialize events classes.
                 */
                $this->classes->backend_events = class_exists('DOPBSPBackEndEvents') ? new DOPBSPBackEndEvents():'Class does not exist!';

                /*
                 * Initialize extras classes.
                 */
                $this->classes->backend_extras = class_exists('DOPBSPBackEndExtras') ? new DOPBSPBackEndExtras():'Class does not exist!';
                $this->classes->backend_extra = class_exists('DOPBSPBackEndExtra') ? new DOPBSPBackEndExtra():'Class does not exist!';
                $this->classes->backend_extra_groups = class_exists('DOPBSPBackEndExtraGroups') ? new DOPBSPBackEndExtraGroups():'Class does not exist!';
                $this->classes->backend_extra_group = class_exists('DOPBSPBackEndExtraGroup') ? new DOPBSPBackEndExtraGroup():'Class does not exist!';
                $this->classes->backend_extra_group_items = class_exists('DOPBSPBackEndExtraGroupItems') ? new DOPBSPBackEndExtraGroupItems():'Class does not exist!';
                $this->classes->backend_extra_group_item = class_exists('DOPBSPBackEndExtraGroupItem') ? new DOPBSPBackEndExtraGroupItem():'Class does not exist!';
                $this->classes->frontend_extras = class_exists('DOPBSPFrontEndExtras') ? new DOPBSPFrontEndExtras():'Class does not exist!';

                /*
                 * Initialize fees classes.
                 */
                $this->classes->backend_fees = class_exists('DOPBSPBackEndFees') ? new DOPBSPBackEndFees():'Class does not exist!';
                $this->classes->backend_fee = class_exists('DOPBSPBackEndFee') ? new DOPBSPBackEndFee():'Class does not exist!';
                $this->classes->frontend_fees = class_exists('DOPBSPFrontEndFees') ? new DOPBSPFrontEndFees():'Class does not exist!';

                /*
                 * Initialize forms classes.
                 */
                $this->classes->backend_forms = class_exists('DOPBSPBackEndForms') ? new DOPBSPBackEndForms():'Class does not exist!';
                $this->classes->backend_form = class_exists('DOPBSPBackEndForm') ? new DOPBSPBackEndForm():'Class does not exist!';
                $this->classes->backend_form_fields = class_exists('DOPBSPBackEndFormFields') ? new DOPBSPBackEndFormFields():'Class does not exist!';
                $this->classes->backend_form_field = class_exists('DOPBSPBackEndFormField') ? new DOPBSPBackEndFormField():'Class does not exist!';
                $this->classes->backend_form_field_select_options = class_exists('DOPBSPBackEndFormFieldSelectOptions') ? new DOPBSPBackEndFormFieldSelectOptions():'Class does not exist!';
                $this->classes->backend_form_field_select_option = class_exists('DOPBSPBackEndFormFieldSelectOption') ? new DOPBSPBackEndFormFieldSelectOption():'Class does not exist!';
                $this->classes->frontend_forms = class_exists('DOPBSPFrontEndForms') ? new DOPBSPFrontEndForms():'Class does not exist!';

                /*
                 * Initialize languages classes, except main class.
                 */
                $this->classes->backend_languages = class_exists('DOPBSPBackEndLanguages') ? new DOPBSPBackEndLanguages():'Class does not exist!';
                $this->classes->backend_language = class_exists('DOPBSPBackEndLanguage') ? new DOPBSPBackEndLanguage():'Class does not exist!';

                /*
                 * Initialize locations classes.
                 */
                $this->classes->backend_locations = class_exists('DOPBSPBackEndLocations') ? new DOPBSPBackEndLocations():'Class does not exist!';
                $this->classes->backend_location = class_exists('DOPBSPBackEndLocation') ? new DOPBSPBackEndLocation():'Class does not exist!';

                /*
                 * Initialize order classes.
                 */
                $this->classes->frontend_order = class_exists('DOPBSPFrontEndOrder') ? new DOPBSPFrontEndOrder():'Class does not exist!';
                
                /*
                 * Initialize payment gateways.
                 */
                $this->classes->payment_gateways = class_exists('DOPBSPPaymentGateways') ? new DOPBSPPaymentGateways():'Class does not exist!';

                /*
                 * Initialize price classes.
                 */
                $this->classes->price = class_exists('DOPBSPPrice') ? new DOPBSPPrice():'Class does not exist!';

                /*
                 * Initialize reservations classes.
                 */
                $this->classes->backend_reservations = class_exists('DOPBSPBackEndReservations') ? new DOPBSPBackEndReservations():'Class does not exist!';
                $this->classes->backend_reservations_add = class_exists('DOPBSPBackEndReservationsAdd') ? new DOPBSPBackEndReservationsAdd():'Class does not exist!';
                $this->classes->backend_reservations_calendar = class_exists('DOPBSPBackEndReservationsCalendar') ? new DOPBSPBackEndReservationsCalendar():'Class does not exist!';
                $this->classes->backend_reservations_list = class_exists('DOPBSPBackEndReservationsList') ? new DOPBSPBackEndReservationsList():'Class does not exist!';
                $this->classes->backend_reservation = class_exists('DOPBSPBackEndReservation') ? new DOPBSPBackEndReservation():'Class does not exist!';
                $this->classes->backend_reservation_notifications = class_exists('DOPBSPBackEndReservationNotifications') ? new DOPBSPBackEndReservationNotifications():'Class does not exist!';
                $this->classes->frontend_reservations = class_exists('DOPBSPFrontEndReservations') ? new DOPBSPFrontEndReservations():'Class does not exist!';
                
                /*
                 * Initialize reviews classes.
                 */
                $this->classes->backend_reviews = class_exists('DOPBSPBackEndReviews') ? new DOPBSPBackEndReviews():'Class does not exist!';

                /*
                 * Initialize rules classes.
                 */
                $this->classes->backend_rules = class_exists('DOPBSPBackEndRules') ? new DOPBSPBackEndRules():'Class does not exist!';
                $this->classes->backend_rule = class_exists('DOPBSPBackEndRule') ? new DOPBSPBackEndRule():'Class does not exist!';
                $this->classes->frontend_rules = class_exists('DOPBSPFrontEndRules') ? new DOPBSPFrontEndRules():'Class does not exist!';

                /*
                 * Initialize search classes.
                 */
                $this->classes->backend_searches = class_exists('DOPBSPBackEndSearches') ? new DOPBSPBackEndSearches():'Class does not exist!';
                $this->classes->backend_search = class_exists('DOPBSPBackEndSearch') ? new DOPBSPBackEndSearch():'Class does not exist!';
                $this->classes->frontend_search = class_exists('DOPBSPFrontEndSearch') ? new DOPBSPFrontEndSearch():'Class does not exist!';
                $this->classes->frontend_search_results = class_exists('DOPBSPFrontEndSearchResults') ? new DOPBSPFrontEndSearchResults():'Class does not exist!';

                /*
                 * Initialize settings classes.
                 */
                $this->classes->backend_settings = class_exists('DOPBSPBackEndSettings') ? new DOPBSPBackEndSettings():'Class does not exist!';
                $this->classes->backend_settings_calendar = class_exists('DOPBSPBackEndSettingsCalendar') ? new DOPBSPBackEndSettingsCalendar():'Class does not exist!';
                $this->classes->backend_settings_notifications = class_exists('DOPBSPBackEndSettingsNotifications') ? new DOPBSPBackEndSettingsNotifications():'Class does not exist!';
                $this->classes->backend_settings_payment_gateways = class_exists('DOPBSPBackEndSettingsPaymentGateways') ? new DOPBSPBackEndSettingsPaymentGateways():'Class does not exist!';
                $this->classes->backend_settings_search = class_exists('DOPBSPBackEndSettingsSearch') ? new DOPBSPBackEndSettingsSearch():'Class does not exist!';
                $this->classes->backend_settings_users = class_exists('DOPBSPBackEndSettingsUsers') ? new DOPBSPBackEndSettingsUsers():'Class does not exist!';

                /*
                 * Initialize shortcodes classes.
                 */
                $this->classes->backend_shortcodes = class_exists('DOPBSPBackEndShortcodes') ? new DOPBSPBackEndShortcodes():'Class does not exist!';

                /*
                 * Initialize staff classes.
                 */
                $this->classes->backend_staff = class_exists('DOPBSPBackEndStaff') ? new DOPBSPBackEndStaff():'Class does not exist!';

                /*
                 * Initialize templates classes.
                 */
                $this->classes->backend_templates = class_exists('DOPBSPBackEndTemplates') ? new DOPBSPBackEndTemplates():'Class does not exist!';
                
                /*
                 * Initialize themes classes.
                 */
                $this->classes->backend_themes = class_exists('DOPBSPBackEndThemes') ? new DOPBSPBackEndThemes():'Class does not exist!';
                
                /*
                 * Initialize tools classes.
                 */
                $this->classes->backend_tools = class_exists('DOPBSPBackEndTools') ? new DOPBSPBackEndTools():'Class does not exist!';
                $this->classes->backend_tools_repair_calendars_settings = class_exists('DOPBSPBackEndToolsRepairCalendarsSettings') ? new DOPBSPBackEndToolsRepairCalendarsSettings():'Class does not exist!';
                $this->classes->backend_tools_repair_database_text = class_exists('DOPBSPBackEndToolsRepairDatabaseText') ? new DOPBSPBackEndToolsRepairDatabaseText():'Class does not exist!';
                
                /*
                 * Initialize translation classes, except main class.
                 */
                $this->classes->backend_translation = class_exists('DOPBSPBackEndTranslation') ? new DOPBSPBackEndTranslation():'Class does not exist!';

                /*
                 * Initialize WooCommerce classes.
                 */
                $this->classes->woocommerce = class_exists('DOPBSPWooCommerce') ? new DOPBSPWooCommerce():'Class does not exist!';
                $this->classes->woocommerce_cart = class_exists('DOPBSPWooCommerceCart') ? new DOPBSPWooCommerceCart():'Class does not exist!';
                $this->classes->woocommerce_category = class_exists('DOPBSPWooCommerceCategory') ? new DOPBSPWooCommerceCategory():'Class does not exist!';
                $this->classes->woocommerce_order = class_exists('DOPBSPWooCommerceOrder') ? new DOPBSPWooCommerceOrder():'Class does not exist!';
                $this->classes->woocommerce_product = class_exists('DOPBSPWooCommerceProduct') ? new DOPBSPWooCommerceProduct():'Class does not exist!';
                $this->classes->woocommerce_tab = class_exists('DOPBSPWooCommerceTab') ? new DOPBSPWooCommerceTab():'Class does not exist!';
                $this->classes->woocommerce_variation = class_exists('DOPBSPWooCommerceVariation') ? new DOPBSPWooCommerceVariation():'Class does not exist!';
            }
            
            /*
             * Initialize back end.
             */
            function initBackEnd(){
                /*
                 * Set role action for current user.
                 */
                $user_roles = array_values(wp_get_current_user()->roles);
                
                switch ($user_roles[0]){
                    case 'administrator':
                        $role_action = 'manage_options';
                        break;
                    case 'author':
                        $role_action = 'publish_posts';
                        break;
                    case 'contributor':
                        $role_action = 'edit_posts';
                        break;
                    case 'editor':
                        $role_action = 'edit_pages';
                        break;
                    case 'subscriber':
                        $role_action = 'read';
                        break;
                    default:
                        $role_action = $user_roles[0];
                        break;
                }
                
                if (!isset($this->classes->backend_settings_users)){
                    return false;
                }
                
                if (!$this->classes->backend_settings_users->permission(wp_get_current_user()->ID, 'use-booking-system')
                        && !$this->classes->backend_settings_users->permission(wp_get_current_user()->ID, 'use-calendars')){
                    return false;
                }
                if (function_exists('add_options_page')){
//                    add_menu_page($this->text('TITLE'), $this->text('TITLE'), $role_action, 'dopbsp', array(&$this->classes->backend_reservations, 'view'), 'div');
					add_submenu_page('dopbsp', $this->text('RESERVATIONS_TITLE'), $this->text('RESERVATIONS_TITLE'), $role_action, 'dopbsp-reservations', array(&$this->classes->backend_reservations, 'view'));
                    add_submenu_page('dopbsp', $this->text('CALENDARS_TITLE'), $this->text('CALENDARS_TITLE'), $role_action, 'dopbsp-calendars', array(&$this->classes->backend_calendars, 'view'));
                    add_submenu_page('dopbsp', $this->text('EXTRAS_TITLE'), $this->text('EXTRAS_TITLE'), $role_action, 'dopbsp-extras', array(&$this->classes->backend_extras, 'view'));
//                     add_submenu_page('dopbsp', $this->text('TRANSLATION_TITLE', 'Translation'), $this->text('TRANSLATION_TITLE', 'Translation'), 'manage_options', 'dopbsp-translation', array(&$this->classes->translation, 'view'));
				// add_submenu_page('dopbsp', $this->text('TOOLS_TITLE', 'Tools'), $this->text('TOOLS_TITLE', 'Tools'), 'manage_options', 'dopbsp-tools', array(&$this->classes->backend_tools, 'view'));
                }
            }
            
            /*
             * Initialize back end AJAX requests.
             */
            function initBackEndAJAX(){
                /*
                 * Calendars back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_calendars_display', array(&$this->classes->backend_calendars, 'display')); // Returns calendars list.
                
                /*
                 * Calendar back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_calendar_get_options', array(&$this->classes->backend_calendar, 'getOptions'));
                add_action('wp_ajax_dopbsp_calendar_add', array(&$this->classes->backend_calendar, 'add'));
                add_action('wp_ajax_dopbsp_calendar_edit', array(&$this->classes->backend_calendar, 'edit'));
                add_action('wp_ajax_dopbsp_calendar_delete', array(&$this->classes->backend_calendar, 'delete'));
                
                add_action('wp_ajax_dopbsp_calendar_schedule_get', array(&$this->classes->backend_calendar_schedule, 'get'));
                add_action('wp_ajax_dopbsp_calendar_schedule_set', array(&$this->classes->backend_calendar_schedule, 'set'));
                add_action('wp_ajax_dopbsp_calendar_schedule_delete', array(&$this->classes->backend_calendar_schedule, 'delete'));
            
                /*
                 * Coupons back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_coupons_display', array(&$this->classes->backend_coupons, 'display'));
                add_action('wp_ajax_dopbsp_coupon_display', array(&$this->classes->backend_coupon, 'display'));
                add_action('wp_ajax_dopbsp_coupon_add', array(&$this->classes->backend_coupon, 'add'));
                add_action('wp_ajax_dopbsp_coupon_edit', array(&$this->classes->backend_coupon, 'edit'));
                add_action('wp_ajax_dopbsp_coupon_delete', array(&$this->classes->backend_coupon, 'delete'));
                
                /*
                 * Custom posts back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_custom_posts_get', array(&$this->classes->custom_posts_meta, 'get')); 
            
                /*
                 * Discounts back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_discounts_display', array(&$this->classes->backend_discounts, 'display'));
                add_action('wp_ajax_dopbsp_discount_display', array(&$this->classes->backend_discount, 'display'));
                add_action('wp_ajax_dopbsp_discount_add', array(&$this->classes->backend_discount, 'add'));
                add_action('wp_ajax_dopbsp_discount_edit', array(&$this->classes->backend_discount, 'edit'));
                add_action('wp_ajax_dopbsp_discount_delete', array(&$this->classes->backend_discount, 'delete'));

                add_action('wp_ajax_dopbsp_discount_items_sort', array(&$this->classes->backend_discount_items, 'sort'));
                add_action('wp_ajax_dopbsp_discount_item_add', array(&$this->classes->backend_discount_item, 'add'));
                add_action('wp_ajax_dopbsp_discount_item_edit', array(&$this->classes->backend_discount_item, 'edit'));
                add_action('wp_ajax_dopbsp_discount_item_delete', array(&$this->classes->backend_discount_item, 'delete'));
                
                add_action('wp_ajax_dopbsp_discount_item_rules_sort', array(&$this->classes->backend_discount_item_rules, 'sort'));
                add_action('wp_ajax_dopbsp_discount_item_rule_add', array(&$this->classes->backend_discount_item_rule, 'add'));
                add_action('wp_ajax_dopbsp_discount_item_rule_edit', array(&$this->classes->backend_discount_item_rule, 'edit'));
                add_action('wp_ajax_dopbsp_discount_item_rule_delete', array(&$this->classes->backend_discount_item_rule, 'delete'));
            
                /*
                 * Emails back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_emails_display', array(&$this->classes->backend_emails, 'display'));
                add_action('wp_ajax_dopbsp_email_display', array(&$this->classes->backend_email, 'display'));
                add_action('wp_ajax_dopbsp_email_add', array(&$this->classes->backend_email, 'add'));
                add_action('wp_ajax_dopbsp_email_edit', array(&$this->classes->backend_email, 'edit'));
                add_action('wp_ajax_dopbsp_email_delete', array(&$this->classes->backend_email, 'delete'));
            
                /*
                 * Extras back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_extras_display', array(&$this->classes->backend_extras, 'display'));
                add_action('wp_ajax_dopbsp_extra_display', array(&$this->classes->backend_extra, 'display'));
                add_action('wp_ajax_dopbsp_extra_add', array(&$this->classes->backend_extra, 'add'));
                add_action('wp_ajax_dopbsp_extra_edit', array(&$this->classes->backend_extra, 'edit'));
                add_action('wp_ajax_dopbsp_extra_delete', array(&$this->classes->backend_extra, 'delete'));

                add_action('wp_ajax_dopbsp_extra_groups_sort', array(&$this->classes->backend_extra_groups, 'sort'));
                add_action('wp_ajax_dopbsp_extra_group_add', array(&$this->classes->backend_extra_group, 'add'));
                add_action('wp_ajax_dopbsp_extra_group_edit', array(&$this->classes->backend_extra_group, 'edit'));
                add_action('wp_ajax_dopbsp_extra_group_delete', array(&$this->classes->backend_extra_group, 'delete'));
                
                add_action('wp_ajax_dopbsp_extra_group_items_sort', array(&$this->classes->backend_extra_group_items, 'sort'));
                add_action('wp_ajax_dopbsp_extra_group_item_add', array(&$this->classes->backend_extra_group_item, 'add'));
                add_action('wp_ajax_dopbsp_extra_group_item_edit', array(&$this->classes->backend_extra_group_item, 'edit'));
                add_action('wp_ajax_dopbsp_extra_group_item_delete', array(&$this->classes->backend_extra_group_item, 'delete'));
            
                /*
                 * Fees back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_fees_display', array(&$this->classes->backend_fees, 'display'));
                add_action('wp_ajax_dopbsp_fee_display', array(&$this->classes->backend_fee, 'display'));
                add_action('wp_ajax_dopbsp_fee_add', array(&$this->classes->backend_fee, 'add'));
                add_action('wp_ajax_dopbsp_fee_edit', array(&$this->classes->backend_fee, 'edit'));
                add_action('wp_ajax_dopbsp_fee_delete', array(&$this->classes->backend_fee, 'delete'));
                
                /*
                 * Forms back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_forms_display', array(&$this->classes->backend_forms, 'display'));
                add_action('wp_ajax_dopbsp_form_display', array(&$this->classes->backend_form, 'display'));
                add_action('wp_ajax_dopbsp_form_add', array(&$this->classes->backend_form, 'add'));
                add_action('wp_ajax_dopbsp_form_edit', array(&$this->classes->backend_form, 'edit'));
                add_action('wp_ajax_dopbsp_form_delete', array(&$this->classes->backend_form, 'delete'));

                add_action('wp_ajax_dopbsp_form_fields_sort', array(&$this->classes->backend_form_fields, 'sort'));
                add_action('wp_ajax_dopbsp_form_field_add', array(&$this->classes->backend_form_field, 'add'));
                add_action('wp_ajax_dopbsp_form_field_edit', array(&$this->classes->backend_form_field, 'edit'));
                add_action('wp_ajax_dopbsp_form_field_delete', array(&$this->classes->backend_form_field, 'delete'));
                
                add_action('wp_ajax_dopbsp_form_field_select_options_sort', array(&$this->classes->backend_form_field_select_options, 'sort'));
                add_action('wp_ajax_dopbsp_form_field_select_option_add', array(&$this->classes->backend_form_field_select_option, 'add'));
                add_action('wp_ajax_dopbsp_form_field_select_option_edit', array(&$this->classes->backend_form_field_select_option, 'edit'));
                add_action('wp_ajax_dopbsp_form_field_select_option_delete', array(&$this->classes->backend_form_field_select_option, 'delete'));
            
                /*
                 * Languages back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_languages_display', array(&$this->classes->backend_languages, 'display'));
                add_action('wp_ajax_dopbsp_language_change', array(&$this->classes->backend_language, 'change'));
                add_action('wp_ajax_dopbsp_language_enable', array(&$this->classes->backend_language, 'enable'));    
                
                /*
                 * Locations back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_locations_display', array(&$this->classes->backend_locations, 'display'));
                add_action('wp_ajax_dopbsp_location_display', array(&$this->classes->backend_location, 'display'));
                add_action('wp_ajax_dopbsp_location_add', array(&$this->classes->backend_location, 'add'));
                add_action('wp_ajax_dopbsp_location_edit', array(&$this->classes->backend_location, 'edit'));
                add_action('wp_ajax_dopbsp_location_delete', array(&$this->classes->backend_location, 'delete'));
            
                /*
                 * Reservations back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_reservations_add_get_json', array(&$this->classes->backend_reservations_add, 'getJSON'));
                add_action('wp_ajax_dopbsp_reservations_add_book', array(&$this->classes->backend_reservations_add, 'book'));
                
                add_action('wp_ajax_dopbsp_reservations_calendar_get_json', array(&$this->classes->backend_reservations_calendar, 'getJSON'));
                add_action('wp_ajax_dopbsp_reservations_calendar_get', array(&$this->classes->backend_reservations_calendar, 'get'));
                
                add_action('wp_ajax_dopbsp_reservations_list_get', array(&$this->classes->backend_reservations_list, 'get'));
                
                add_action('wp_ajax_dopbsp_reservation_approve', array(&$this->classes->backend_reservation, 'approve'));
                add_action('wp_ajax_dopbsp_reservation_reject', array(&$this->classes->backend_reservation, 'reject'));
                add_action('wp_ajax_dopbsp_reservation_cancel', array(&$this->classes->backend_reservation, 'cancel'));
                add_action('wp_ajax_dopbsp_reservation_delete', array(&$this->classes->backend_reservation, 'delete'));
            
                /*
                 * Rules back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_rules_display', array(&$this->classes->backend_rules, 'display'));
                add_action('wp_ajax_dopbsp_rule_display', array(&$this->classes->backend_rule, 'display'));
                add_action('wp_ajax_dopbsp_rule_add', array(&$this->classes->backend_rule, 'add'));
                add_action('wp_ajax_dopbsp_rule_edit', array(&$this->classes->backend_rule, 'edit'));
                add_action('wp_ajax_dopbsp_rule_delete', array(&$this->classes->backend_rule, 'delete'));
            
                /*
                 * Search back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_searches_display', array(&$this->classes->backend_searches, 'display'));
                add_action('wp_ajax_dopbsp_search_display', array(&$this->classes->backend_search, 'display'));
                add_action('wp_ajax_dopbsp_search_add', array(&$this->classes->backend_search, 'add'));
                add_action('wp_ajax_dopbsp_search_edit', array(&$this->classes->backend_search, 'edit'));
                add_action('wp_ajax_dopbsp_search_delete', array(&$this->classes->backend_search, 'delete'));
            
                /*
                 * Settings back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_settings_calendar_display', array(&$this->classes->backend_settings_calendar, 'display'));
                add_action('wp_ajax_dopbsp_settings_notifications_display', array(&$this->classes->backend_settings_notifications, 'display'));
                add_action('wp_ajax_dopbsp_settings_notifications_test', array(&$this->classes->notifications, 'test'));
                add_action('wp_ajax_dopbsp_settings_payment_gateways_display', array(&$this->classes->backend_settings_payment_gateways, 'display'));
                add_action('wp_ajax_dopbsp_settings_search_display', array(&$this->classes->backend_settings_search, 'display'));
                add_action('wp_ajax_dopbsp_settings_users_permissions_display', array(&$this->classes->backend_settings_users, 'display'));
                add_action('wp_ajax_dopbsp_settings_set', array(&$this->classes->backend_settings, 'set'));
                
                /*
                 * Settings users permissions back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_settings_users_display', array(&$this->classes->backend_settings_users, 'display'));
                add_action('wp_ajax_dopbsp_settings_users_get', array(&$this->classes->backend_settings_users, 'get'));
                add_action('wp_ajax_dopbsp_settings_users_set', array(&$this->classes->backend_settings_users, 'set'));
                add_action('wp_ajax_dopbsp_settings_users_display_calendar', array(&$this->classes->backend_settings_users, 'displayCalendar'));
                add_action('wp_ajax_dopbsp_settings_users_set_calendar', array(&$this->classes->backend_settings_users, 'setCalendar'));
            
                /*
                 * Tools back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_tools_repair_calendars_settings_display', array(&$this->classes->backend_tools_repair_calendars_settings, 'display'));
                add_action('wp_ajax_dopbsp_tools_repair_calendars_settings_get', array(&$this->classes->backend_tools_repair_calendars_settings, 'get'));
                add_action('wp_ajax_dopbsp_tools_repair_calendars_settings_set', array(&$this->classes->backend_tools_repair_calendars_settings, 'set'));
                add_action('wp_ajax_dopbsp_tools_repair_database_text_set', array(&$this->classes->backend_tools_repair_database_text, 'set'));
                
                /*
                 * Translation back end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_translation_display', array(&$this->classes->backend_translation, 'display'));
                add_action('wp_ajax_dopbsp_translation_edit', array(&$this->classes->backend_translation, 'edit'));
                add_action('wp_ajax_dopbsp_translation_reset', array(&$this->classes->backend_translation, 'reset'));
                add_action('wp_ajax_dopbsp_translation_check', array(&$this->classes->translation, 'check'));
            }
            
            /*
             * Initialize front end AJAX requests. 
             */
            function initFrontEndAJAX(){
                /*
                 * Calendar front end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_calendar_schedule_get', array(&$this->classes->backend_calendar_schedule, 'get'));
                add_action('wp_ajax_nopriv_dopbsp_calendar_schedule_get', array(&$this->classes->backend_calendar_schedule, 'get'));
                
                /*
                 * Coupons front end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_coupons_verify', array(&$this->classes->frontend_coupons, 'verify'));
                add_action('wp_ajax_nopriv_dopbsp_coupons_verify', array(&$this->classes->frontend_coupons, 'verify'));
                
                /*
                 * Reservations front end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_reservations_book', array(&$this->classes->frontend_reservations, 'book'));
                add_action('wp_ajax_nopriv_dopbsp_reservations_book', array(&$this->classes->frontend_reservations, 'book'));
                
                /*
                 * Search front end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_search_results_get', array(&$this->classes->frontend_search_results, 'get'));
                add_action('wp_ajax_nopriv_dopbsp_search_results_get', array(&$this->classes->frontend_search_results, 'get'));
            
                /*
                 * WooCommerce front end AJAX requests.
                 */
                add_action('wp_ajax_dopbsp_woocommerce_variation_add', array(&$this->classes->woocommerce_variation, 'add'));
                add_action('wp_ajax_nopriv_dopbsp_woocommerce_variation_add', array(&$this->classes->woocommerce_variation, 'add'));
            }
            
            /*
             * Get text.
             * 
             * @param key (string): translation text key
             * 
             * @return a string 
             */
            function text($key,
                          $fallback = '!'){
                switch ($key){
                    case 'BETA':
                        $prefix = '&nbsp;<em class="dopbsp-small dopbsp-beta">';
                        $suffix = '</em>';
                        break;
                    case 'BETA_TITLE':
                        $prefix = '<em class="dopbsp-beta">';
                        $suffix = '</em>';
                        break;
                    case 'SOON':
                        $prefix = '&nbsp;<em class="dopbsp-small dopbsp-soon">';
                        $suffix = '</em>';
                        break;
                    case 'SOON_TITLE':
                        $prefix = '<em class="dopbsp-soon">';
                        $suffix = '</em>';
                        break;
                    default:
                        $prefix = '';
                        $suffix = '';
                }
                
                return isset($this->vars->translation_text[$key]) ? $prefix.$this->vars->translation_text[$key].$suffix:$fallback;
            }
        }
        $DOPBSP = new DOPBSP();
    }
    
    /*
     * Delete all plugin data if you uninstall it. IMPORTANT! The function needs to be in this file.
     */
    function DOPBSPUninstall(){
        if (DOPBSP_CONFIG_DELETE_DATA_ON_DELETE){
            global $wpdb;
            global $wp_roles;

            /*
             * Delete database tables.
             */
            $tables = $wpdb->get_results('SHOW TABLES');

            foreach ($tables as $table){
                $object_name = 'Tables_in_'.DB_NAME;
                $table_name = $table->$object_name;

                if (strrpos($table_name, 'dopbsp_') !== false){
                    $wpdb->query('DROP TABLE IF EXISTS '.$table_name);
                }
            }
            
            /*
             * Delete options.
             */
            delete_option('DOPBSP_db_version');
            delete_option('DOPBSP_db_version_paypal');
            delete_option('DOPBSP_db_update_settings_calendar_data');

            $roles = $wp_roles->get_names();

            while ($data = current($roles)){
                delete_option('DOPBSP_users_permissions_'.key($roles));
                delete_option('DOPBSP_users_permissions_custom_posts_'.key($roles));
                next($roles);                        
            }
        }
    }
          
    /*
     * Hook uninstall function. The registration needs to be in this file.
     */
    register_uninstall_hook(__FILE__, 'DOPBSPUninstall');  
 
 // Files not included errors handler.
    
    /*
     * Error handler PHP class. IMPORTANT! The class needs to be in this file.
     */
    class DOPBSPErrorsHandler{
        static $IGNORE_DEPRECATED = true;

        /*
         * Start redirecting PHP errors.
         * 
         * @param level (integer): PHP error level to catch (Default = E_ALL & ~E_DEPRECATED)
         */
        static function start($level = null){
            if ($level == null){
                if (defined('E_DEPRECATED')){
                    $level = E_ALL & ~E_DEPRECATED;
                }
                else{
                    $level = E_ALL;
                    self::$IGNORE_DEPRECATED = true;
                }
            }
            set_error_handler(array('DOPBSPErrorsHandler', 'handle'), $level);
        }

        /*
         * Stop redirecting PHP errors.
         */
        static function finish(){
            restore_error_handler();
        }

        /*
         * Handle error exceptions.
         *
         * @param code (string)
         * @param string (string)
         * @param file (string)
         * @param line (string)
         * @param context (string)
         * 
         * @return true if no errors else the errors object
         */
        static function handle($code,
                               $string,
                               $file,
                               $line,
                               $context){
            if (error_reporting() == 0){
                return;
            }

            if (self::$IGNORE_DEPRECATED 
                    && strpos($string, 'deprecated') === true){
                return true;
            }
            throw new Exception($string, $code);
        }
    }
    
    /*
     * Message to be displayed if not all PHP files are loaded. IMPORTANT! The function needs to be in this file.
     */
    function dopbspMissingFiles(){
        $error = array();
        
        array_push($error, '<div class="update-nag">');
        array_push($error, '  <p>WARNING for System)! Not all PHP files needed to run the server, in folder <strong>wp-content/plugins/dopbsp</strong>. If you are installing or updating the plugin using FTP, please allow all files to upload, or try to upload them again. If you think all files are on the server and this message still exist, please contact us on our <a href="http://www.facebook.com/saaduddinj" target="_blank">Follow</a>.</p>');
        array_push($error, '</div>');
        
        echo implode('', $error);
    }