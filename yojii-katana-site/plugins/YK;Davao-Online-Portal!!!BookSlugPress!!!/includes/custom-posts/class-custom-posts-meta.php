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


    if (!class_exists('DOPBSPCustomPostsMeta')){
        class DOPBSPCustomPostsMeta extends DOPBSPCustomPosts{
            /*
             * Constructor
             */
            function DOPBSPCustomPostsMeta(){
                add_action('add_meta_boxes_'.DOPBSP_CONFIG_CUSTOM_POSTS_SLUG, array(&$this, 'init'));
            }
            
            /*
             * Initialize meta box for custom posts.
             * 
             * @param post (object): post data
             */
            function init($post){
                global $DOPBSP;
                
                if ($post->post_status == 'publish'){
                    $meta = array('id' => 'dopbsp-custom-post-meta',
                                  'title' => $DOPBSP->text('CUSTOM_POSTS_BOOKING_SYSTEM'),
                                  'description' => '',
                                  'post_type' => DOPBSP_CONFIG_CUSTOM_POSTS_SLUG,
                                  'context' => 'normal',
                                  'priority' => 'high');
                    
                    $DOPBSP->classes->custom_posts->add($post->ID);
                    
                    $callback = create_function('$post, $meta', 
                                                'DOPBSPCustomPostsMeta::set($post, $meta["args"]);');
                    add_meta_box($meta['id'], 
                                 $meta['title'], 
                                 $callback, 
                                 $meta['post_type'], 
                                 $meta['context'], 
                                 $meta['priority'], 
                                 $meta);
                }
            }
            
            /*
             * Get custom post calendar ID.
             * 
             * @post post_id (integer): post ID
             */
            function get(){
                global $wpdb;
                global $DOPBSP;
                
                $calendar = $wpdb->get_row($wpdb->prepare('SELECT * FROM '.$DOPBSP->tables->calendars.' WHERE post_id=%d ORDER BY id',
                                                          $_POST['post_id']));
                echo $calendar->id;
                
                die();
            }
            
            /*
             * Initialize meta box content for custom posts.
             * 
             * @param post (object): post data
             * @param meta (object): meta box arguments
             */
            public static function set($post, 
                                       $meta){
                DOPBSPCustomPostsMeta::display();
            }
            
            /*
             * Display custom post meta box content.
             * 
             * @param post (object): post data
             * @param meta (object): meta box arguments
             * 
             * @return meta box HTML page
             */
            public static function display(){
                global $DOPBSP;
                
                require_once($DOPBSP->paths->abs.'views/calendars/views-backend-calendars.php');                
                $DOPBSP->views->backend_calendars->template();
            }
        }
    }