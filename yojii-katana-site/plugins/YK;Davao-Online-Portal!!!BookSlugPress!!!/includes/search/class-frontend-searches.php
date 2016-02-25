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


    if (!class_exists('DOPBSPFrontEndSearches')){
        class DOPBSPFrontEndSearches extends DOPBSPFrontEnd{
            /*
             * Constructor.
             */
            function DOPBSPFrontEndSearch(){
                add_action('init', array(&$this, 'init'));
            }

            /*
             * Initialize search.
             */
            function init(){
                add_shortcode('dopbsp-search', array(&$this, 'shortcode'));
                
//                wp_register_script('DOPBSP-js-frontend-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp', array('jquery'), false, true);
//                wp_enqueue_script('DOPBSP-js-frontend-map');
                //https://maps.googleapis.com/maps/api/js?v=3.exp
            }

            /*
             * Initialize calendars shortcode.
             * 
             * @param atts (array): shortcode attributes
             */
            function shortcode($atts){
                global $DOPBSP;
                global $wpdb;
                
                extract(shortcode_atts(array('class' => 'dopbsp-search'), $atts));
                
                if (!array_key_exists('id', $atts)){
                    $atts['id'] = 1;
                }
                                
                if (!isset($atts['lang'])){
                    $atts['lang'] = DOPBSP_CONFIG_TRANSLATION_DEFAULT_LANGUAGE;
                }
                
                $id = $atts['id'];
                
                /*
                 * Do not display anything if the shortcode is invalid.
                 */
                $searches = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$DOPBSP->tables->searches.' WHERE id=%d',
                                                           $id));
                
                if ($wpdb->num_rows == 0){
                    return false;
                }
              
                $options = $this->getJSON($atts);
               
                $data = array();
                
// HOOK (dopbsp_action_search_init_before) ********************************* Add action before search init.
                do_action('dopbsp_action_search_init_before');
                
// HOOK (dopbsp_frontend_content_before_search) ****************************** Add content before search.
                ob_start();
                    do_action('dopbsp_frontend_content_before_search');
                    $dopbsp_frontend_before_search = ob_get_contents();
                ob_end_clean();
                array_push($data, $dopbsp_frontend_before_search);
                
                /*
                 * Search HTML.
                 */
//                array_push($data, '<link rel="stylesheet" type="text/css" href="'.$DOPBSP->paths->url.'templates/'.$options['search']['data']['template'].'/css/jquery.dop.frontend.BSPCalendar.css" />');            
                array_push($data, '<link rel="stylesheet" type="text/css" href="'.$DOPBSP->paths->url.'templates/'.$options['search']['data']['template'].'/css/jquery.dop.frontend.BSPSearch.css" />');            
                array_push($data, '<script type="text/JavaScript">');
                array_push($data, '    jQuery(document).ready(function(){');
                array_push($data, "        jQuery('#DOPBSPSearch').DOPBSPSearch('".json_encode($options)."');");
                array_push($data, '    });');
                array_push($data, '</script>');
                array_push($data, '<div class="DOPBSPSearch-wrapper notranslate" id="DOPBSPSearch"><a href="'.admin_url('admin-ajax.php').'"></a></div>');
                
// HOOK (dopbsp_frontend_content_after_search) ******************************* Add content after search.
                ob_start();
                    do_action('dopbsp_frontend_content_after_search');
                    $dopbsp_frontend_after_search = ob_get_contents();
                ob_end_clean();
                array_push($data, $dopbsp_frontend_after_search);
                
                return implode("\n", $data);
            }
            
            /*
             * Get search.
             * 
             * @param settings_calendar (object): calendar settings data
             * 
             * @return data array
             */
            function get(){
                global $DOPBSP;
                    
                return array('data' => array(),
                             'text' => array('checkIn' => $DOPBSP->text('SEARCH_FRONT_END_CHECK_IN'),
                                             'checkOut' => $DOPBSP->text('SEARCH_FRONT_END_CHECK_OUT'),
                                             'hourEnd' => $DOPBSP->text('SEARCH_FRONT_END_END_HOUR'),
                                             'hourStart' => $DOPBSP->text('SEARCH_FRONT_END_START_HOUR'),
                                             'noItems' => $DOPBSP->text('SEARCH_FRONT_END_NO_ITEMS'),
                                             'noServices' => $DOPBSP->text('SEARCH_FRONT_END_NO_SERVICES_AVAILABLE'),
                                             'noServicesSplitGroup' => $DOPBSP->text('SEARCH_FRONT_END_NO_SERVICES_AVAILABLE_SPLIT_GROUP'),
                                             'title' => $DOPBSP->text('SEARCH_TITLE')));
            }
            
            /*
             * Get search.
             * 
             * @param atts (object): shortocode attributes
             * 
             * @return data array
             */
            function getJSON($atts){
                global $wpdb;
                global $DOPBSP;
                
                $data = array();
                $currencyData = array();
                $currenciesData = array();
                $id = $atts['id'];
                $language = $atts['lang'];
                
                $DOPBSP->classes->translation->set($language);
                
                $searches= $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->searches.' where id="'.$id.'"');
                
                $currencies = $this->httpGet('http://www.xe.com/datafeed/samples/sample-xml-'.strtolower($searches->currency).'.xml');
                $xmlCurrencies = new SimpleXMLElement($currencies);
                
                for ($i = 0; $i < 171; $i++){
                    $csymbol = (array)$xmlCurrencies->currency[$i]->csymbol;
                    $crate = (array)$xmlCurrencies->currency[$i]->crate;
                    $cinverse = (array)$xmlCurrencies->currency[$i]->cinverse;
                    
                    $currencyData = array('code' => $csymbol[0],
                                          'rate' => $crate[0],
                                          'inverse' => $cinverse[0]
                                        );
                    array_push($currenciesData, $currencyData);
                }
                
                $currenciesData = str_replace('"',';;;',json_encode($currenciesData));
                
                $extras = json_encode($this->getAllExtras($searches,$language));
                $extras = str_replace('"',';;;',$extras);
                $price_min = $this->getMinPrice($id,$xmlCurrencies);
                $price_max = $this->getMaxPrice($id,$xmlCurrencies);
                
                return array('search' => array('data' => array('id' => $id,
                                                               'minPrice' => $price_min,
                                                               'maxPrice' => $price_max,
                                                               'dateType' => (int)$searches->date_type,
                                                               'template' => $searches->template,
                                                               'searchEnabled' => $searches->search_enabled == 'true' ? true:false,
                                                               'priceEnabled' => $searches->price_enabled == 'true' ? true:false,
                                                               'language' => $language,
                                                               'noCalendars' => $searches->view_results_page,
                                                               'currPage' => 1,
                                                               'location' => '',
                                                               'sortBy' => 'price',
                                                               'sortType' => 'asc',
                                                               'firstLoad' => true,
                                                               'skipCalendars' => 0,
                                                               'appendData' => true,
                                                               'monthsNames' => array($DOPBSP->text('MONTH_JANUARY'), 
                                                                                 $DOPBSP->text('MONTH_FEBRUARY'),  
                                                                                 $DOPBSP->text('MONTH_MARCH'),
                                                                                 $DOPBSP->text('MONTH_APRIL'),  
                                                                                 $DOPBSP->text('MONTH_MAY'),  
                                                                                 $DOPBSP->text('MONTH_JUNE'),  
                                                                                 $DOPBSP->text('MONTH_JULY'),  
                                                                                 $DOPBSP->text('MONTH_AUGUST'),  
                                                                                 $DOPBSP->text('MONTH_SEPTEMBER'),  
                                                                                 $DOPBSP->text('MONTH_OCTOBER'),  
                                                                                 $DOPBSP->text('MONTH_NOVEMBER'),  
                                                                                 $DOPBSP->text('MONTH_DECEMBER')),
                                                                'monthsShortNames' => array($DOPBSP->text('SHORT_MONTH_JANUARY'),  
                                                                                      $DOPBSP->text('SHORT_MONTH_FEBRUARY'), 
                                                                                      $DOPBSP->text('SHORT_MONTH_MARCH'),
                                                                                      $DOPBSP->text('SHORT_MONTH_APRIL'),
                                                                                      $DOPBSP->text('SHORT_MONTH_MAY'),
                                                                                      $DOPBSP->text('SHORT_MONTH_JUNE'), 
                                                                                      $DOPBSP->text('SHORT_MONTH_JULY'), 
                                                                                      $DOPBSP->text('SHORT_MONTH_AUGUST'), 
                                                                                      $DOPBSP->text('SHORT_MONTH_SEPTEMBER'), 
                                                                                      $DOPBSP->text('SHORT_MONTH_OCTOBER'), 
                                                                                      $DOPBSP->text('SHORT_MONTH_NOVEMBER'), 
                                                                                      $DOPBSP->text('SHORT_MONTH_DECEMBER'))),
                                               'text' => array('search' => $DOPBSP->text('PARENT_SEARCH'),
                                                               'checkIn' => $DOPBSP->text('SEARCH_FRONT_END_CHECK_IN'),
                                                               'checkOut' => $DOPBSP->text('SEARCH_FRONT_END_CHECK_OUT'),
                                                               'hourEnd' => $DOPBSP->text('SEARCH_FRONT_END_END_HOUR'),
                                                               'hourStart' => $DOPBSP->text('SEARCH_FRONT_END_START_HOUR'),
                                                               'noItems' => $DOPBSP->text('SEARCH_FRONT_END_NO_ITEMS'),
                                                               'noServices' => $DOPBSP->text('SEARCH_FRONT_END_NO_SERVICES_AVAILABLE'),
                                                               'sortBy' => 'Sort by',
                                                               'sortByPrice' => 'Price',
                                                               'sortByRating' => 'Rating',
                                                               'sortTypeAsc' => 'Asc',
                                                               'sortTypeDesc'=> 'Desc',
                                                               'extrasTitle' => 'Extras',
                                                               'searchEnabled' => $DOPBSP->text('SEARCHES_SEARCH_LOCATION'),
                                                               'viewBtn' => $DOPBSP->text('SEARCHES_SEARCH_VIEW_BUTTON'),
                                                               'startAt' => $DOPBSP->text('SEARCHES_SEARCH_START_AT'))),
                    'view' => array('data' => array('listViewEnabled' => $searches->view_list_enabled == 'false' ? false:true,
                                                    'gridViewEnabled' => $searches->view_grid_enabled == 'false' ? false:true,
                                                    'mapViewEnabled' => $searches->view_map_enabled == 'false' ? false:true,
                                                    'defaultView' => $searches->view_default,
                                                    'viewResultsPerPage' => $searches->view_results_page),
                                    'text' =>array('listView' => $DOPBSP->text('SEARCHES_SEARCH_SETTINGS_LIST_VIEW_ENABLED'),
                                                   'gridView' => $DOPBSP->text('SEARCHES_SEARCH_SETTINGS_GRID_VIEW_ENABLED'),
                                                   'mapView' => $DOPBSP->text('SEARCHES_SEARCH_SETTINGS_MAP_VIEW_ENABLED'))),
                    'days' => array('data' => array('first' => (int)$searches->days_first,
                                                              'multipleSelect' => $searches->days_multiple_select == 'false' ? false:true),
                                              'text' => array('names' => array($DOPBSP->text('DAY_SUNDAY'), 
                                                                               $DOPBSP->text('DAY_MONDAY'), 
                                                                               $DOPBSP->text('DAY_TUESDAY'), 
                                                                               $DOPBSP->text('DAY_WEDNESDAY'), 
                                                                               $DOPBSP->text('DAY_THURSDAY'), 
                                                                               $DOPBSP->text('DAY_FRIDAY'), 
                                                                               $DOPBSP->text('DAY_SATURDAY')),
                                                              'shortNames' => array($DOPBSP->text('SHORT_DAY_SUNDAY'), 
                                                                                    $DOPBSP->text('SHORT_DAY_MONDAY'), 
                                                                                    $DOPBSP->text('SHORT_DAY_TUESDAY'), 
                                                                                    $DOPBSP->text('SHORT_DAY_WEDNESDAY'), 
                                                                                    $DOPBSP->text('SHORT_DAY_THURSDAY'), 
                                                                                    $DOPBSP->text('SHORT_DAY_FRIDAY'), 
                                                                                    $DOPBSP->text('SHORT_DAY_SATURDAY'))),
                                                               'nextMonth' => $DOPBSP->text('CALENDARS_CALENDAR_NEXT_MONTH'),
                                                               'previousMonth' => $DOPBSP->text('CALENDARS_CALENDAR_PREVIOUS_MONTH')),
                    'hours' => array('data' => array(          'ampm' => $searches->hours_ampm == 'true' ? true:false,
                                                               'definitions' => json_decode($searches->hours_definitions),
                                                               'enabled' => $searches->hours_enabled == 'true' ? true:false,
                                                               'multipleSelect' => $searches->hours_multiple_select == 'true' ? true:false),
                                               'text' => array()),
                    'extras' =>  $extras,
                    'currency' => array('data' => array('code' => $searches->currency,
                                                                  'position' => $searches->currency_position,
                                                                  'sign' => $DOPBSP->classes->currencies->get($searches->currency),
                                                                  'currencies' => $currenciesData),
                                        'text' => array('converted' => 'converted from')));
            }
            
            function getAllExtras($searches, 
                                  $language){
                global $DOPBSP;
                $extras = array();
                
                if ($searches->extras != "") {
                    $extrasIDS = explode(',',$searches->extras);

                    foreach($extrasIDS as $extrasID){
                        $extra = $DOPBSP->classes->frontend_extras->get($extrasID,$language);
                        array_push($extras, $extra);
                    }
                }
                
                return $extras;
            }
            
            function getMinPrice($searchID, $xmlCurrencies){
                global $wpdb;
                global $DOPBSP;
                
                $calendars = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->calendars);
                $searches= $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->searches.' where id="'.$searchID.'"');
                $minPrice = 10000000000;
                
                 
                
                if (isset($calendars)) {
                    
                    foreach($calendars as $calendar){
                        $settings_calendar = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$DOPBSP->tables->settings_calendar.' WHERE calendar_id=%d',
                                                               $calendar->id));
                        $calendar->price_min = $this->convertPrice($xmlCurrencies, $calendar->price_min, $settings_calendar->currency, $searches->currency);

                        if ($calendar->price_min == '1e+09') {
                           $calendar->price_min = 0;
                        }

                        if ($calendar->price_min < $minPrice){
                            $minPrice = $calendar->price_min;
                        }
                    }
                } else {
                    $minPrice = 0;
                }
                
                return $minPrice;
            }
            
            function getMaxPrice($searchID, $xmlCurrencies){
                global $wpdb;
                global $DOPBSP;
                
                $calendars = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->calendars);
                $searches= $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->searches.' where id="'.$searchID.'"');
                $maxPrice = 0;
                
                if (isset($calendars)) {
                    
                    foreach($calendars as $calendar){
                        $settings_calendar = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$DOPBSP->tables->settings_calendar.' WHERE calendar_id=%d',
                                                               $calendar->id));

                        $calendar->price_max = $this->convertPrice($xmlCurrencies, $calendar->price_max, $settings_calendar->currency, $searches->currency);

                        if ($calendar->price_max > $maxPrice){
                            $maxPrice = $calendar->price_max;
                        }
                        
                        
                    }
                } else {
                    $maxPrice = 100;
                }
                
                return $maxPrice;
            }
            
            function httpGet($url){
                $ch = curl_init();  

                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            //  curl_setopt($ch,CURLOPT_HEADER, false); 

                $output=curl_exec($ch);

                curl_close($ch);
                return $output;
            }
            
            /*
             * Get search calendars. 
             * 
             * @param settings (object): calendars settings
             * 
             * @return data array
             */
            function getSearchCalendarsJSON(){
                global $wpdb;
                global $DOPBSP;
                
                $data = array();
                $filters = array();
                $language = $_POST['language'];
                
                $limit = '';
                
                //if (intval($_POST['noCalendars']) > 0){
                   $limit = ' LIMIT '.$_POST['skipCalendars'].','.$_POST['noCalendars'];
              //  }
                   
                
                
                $DOPBSP->classes->translation->set($language);
                
                $searches= $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->searches.' where id="'.$_POST['id'].'"');
                $searches->calendars_excluded = "'".str_replace(",","','",$searches->calendars_excluded)."'";
                
                
                //$calendars = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->calendars.' WHERE id NOT IN ('.$searches->calendars_excluded.')'.$limit);
                
                $currencies = $this->httpGet('http://www.xe.com/datafeed/samples/sample-xml-'.strtolower($searches->currency).'.xml');
                $xmlCurrencies = new SimpleXMLElement($currencies);
                $price_min = $this->getMinPrice($_POST['id'],$xmlCurrencies);
                $price_max = $this->getMaxPrice($_POST['id'],$xmlCurrencies);
                
                $filters = array('skipCalendars' => $_POST['skipCalendars'],
                                 'noCalendars' => $_POST['noCalendars'],
                                 'startDate' => $_POST['startDate'],
                                 'endDate' => $_POST['endDate'],
                                 'startHour' => $_POST['startHour'],
                                 'endHour' => $_POST['endHour'],
                                 'startHourSelected' => $_POST['startHourSelected'] == 'false' ? false:true,
                                 'endHourSelected' => $_POST['endHourSelected'] == 'false' ? false:true,
                                 'minPrice' => $_POST['minPrice'],
                                 'maxPrice' => $_POST['maxPrice'],
                                 'extras' => $_POST['extras'],
                                 'location' => $_POST['location'],
                                 'sortBy' => $_POST['sortBy'],
                                 'sortType' => $_POST['sortType'],
                                 'excluded' => $searches->calendars_excluded,
                                 'extras' => $_POST['extras'],
                                 'price_min' => $price_min,
                                 'price_max' => $price_max,
                                 'id' => $_POST['id'],
                                 'noItems' => $_POST['noItems'],
                                 'viewMode' =>  $_POST['viewMode']);
                
                $getCalendars = $this->getCalendars($filters);
                $noPages = 0;
                $currentPage = 0;
                
                if ($getCalendars != "0") {
                    $calendarsSQL = explode(';;;;;',$getCalendars);
                    $calendarsSQL_LIMIT = $calendarsSQL[0];
                    $calendarsSQL_ALL = $calendarsSQL[1];
                    $calendars = $wpdb->get_results($calendarsSQL_LIMIT);
                    $noCalendars = count($wpdb->get_results($calendarsSQL_ALL));
                    
                    $noPages = round($noCalendars/$_POST['noCalendars']);
                    $currentPage = intval($_POST['skipCalendars']/$_POST['noCalendars'])+1;

                    $i = 0;
                    $calendarData = array();
                    $post_id = 0;
                }
                
                if (isset($calendars)) {
                    foreach ($calendars as $calendar){
                       $settings_calendar = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$DOPBSP->tables->settings_calendar.' WHERE calendar_id=%d',
                                                                          $calendar->id));

                        if (isset($settings_calendar->post_id)) {
                            $post_id = $settings_calendar->post_id;
                        }
                        
                        $coordinates = str_replace('"','',$calendar->coordinates);
                        $coordinates = str_replace("'",'',$calendar->coordinates);
                        $coordinates = str_replace("\\\"",'',$calendar->coordinates);
                        
                        $location = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$DOPBSP->tables->locations.' WHERE coordinates=%s',
                                                                   $coordinates));
                        
                        
                        $calendarData[$i]['calendar_id'] = $calendar->id;
                        $calendarData[$i]['user_id'] = $calendar->user_id;
                        $calendarData[$i]['post_id'] = '';
                        $calendarData[$i]['name'] = $calendar->name;
                        $calendarData[$i]['description'] = '';
                        $calendarData[$i]['address'] = '';
                        $calendarData[$i]['address_alt'] = '';
                        $calendarData[$i]['image'] = '';
                        $calendarData[$i]['link'] = '';
                        $calendarData[$i]['rating'] = $calendar->rating;
                        $calendarData[$i]['currency'] = $settings_calendar->currency;
                        $calendarData[$i]['currency_sign'] = $DOPBSP->classes->currencies->get($settings_calendar->currency);
                        $calendarData[$i]['coordinates'] = $coordinates;

                        if (isset($location->address) && isset($location->address_alt)) {
                            $calendarData[$i]['address'] = $location->address;
                            $calendarData[$i]['address_alt'] = $location->address_alt;
                        }

                        if ($calendar->price_min == '1e+09') {
                            $calendarData[$i]['price_min'] = 0;
                        } else {
                            $calendarData[$i]['price_min'] = $calendar->price_min;
                        }

                        $calendarData[$i]['converted_price'] = $this->convertPrice($xmlCurrencies, $calendarData[$i]['price_min'], $settings_calendar->currency, $searches->currency);

                        if (isset($settings_calendar->post_id) && $settings_calendar->post_id != "" && $settings_calendar->post_id > 0) {
                             $calendarData[$i]['post_id'] = $settings_calendar->post_id;
                             // GET POST
                             $post_info = get_post($calendarData[$i]['post_id']); 
                             //$calendarData[$i]['name'] = $post_info->post_title;
                             $calendarData[$i]['description'] = substr($post_info->post_content,0,330);
                             $post_image = wp_get_attachment_image_src(get_post_thumbnail_id($calendarData[$i]['post_id'], 'thumbnail'));
                             $calendarData[$i]['image'] = $post_image[0];
                             $calendarData[$i]['link'] = get_permalink($calendarData[$i]['post_id']);
                        }

                        $i++;

                    }

                    if ($filters['sortBy'] == 'price') {
                        if ($filters['sortType'] == 'asc') {
                            usort($calendarData, array(&$this, 'sortByConvertedPriceAsc'));
                        } else {
                            usort($calendarData, array(&$this, 'sortByConvertedPriceDesc'));
                        }
                    }

                    echo json_encode($calendarData).';;;;;'.$noPages.';;;;;'.$currentPage;
                } else {
                    echo '0';
                }
                
                die();
            }
            
            function sortByConvertedPriceAsc($a, $b) {
                return $a['converted_price'] - $b['converted_price'];
            }
            
            function sortByConvertedPriceDesc($a, $b) {
                return $b['converted_price'] - $a['converted_price'];
            }
            
            function getCalendars($filter){
                global $wpdb;
                global $DOPBSP;
                
                $searches= $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->searches.' where id="'.$filter['id'].'"');
                
                if ($filter['viewMode'] != 'map') {
                    $limit = ' LIMIT '.$filter['skipCalendars'].','.$filter['noCalendars'];
                } else {
                    $limit = ' LIMIT 0,1000';
                }
                
                if ($filter['sortBy'] == 'price') {
                    $filter['sortBy'] = 'REPLACE('.$DOPBSP->tables->calendars.'.price_min,"1e+09","0")';
                }
                
                $calendarsFields = '';
                $price = '';
                $excluded = '';
                $extras = '';
                $extrasFields = '';
                $extrasTable = '';
                $locations = '';
                $locationsFields = '';
                $locationsTable = '';
                $availables = '';
                $availablesTable = '';
                $calendarsAvailable = '';
                $noItemsSelected = false;
                $availabilityChecked = false;
                
                $calendarsFields = $DOPBSP->tables->calendars.'.id,'.$DOPBSP->tables->calendars.'.name,'.$DOPBSP->tables->calendars.'.user_id,'.$DOPBSP->tables->calendars.'.post_id,'.$DOPBSP->tables->calendars.'.name,'.$DOPBSP->tables->calendars.'.rating,'.$DOPBSP->tables->calendars.'.coordinates,'.$DOPBSP->tables->calendars.'.price_min,'.$DOPBSP->tables->calendars.'.price_max';
                
                // Sort
                $sort = ' ORDER by '.$filter['sortBy'].' '.$filter['sortType'];
                
                // Price
                $price = ' WHERE '.$DOPBSP->tables->calendars.'.price_max >= '.$filter['minPrice'].' AND '.$DOPBSP->tables->calendars.'.price_min <= '.$filter['maxPrice'];
                
                // Extras
                if ($filter['extras'] != "") {
                    $extrasTable = ','.$DOPBSP->tables->settings_calendar;
                    $extrasFields = ','.$DOPBSP->tables->settings_calendar.'extra,'.$DOPBSP->tables->settings_calendar.'calendar_id';
                    $extras = ' AND '.$DOPBSP->tables->settings_calendar.'.extra IN ('.$filter['extras'].') AND '.$DOPBSP->tables->calendars.'.id='.$DOPBSP->tables->settings_calendar.'.calendar_id';
                }
                
                // Excluded Calendars
                if ($filter['excluded'] != ""){
                    $excluded = ' AND '.$DOPBSP->tables->calendars.'.id NOT IN ('.$filter['excluded'].')';
                }
                
                // Locations
                if ($filter['location'] != "") {
                    $locationsTable = ','.$DOPBSP->tables->locations;
                    $locationsFields = ','.$DOPBSP->tables->locations.'.address,'.$DOPBSP->tables->locations.'.address_en,'.$DOPBSP->tables->locations.'.address_alt,'.$DOPBSP->tables->locations.'.address_alt_en';
                    $locations = ' AND ('.$DOPBSP->tables->locations.'.address LIKE "%'.$filter['location'].'%" OR '.$DOPBSP->tables->locations.'.address_en LIKE "%'.$filter['location'].'%" OR '.$DOPBSP->tables->locations.'.address_alt LIKE "%'.$filter['location'].'%" OR '.$DOPBSP->tables->locations.'.address_alt_en LIKE "%'.$filter['location'].'%") AND '.$DOPBSP->tables->calendars.'.id IN ('.$DOPBSP->tables->locations.'.calendars)';
                }

                if ($filter['startDate'] != "" || $filter['endDate'] != "" || $filter['startHourSelected'] != false || $filter['endHourSelected'] != false || $filter['noItems'] > 1) {

                    if ($filter['startHourSelected'] != false || $filter['endHourSelected'] != false) {
                        $limitAvailable = ' ORDER by unique_key ASC LIMIT 0, 10000';
                        // Use Date & Hours
                        if ($filter['startDate'] != "" && $filter['endDate'] != "" && $filter['startHourSelected'] != false && $filter['endHourSelected'] != false) {
                            $availabilityChecked = true;
                            $calendars_available = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->days_available.' WHERE day >= "'.$filter['startDate'].'" AND day <= "'.$filter['endDate'].'" AND hour >= "'.$filter['startHour'].'" AND hour <= "'.$filter['endHour'].'"'.$limitAvailable);
                        }
                        elseif ($filter['startDate'] != "" 
                                && $filter['endDate'] == "" 
                                && $filter['startHourSelected'] != false 
                                && $filter['endHourSelected'] != false){
                            $availabilityChecked = true;
                            $calendars_available = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->days_available.' WHERE day >= "'.$filter['startDate'].'" AND hour >= "'.$filter['startHour'].'" AND hour <= "'.$filter['endHour'].'"'.$limitAvailable);
                        } else if ($filter['startDate'] != "" && $filter['endDate'] == "" && $filter['startHourSelected'] != false && $filter['endHourSelected'] == false){
                            $availabilityChecked = true;
                            $calendars_available = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->days_available.' WHERE day >= "'.$filter['startDate'].'" AND hour >= "'.$filter['startHour'].'"'.$limitAvailable);
                        } else if ($filter['startDate'] != "" && $filter['endDate'] == "" && $filter['startHourSelected'] == false && $filter['endHourSelected'] != false){
                            $availabilityChecked = true;
                            $calendars_available = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->days_available.' WHERE day >= "'.$filter['startDate'].'" AND AND hour <= "'.$filter['endHour'].'"'.$limitAvailable);
                        } else if ($filter['startDate'] == "" && $filter['endDate'] != "" && $filter['startHourSelected'] != false && $filter['endHourSelected'] != false){
                            $availabilityChecked = true;
                            $calendars_available = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->days_available.' WHERE day <= "'.$filter['endDate'].'" AND hour >= "'.$filter['startHour'].'" AND hour <= "'.$filter['endHour'].'"'.$limitAvailable);
                        } else if ($filter['startDate'] == "" && $filter['endDate'] != "" && $filter['startHourSelected'] != false && $filter['endHourSelected'] != false){
                            $availabilityChecked = true;
                            $calendars_available = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->days_available.' WHERE day <= "'.$filter['endDate'].'" AND hour >= "'.$filter['startHour'].'"'.$limitAvailable);
                        } else if ($filter['startDate'] == ""  && $filter['endDate'] != "" && $filter['startHourSelected'] == false && $filter['endHourSelected'] != false){
                            $availabilityChecked = true;
                            $calendars_available = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->days_available.' WHERE day <= "'.$filter['endDate'].'" AND hour <= "'.$filter['endHour'].'"'.$limitAvailable);
                        } else if ($filter['startDate'] == ""  && $filter['endDate'] == ""  && $filter['startHourSelected'] != false && $filter['endHourSelected'] != false){ // Only Hours
                            $availabilityChecked = true;
                            $calendars_available = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->days_available.' WHERE hour >= "'.$filter['startHour'].'" AND hour <= "'.$filter['endHour'].'"'.$limitAvailable);
                        } else if ($filter['startDate'] == ""  && $filter['endDate'] == ""  && $filter['startHourSelected'] != false && $filter['endHourSelected'] == false){ // Only Start Hour
                            $availabilityChecked = true;
                            $calendars_available = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->days_available.' WHERE hour >= "'.$filter['startHour'].'"'.$limitAvailable);
                        } else if ($filter['startDate'] == ""  && $filter['endDate'] == ""  && $filter['startHourSelected'] == false && $filter['endHourSelected'] != false){ // Only End Hour
                            $availabilityChecked = true;
                            $calendars_available = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->days_available.' WHERE hour <= "'.$filter['endHour'].'"'.$limitAvailable);
                        }

                    } else if ($filter['startDate'] != "" || $filter['endDate'] != ""){
                        $limitAvailable = ' ORDER by unique_key ASC LIMIT 0, 10000';
                        // Only Days
                        if ($filter['startDate'] != ""  && $filter['endDate'] != ""){ // Check In & Check Out
                            $availabilityChecked = true;
                            $calendars_available = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->days_available.' WHERE day >= "'.$filter['startDate'].'" AND day <= "'.$filter['endDate'].'"'.$limitAvailable);
                        } else if ($filter['startDate'] != ""  && $filter['endDate'] == ""){ // Only Check In
                            $availabilityChecked = true;
                            $calendars_available = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->days_available.' WHERE day >= "'.$filter['startDate'].'"'.$limitAvailable);
                        } else if ($filter['startDate'] == ""  && $filter['endDate'] != ""){ // Only Check Out
                            $availabilityChecked = true;
                            $calendars_available = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->days_available.' WHERE day <= "'.$filter['endDate'].'"'.$limitAvailable);
                        }
                    } else if (intval($filter['noItems']) > 1){
                        $limitAvailable = ' ORDER by unique_key ASC LIMIT 0, 1000';
                        $noItemsSelected = true;
                        $availabilityChecked = true;
                        $calendars_available = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->days_available.' WHERE hour >= "'.$filter['startHour'].'" AND hour <= "'.$filter['endHour'].'"'.$limitAvailable);
                    }

                   // Availability
                   if (isset($calendars_available)) {
                       $j = 0;
                        foreach($calendars_available as $calendar_available){
                            
                            if (isset($calendar_available) && $calendar_available->data != "") {
                                $calendarsDataList = explode('|',$calendar_available->data);
                                $calendarsListMod = $calendarsDataList[0];
                                $calendarsLists = explode(',',$calendarsListMod);
                                $calendarsListAvailables = $calendarsDataList[0];
                                $calendarsAvailables = explode(',',$calendarsListAvailables);
                                //echo $noItemsSelected;
                               // print_r($calendar_available->data); die();
                                if ($noItemsSelected == true || $noItemsSelected == 1) {
                                    $k = 0;
                                    
                                    foreach($calendarsLists as $calendarsList) {
                                        
                                        if (intval($calendarsAvailables[$k]) >= intval($filter['noItems'])){

                                            if ($j<1) {
                                                $calendarsAvailable = $calendarsList;
                                            } else {
                                                
                                                if (strpos($calendarsAvailable,$calendarsList) === false) {
                                                    $calendarsAvailable = $calendarsAvailable.','.$calendarsList;
                                                }
                                            }

                                            $k++;
                                        }
                                    }
                                } else {
                                    
                                    if ($j<1) {
                                        $calendarsAvailable = $calendarsListMod;
                                    } else {
                                        if (strpos($calendarsAvailable,$calendarsListMod) === false) {
                                            $calendarsAvailable = $calendarsAvailable.','.$calendarsListMod;
                                        }
                                    }
                                }
                                
                                $j++;
                            }
                        }
                   }
                }
//                print_r($calendarsAvailable);
                // Availability
                if ($calendarsAvailable != "") {
                    $availables = ' AND '.$DOPBSP->tables->calendars.'.id IN ('.$calendarsAvailable.')';
                }
                
                if (($availabilityChecked == true && $calendarsAvailable != "") || $availabilityChecked == false) {
                    return 'SELECT '.$calendarsFields.$extrasFields.$locationsFields.' FROM '.$DOPBSP->tables->calendars.$extrasTable.$locationsTable.$price.$excluded.$availables.$extras.$locations.$sort.$limit.';;;;;'.'SELECT '.$calendarsFields.$extrasFields.$locationsFields.' FROM '.$DOPBSP->tables->calendars.$extrasTable.$locationsTable.$price.$excluded.$availables.$extras.$locations.$sort;
                } else {
                    return 0;
                }
            }
            
            function convertPrice($currencies,$amount,$from,$to){
                
                if ($from != $to) {
                    for ($i = 0; $i < 171; $i++){
                        $csymbol = (array)$currencies->currency[$i]->csymbol;
                        $crate = (array)$currencies->currency[$i]->crate;
                        $cinverse = (array)$currencies->currency[$i]->cinverse;
                         
                        if ($csymbol[0] == $from) {
                            $amount = floatval($amount)*floatval($cinverse[0]);
                        }
                    }
                }
                
                return intval($amount);
            }
        }
    }