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

    if (!class_exists('DOPBSPViewsBackEndDiscountItems')){
        class DOPBSPViewsBackEndDiscountItems extends DOPBSPViewsBackEndDiscount{
            /*
             * Constructor
             */
            function DOPBSPViewsBackEndDiscountItems(){
            }
            
            /*
             * Returns discount items template.
             * 
             * @param args (array): function arguments
             *                      * id (integer): discount ID
             *                      * language (string): discount language
             * 
             * @return discount items HTML
             */
            function template($args = array()){
                global $wpdb;
                global $DOPBSP;
                
                $id = $args['id'];
                $language = isset($args['language']) && $args['language'] != '' ? $args['language']:$DOPBSP->classes->backend_language->get();
?>
                <div class="dopbsp-discount-items-header">
                    <a href="javascript:DOPBSPDiscountItem.add(<?php echo $id; ?>, '<?php echo $language; ?>')" class="dopbsp-button dopbsp-add"><span class="dopbsp-info"><?php echo $DOPBSP->text('DISCOUNTS_DISCOUNT_ADD_ITEM_SUBMIT'); ?></span></a>
                    <h3><?php echo $DOPBSP->text('DISCOUNTS_DISCOUNT_ITEMS'); ?></h3>
                </div>
                <ul id="DOPBSP-discount-items" class="dopbsp-discount-items">
<?php
                $items = $wpdb->get_results('SELECT * FROM '.$DOPBSP->tables->discounts_items.' WHERE discount_id='.$id.' ORDER BY position ASC');
                
                if ($wpdb->num_rows > 0){
                    foreach($items as $item){
                        $DOPBSP->views->backend_discount_item->template(array('item' => $item,
                                                                      'language' => $language));
                    }
                }
?>    
                </ul>
<?php                    
            }
        }
    }