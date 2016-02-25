/*!Title                   : DOP BookSlug Press V2
* Version                 : 2.0
: Plugin URL	:		https://github.com/MrJii/DOPBSP
* File Version            : 1.0.1
* Last Updated	 : 05 January 2016
* Author                  : JihadC
* Copyright               : © 2015 JihadC <Software7.0 - saaduddinj@gmail.com>
* Website                 : http://www.facebook.com/CSoftware7.0
* Description             : BookSlug Press is an online days/hours calculated booking or reservation system with PHP & AJAX server side design..*/


(function(){
    var calendars = new Array(),
        calendarsData,
        i,
        title = 'Insert KTV Room',
        languages = new Array(),
        languagesData,
        windowHTML = new Array(),
        formHTML = new Array();
        
    if (typeof DOPBSP_tinyMCE_data === 'undefined'){
        return false;
    }

    tinymce.create('tinymce.plugins.DOPBSP', {
        init:function(ed, url){
            var calendarsData = DOPBSP_tinyMCE_data.split(';;;;;')[1],
                calendars = calendarsData.split(';;;'),
                Calendar = DOPBSP_tinyMCE_data.split(';;;;;')[2],
                selectCalendar = DOPBSP_tinyMCE_data.split(';;;;;')[3],
                Language = DOPBSP_tinyMCE_data.split(';;;;;')[4],
                selectLanguage = DOPBSP_tinyMCE_data.split(';;;;;')[5],
                languagesData = DOPBSP_tinyMCE_data.split(';;;;;')[6],
                languages = languagesData.split(';;;'),
                selectedLanguage = DOPBSP_language;

            if (parseFloat(WP_version) > 3.8){ 
                var valueNew = '',
                valueALL = [];
                // GET Calendars
                for (i=0; i<calendars.length; i++){
                    if (calendars[i] !== ''){
                        valueALL.push('<option value="'+calendars[i].split(';;')[0]+'">ID: '+calendars[i].split(';;')[0]+": "+calendars[i].split(';;')[1]+'</option>');
                    }
                }
                // GET Languages
                var langValueNew = '',
                langValueALL = [];

                for (i=0; i<languages.length; i++){
                    if (languages[i] !== ''){
                        langValueALL.push('<option value="'+languages[i].split(';;')[0]+'">'+languages[i].split(';;')[1]+'</option>');
                    }
                }
                // ADD Button
                ed.addButton('DOPBSP', {
                    title: title,
                    image: DOPBSP_PATH+'assets/gui/images/icon-add.png',
                    onclick: function() {
                        
                  //      formHTML.push('   <div class="DOPBSP-window-title">'+title+'</div>');
                        formHTML.push('   <select id="DOPBSP-select-element" onchange="dopbspChangeElement(this);">');
                        formHTML.push('       <option value="dopbsp">√ Module Enabled</option>');
                     //   formHTML.push('       <option value="dopbsp">Calendar</option>');
                     //   formHTML.push('       <option value="dopbsps">Search</option>');
                        formHTML.push('   </select>');
                        formHTML.push('   <select id="DOPBSP-select-calendar" onchange="dopbspChangeElement(this);" class="hide">');
                        formHTML.push('       <option value="none">Room Type</option>');
                        formHTML.push(        valueALL.join(''));
                        formHTML.push('   </select>');
                        formHTML.push('   <select id="DOPBSP-select-language" onchange="dopbspChangeElement(this);" class="hide">');
                        formHTML.push('       <option value="none">Choose language</option>');
                        formHTML.push(        langValueALL.join(''));
                        formHTML.push('   </select>');
                        formHTML.push('   <div id="DOPBSP-buttons">');
                        formHTML.push('       <a href="#" id="DOPBSP-add" class="DOPBSP-button hide" onclick="dopbspInsertShortcode();"><span>Install Now</span></a>');
                        formHTML.push('       <a href="#" class="DOPBSP-button" onclick="dopbspCancelShortcode();"><span>Close</span></a>');
                        formHTML.push('   </div>');

                        windowHTML.push('<div class="DOPBSP-window-background"></div>');
                        windowHTML.push('<div class="DOPBSP-window">');
                        windowHTML.push('</div>');
                        
                        jQuery('body').append(windowHTML.join(''));
                        jQuery('.DOPBSP-window').html('');
                        jQuery('.DOPBSP-window').append(formHTML.join(''));
                        jQuery('.DOPBSP-window-background').fadeIn(300);
                        jQuery('.DOPBSP-window').animate({'top':'80px'},500);
                        formHTML = new Array();
                        windowHTML = new Array();
                        
                    }
                });
            }
    
        },

        createControl:function(n, cm){// Init Combo Box.
            
            if (parseFloat(WP_version) < 3.9) { 
                
                switch (n){
                    case 'DOPBSP':
                        if (calendarsData !== ''){
                            var mlb = cm.createListBox('DOPBSP', {
                                 title: title,
                                 onselect: function(value){
                                     tinyMCE.activeEditor.selection.setContent(value);
                                 }
                            });

                            for (i=0; i<calendars.length; i++){
                                if (calendars[i] !== ''){
                                    mlb.add('ID '+calendars[i].split(';;')[0]+': '+calendars[i].split(';;')[1], '[dopbsp id="'+calendars[i].split(';;')[0]+'"]');
                                }
                            }

                            return mlb;
                        }
                }
                
            }

            return null;
        },

        getInfo:function(){
            return {longname  : 'Insert KTV Room',
                    author    : 'Davao Online Project',
                    authorurl : 'http://jiiyo.wordpress.com',
                    infourl   : 'http://www.facebook.com/davaocapstone',
                    version   : '1.0'};
        }
    });

    tinymce.PluginManager.add('DOPBSP', tinymce.plugins.DOPBSP);
})();

function dopbspInsertShortcode(){
    var element = jQuery('#DOPBSP-select-element').val(),
        calendar = jQuery('#DOPBSP-select-calendar').val(),
        language = jQuery('#DOPBSP-select-language').val(),
        shortcodeHML = '';

        if (element == 'dopbsp') {
            shortcodeHML = '[dopbsp id="'+calendar+'" lang="'+language+'"]';
        } else if (element == 'dopbsps'){
            shortcodeHML = '[dopbsps lang="'+language+'"]';
        }
        
        if (shortcodeHML != '') {
            window.tinyMCE.activeEditor.selection.setContent(shortcodeHML);
        }
        
        jQuery('.DOPBSP-window-background').fadeOut(300);
        jQuery('.DOPBSP-window').animate({'top':'-180px'},500, function(){
            jQuery('.DOPBSP-window').html('');
            jQuery('.DOPBSP-window-background').remove();
        });
}

function dopbspChangeElement(el){
    jQuery(el).val(el.value);
    var element = jQuery('#DOPBSP-select-element').val(),
        calendar = jQuery('#DOPBSP-select-calendar').val(),
        language = jQuery('#DOPBSP-select-language').val();

    if (element != 'none') {

        if (element == 'dopbsp') {
            // SHOW ELEMENTS
            jQuery('#DOPBSP-select-calendar').removeClass('hide');
            jQuery('#DOPBSP-select-language').removeClass('hide');

            if (calendar != 'none' && language != 'none' ){
               jQuery('#DOPBSP-add').removeClass('hide');
            } else {
                // Hide add
                jQuery('#DOPBSP-add').addClass('hide');
            }

        } else if (element == 'dopbsps'){
            // SHOW ELEMENTS
            jQuery('#DOPBSP-select-calendar').addClass('hide');
            jQuery('#DOPBSP-select-language').removeClass('hide');

            if (language != 'none' ){
                jQuery('#DOPBSP-add').removeClass('hide');
            } else {
                // Hide add
                jQuery('#DOPBSP-add').addClass('hide');
            }
        }
    } else {
        // HIDE ELEMENTS
        jQuery('#DOPBSP-select-calendar').addClass('hide');
        jQuery('#DOPBSP-select-language').addClass('hide');
        jQuery('#DOPBSP-add').addClass('hide');
    }
}

function dopbspCancelShortcode(){
    jQuery('.DOPBSP-window-background').fadeOut(300);
    jQuery('.DOPBSP-window').animate({'top':'-180px'},500, function(){
        jQuery('.DOPBSP-window').html('');
        jQuery('.DOPBSP-window-background').remove();
    });
}