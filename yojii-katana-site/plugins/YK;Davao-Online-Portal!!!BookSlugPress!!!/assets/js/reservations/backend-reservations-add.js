/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/


var DOPBSPReservationsAdd = new function(){
    'use strict';
    
    /*
     * Private variables.
     */
    var $ = jQuery.noConflict();
        
    /*
     * Constructor
     */
    this.DOPBSPReservationsAdd = function(){
    };
    
    /*
     * Display reservations add.
     */
    this.display = function(){
        if ($('#DOPBSP-calendar-ID').val().indexOf(',') !== -1){
            return false;
        }
        
        /*
         * Clear previous content.
         */
        DOPBSP.clearColumns(2);
        $('#DOPBSP-col-column-separator2').removeAttr('style');
        $('#DOPBSP-col-column3').removeAttr('style');
        $('#DOPBSP-column-separator2').removeAttr('style');
        $('#DOPBSP-column3').removeAttr('style');
        
        if ($('.DOPBSPReservationsCalendar-tooltip').length !== undefined){
            $('.DOPBSPReservationsCalendar-tooltip').remove();
        }
        
        /*
         * Set buttons.
         */
        $('.DOPBSP-admin .dopbsp-main .dopbsp-button.dopbsp-reservations-add-button').addClass('dopbsp-selected');
        $('.DOPBSP-admin .dopbsp-main .dopbsp-button.dopbsp-reservations-list-button').removeClass('dopbsp-selected');
        $('.DOPBSP-admin .dopbsp-main .dopbsp-button.dopbsp-reservations-calendar-button').removeClass('dopbsp-selected');
        
        /*
         * Set filters.
         */
        $('#DOPBSP-inputs-reservations-filters-calendars').addClass('dopbsp-last');
        
        $('#DOPBSP-inputs-button-reservations-filters-period').parent().css('display', 'none');
        $('#DOPBSP-inputs-reservations-filters-period').css('display', 'none');
        $('#DOPBSP-reservations-start-date-wrapper').css('display', 'block');
        $('#DOPBSP-reservations-end-date-wrapper').css('display', 'block');
        
        $('#DOPBSP-inputs-button-reservations-filters-status').parent().css('display', 'none');
        $('#DOPBSP-inputs-reservations-filters-status').css('display', 'none');
        $('#DOPBSP-reservations-expired-wrapper').css('display', 'block');
                                               
        $('#DOPBSP-inputs-button-reservations-filters-payment').parent().css('display', 'none')
                                                                        .removeClass('dopbsp-last');
        $('#DOPBSP-inputs-reservations-filters-payment').css('display', 'none')
                                                        .removeClass('dopbsp-last');
        
        $('#DOPBSP-inputs-button-reservations-filters-search').parent().css('display', 'none');
        $('#DOPBSP-inputs-reservations-filters-search').css('display', 'none');
        
        DOPBSPReservationsAdd.init();
    };
    
    /*
     * Initialize reservations add calendar.
     */
    this.init = function(){
        DOPBSP.toggleMessages('active', DOPBSP.text('MESSAGES_LOADING'));
        $('#DOPBSP-column2 .dopbsp-column-content').html('<div id="DOPBSP-reservations-add"></div>');
        
        $.post(ajaxurl, {action: 'dopbsp_reservations_add_get_json',
                         calendar_id: $('#DOPBSP-calendar-ID').val()}, function(data){
            data = $.trim(data);
            
            $('#DOPBSP-reservations-add').DOPBSPReservationsAdd(JSON.parse(data));
        });
    };
    
    return this.DOPBSPReservationsAdd();
};