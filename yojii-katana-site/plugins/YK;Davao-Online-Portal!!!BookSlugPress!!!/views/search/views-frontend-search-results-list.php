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

    if (!class_exists('DOPBSPViewsFrontEndSearchResultsList')){
        class DOPBSPViewsFrontEndSearchResultsList extends DOPBSPViewsFrontEndSearchResults{
            /*
             * Constructor
             */
            function DOPBSPViewsFrontEndSearchResultsList(){
            }
            
            /*
             * Returns search results list.
             * 
             * @param args (array): function arguments
             *                      * calendars (array): list of calendars
             * 
             * @return search results list HTML
             */
            function template($args = array()){
                global $DOPBSP;
                
                $calendars = $args['calendars'];
                $page = $args['page'];
                $results = $args['results'];
?>
                <ul class="dopbsp-list">
<?php              
                if (count($calendars) > 0){
                    for ($i=($page-1)*$results; $i<($page*$results > count($calendars) ? count($calendars):$page*$results); $i++){
                        $this->item($calendars[$i]);
                    }
                }
                else{         
?>
                    <li class="dopbsp-no-data"><?php echo $DOPBSP->text('SEARCH_FRONT_END_NO_AVAILABILITY'); ?></li>
<?php
                }
?>
                </ul>
<?php 
                $this->pagination(array('no' => count($calendars),
                                        'page' => $page,
                                        'results' => $results));
            }
            
            function item($calendar){
                global $DOPBSP;
                
                $post = get_post($calendar->post_id);
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($calendar->post_id), 'medium');
?>
                <li>
                    <!--
                        Image
                    -->
                    <div class="dopbsp-image">
                        <a href="<?php echo get_permalink($calendar->post_id); ?>" target="_parent" style="background-image: url(<?php echo $image[0]; ?>);">
                            <img src="<?php echo $image[0]; ?>" alt="<?php echo $calendar->name; ?>" title="<?php echo $calendar->name; ?>" />
                        </a>
                    </div>

                    <!--
                        Content
                    -->
                    <div class="dopbsp-content">
                        <!--
                            Title
                        -->
                        <h3>
                            <a href="<?php echo get_permalink($calendar->post_id); ?>" target="_parent"><?php echo $calendar->name; ?></a>
                        </h3>

                        <!--
                            Address
                        -->
                        <div class="dopbsp-address"><?php echo $calendar->address_alt == '' ? $calendar->address:$calendar->address_alt; ?></div>

                        <!--
                            Price
                        -->
                        <div class="dopbsp-price-wrapper">
                            <?php printf($DOPBSP->text('SEARCH_FRONT_END_RESULTS_PRICE'), '<span class="dopbsp-price">'.($DOPBSP->classes->price->set($calendar->price_min,
                                                                                                                                                      $DOPBSP->classes->currencies->get($calendar->currency),
                                                                                                                                                      $calendar->currency_position)).'<span>'); ?>
                        </div>

                        <!--
                            Text
                        -->
                        <div class="dopbsp-text">
                            <?php echo $post->post_excerpt == '' ? wp_strip_all_tags(strip_shortcodes($post->post_content)):$post->post_excerpt; ?>
                        </div>

                        <!--
                            View
                        -->
                        <a href="<?php echo get_permalink($calendar->post_id); ?>" target="_parent" class="dopbsp-view"><?php echo $DOPBSP->text('SEARCH_FRONT_END_RESULTS_VIEW'); ?></a>
                    </div>
                </li>
<?php
            }
        }
    }