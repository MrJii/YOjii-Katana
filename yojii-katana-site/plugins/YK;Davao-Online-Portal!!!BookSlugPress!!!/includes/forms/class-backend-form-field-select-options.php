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


    if (!class_exists('DOPBSPBackEndFormFieldSelectOptions')){
        class DOPBSPBackEndFormFieldSelectOptions extends DOPBSPBackEndFormField{
            /*
             * Constructor
             */        
            function DOPBSPBackEndFormFieldSelectOptions(){
            }
            
            /*
             * Sort form field select options.
             * 
             * @post positions (string): list of options ids in new order
             */
            function sort(){
                global $wpdb;
                global $DOPBSP;
                
                $ids = explode(',', $_POST['ids']);
                $i = 0;
                        
                foreach ($ids as $id){
                    $i++;
                    $wpdb->update($DOPBSP->tables->forms_fields_options, array('position' => $i), 
                                                                         array('id' => $id));
                }
                
                die();
            }
        }
    }