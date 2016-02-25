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


    if (!class_exists('DOPBSPDatabase')){
        class DOPBSPDatabase{
            /*
             * Private variables.
             */
            private $db_version = 2.169;
            
            /*
             * Public variables.
             */
            public $db_config;
            public $db_collation = 'utf8_unicode_ci';
            
            /*
             * Constructor
             */
            function DOPBSPDatabase(){
                global $wpdb;
                
                $this->db_collation = $wpdb->collate != '' ? $wpdb->collate:$this->db_collation;
            
                add_filter('dopbsp_filter_database_configuration', array(&$this, 'config'), 9);
                 
                /*
                 * Change database version if requested.
                 */
                if (DOPBSP_CONFIG_INIT_DATABASE
                        || DOPBSP_REPAIR_DATABASE_TEXT){
                    update_option('DOPBSP_db_version', '2.0');
                }
            }
            
// Database
            
            /*
             * Initialize plugin tables.
             */
            function init(){
                global $wpdb;
                global $DOPBSP;
                
                $this->db_config = new stdClass;
                
                /*
                 * Default values and collation filters.
                 */
                $this->db_config = apply_filters('dopbsp_filter_database_configuration', $this->db_config);
                $this->db_collation = apply_filters('dopbsp_filter_database_collation', $this->db_collation);
                
                /*
                 * Get current database version.
                 */
                $current_db_version = get_option('DOPBSP_db_version');
                 
                if ($this->db_version != $current_db_version){
                    require_once(str_replace('\\', '/', ABSPATH).'wp-admin/includes/upgrade.php');
                    
                    $this->update();
                    
                    /*
                     * Calendars table.
                     */
                    $sql_calendars = "CREATE TABLE ".$DOPBSP->tables->calendars." (
                                            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                            user_id BIGINT UNSIGNED DEFAULT ".$this->db_config->calendars['user_id']." NOT NULL,
                                            post_id BIGINT UNSIGNED DEFAULT ".$this->db_config->calendars['post_id']." NOT NULL,
                                            name VARCHAR(128) DEFAULT '".$this->db_config->calendars['name']."' COLLATE ".$this->db_collation." NOT NULL,
                                            price_min FLOAT DEFAULT ".$this->db_config->calendars['price_min']." NOT NULL,
                                            price_max FLOAT DEFAULT ".$this->db_config->calendars['price_max']." NOT NULL,
                                            rating FLOAT DEFAULT ".$this->db_config->calendars['rating']." NOT NULL,
                                            address VARCHAR(512) DEFAULT '".$this->db_config->calendars['address']."' COLLATE ".$this->db_collation." NOT NULL,
                                            address_en VARCHAR(512) DEFAULT '".$this->db_config->calendars['address_en']."' COLLATE ".$this->db_collation." NOT NULL,
                                            address_alt VARCHAR(512) DEFAULT '".$this->db_config->calendars['address_alt']."' COLLATE ".$this->db_collation." NOT NULL,
                                            address_alt_en VARCHAR(512) DEFAULT '".$this->db_config->calendars['address_alt_en']."' COLLATE ".$this->db_collation." NOT NULL,
                                            coordinates TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            UNIQUE KEY id (id),
                                            KEY user_id (user_id),
                                            KEY post_id (post_id),
                                            KEY price_min (price_min),
                                            KEY price_max (price_max)
                                        );";
                    dbDelta($sql_calendars);
                    
                    
                    
                    /*
                     * Days table.
                     */
                    $sql_days = "CREATE TABLE " . $DOPBSP->tables->days." (
                                            unique_key VARCHAR(32) COLLATE ".$this->db_collation." NOT NULL,
                                            calendar_id BIGINT UNSIGNED DEFAULT ".$this->db_config->days['calendar_id']." NOT NULL,
                                            day VARCHAR(16) DEFAULT '".$this->db_config->days['day']."' COLLATE ".$this->db_collation." NOT NULL,
                                            year SMALLINT UNSIGNED DEFAULT ".$this->db_config->days['year']." NOT NULL,
                                            data TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            price_min FLOAT DEFAULT '".$this->db_config->days['price_min']."' NOT NULL,
                                            price_max FLOAT DEFAULT '".$this->db_config->days['price_max']."' NOT NULL,
                                            UNIQUE KEY id (unique_key),
                                            KEY calendar_id (calendar_id),
                                            KEY day (day),
                                            KEY year (year),
                                            KEY price_min (price_min),
                                            KEY price_max (price_max)
                                        );";
                    dbDelta($sql_days);
                    
                    $sql_days_available = "CREATE TABLE " . $DOPBSP->tables->days_available." (
                                            unique_key VARCHAR(32) COLLATE ".$this->db_collation." NOT NULL,
                                            day VARCHAR(16) DEFAULT '".$this->db_config->days_available['day']."' COLLATE ".$this->db_collation." NOT NULL,
                                            hour VARCHAR(6) DEFAULT '".$this->db_config->days_available['hour']."' COLLATE ".$this->db_collation." NOT NULL,
                                            data LONGTEXT COLLATE ".$this->db_collation." NOT NULL,
                                            UNIQUE KEY id (unique_key),
                                            KEY day (day),
                                            KEY hour (hour)
                                        );";
                    dbDelta($sql_days_available);
                    
                    $sql_days_unavailable = "CREATE TABLE " . $DOPBSP->tables->days_unavailable." (
                                            unique_key VARCHAR(32) COLLATE ".$this->db_collation." NOT NULL,
                                            day VARCHAR(16) DEFAULT '".$this->db_config->days_unavailable['day']."' COLLATE ".$this->db_collation." NOT NULL,
                                            hour VARCHAR(6) DEFAULT '".$this->db_config->days_unavailable['hour']."' COLLATE ".$this->db_collation." NOT NULL,
                                            data LONGTEXT COLLATE ".$this->db_collation." NOT NULL,
                                            UNIQUE KEY id (unique_key),
                                            KEY day (day),
                                            KEY hour (hour)
                                        );";
                    dbDelta($sql_days_unavailable);

                   
                    
                    /*
                     * Emails table.
                     */
                    $sql_emails = "CREATE TABLE ".$DOPBSP->tables->emails." (
                                            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                            user_id BIGINT UNSIGNED DEFAULT ".$this->db_config->emails['user_id']." NOT NULL,
                                            name VARCHAR(128) DEFAULT '".$this->db_config->emails['name']."' COLLATE ".$this->db_collation." NOT NULL,
                                            UNIQUE KEY id (id),
                                            KEY user_id (user_id)
                                        );";
                    dbDelta($sql_emails);
                    
                    $sql_emails_translation = "CREATE TABLE ".$DOPBSP->tables->emails_translation." (
                                            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                            email_id BIGINT UNSIGNED DEFAULT ".$this->db_config->emails_translation['email_id']." NOT NULL,
                                            template VARCHAR(64) DEFAULT '".$this->db_config->emails_translation['template']."' COLLATE ".$this->db_collation." NOT NULL,
                                            subject TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            message TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            UNIQUE KEY id (id),
                                            KEY email_id (email_id),
                                            KEY template (template)
                                        );";
                    dbDelta($sql_emails_translation);

                   
                    
                    /*
                     * Fees table.
                     */
                    $sql_fees = "CREATE TABLE ".$DOPBSP->tables->fees." (
                                            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                            user_id BIGINT UNSIGNED DEFAULT ".$this->db_config->fees['user_id']." NOT NULL,
                                            name VARCHAR(128) DEFAULT '".$this->db_config->fees['name']."' COLLATE ".$this->db_collation." NOT NULL,
                                            operation VARCHAR(1) DEFAULT '".$this->db_config->fees['operation']."' COLLATE ".$this->db_collation." NOT NULL,
                                            price FLOAT DEFAULT '".$this->db_config->fees['price']."' NOT NULL,
                                            price_type VARCHAR(8) DEFAULT '".$this->db_config->fees['price_type']."' COLLATE ".$this->db_collation." NOT NULL,
                                            price_by VARCHAR(8) DEFAULT '".$this->db_config->fees['price_by']."' COLLATE ".$this->db_collation." NOT NULL,
                                            included VARCHAR(6) DEFAULT '".$this->db_config->fees['included']."' COLLATE ".$this->db_collation." NOT NULL,
                                            extras VARCHAR(6) DEFAULT '".$this->db_config->fees['extras']."' COLLATE ".$this->db_collation." NOT NULL,
                                            cart VARCHAR(6) DEFAULT '".$this->db_config->fees['cart']."' COLLATE ".$this->db_collation." NOT NULL,
                                            translation TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            UNIQUE KEY id (id),
                                            KEY user_id (user_id)
                                        );";
                    dbDelta($sql_fees);

                    /*
                     * Forms tables.
                     */
                    $sql_forms = "CREATE TABLE " . $DOPBSP->tables->forms . " (
                                            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                            user_id BIGINT UNSIGNED DEFAULT ".$this->db_config->forms['user_id']." NOT NULL,
                                            name VARCHAR(128) DEFAULT '".$this->db_config->forms['name']."' COLLATE ".$this->db_collation." NOT NULL,
                                            UNIQUE KEY id (id),
                                            KEY user_id (user_id)
                                        );";
                    dbDelta($sql_forms);
                    
                    $sql_forms_fields = "CREATE TABLE " . $DOPBSP->tables->forms_fields . " (
                                            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                            form_id BIGINT UNSIGNED DEFAULT ".$this->db_config->forms_fields['form_id']." NOT NULL,
                                            type VARCHAR(20) DEFAULT '".$this->db_config->forms_fields['type']."' COLLATE ".$this->db_collation." NOT NULL,
                                            position INT UNSIGNED DEFAULT ".$this->db_config->forms_fields['position']." NOT NULL,
                                            multiple_select VARCHAR(6) DEFAULT '".$this->db_config->forms_fields['multiple_select']."' COLLATE ".$this->db_collation." NOT NULL,
                                            allowed_characters TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            size INT UNSIGNED DEFAULT ".$this->db_config->forms_fields['size']." NOT NULL,
                                            is_email VARCHAR(6) DEFAULT '".$this->db_config->forms_fields['is_email']."' COLLATE ".$this->db_collation." NOT NULL,
                                            required VARCHAR(6) DEFAULT '".$this->db_config->forms_fields['required']."' COLLATE ".$this->db_collation." NOT NULL,
                                            add_to_day_hour_info VARCHAR(6) DEFAULT '".$this->db_config->forms_fields['add_to_day_hour_info']."' COLLATE ".$this->db_collation." NOT NULL,
                                            add_to_day_hour_body VARCHAR(6) DEFAULT '".$this->db_config->forms_fields['add_to_day_hour_body']."' COLLATE ".$this->db_collation." NOT NULL,
                                            translation TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            UNIQUE KEY id (id),
                                            KEY form_id (form_id)
                                        );";
                    dbDelta($sql_forms_fields);
                    
                    $sql_forms_select_options = "CREATE TABLE " . $DOPBSP->tables->forms_fields_options . " (
                                            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                            field_id BIGINT UNSIGNED DEFAULT ".$this->db_config->forms_fields_options['field_id']." NOT NULL,
                                            position INT UNSIGNED DEFAULT ".$this->db_config->forms_fields_options['position']." NOT NULL,
                                            translation TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            UNIQUE KEY id (id),
                                            KEY field_id (field_id)
                                        );";
                    dbDelta($sql_forms_select_options);
                    
                    /*
                     * Languages table.
                     */
                    $sql_languages = "CREATE TABLE ".$DOPBSP->tables->languages." (
                                            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                            name VARCHAR(128) DEFAULT '".$this->db_config->languages['name']."' COLLATE ".$this->db_collation." NOT NULL,
                                            code VARCHAR(2) DEFAULT '".$this->db_config->languages['code']."' COLLATE ".$this->db_collation." NOT NULL,
                                            enabled VARCHAR(6) DEFAULT ".$this->db_config->languages['enabled']." NOT NULL,
                                            UNIQUE KEY id (id),
                                            KEY code (code),
                                            KEY enabled (enabled)
                                        );";
                    dbDelta($sql_languages);
                    
                 

                    /*
                     * Reservations table.
                     */   
                    $sql_reservations = "CREATE TABLE " . $DOPBSP->tables->reservations . " (
                                            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                            calendar_id BIGINT UNSIGNED DEFAULT ".$this->db_config->reservations['calendar_id']." NOT NULL,
                                            language VARCHAR(8) DEFAULT '".$this->db_config->reservations['language']."' COLLATE ".$this->db_collation." NOT NULL,
                                            currency VARCHAR(32) DEFAULT '".$this->db_config->reservations['currency']."' COLLATE ".$this->db_collation." NOT NULL,
                                            currency_code VARCHAR(8) DEFAULT '".$this->db_config->reservations['currency_code']."' COLLATE ".$this->db_collation." NOT NULL,
                                            check_in VARCHAR(16) DEFAULT '".$this->db_config->reservations['check_in']."' COLLATE ".$this->db_collation." NOT NULL,
                                            check_out VARCHAR(16) DEFAULT '".$this->db_config->reservations['check_out']."' COLLATE ".$this->db_collation." NOT NULL,
                                            start_hour VARCHAR(16) DEFAULT '".$this->db_config->reservations['start_hour']."' COLLATE ".$this->db_collation." NOT NULL,
                                            end_hour VARCHAR(16) DEFAULT '".$this->db_config->reservations['end_hour']."' COLLATE ".$this->db_collation." NOT NULL,
                                            no_items INT UNSIGNED DEFAULT ".$this->db_config->reservations['no_items']." NOT NULL,
                                            price FLOAT DEFAULT ".$this->db_config->reservations['price']." NOT NULL,
                                            price_total FLOAT DEFAULT ".$this->db_config->reservations['price_total']." NOT NULL,
                                            extras TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            extras_price FLOAT DEFAULT ".$this->db_config->reservations['extras_price']." NOT NULL,
                                            discount TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            discount_price FLOAT DEFAULT ".$this->db_config->reservations['discount_price']." NOT NULL,
                                            coupon TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            coupon_price FLOAT DEFAULT ".$this->db_config->reservations['coupon_price']." NOT NULL,
                                            fees TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            fees_price FLOAT DEFAULT ".$this->db_config->reservations['fees_price']." NOT NULL,
                                            deposit TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            deposit_price FLOAT DEFAULT ".$this->db_config->reservations['deposit_price']." NOT NULL,
                                            days_hours_history TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            form TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            email VARCHAR(128) DEFAULT '".$this->db_config->reservations['email']."' COLLATE ".$this->db_collation." NOT NULL,
                                            status VARCHAR(16) DEFAULT '".$this->db_config->reservations['status']."' COLLATE ".$this->db_collation." NOT NULL,
                                            payment_method VARCHAR(32) DEFAULT '".$this->db_config->reservations['payment_method']."' NOT NULL, 
                                            transaction_id VARCHAR(128) DEFAULT '".$this->db_config->reservations['transaction_id']."' COLLATE ".$this->db_collation." NOT NULL, 
                                            token VARCHAR(32) DEFAULT '".$this->db_config->reservations['token']."' NOT NULL, 
                                            date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
                                            UNIQUE KEY id (id),
                                            KEY calendar_id (calendar_id),
                                            KEY check_in (check_in),
                                            KEY check_out (check_out),
                                            KEY start_hour (end_hour),
                                            KEY status (status),
                                            KEY payment_method (payment_method),
                                            KEY transaction_id (transaction_id),
                                            KEY token (token)
                                    );";
                    dbDelta($sql_reservations);
                    
                   
                    /*
                     * Settings tables.
                     */
                    $sql_settings = "CREATE TABLE ".$DOPBSP->tables->settings." (
                                            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                            unique_key VARCHAR(128) DEFAULT '".$this->db_config->settings['unique_key']."' COLLATE ".$this->db_collation." NOT NULL,
                                            value VARCHAR(128) DEFAULT '".$this->db_config->settings['value']."' COLLATE ".$this->db_collation." NOT NULL,
                                            UNIQUE KEY id (id),
                                            KEY unique_key (unique_key)
                                        );";
                    dbDelta($sql_settings);
                    
                    $sql_settings_calendar = "CREATE TABLE ".$DOPBSP->tables->settings_calendar." (
                                            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                            calendar_id BIGINT UNSIGNED DEFAULT ".$this->db_config->settings_calendar['calendar_id']." NOT NULL,
                                            date_type INT UNSIGNED DEFAULT ".$this->db_config->settings_calendar['date_type']." NOT NULL,
                                            template VARCHAR(128) DEFAULT '".$this->db_config->settings_calendar['template']."' COLLATE ".$this->db_collation." NOT NULL,
                                            booking_stop INT UNSIGNED DEFAULT ".$this->db_config->settings_calendar['booking_stop']." NOT NULL,
                                            months_no INT UNSIGNED DEFAULT ".$this->db_config->settings_calendar['months_no']." NOT NULL,
                                            view_only VARCHAR(6) DEFAULT '".$this->db_config->settings_calendar['view_only']."' COLLATE ".$this->db_collation." NOT NULL,  
                                            max_year INT UNSIGNED DEFAULT ".$this->db_config->settings_calendar['max_year']." NOT NULL,
                                            currency VARCHAR(8) DEFAULT '".$this->db_config->settings_calendar['currency']."' COLLATE ".$this->db_collation." NOT NULL,
                                            currency_position VARCHAR(32) DEFAULT '".$this->db_config->settings_calendar['currency_position']."' COLLATE ".$this->db_collation." NOT NULL,
                                            days_available VARCHAR(128) DEFAULT '".$this->db_config->settings_calendar['days_available']."' COLLATE ".$this->db_collation." NOT NULL,
                                            days_details_from_hours VARCHAR(6) DEFAULT '".$this->db_config->settings_calendar['days_details_from_hours']."' COLLATE ".$this->db_collation." NOT NULL,
                                            days_first INT UNSIGNED DEFAULT ".$this->db_config->settings_calendar['days_first']." NOT NULL,
                                            days_first_displayed VARCHAR(10) DEFAULT '".$this->db_config->settings_calendar['days_first_displayed']."' COLLATE ".$this->db_collation." NOT NULL,
                                            days_morning_check_out VARCHAR(6) DEFAULT '".$this->db_config->settings_calendar['days_morning_check_out']."' COLLATE ".$this->db_collation." NOT NULL,
                                            days_multiple_select VARCHAR(6) DEFAULT '".$this->db_config->settings_calendar['days_multiple_select']."' COLLATE ".$this->db_collation." NOT NULL,
                                            hours_add_last_hour_to_total_price VARCHAR(6) DEFAULT '".$this->db_config->settings_calendar['hours_add_last_hour_to_total_price']."' COLLATE ".$this->db_collation." NOT NULL,
                                            hours_ampm VARCHAR(6) DEFAULT '".$this->db_config->settings_calendar['hours_ampm']."' COLLATE ".$this->db_collation." NOT NULL,
                                            hours_definitions TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            hours_enabled VARCHAR(6) DEFAULT '".$this->db_config->settings_calendar['hours_enabled']."' COLLATE ".$this->db_collation." NOT NULL,
                                            hours_info_enabled VARCHAR(6) DEFAULT '".$this->db_config->settings_calendar['hours_info_enabled']."' COLLATE ".$this->db_collation." NOT NULL,
                                            hours_interval_enabled VARCHAR(6) DEFAULT '".$this->db_config->settings_calendar['hours_interval_enabled']."' COLLATE ".$this->db_collation." NOT NULL,
                                            hours_multiple_select VARCHAR(6) DEFAULT '".$this->db_config->settings_calendar['hours_multiple_select']."' COLLATE ".$this->db_collation." NOT NULL,
                                            sidebar_style INT UNSIGNED DEFAULT ".$this->db_config->settings_calendar['sidebar_style']." NOT NULL,
                                            sidebar_no_items_enabled VARCHAR(6) DEFAULT '".$this->db_config->settings_calendar['sidebar_no_items_enabled']."' COLLATE ".$this->db_collation." NOT NULL,
                                            rule BIGINT UNSIGNED DEFAULT ".$this->db_config->settings_calendar['rule']." NOT NULL,
                                            extra BIGINT UNSIGNED DEFAULT ".$this->db_config->settings_calendar['extra']." NOT NULL,
                                            cart_enabled VARCHAR(6) DEFAULT '".$this->db_config->settings_calendar['cart_enabled']."' COLLATE ".$this->db_collation." NOT NULL,
                                            discount BIGINT UNSIGNED DEFAULT ".$this->db_config->settings_calendar['discount']." NOT NULL,
                                            fees VARCHAR(128) DEFAULT '".$this->db_config->settings_calendar['fees']."' NOT NULL,
                                            coupon BIGINT UNSIGNED DEFAULT ".$this->db_config->settings_calendar['coupon']." NOT NULL,
                                            deposit FLOAT DEFAULT ".$this->db_config->settings_calendar['deposit']." NOT NULL,
                                            deposit_type VARCHAR(16) DEFAULT '".$this->db_config->settings_calendar['deposit_type']."' NOT NULL,
                                            form BIGINT UNSIGNED DEFAULT ".$this->db_config->settings_calendar['form']." NOT NULL,
                                            terms_and_conditions_enabled VARCHAR(6) DEFAULT '".$this->db_config->settings_calendar['terms_and_conditions_enabled']."' COLLATE ".$this->db_collation." NOT NULL,
                                            terms_and_conditions_link VARCHAR(128) DEFAULT '".$this->db_config->settings_calendar['terms_and_conditions_link']."' COLLATE ".$this->db_collation." NOT NULL,
                                            UNIQUE KEY id (id),
                                            KEY calendar_id (calendar_id)
                                        );";
                    dbDelta($sql_settings_calendar);
                    
                    $sql_settings_notifications = "CREATE TABLE ".$DOPBSP->tables->settings_notifications." (
                                            id BIGINT UNSIGNED NOT NULL,
                                            calendar_id BIGINT UNSIGNED DEFAULT ".$this->db_config->settings_notifications['calendar_id']." NOT NULL,
                                            templates BIGINT UNSIGNED DEFAULT '".$this->db_config->settings_notifications['templates']."' COLLATE ".$this->db_collation." NOT NULL,
                                            method_admin VARCHAR(16) DEFAULT '".$this->db_config->settings_notifications['method_admin']."' COLLATE ".$this->db_collation." NOT NULL,                                     
                                            method_user VARCHAR(16) DEFAULT '".$this->db_config->settings_notifications['method_user']."' COLLATE ".$this->db_collation." NOT NULL,                                     
                                            email VARCHAR(128) DEFAULT '".$this->db_config->settings_notifications['email']."' COLLATE ".$this->db_collation." NOT NULL,
                                            email_reply VARCHAR(128) DEFAULT '".$this->db_config->settings_notifications['email_reply']."' COLLATE ".$this->db_collation." NOT NULL,
                                            email_name VARCHAR(128) DEFAULT '".$this->db_config->settings_notifications['email_name']."' COLLATE ".$this->db_collation." NOT NULL,
                                            email_cc TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            email_cc_name TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            email_bcc TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            email_bcc_name TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            smtp_host_name VARCHAR(128) DEFAULT '".$this->db_config->settings_notifications['smtp_host_name']."' COLLATE ".$this->db_collation." NOT NULL,
                                            smtp_host_port INT UNSIGNED DEFAULT ".$this->db_config->settings_notifications['smtp_host_port']." NOT NULL,
                                            smtp_ssl VARCHAR(6) DEFAULT '".$this->db_config->settings_notifications['smtp_ssl']."' COLLATE ".$this->db_collation." NOT NULL,                                   
                                            smtp_user VARCHAR(128) DEFAULT '".$this->db_config->settings_notifications['smtp_user']."' COLLATE ".$this->db_collation." NOT NULL,                                   
                                            smtp_password VARCHAR(128) DEFAULT '".$this->db_config->settings_notifications['smtp_password']."' COLLATE ".$this->db_collation." NOT NULL,
                                            smtp_host_name2 VARCHAR(128) DEFAULT '".$this->db_config->settings_notifications['smtp_host_name2']."' COLLATE ".$this->db_collation." NOT NULL,
                                            smtp_host_port2 INT UNSIGNED DEFAULT ".$this->db_config->settings_notifications['smtp_host_port2']." NOT NULL,
                                            smtp_ssl2 VARCHAR(6) DEFAULT '".$this->db_config->settings_notifications['smtp_ssl2']."' COLLATE ".$this->db_collation." NOT NULL,                                   
                                            smtp_user2 VARCHAR(128) DEFAULT '".$this->db_config->settings_notifications['smtp_user2']."' COLLATE ".$this->db_collation." NOT NULL,                                   
                                            smtp_password2 VARCHAR(128) DEFAULT '".$this->db_config->settings_notifications['smtp_password2']."' COLLATE ".$this->db_collation." NOT NULL,
                                            send_book_admin VARCHAR(6) DEFAULT '".$this->db_config->settings_notifications['send_book_admin']."' COLLATE ".$this->db_collation." NOT NULL,
                                            send_book_user VARCHAR(6) DEFAULT '".$this->db_config->settings_notifications['send_book_user']."' COLLATE ".$this->db_collation." NOT NULL,
                                            send_book_with_approval_admin VARCHAR(6) DEFAULT '".$this->db_config->settings_notifications['send_book_with_approval_admin']."' COLLATE ".$this->db_collation." NOT NULL,
                                            send_book_with_approval_user VARCHAR(6) DEFAULT '".$this->db_config->settings_notifications['send_book_with_approval_user']."' COLLATE ".$this->db_collation." NOT NULL,
                                            send_approved VARCHAR(6) DEFAULT '".$this->db_config->settings_notifications['send_approved']."' COLLATE ".$this->db_collation." NOT NULL,
                                            send_canceled VARCHAR(6) DEFAULT '".$this->db_config->settings_notifications['send_canceled']."' COLLATE ".$this->db_collation." NOT NULL,
                                            send_rejected VARCHAR(6) DEFAULT '".$this->db_config->settings_notifications['send_rejected']."' COLLATE ".$this->db_collation." NOT NULL,                                
                                            UNIQUE KEY id (id),
                                            KEY calendar_id (calendar_id)
                                        );";
                    dbDelta($sql_settings_notifications);
                    
                    $sql_settings_payment = "CREATE TABLE ".$DOPBSP->tables->settings_payment." (
                                            id BIGINT UNSIGNED NOT NULL,
                                            calendar_id BIGINT UNSIGNED DEFAULT ".$this->db_config->settings_payment['calendar_id']." NOT NULL,
                                            arrival_enabled VARCHAR(6) DEFAULT '".$this->db_config->settings_payment['arrival_enabled']."' COLLATE ".$this->db_collation." NOT NULL,
                                            arrival_with_approval_enabled VARCHAR(6) DEFAULT '".$this->db_config->settings_payment['arrival_with_approval_enabled']."' COLLATE ".$this->db_collation." NOT NULL,
                                            redirect VARCHAR(128) DEFAULT '".$this->db_config->settings_payment['redirect']."' COLLATE ".$this->db_collation." NOT NULL,
                                            UNIQUE KEY id (id),
                                            KEY calendar_id (calendar_id)
                                        );";
                    dbDelta($sql_settings_payment);
                    
                    $sql_settings_search = "CREATE TABLE ".$DOPBSP->tables->settings_search." (
                                            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                            search_id BIGINT UNSIGNED DEFAULT ".$this->db_config->settings_search['search_id']." NOT NULL,
                                            date_type INT UNSIGNED DEFAULT ".$this->db_config->settings_search['date_type']." NOT NULL,
                                            template VARCHAR(128) DEFAULT '".$this->db_config->settings_search['template']."' COLLATE ".$this->db_collation." NOT NULL,
                                            search_enabled VARCHAR(6) DEFAULT '".$this->db_config->settings_search['search_enabled']."' NOT NULL,
                                            price_enabled VARCHAR(6) DEFAULT '".$this->db_config->settings_search['price_enabled']."' COLLATE ".$this->db_collation." NOT NULL,
                                            view_default VARCHAR(6) DEFAULT '".$this->db_config->settings_search['view_default']."' NOT NULL,
                                            view_list_enabled VARCHAR(6) DEFAULT '".$this->db_config->settings_search['view_list_enabled']."' NOT NULL,
                                            view_grid_enabled VARCHAR(6) DEFAULT '".$this->db_config->settings_search['view_grid_enabled']."' NOT NULL,
                                            view_map_enabled VARCHAR(6) DEFAULT' ".$this->db_config->settings_search['view_map_enabled']."' NOT NULL,
                                            view_results_page INT UNSIGNED DEFAULT ".$this->db_config->settings_search['view_results_page']." NOT NULL,
                                            view_sidebar_position VARCHAR(8) DEFAULT '".$this->db_config->settings_search['view_sidebar_position']."' COLLATE ".$this->db_collation." NOT NULL,
                                            currency VARCHAR(8) DEFAULT '".$this->db_config->settings_search['currency']."' COLLATE ".$this->db_collation." NOT NULL,
                                            currency_position VARCHAR(32) DEFAULT '".$this->db_config->settings_search['currency_position']."' COLLATE ".$this->db_collation." NOT NULL,
                                            days_first INT UNSIGNED DEFAULT ".$this->db_config->settings_search['days_first']." NOT NULL,
                                            days_multiple_select VARCHAR(6) DEFAULT '".$this->db_config->settings_search['days_multiple_select']."' COLLATE ".$this->db_collation." NOT NULL,
                                            hours_ampm VARCHAR(6) DEFAULT '".$this->db_config->settings_search['hours_ampm']."' COLLATE ".$this->db_collation." NOT NULL,
                                            hours_definitions TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            hours_enabled VARCHAR(6) DEFAULT '".$this->db_config->settings_search['hours_enabled']."' COLLATE ".$this->db_collation." NOT NULL,
                                            hours_multiple_select VARCHAR(6) DEFAULT '".$this->db_config->settings_search['hours_multiple_select']."' COLLATE ".$this->db_collation." NOT NULL,
                                            availability_enabled VARCHAR(6) DEFAULT '".$this->db_config->settings_search['availability_enabled']."' NOT NULL,
                                            availability_max INT UNSIGNED DEFAULT '".$this->db_config->settings_search['availability_max']."' NOT NULL,
                                            availability_min INT UNSIGNED DEFAULT '".$this->db_config->settings_search['availability_min']."' NOT NULL,
                                            UNIQUE KEY id (id),
                                            KEY search_id (search_id)
                                        );";
                    dbDelta($sql_settings_search);
                    
                    /*
                     * Translation tables.
                     */
                    $languages[0] = 'en';
                    $languages = explode(',', DOPBSP_CONFIG_TRANSLATION_LANGUAGES_TO_INSTALL);
                    
                    for ($l=0; $l<count($languages); $l++){
                        $sql_translation = "CREATE TABLE ".$DOPBSP->tables->translation."_".$languages[$l]." (
                                            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
                                            key_data VARCHAR(128) DEFAULT '".$this->db_config->translation['key_data']."' COLLATE ".$this->db_collation." NOT NULL,
                                            parent_key VARCHAR(128) DEFAULT '".$this->db_config->translation['parent_key']."' COLLATE ".$this->db_collation." NOT NULL,
                                            text_data TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            translation TEXT COLLATE ".$this->db_collation." NOT NULL,
                                            UNIQUE KEY id (id),
                                            KEY key_data (key_data)
                                        );";
                        dbDelta($sql_translation);
                    }
                    
                  
                    /*
                     * Update settings tables.
                     */
                    if (get_option('DOPBSP_db_update_settings_calendar_data') == 'true'){
                        $this->updateSettingsCalendarData1x();
                    }

                    /*
                     * Update database version.
                     */
                    if ($current_db_version == ''){
                        add_option('DOPBSP_db_version', $this->db_version);
                    }
                    else{
                        update_option('DOPBSP_db_version', $this->db_version);
                    }
                    
                    /*
                     * Initialize users permissions.
                     */
                    $DOPBSP->classes->backend_settings_users->init();
                    
                    $this->set();
                }
            }
            
// Set            
            
            /*
             * Set initial data for plugin tables.
             */
            function set(){
                global $DOPBSP;
                
                /*
                 * Translation data.
                 */
                $DOPBSP->classes->backend_translation->database();
                $DOPBSP->classes->translation->set();
                
                /*
                 * Emails data.
                 */
                $this->setEmails();

                /*
                 * Extras data.
                 */
                $this->setExtras();
                
                /*
                 * Forms data.
                 */
                $this->setForms();
                
                /*
                 * Settings data.
                 */
                $this->setSettingsCalendar();
                
                /*
                 * Settings search data.
                 */
                $this->setSettingsSearch();
            }
            
            /*
             * Set emails data.
             */
            function setEmails(){
                global $wpdb;
                global $DOPBSP;
                
                $control_data = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->emails.' WHERE id=1');
                
                if ($wpdb->num_rows == 0){
                     $wpdb->insert($DOPBSP->tables->emails, array('id' => 1,
                                                                  'user_id' => 0,
                                                                  'name' => $DOPBSP->text('EMAILS_DEFAULT_NAME')));
                    /*
                     * Simple book.
                     */
                    $wpdb->insert($DOPBSP->tables->emails_translation, array('email_id' => 1,
                                                                            'template' => 'book_admin',
                                                                            'subject' => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_BOOK_ADMIN_SUBJECT'),
                                                                            'message' => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_BOOK_ADMIN')));
                    $wpdb->insert($DOPBSP->tables->emails_translation, array('email_id' => 1,
                                                                            'template' => 'book_user',
                                                                            'subject' => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_BOOK_USER_SUBJECT'),
                                                                            'message' => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_BOOK_USER')));
                    /*
                     * Book with approval.
                     */
                    $wpdb->insert($DOPBSP->tables->emails_translation, array('email_id' => 1,
                                                                            'template' => 'book_with_approval_admin',
                                                                            'subject' => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_BOOK_WITH_APPROVAL_ADMIN_SUBJECT'),
                                                                            'message' => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_BOOK_WITH_APPROVAL_ADMIN')));
                    $wpdb->insert($DOPBSP->tables->emails_translation, array('email_id' => 1,
                                                                            'template' => 'book_with_approval_user',
                                                                            'subject' => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_BOOK_WITH_APPROVAL_USER_SUBJECT'),
                                                                            'message' => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_BOOK_WITH_APPROVAL_USER')));
                    /*
                     * Approved
                     */
                    $wpdb->insert($DOPBSP->tables->emails_translation, array('email_id' => 1,
                                                                            'template' => 'approved',
                                                                            'subject' => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_APPROVED_SUBJECT'),
                                                                            'message' => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_APPROVED')));
                    /*
                     * Canceled
                     */
                    $wpdb->insert($DOPBSP->tables->emails_translation, array('email_id' => 1,
                                                                            'template' => 'canceled',
                                                                            'subject' => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_CANCELED_SUBJECT'),
                                                                            'message' => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_CANCELED')));
                    /*
                      Rejected
                     */
                    $wpdb->insert($DOPBSP->tables->emails_translation, array('email_id' => 1,
                                                                            'template' => 'rejected',
                                                                            'subject' => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_REJECTED_SUBJECT'),
                                                                            'message' => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_REJECTED')));

                    /*
                     * Payment gateways.
                     */
                    $pg_list = $DOPBSP->classes->payment_gateways->get();

                    for ($i=0; $i<count($pg_list); $i++){
                        $pg_id = $pg_list[$i];
                        
                        $wpdb->insert($DOPBSP->tables->emails_translation, array('email_id' => 1,
                                                                                 'template' => $pg_id.'_admin',
                                                                                 'subject' => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_'.strtoupper($pg_id).'_ADMIN_SUBJECT'),
                                                                                 'message' => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_'.strtoupper($pg_id).'_ADMIN')));
                        $wpdb->insert($DOPBSP->tables->emails_translation, array('email_id' => 1,
                                                                                 'template' => $pg_id.'_user',
                                                                                 'subject' => $DOPBSP->classes->translation->encodeJSON('EMAILS_DEFAULT_'.strtoupper($pg_id).'_USER_SUBJECT'),
                                                                                 'message' => $DOPBSP->classes->backend_email->defaultTemplate('EMAILS_DEFAULT_'.strtoupper($pg_id).'_USER')));
                    }
                }
            }
            
            /*
             * Set extras data.
             */
            function setExtras(){
                global $wpdb;
                global $DOPBSP;
                
                $control_data = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->extras.' WHERE id=1');
                
                if ($wpdb->num_rows == 0){
                    $wpdb->insert($DOPBSP->tables->extras, array('id' => 1,
                                                                 'user_id' => 0,
                                                                 'name' => $DOPBSP->text('EXTRAS_DEFAULT_PEOPLE')));
                    $wpdb->insert($DOPBSP->tables->extras_groups, array('id' => 1,
                                                                        'extra_id' => 1,
                                                                        'position' => 1,
                                                                        'multiple_select' => 'false',
                                                                        'required' => 'true',
                                                                        'translation' => $DOPBSP->classes->translation->encodeJSON('EXTRAS_DEFAULT_ADULTS')));
                    $wpdb->insert($DOPBSP->tables->extras_groups_items, array('id' => 1,
                                                                              'group_id' => 1,
                                                                              'position' => 1,
                                                                              'translation' => $DOPBSP->classes->translation->encodeJSON('', '1')));
                    $wpdb->insert($DOPBSP->tables->extras_groups_items, array('id' => 2,
                                                                              'group_id' => 1,
                                                                              'position' => 2,
                                                                              'translation' => $DOPBSP->classes->translation->encodeJSON('', '2')));
                    $wpdb->insert($DOPBSP->tables->extras_groups_items, array('id' => 3,
                                                                              'group_id' => 1,
                                                                              'position' => 3,
                                                                              'translation' => $DOPBSP->classes->translation->encodeJSON('', '3')));
                    $wpdb->insert($DOPBSP->tables->extras_groups_items, array('id' => 4,
                                                                              'group_id' => 1,
                                                                              'position' => 4,
                                                                              'translation' => $DOPBSP->classes->translation->encodeJSON('', '4')));
                    $wpdb->insert($DOPBSP->tables->extras_groups_items, array('id' => 5,
                                                                              'group_id' => 1,
                                                                              'position' => 5,
                                                                              'translation' => $DOPBSP->classes->translation->encodeJSON('', '5')));
                    $wpdb->insert($DOPBSP->tables->extras_groups, array('id' => 2,
                                                                        'extra_id' => 1,
                                                                        'position' => 2,
                                                                        'multiple_select' => 'false',
                                                                        'required' => 'true',
                                                                        'translation' => $DOPBSP->classes->translation->encodeJSON('EXTRAS_DEFAULT_CHILDREN')));
                    $wpdb->insert($DOPBSP->tables->extras_groups_items, array('id' => 6,
                                                                              'group_id' => 2,
                                                                              'position' => 1,
                                                                              'translation' => $DOPBSP->classes->translation->encodeJSON('', '0')));
                    $wpdb->insert($DOPBSP->tables->extras_groups_items, array('id' => 7,
                                                                              'group_id' => 2,
                                                                              'position' => 2,
                                                                              'translation' => $DOPBSP->classes->translation->encodeJSON('', '1')));
                    $wpdb->insert($DOPBSP->tables->extras_groups_items, array('id' => 8,
                                                                              'group_id' => 2,
                                                                              'position' => 3,
                                                                              'translation' => $DOPBSP->classes->translation->encodeJSON('', '2')));
                    $wpdb->insert($DOPBSP->tables->extras_groups_items, array('id' => 9,
                                                                              'group_id' => 2,
                                                                              'position' => 4,
                                                                              'translation' => $DOPBSP->classes->translation->encodeJSON('', '3')));
                }
            }
            
            /*
             * Set forms data.
             */
            function setForms(){
                global $wpdb;
                global $DOPBSP;
                
                $control_data = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->forms.' WHERE id=1');
                
                if ($wpdb->num_rows == 0){
                    $wpdb->insert($DOPBSP->tables->forms, array('id' => 1,
                                                                'user_id' => 0,
                                                                'name' => $DOPBSP->text('FORMS_DEFAULT_NAME')));
                    $wpdb->insert($DOPBSP->tables->forms_fields, array('id' => 1,
                                                                       'form_id' => 1,
                                                                       'type' => 'text',
                                                                       'position' => 1,
                                                                       'multiple_select' => 'false',
                                                                       'allowed_characters' => '',
                                                                       'size' => 0,
                                                                       'is_email' => 'false',
                                                                       'required' => 'true',
                                                                       'translation' => $DOPBSP->classes->translation->encodeJSON('FORMS_DEFAULT_FIRST_NAME')));
                    $wpdb->insert($DOPBSP->tables->forms_fields, array('id' => 2,
                                                                       'form_id' => 1,
                                                                       'type' => 'text',
                                                                       'position' => 2,
                                                                       'multiple_select' => 'false',
                                                                       'allowed_characters' => '',
                                                                       'size' => 0,
                                                                       'is_email' => 'false',
                                                                       'required' => 'true',
                                                                       'translation' => $DOPBSP->classes->translation->encodeJSON('FORMS_DEFAULT_LAST_NAME')));
                    $wpdb->insert($DOPBSP->tables->forms_fields, array('id' => 3,
                                                                       'form_id' => 1,
                                                                       'type' => 'text',
                                                                       'position' => 3,
                                                                       'multiple_select' => 'false',
                                                                       'allowed_characters' => '',
                                                                       'size' => 0,
                                                                       'is_email' => 'true',
                                                                       'required' => 'true',
                                                                       'translation' => $DOPBSP->classes->translation->encodeJSON('FORMS_DEFAULT_EMAIL')));
                    $wpdb->insert($DOPBSP->tables->forms_fields, array('id' => 4,
                                                                       'form_id' => 1,
                                                                       'type' => 'text',
                                                                       'position' => 4,
                                                                       'multiple_select' => 'false',
                                                                       'allowed_characters' => '0123456789+-().',
                                                                       'size' => 0,
                                                                       'is_email' => 'false',
                                                                       'required' => 'true',
                                                                       'translation' => $DOPBSP->classes->translation->encodeJSON('FORMS_DEFAULT_PHONE')));
                    $wpdb->insert($DOPBSP->tables->forms_fields, array('id' => 5,
                                                                       'form_id' => 1,
                                                                       'type' => 'textarea',
                                                                       'position' => 5,
                                                                       'multiple_select' => 'false',
                                                                       'allowed_characters' => '',
                                                                       'size' => 0,
                                                                       'is_email' => 'false',
                                                                       'required' => 'true',
                                                                       'translation' => $DOPBSP->classes->translation->encodeJSON('FORMS_DEFAULT_MESSAGE')));
                }
            }
            
            /*
             * Set settings calendar data.
             */
            function setSettingsCalendar(){
                global $wpdb;
                global $DOPBSP;
                
                $control_data = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->settings_calendar.' WHERE calendar_id=0');

                if ($wpdb->num_rows == 0){
                    $wpdb->insert($DOPBSP->tables->settings_calendar, array('calendar_id' => 0,
                                                                             'hours_definitions' => '[{"value": "00:00"}]'));
                    
                    $settings_id = $wpdb->insert_id;
                    
                    $wpdb->insert($DOPBSP->tables->settings_notifications, array('id' => $settings_id,
                                                                                 'calendar_id' => 0));
                    $wpdb->insert($DOPBSP->tables->settings_payment, array('id' => $settings_id,
                                                                           'calendar_id' => 0));
                }
                else{
                    $settings_id = $control_data->id;
                
                    /*
                     * Settings notifications data.
                     */ 
                    $control_data = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->settings_notifications.' WHERE calendar_id=0');
                    
                    if ($wpdb->num_rows == 0){
                        $wpdb->insert($DOPBSP->tables->settings_notifications, array('id' => $settings_id,
                                                                                     'calendar_id' => 0));
                    }
                
                    /*
                     * Settings payment data.
                     */ 
                    $control_data = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->settings_payment.' WHERE calendar_id=0');
                    
                    if ($wpdb->num_rows == 0){
                        $wpdb->insert($DOPBSP->tables->settings_payment, array('id' => $settings_id,
                                                                               'calendar_id' => 0));
                    }
                }
            }
            
            /*
             * Set settings search data.
             */
            function setSettingsSearch(){
                global $wpdb;
                global $DOPBSP;
                
                $control_data = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->settings_search.' WHERE search_id=0');

                if ($wpdb->num_rows == 0){
                    $wpdb->insert($DOPBSP->tables->settings_search, array('search_id' => 0,
                                                                          'hours_definitions' => '[{"value": "00:00"},{"value": "01:00"},{"value": "02:00"},{"value": "03:00"},{"value": "04:00"},{"value": "05:00"},{"value": "06:00"},{"value": "07:00"},{"value": "08:00"},{"value": "09:00"},{"value": "10:00"},{"value": "11:00"},{"value": "12:00"},{"value": "13:00"},{"value": "14:00"},{"value": "15:00"},{"value": "16:00"},{"value": "17:00"},{"value": "18:00"},{"value": "19:00"},{"value": "20:00"},{"value": "21:00"},{"value": "22:00"},{"value": "23:00"}]'));
                }
            }
            
// Update
            
            /*
             * Update database. Rename table columns and transfer data from old tables.
             */
            function update(){
                $current_db_version = get_option('DOPBSP_db_version');
                
                /*
                 * Rename calendar settings table.
                 */
                $this->updateRename();
                
                if ($current_db_version != ''
                        && $current_db_version < 2.0){
                    /*
                     * Calendar settings table.
                     */
                    $this->updateSettingsCalendar1x();

                    /*
                     * Forms tables.
                     */
                    $this->updateForms1x();

                    /*
                     * Reservation table.
                     */
                    $this->updateReservations1x();
                }
            }
            
            /*
             * Update forms tables from versions 1.x
             */
            function updateForms1x(){
                global $wpdb;
                global $DOPBSP;
                
                $fields = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->forms_fields);

                foreach ($fields as $field){
                    if (!is_object(json_decode($field->translation))){
                        $wpdb->update($DOPBSP->tables->forms_fields, array('translation' => stripslashes($field->translation)), 
                                                                     array('id' => $field->id));
                    }
                }
            }
            
            /*
             * Update reservations tables from versions 1.x
             */
            function updateReservations1x(){
                global $wpdb;
                global $DOPBSP;
                
                $control_data = $wpdb->query('SHOW TABLES LIKE "'.$DOPBSP->tables->reservations.'"');

                if ($wpdb->num_rows != 0){
                    $new_columns = array('total_price' => 'CHANGE total_price price_total FLOAT DEFAULT '.$this->db_config->reservations['price_total'].' NOT NULL',
                                         'discount' => 'CHANGE discount discount_price FLOAT DEFAULT '.$this->db_config->reservations['discount_price'].' NOT NULL',
                                         'deposit' => 'CHANGE deposit deposit_price FLOAT DEFAULT '.$this->db_config->reservations['deposit_price'].' NOT NULL',
                                         'paypal_transaction_id' => 'CHANGE paypal_transaction_id transaction_id VARCHAR(128) DEFAULT "'.$this->db_config->reservations['transaction_id'].'" COLLATE '.$this->db_collation.' NOT NULL',
                                         'info' => 'CHANGE info form TEXT COLLATE '.$this->db_collation.' NOT NULL');
                    $valid = true;

                    $columns = $wpdb->get_results('SHOW COLUMNS FROM '.$DOPBSP->tables->reservations);

                    foreach ($columns as $column){
                        if ($column->Field == 'discount_price'
                                || $column->Field == 'deposit_price'){
                            $valid = false;
                        }
                    }

                    if ($valid){
                        foreach ($columns as $column){
                            foreach ($new_columns as $key => $query){
                                if ($column->Field == $key){
                                    $wpdb->query('ALTER TABLE '.$DOPBSP->tables->reservations.' '.$query);
                                }
                            }
                        }  

                        /*
                         * Update reservations data.
                         */
                        $reservations = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->reservations);

                        foreach ($reservations as $reservation){
                            switch ($reservation->payment_method){
                                case '0':
                                    $payment_method = 'none';
                                    break;
                                case '1':
                                    $payment_method = 'default';
                                    break;
                                case '2':
                                    $payment_method = 'paypal';
                                    break;
                                default:
                                    $payment_method = $reservation->payment_method;
                            }

                            $form = json_decode($reservation->form);

                            for ($i=0; $i<count($form); $i++){
                                $form[$i]->translation = $form[$i]->name;
                            }

                            $wpdb->update($DOPBSP->tables->reservations, array('discount_price' => $reservation->discount,
                                                                               'deposit_price' => $reservation->deposit,
                                                                               'form' => json_encode($form),
                                                                               'payment_method' => $payment_method), 
                                                                         array('id' => $reservation->id));
                        }  
                    }
                }
            }
            
            /*
             * Update calendar settings tables from versions 1.x
             */
            function updateSettingsCalendar1x(){
                global $wpdb;
                global $DOPBSP;
                
                $control_data = $wpdb->query('SHOW TABLES LIKE "'.$DOPBSP->tables->settings_calendar.'"');

                if ($wpdb->num_rows != 0){
                    $new_columns = array('available_days' => 'CHANGE available_days days_available VARCHAR(128) DEFAULT "'.$this->db_config->settings_calendar['days_available'].'" COLLATE '.$this->db_collation.' NOT NULL',
                                         'details_from_hours' => 'CHANGE details_from_hours days_details_from_hours VARCHAR(6) DEFAULT "'.$this->db_config->settings_calendar['days_details_from_hours'].'" COLLATE '.$this->db_collation.' NOT NULL',
                                         'first_day' => 'CHANGE first_day days_first INT DEFAULT '.$this->db_config->settings_calendar['days_first'].' NOT NULL',
                                         'morning_check_out' => 'CHANGE morning_check_out days_morning_check_out VARCHAR(6) DEFAULT "'.$this->db_config->settings_calendar['days_morning_check_out'].'" COLLATE '.$this->db_collation.' NOT NULL',
                                         'multiple_days_select' => 'CHANGE multiple_days_select days_multiple_select VARCHAR(6) DEFAULT "'.$this->db_config->settings_calendar['days_multiple_select'].'" COLLATE '.$this->db_collation.' NOT NULL',
                                         'last_hour_to_total_price' => 'CHANGE last_hour_to_total_price hours_add_last_hour_to_total_price VARCHAR(6) DEFAULT "'.$this->db_config->settings_calendar['hours_add_last_hour_to_total_price'].'" COLLATE '.$this->db_collation.' NOT NULL',
                                         'multiple_hours_select' => 'CHANGE multiple_hours_select hours_multiple_select VARCHAR(6) DEFAULT "'.$this->db_config->settings_calendar['hours_multiple_select'].'" COLLATE '.$this->db_collation.' NOT NULL',
                                         'no_items_enabled' => 'CHANGE no_items_enabled sidebar_no_items_enabled VARCHAR(6) DEFAULT "'.$this->db_config->settings_calendar['sidebar_no_items_enabled'].'" COLLATE '.$this->db_collation.' NOT NULL');

                    $columns = $wpdb->get_results('SHOW COLUMNS FROM '.$DOPBSP->tables->settings_calendar);

                    foreach ($columns as $column){
                        foreach ($new_columns as $key => $query){
                            if ($column->Field == $key){
                                $wpdb->query('ALTER TABLE '.$DOPBSP->tables->settings_calendar.' '.$query);
                            }
                        }
                    }

                    /*
                     * Update notifications & payment settings.
                     */
                    $notifications = $wpdb->query('SHOW TABLES LIKE "'.$DOPBSP->tables->settings_notifications.'"');

                    if (!$notifications){
                        if (get_option('DOPBSP_db_update_settings_calendar_data') == ''){
                            add_option('DOPBSP_db_update_settings_calendar_data', 'true');
                        }
                        else{
                            update_option('DOPBSP_db_update_settings_calendar_data', 'true');
                        }
                    }
                }
            }
            
            
            /*
             * Update calendar settings data from versions 1.x
             */
            function updateSettingsCalendarData1x(){
                global $wpdb;
                global $DOPBSP;
                
                $settings_calendar = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->settings_calendar.' ORDER BY calendar_id');
                
                foreach ($settings_calendar as $data){
                    /*
                     * Update notifications settings.
                     */
                    $wpdb->insert($DOPBSP->tables->settings_notifications, array('id' => $data->id,
                                                                                 'calendar_id' => $data->calendar_id,
                                                                                 'email' => isset($data->notifications_email) ? $data->notifications_email:$this->db_config->settings_notifications['notifications_email'],
                                                                                 'smtp_host_name' => isset($data->smtp_host_name) ? $data->smtp_host_name:$this->db_config->settings_notifications['smtp_host_name'],
                                                                                 'smtp_host_port' => isset($data->smtp_host_port) ? $data->smtp_host_port:$this->db_config->settings_notifications['smtp_host_port'],
                                                                                 'smtp_ssl' => isset($data->smtp_ssl) ? $data->smtp_ssl:$this->db_config->settings_notifications['smtp_ssl'],
                                                                                 'smtp_user' => isset($data->smtp_user) ? $data->smtp_user:$this->db_config->settings_notifications['smtp_user'],
                                                                                 'smtp_password' => isset($data->smtp_password) ? $data->smtp_password:$this->db_config->settings_notifications['smtp_password']));
                    /*
                     * Update payment settings.
                     */
                    $wpdb->insert($DOPBSP->tables->settings_payment, array('id' => $data->id,
                                                                           'calendar_id' => $data->calendar_id,
                                                                           'arrival_enabled' => isset($data->payment_arrival_enabled) ? $data->payment_arrival_enabled:$this->db_config->settings_payment['payment_arrival_enabled'],
                                                                           'arrival_with_approval_enabled' => isset($data->instant_booking) ? $data->instant_booking:$this->db_config->settings_payment['instant_booking'],
                                                                           'paypal_enabled' => isset($data->payment_paypal_enabled) ? $data->payment_paypal_enabled:$this->db_config->settings_payment['payment_paypal_enabled'],
                                                                           'paypal_username' => isset($data->payment_paypal_username) ? $data->payment_paypal_username:$this->db_config->settings_payment['payment_paypal_username'],
                                                                           'paypal_password' => isset($data->payment_paypal_password) ? $data->payment_paypal_password:$this->db_config->settings_payment['payment_paypal_password'],
                                                                           'paypal_signature' => isset($data->payment_paypal_signature) ? $data->payment_paypal_signature:$this->db_config->settings_payment['payment_paypal_signature'],
                                                                           'paypal_credit_card' => isset($data->payment_paypal_credit_card) ? $data->payment_paypal_credit_card:$this->db_config->settings_payment['payment_paypal_credit_card'],
                                                                           'paypal_sandbox_enabled' => isset($data->payment_paypal_sandbox_enabled) ? $data->payment_paypal_sandbox_enabled:$this->db_config->settings_payment['payment_paypal_sandbox_enabled']));
                }
                
                update_option('DOPBSP_db_update_settings_calendar_data', 'false');
            }
            
            /*
             * Rename tables names.
             */
            function updateRename(){
                global $wpdb;
                
                $current_db_version = get_option('DOPBSP_db_version');
                
                /*
                 * Rename calendars settings table.
                 */
                if ($current_db_version != ''
                        && $current_db_version < 2.165){
                    $control_data = $wpdb->query('SHOW TABLES LIKE "'.$wpdb->prefix.'dopbsp_settings_calendar"');
                    
                    if ($wpdb->num_rows == 0){
                        $wpdb->query('RENAME TABLE '.$wpdb->prefix.'dopbsp_settings TO '.$wpdb->prefix.'dopbsp_settings_calendar');
                    }
                }
            }
         
// Configuration
            
            /*
             * Set database configuration.
             * 
             * @return database configuration
             */
            function config($db_config){
                /*
                 * Calendars
                 */
                $db_config->calendars = array('user_id' => 0,
                                              'post_id' => 0,
                                              'name' => '',
                                              'price_min' => 0,
                                              'price_max' => 0,
                                              'rating' => 0,
                                              'address' => '',
                                              'address_en' => '',
                                              'address_alt' => '',
                                              'address_alt_en' => '',
                                              'coordinates' => '');
                
                /*
                 * Coupons
                 */
                $db_config->coupons = array('user_id' => 0,
                                            'name' => '',
                                            'code' => '',
                                            'start_time_lapse' => '',
                                            'end_time_lapse' => '',
                                            'start_date' => '',
                                            'end_date' => '',
                                            'start_hour' => '',
                                            'end_hour' => '',
                                            'no_coupons' => '',
                                            'operation' => '+',
                                            'price' => 0,
                                            'price_type' => 'fixed',
                                            'price_by' => 'once',
                                            'translation' => '');
                
                /*
                 * Days
                 */
                $db_config->days = array('calendar_id' => 0,
                                         'day' => '',
                                         'year' => date('Y'),
                                         'data' => '',
                                         'price_min' => 0,
                                         'price_max' => 0);
                
                /*
                 * Days available.
                 */
                $db_config->days_available = array('day' => '',
                                                   'hour' => '',
                                                   'data' => '');
                
                /*
                 * Days unavailable
                 */
                $db_config->days_unavailable = array('day' => '',
                                                     'hour' => '',
                                                     'data' => '');
                
                /*
                 * Discounts
                 */
                $db_config->discounts = array('user_id' => 0,
                                              'name' => '',
                                              'extras' => 'false');
                
                /*
                 * Discounts items.
                 */
                $db_config->discounts_items = array('discount_id' => 0,
                                                    'position' => 0,
                                                    'start_time_lapse' => '',
                                                    'end_time_lapse' => '',
                                                    'operation' => '-',
                                                    'price' => 0,
                                                    'price_type' => 'percent',
                                                    'price_by' => 'once',
                                                    'translation' => '');
                
                /*
                 * Discounts items rules.
                 */
                $db_config->discounts_items_rules = array('discount_item_id' => 0,
                                                          'position' => 0,
                                                          'start_date' => '',
                                                          'end_date' => '',
                                                          'start_hour' => '',
                                                          'end_hour' => '',
                                                          'operation' => '-',
                                                          'price' => 0,
                                                          'price_type' => 'percent',
                                                          'price_by' => 'once');
                
                /*
                 * Emails
                 */
                $db_config->emails = array('user_id' => 0,
                                           'name' => '');
                
                /*
                 * Emails translation.
                 */
                $db_config->emails_translation = array('email_id' => 0,
                                                       'template' => '',
                                                       'subject' => '',
                                                       'message' => '');
                
                /*
                 * Extras
                 */
                $db_config->extras = array('user_id' => 0,
                                           'name' => '');
                
                /*
                 * Extras groups.
                 */
                $db_config->extras_groups = array('extra_id' => 0,
                                                  'position' => 0,
                                                  'multiple_select' => 'false',
                                                  'required' => 'false',
                                                  'translation' => '');
                
                /*
                 * Extras groups items.
                 */
                $db_config->extras_groups_items = array('group_id' => 0,
                                                        'position' => 0,
                                                        'operation' => '+',
                                                        'price' => 0,
                                                        'price_type' => 'fixed',
                                                        'price_by' => 'once',
                                                        'translation' => '');
                
                /*
                 * Fees
                 */
                $db_config->fees = array('user_id' => 0,
                                         'name' => '',
                                         'operation' => '+',
                                         'price' => 0,
                                         'price_type' => 'fixed',
                                         'price_by' => 'once',
                                         'included' => 'true',
                                         'extras' => 'true',
                                         'cart' => 'true',
                                         'translation' => '');
                
                /*
                 * Forms
                 */
                $db_config->forms = array('user_id' => 0,
                                          'name' => '',
                                          'label' => '');
                
                /*
                 * Forms fields.
                 */
                $db_config->forms_fields = array('form_id' => 0,
                                                 'label' => '',
                                                 'type' => '',
                                                 'position' => 0,
                                                 'multiple_select' => 'false',
                                                 'allowed_characters' => '',
                                                 'size' => 0,
                                                 'is_email' => 'false',
                                                 'required' => 'false',
                                                 'add_to_day_hour_info' => 'false',
                                                 'add_to_day_hour_body' => 'false',
                                                 'info' => '');
                
                /*
                 * Forms select options.
                 */
                $db_config->forms_fields_options = array('field_id' => 0,
                                                         'label' => '',
                                                         'position' => 0);
                
                /*
                 * Languages
                 */
                $db_config->languages = array('name' => '',
                                              'code' => '',
                                              'enabled' => 'false');
                
                /*
                 * Locations
                 */
                $db_config->locations = array('user_id' => 0,
                                              'name' => '',
                                              'address' => '',
                                              'address_en' => '',
                                              'address_alt' => '',
                                              'address_alt_en' => '',
                                              'coordinates' => '',
                                              'calendars' => '');
                
                /*
                 * Reservations
                 */
                $db_config->reservations = array('calendar_id' => 0,
                                                 'language' => 'en',
                                                 'currency' => '$',
                                                 'currency_code' => 'USD',

                                                 'check_in' => '',
                                                 'check_out' => '',
                                                 'start_hour' => '',
                                                 'end_hour' => '',
                                                 'no_items' => 1,
                                                 'price' => 0,
                                                 'price_total' => 0,

                                                 'extras' => '',
                                                 'extras_price' => 0,
                                                 'discount' => '',
                                                 'discount_price' => 0,
                                                 'coupon' => '',
                                                 'coupon_price' => 0,
                                                 'fees' => '',
                                                 'fees_price' => 0,
                                                 'deposit' => '',
                                                 'deposit_price' => 0,

                                                 'days_hours_history' => '',
                                                 'form' => '',
                                                 'email' => '',
                                                 'status' => 'pending',
                                                 'payment_method' => 'default',
                                                 'transaction_id' => '',
                                                 'token' => '',
                                                 'date_created' => '');
                
                /*
                 * Rules
                 */
                $db_config->rules = array('user_id' => 0,
                                          'name' => '',
                                          'time_lapse_min' => 0,
                                          'time_lapse_max' => 0);
                
                /*
                 * Search
                 */
                $db_config->searches = array('user_id' => 0,
                                             'name' => '',
                                             'calendars_excluded' => '');
                
                /*
                 * Settings
                 */
                $db_config->settings = array('unique_key' => '',
                                             'value' => '');
                
                /*
                 * Settings calendar.
                 */
                $db_config->settings_calendar = array('calendar_id' => 0,
                                                      'date_type' => 1,
                                                      'template' => 'default',
                                                      'booking_stop' => 0,
                                                      'months_no' => 1,
                                                      'view_only' => 'false',
                                                      'max_year' => date('Y'),

                                                      'currency' => 'USD',
                                                      'currency_position' => 'before',

                                                      'days_available' => 'true,true,true,true,true,true,true',
                                                      'days_details_from_hours' => 'true',
                                                      'days_first' => 1,
                                                      'days_first_displayed' => '',
                                                      'days_morning_check_out' => 'false',
                                                      'days_multiple_select' => 'true',

                                                      'hours_add_last_hour_to_total_price' => 'true',
                                                      'hours_ampm' => 'false',
                                                      'hours_definitions' => '',
                                                      'hours_enabled' => 'false',
                                                      'hours_info_enabled' => 'true',
                                                      'hours_interval_enabled' => 'false',
                                                      'hours_multiple_select' => 'true',

                                                      'sidebar_no_items_enabled' => 'true',
                                                      'sidebar_style' => 1,

                                                      'rule' => 0,
                                                      'extra' => 0,
                                                      'cart_enabled' => 'false',
                                                      'discount' => 0,
                                                      'fees' => '',
                                                      'coupon' => 0,

                                                      'deposit' => 0,
                                                      'deposit_type' => 'percent',

                                                      'form' => 1,

                                                      'terms_and_conditions_enabled' => 'false',
                                                      'terms_and_conditions_link' => '');
                
                /*
                 * Settings notifications.
                 */
                $db_config->settings_notifications = array('calendar_id' => 0,
                                                           'templates' => 1,
                                                           'method_admin' => 'mailer',
                                                           'method_user' => 'mailer',
                                                           'email' => '',
                                                           'email_reply' => '',
                                                           'email_name' => '',
                                                           'email_cc' => '',
                                                           'email_cc_name' => '',
                                                           'email_bcc' => '',
                                                           'email_bcc_name' => '',

                                                           'smtp_host_name' => '',
                                                           'smtp_host_port' => 25,
                                                           'smtp_ssl' => 'false',
                                                           'smtp_user' => '',
                                                           'smtp_password' => '',

                                                           'smtp_host_name2' => '',
                                                           'smtp_host_port2' => 25,
                                                           'smtp_ssl2' => 'false',
                                                           'smtp_user2' => '',
                                                           'smtp_password2' => '',

                                                           'send_book_admin' => 'true',
                                                           'send_book_user' => 'true',
                                                           'send_book_with_approval_admin' => 'true',
                                                           'send_book_with_approval_user' => 'true',
                                                           'send_approved' => 'true',
                                                           'send_canceled' => 'true',
                                                           'send_rejected' => 'true');
                
                /*
                 * Settings payment.
                 */
                $db_config->settings_payment = array('calendar_id' => 0,
                                                     'arrival_enabled' => 'true',
                                                     'arrival_with_approval_enabled' => 'false',
                                                     'redirect' => '',

                                                     'paypal_enabled' => 'false',
                                                     'paypal_username' => '',
                                                     'paypal_password' => '',
                                                     'paypal_signature' => '',
                                                     'paypal_credit_card' => 'false',
                                                     'paypal_sandbox_enabled' => 'false',
                                                     'paypal_redirect' => '');
                
                /*
                 * Settings search.
                 */
                $db_config->settings_search = array('search_id' => 0,
                                                    'date_type' => 1,
                                                    'template' => 'default',
                                                    'search_enabled' => 'false',
                                                    'price_enabled' => 'true',

                                                    'view_default' => 'list',
                                                    'view_list_enabled' => 'true',
                                                    'view_grid_enabled' => 'false',
                                                    'view_map_enabled' => 'false',
                                                    'view_results_page' => 10,
                                                    'view_sidebar_position' => 'left',

                                                    'currency' => 'USD',
                                                    'currency_position' => 'before',

                                                    'days_first' => 1,
                                                    'days_multiple_select' => 'true',

                                                    'hours_ampm' => 'false',
                                                    'hours_definitions' => '',
                                                    'hours_enabled' => 'false',
                                                    'hours_multiple_select' => 'true',

                                                    'availability_enabled' => 'false',
                                                    'availability_max' => 10,
                                                    'availability_min' => 1);
                
                /*
                 * Translation
                 */
                $db_config->translation = array('key_data' => '',
                                                'location' => 'backend',
                                                'parent_key' => '',
                                                'text_data' => '',
                                                'translation' => '');
                
                /*
                 * WooCommerce
                 */
                $db_config->woocommerce = array('cart_key' => '',
                                                'variation_id' => 0,
                                                'product_id' => 0,
                                                'calendar_id' => 0,
                                                'language' => '',
                                                'currency' => '',
                                                'currency_code' => '',
                                                'data' => '',
                                                'date_created' => '');
                
                return $db_config;
            }
        }
    }