<?php


		/*!############## DOPBSP Framework by YO Jii Had Saaduddin /*##############*
			   /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *  \
			><;"> * Title             	:	DOP Module v2.0 for Booking System Project		* <";><"
			><;"> * Version      		:	2.0																					* <";><
			><;"> * Last Updated	:	02 February 2016															* <";><
			><;"> * Author				:	Digital Online Project (DOP.Capstone)						* <";><
			><;"> * Copyright		:	© 2015 Digital Online Project (DOP.Capstone)			* <";><
			><;"> * Facebook		:	http://www.facebook.com/davaocapstone					* <";><
			><;"> * Description  	:	Booking System Project configuration file.					* <";><
			><;"> * Website			:	http://jiiyo.wordpress.com												* <";><
			><;"> * Group				:	http://facebook.com/groups/futuredavao						* <";><
			><;"> * Sourcecode	:	http://www.sourcecodester.com/user/47286/track		* <";><
			><;"> * Github				:	https://github.com/MrJii/dopbsp									* <";><
			><;"> * Email				:	saaduddinj@gmail.com													* <";><
			><;"> * Skype				:	jii.yo																					* <";><
			   \ * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
							*//*!############## DOP Module v2.0 /*##############*//*!

			1.8 (2015-11-01)
					
					* Add bookins/reservations in WordPress admin.
					* Approving/canceling a reservation modifies the booking calendar data.
					* Back end CSS bugs fixed.
					* Bookings/reservations logic has been completly modified (search added, filters added, calendar & list view added).
					* Custom post types bugs fixed.
					* Edit unavailable days, bug fixed.
					* Front end booking calendar CSS bugs fixed.
					* Instant/waiting approval display, bug fixed.
					* JavaScript in admin posts fixed.
					* Localhost bugs fixed.
					* Plugin paths updated.
					* Prices, deposits, discounts can have float values.
					* Select days from different months on front end booking calendar, bug fixed.
					* Translation system has been updated.
					* User management updated.
					* Windows server mySQL text fields bug fixed.

			1.7 (2015-07-31)

					* Add booking calendars in widgets.
					* Approve booking/reservation bug fixed.
					* Back end style changes.
					* Calendar ID is removed from clients booking notification emails.
					* CSS bug fixes, in booking calendar.
					* Custom post type added.
					* Date select is fixed when minimum amount of days is set.
					* Datepicker bug fix, when you can select only one day, in booking calendar.
					* Drop down fields display correct selected option in booking notifications.
					* Hours info is displayed on day hover, in booking calendar.
					* Major changes in booking hours logic and display.
					* Newly created booking forms display correct after PayPal Payment.
					* PayPal booking notification email content bug fixed.
					* Send email using normal function if SMTP is incorrect.
					* Tables not created on Windows OS bug fixed.
					* Text on Settings page, in WordPress admin, has been changed.
					* Translation for check fields added.
					* User role is updated when is changed in WordPress admin.
					* When hours are enabled, days details can be set manually or set depending on hours details on that current day.
					* WordPress update error fixed. 

			1.6 (2015-06-15)

					* CSS incompatibility fixes, in front end booking calendar.
					* Custom booking forms added.
					* Datepicker z-index bug fixed, in front end booking calendar.
					* Email header is custom.
					* Group day date is displayed correctly after select, in front end booking calendar.
					* Users permissons translation fixed.
					* ACAO buster added.
					* Admin change language bug fixed.
					* Administrators can create booking calendars for users.
					* Booking calendar loading time is improved.
					* Booking calendar resize on hidden elements, bug fixed.
					* Booking notifications are sent using "wp_mail()".
					* Database is deleted when you delete the DOP Module system plugin.
					* Display only an information calendar in front end.
					* Indonesia Rupiah currency bug fixed.
					* PayPal credit card payment bug fixed.
					* PayPal session bug fixed.
					* Select first day of the week, in booking calendar.
					* Slow admin bug fixed.
					* Small admin changes.
					* Touch devices freeze bug fixed.
					* Translation fixes, both in front end booking calendar and back end.
					* Update booking notification added.
					* User permissions updated, in DOP Module system back end.
					* Booking notifications message and language bugs have been fixed.
					* Correct hours format is displayed, in front end booking calendar.
					* Deposit feature has been added, for booking requests.
					* Discounts by number of days booked have been added.
					* Front end booking calendar is responsive.
					* Touch devices navigation has been enabled.
					* You can translate the sidebar datepicker.
					* You can use PayPal credit card payment, for booking requests.
					* AM/PM hour format added, in front end booking calendar and WordPress admin.
					* Booking/reservation cancel added.
					* Hours data save bug fixed.
					* Language files added (but not translated), for front end booking calendar and back end WordPress admin.
					* Morning check out added, in booking calendar.
					* Past hours are removed from current day, in booking calendar.
					* Rejected booking/reservation notification email fixed.  
					* Shortcode generator doesn't appear if you are not allowed to create booking calendars or you did nt create any booking calendars.
					* SMTP SSL fix, when sending booking notifications.
					* User permissions bug fixed, in WordPress admin.
					* You can select minimum and/or maximum amount of days that can be booked.
					* You can set default hours values by day(s), in WordPress admin.
					* "ereg()" function replaced with "preg_match()".
					* Administrators can view and edit users booking calendars.
					* Back end & front end CSS incompatibility fixes.
					* Clean script to remove past days info to clear database from unnecessary data.
					* Database structure has been changed (now is much faster to save/load data & works on server with few resources).
					* Delete booking calendar bug fixed.
					* Display correct month in future years, bug fixed.
					* Emails template system added, for booking notifications.
					* PayPal bugs fixed.
					* Reservation ID is displayed in notifications emails.
					* Terms & Conditions checkbox and link added.
					* You can now add the booking calendar sidebar in a widget area.
					* You can set if individual users can create or not booking calendars.
					* You can use SMTP to send booking notifications emails.
		
		1.0 (2015-47-15)
		
			*//* Initial release of DOP Module Booking System Project.
			
	Installation: Upload the folder dopbsp from the zip file to "wp-content/plugins/" and activate the plugin in your admin panel or upload dopbsp.zip in the "Add new" section.
	*/

    if (!class_exists('DOPBSPViewsBackEndCalendars')){
        class DOPBSPViewsBackEndCalendars extends DOPBSPViewsBackEnd{
            /*
             * Constructor
             */
            function DOPBSPViewsBackEndCalendars(){
            }
            
            /*
             * Returns calendars template.
             * 
             * @return calendars HTML page
             */
            function template(){
                global $DOPBSP;
                
                $this->getTranslation();
?>            
    <div class="wrap DOPBSP-admin">
<!--
    Header
-->
        <?php $this->displayHeader($DOPBSP->text('TITLE')); ?>
        <input type="hidden" name="DOPBSP-calendar-ID" id="DOPBSP-calendar-ID" value="" />
        <input type="hidden" name="DOPBSP-calendar-jump-to-day" id="DOPBSP-calendar-jump-to-day" value="" />
<!--
    Content
-->
        <div class="dopbsp-main dopbsp-hidden">
 
            <table class="dopbsp-content-wrapper">
			
                <colgroup>
                    <col id="DOPBSP-col-column1" class="dopbsp-column1" />
                    <col id="DOPBSP-col-column-separator1" class="dopbsp-separator" />
                    <col id="DOPBSP-col-column2" class="dopbsp-column2" />
                    <col id="DOPBSP-col-column-separator2" class="dopbsp-separator" />
                    <col id="DOPBSP-col-column1" class="dopbsp-column3" />
                </colgroup>
                <tbody>
                    <tr>
                        <td id="DOPBSP-column1" class="dopbsp-column">
                            <div class="dopbsp-column-header">
<?php 
                if (isset($_GET['page']) 
                        && $DOPBSP->classes->backend_settings_users->permission(wp_get_current_user()->ID, 'use-booking-system')){ 
?>                  
                               
                                
<?php
                }
                else{
?>           
                         
<?php
                }
?>                           
                               
                            </div>
							 
                            <div class="dopbsp-column-content">
							
							</div>
                        </td>
						<div align="center">
						<a href="javascript:DOPBSPCalendar.add()"><?php echo ('Create New Room for Reservations'); ?></span></a>
						</div>
                        <td id="DOPBSP-column-separator1" class="dopbsp-separator"></td>
                        <td id="DOPBSP-column2" class="dopbsp-column">
                            <div class="dopbsp-column-header">&nbsp;</div>
                            <div class="dopbsp-column-content">&nbsp;</div>
                        </td>
                        <td id="DOPBSP-column-separator2" class="dopbsp-separator"></td>
                        <td id="DOPBSP-column3" class="dopbsp-column">
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