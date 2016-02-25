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
/*
Installation: Upload the folder dopbsp from the zip file to "wp-content/plugins/" and activate the plugin in your admin panel or upload dopbsp.zip in the "Add new" section.
*/

    if (!class_exists('DOPBSPTranslationTextExtras')){
        class DOPBSPTranslationTextExtras{
            /*
             * Constructor
             */
            function DOPBSPTranslationTextExtras(){
                /*
                 * Initialize extras text.
                 */
                add_filter('dopbsp_filter_translation_text', array(&$this, 'extras'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'extrasDefault'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'extrasExtra'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'extrasAddExtra'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'extrasDeleteExtra'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'extrasExtraGroups'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'extrasExtraGroup'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'extrasExtraAddGroup'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'extrasExtraDeleteGroup'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'extrasExtraGroupItems'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'extrasExtraGroupItem'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'extrasExtraGroupAddItem'));
                add_filter('dopbsp_filter_translation_text', array(&$this, 'extrasExtraGroupDeleteItem'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'extrasHelp'));
                
                add_filter('dopbsp_filter_translation_text', array(&$this, 'extrasFrontEnd'));
            }
            
            /*
             * Extras text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function extras($text){
                array_push($text, array('key' => 'PARENT_EXTRAS',
                                        'parent' => '',
                                        'text' => 'Fees Module'));
                
                array_push($text, array('key' => 'EXTRAS_TITLE',
                                        'parent' => 'PARENT_EXTRAS',
                                        'text' => 'Fees Module'));
                array_push($text, array('key' => 'EXTRAS_CREATED_BY',
                                        'parent' => 'PARENT_EXTRAS',
                                        'text' => 'Created by'));
                array_push($text, array('key' => 'EXTRAS_LOAD_SUCCESS',
                                        'parent' => 'PARENT_EXTRAS',
                                        'text' => 'Fees Module data acquired.'));
                array_push($text, array('key' => 'EXTRAS_NO_EXTRAS',
                                        'parent' => 'PARENT_EXTRAS',
                                        'text' => 'No Fees Module. Click the above "plus" icon to add a new one.'));
                
                return $text;
            }
            
            /*
             * Extras default text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function extrasDefault($text){
                array_push($text, array('key' => 'PARENT_EXTRAS_DEFAULT',
                                        'parent' => '',
                                        'text' => 'Fees Orders - Default data'));
                
                array_push($text, array('key' => 'EXTRAS_DEFAULT_PEOPLE',
                                        'parent' => 'PARENT_EXTRAS_DEFAULT',
                                        'text' => 'Customers'));
                array_push($text, array('key' => 'EXTRAS_DEFAULT_ADULTS',
                                        'parent' => 'PARENT_EXTRAS_DEFAULT',
                                        'text' => 'Food'));
                array_push($text, array('key' => 'EXTRAS_DEFAULT_CHILDREN',
                                        'parent' => 'PARENT_EXTRAS_DEFAULT',
                                        'text' => 'Drinks'));
                
                return $text;
            }
            
            /*
             * Extras - Extra text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function extrasExtra($text){
                array_push($text, array('key' => 'PARENT_EXTRAS_EXTRA',
                                        'parent' => '',
                                        'text' => 'Fees Order - Deposit'));
                
                array_push($text, array('key' => 'EXTRAS_EXTRA_NAME',
                                        'parent' => 'PARENT_EXTRAS_EXTRA',
                                        'text' => 'Name'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_LANGUAGE',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP',
                                        'text' => 'Language'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_LOADED',
                                        'parent' => 'PARENT_EXTRAS_EXTRA',
                                        'text' => 'Data loaded.'));
                
                return $text;
            }
            
            /*
             * Extras - Add extra text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function extrasAddExtra($text){
                array_push($text, array('key' => 'PARENT_EXTRAS_ADD_EXTRA',
                                        'parent' => '',
                                        'text' => 'Fees Order - Add fee'));
                
                array_push($text, array('key' => 'EXTRAS_ADD_EXTRA_NAME',
                                        'parent' => 'PARENT_EXTRAS_ADD_EXTRA',
                                        'text' => 'New fee'));
                array_push($text, array('key' => 'EXTRAS_ADD_EXTRA_SUBMIT',
                                        'parent' => 'PARENT_EXTRAS_ADD_EXTRA',
                                        'text' => 'Add fee'));
                array_push($text, array('key' => 'EXTRAS_ADD_EXTRA_ADDING',
                                        'parent' => 'PARENT_EXTRAS_ADD_EXTRA',
                                        'text' => 'Adding a new fee ...'));
                array_push($text, array('key' => 'EXTRAS_ADD_EXTRA_SUCCESS',
                                        'parent' => 'PARENT_EXTRAS_ADD_EXTRA',
                                        'text' => 'You have succesfully added a new fee.'));
                
                return $text;
            }
            
            /*
             * Extras - Delete extra text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function extrasDeleteExtra($text){
                array_push($text, array('key' => 'PARENT_EXTRAS_DELETE_EXTRA',
                                        'parent' => '',
                                        'text' => 'Fees Order - Delete Fee'));
                
                array_push($text, array('key' => 'EXTRAS_DELETE_EXTRA_CONFIRMATION',
                                        'parent' => 'PARENT_EXTRAS_DELETE_EXTRA',
                                        'text' => 'Are you sure you want to delete this Fee?'));
                array_push($text, array('key' => 'EXTRAS_DELETE_EXTRA_SUBMIT',
                                        'parent' => 'PARENT_EXTRAS_DELETE_EXTRA',
                                        'text' => 'Delete Fee'));
                array_push($text, array('key' => 'EXTRAS_DELETE_EXTRA_DELETING',
                                        'parent' => 'PARENT_EXTRAS_DELETE_EXTRA',
                                        'text' => 'Deleting Fee ...'));
                array_push($text, array('key' => 'EXTRAS_DELETE_EXTRA_SUCCESS',
                                        'parent' => 'PARENT_EXTRAS_DELETE_EXTRA',
                                        'text' => 'You have successfully deleted the Fee.'));
                
                return $text;
            }
            
            /*
             * Extras - Extra groups text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function extrasExtraGroups($text){
                array_push($text, array('key' => 'PARENT_EXTRAS_EXTRA_GROUPS',
                                        'parent' => '',
                                        'text' => 'Fees Order - Menu List'));
                
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUPS',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUPS',
                                        'text' => 'Menu list'));
                
                return $text;
            }
            
            /*
             * Extras - Extra group text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function extrasExtraGroup($text){
                array_push($text, array('key' => 'PARENT_EXTRAS_EXTRA_GROUP',
                                        'parent' => '',
                                        'text' => 'Fees Order - Menu List'));
                
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_SHOW_SETTINGS',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP',
                                        'text' => 'Show settings'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_HIDE_SETTINGS',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP',
                                        'text' => 'Hide settings'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_SORT',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP',
                                        'text' => 'Sort'));
                /*
                 * Settings labels.
                 */
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_LABEL_LABEL',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP',
                                        'text' => 'Display title on front end'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_REQUIRED_LABEL',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP',
                                        'text' => 'Required'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_MULTIPLE_SELECT_LABEL',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP',
                                        'text' => 'Multiple order list'));
                
                return $text;
            }
            
            /*
             * Extras - Add extra group text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function extrasExtraAddGroup($text){
                array_push($text, array('key' => 'PARENT_EXTRAS_EXTRA_ADD_GROUP',
                                        'parent' => '',
                                        'text' => 'Fees Order - Add order list'));
                
                array_push($text, array('key' => 'EXTRAS_EXTRA_ADD_GROUP_SUBMIT',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_ADD_GROUP',
                                        'text' => 'Add order list'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_ADD_GROUP_LABEL',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_ADD_GROUP',
                                        'text' => 'New order list'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_ADD_GROUP_ADDING',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_ADD_GROUP',
                                        'text' => 'Adding a new order list ...'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_ADD_GROUP_SUCCESS',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_ADD_GROUP',
                                        'text' => 'You have successfully added a new order list.'));
                
                return $text;
            }
            
            /*
             * Extras - Delete extra group text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function extrasExtraDeleteGroup($text){
                array_push($text, array('key' => 'PARENT_EXTRAS_EXTRA_DELETE_GROUP',
                                        'parent' => '',
                                        'text' => 'Fees Order - Delete order list'));
                
                array_push($text, array('key' => 'EXTRAS_EXTRA_DELETE_GROUP_CONFIRMATION',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_DELETE_GROUP',
                                        'text' => 'Are you sure you want to delete this order list?'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_DELETE_GROUP_SUBMIT',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_DELETE_GROUP',
                                        'text' => 'Delete'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_DELETE_GROUP_DELETING',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_DELETE_GROUP',
                                        'text' => 'Deleting order list ...'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_DELETE_GROUP_SUCCESS',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_DELETE_GROUP',
                                        'text' => 'You have successfully deleted the order list.'));
                
                return $text;
            }
            
            /*
             * Extras - Extra group items text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function extrasExtraGroupItems($text){
                array_push($text, array('key' => 'PARENT_EXTRAS_EXTRA_GROUP_ITEMS',
                                        'parent' => '',
                                        'text' => 'Fees Order - Menu list - Order'));
                
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ITEMS_LABEL',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_ITEMS',
                                        'text' => 'Orders'));
                
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ITEMS_LABELS_LABEL',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_ITEMS',
                                        'text' => 'Menu title'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ITEMS_LABELS_OPERATION',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_ITEMS',
                                        'text' => 'Default'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ITEMS_LABELS_PRICE',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_ITEMS',
                                        'text' => 'PHP'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ITEMS_LABELS_PRICE_TYPE',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_ITEMS',
                                        'text' => 'Default'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ITEMS_LABELS_PRICE_BY',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_ITEMS',
                                        'text' => 'Default'));
                                    
                return $text;
            }
            
            /*
             * Extras - Extra group item text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function extrasExtraGroupItem($text){
                array_push($text, array('key' => 'PARENT_EXTRAS_EXTRA_GROUP_ITEM',
                                        'parent' => '',
                                        'text' => 'Fees Module - Fee Option - Order'));
                
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ITEMS_PRICE_TYPE_FIXED',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_ITEM',
                                        'text' => 'Fixed'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ITEMS_PRICE_TYPE_PERCENT',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_ITEM',
                                        'text' => 'Disabled'));
                
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ITEMS_PRICE_BY_ONCE',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_ITEM',
                                        'text' => 'Once'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ITEMS_PRICE_BY_PERIOD',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_ITEM',
                                        'text' => 'Disabled'));
                
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ITEM_SORT',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_ITEM',
                                        'text' => 'Sort'));
                
                return $text;
            }
            
            /*
             * Extras - Add extra group item text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function extrasExtraGroupAddItem($text){
                array_push($text, array('key' => 'PARENT_EXTRAS_EXTRA_GROUP_ADD_ITEM',
                                        'parent' => '',
                                        'text' => 'Fees Order - Menu - Add list'));
                
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ADD_ITEM_LABEL',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_ADD_ITEM',
                                        'text' => 'New list'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ADD_ITEM_SUBMIT',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_ADD_ITEM',
                                        'text' => 'Add list'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ADD_ITEM_ADDING',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_ADD_ITEM',
                                        'text' => 'Adding a new list ...'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ADD_ITEM_SUCCESS',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_ADD_ITEM',
                                        'text' => 'You have successfully added a new list.'));
                
                return $text;
            }
            
            /*
             * Extras - Delete extra group item text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function extrasExtraGroupDeleteItem($text){
                array_push($text, array('key' => 'PARENT_EXTRAS_EXTRA_GROUP_DELETE_ITEM',
                                        'parent' => '',
                                        'text' => 'Fees Order - Order - Delete menu list'));
                
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_DELETE_ITEM_CONFIRMATION',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_DELETE_ITEM',
                                        'text' => 'Are you sure you want to delete this  menu list?'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_DELETE_ITEM_SUBMIT',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_DELETE_ITEM',
                                        'text' => 'Delete'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_DELETE_ITEM_DELETING',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_DELETE_ITEM',
                                        'text' => 'Deleting  menu list ...'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_DELETE_ITEM_SUCCESS',
                                        'parent' => 'PARENT_EXTRAS_EXTRA_GROUP_DELETE_ITEM',
                                        'text' => 'You have successfully deleted the  menu list.'));
                
                return $text;
            }
            
            /*
             * Extras - Help text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function extrasHelp($text){
                array_push($text, array('key' => 'PARENT_EXTRAS_HELP',
                                        'parent' => '',
                                        'text' => 'Fees Order - Help'));
                
                array_push($text, array('key' => 'EXTRAS_HELP',
                                        'parent' => 'PARENT_EXTRAS_HELP',
                                        'text' => 'Click on a extra item to open the editing Order.'));
                array_push($text, array('key' => 'EXTRAS_ADD_EXTRA_HELP',
                                        'parent' => 'PARENT_EXTRAS_HELP',
                                        'text' => 'Click on the "plus" icon to add a Order.'));
                
                /*
                 * Extra help.
             
                array_push($text, array('key' => 'EXTRAS_EXTRA_NAME_HELP',
                                        'parent' => 'PARENT_EXTRAS_HELP',
                                        'text' => 'Change Order name.'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_LANGUAGE_HELP',
                                        'parent' => 'PARENT_EXTRAS_HELP',
                                        'text' => 'Change to the language you want to edit the Order.'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_ADD_GROUP_HELP',
                                        'parent' => 'PARENT_EXTRAS_HELP',
                                        'text' => 'Click on the bellow "plus" icon to add a new Order group.'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_EDIT_GROUP_HELP',
                                        'parent' => 'PARENT_EXTRAS_HELP',
                                        'text' => 'Click the group "expand" icon to display/hide the settings.'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_DELETE_GROUP_HELP',
                                        'parent' => 'PARENT_EXTRAS_HELP',
                                        'text' => 'Click the group "trash" icon to delete it.'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_SORT_GROUP_HELP',
                                        'parent' => 'PARENT_EXTRAS_HELP',
                                        'text' => 'Drag the group "arrows" icon to sort it.'));
                /*
                 * Extra group help.
                 */
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_LABEL_HELP',
                                        'parent' => 'PARENT_EXTRAS_HELP',
                                        'text' => 'Enter group label.'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_REQUIRED_HELP',
                                        'parent' => 'PARENT_EXTRAS_HELP',
                                        'text' => 'Enable it if you want the group to be mandatory.'));
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_MULTIPLE_SELECT_HELP',
                                        'parent' => 'PARENT_EXTRAS_HELP',
                                        'text' => 'Enable it if you want multiple selection.'));
                
                array_push($text, array('key' => 'EXTRAS_EXTRA_GROUP_ITEMS_HELP',
                                        'parent' => 'PARENT_EXTRAS_HELP',
                                        'text' => 'Click the "plus" icon to add another item and enter the name and price conditions. Click on the "delete" icon to remove the item.'));
                
                return $text;
            }
            
            /*
             * Extras front end text.
             * 
             * @param lang (array): current translation
             * 
             * @return array with updated translation
             */
            function extrasFrontEnd($text){
                array_push($text, array('key' => 'PARENT_EXTRAS_FRONT_END',
                                        'parent' => '',
                                        'text' => 'Extras - Front end'));
                
                array_push($text, array('key' => 'EXTRAS_FRONT_END_TITLE',
                                        'parent' => 'PARENT_EXTRAS_FRONT_END',
                                        'text' => 'Extras'));
                array_push($text, array('key' => 'EXTRAS_FRONT_END_BY_DAY',
                                        'parent' => 'PARENT_EXTRAS_FRONT_END',
                                        'text' => 'day'));
                array_push($text, array('key' => 'EXTRAS_FRONT_END_BY_HOUR',
                                        'parent' => 'PARENT_EXTRAS_FRONT_END',
                                        'text' => 'hour'));
                array_push($text, array('key' => 'EXTRAS_FRONT_END_INVALID',
                                        'parent' => 'PARENT_EXTRAS_FRONT_END',
                                        'text' => 'Select an option from'));
                
                return $text;
            }
        }
    }