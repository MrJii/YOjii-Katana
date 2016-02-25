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

    if (!class_exists('DOPBSPViewsBackEndRule')){
        class DOPBSPViewsBackEndRule extends DOPBSPViewsBackEndRules{
            /*
             * Constructor
             */
            function DOPBSPViewsBackEndRule(){
            }
            
            /*
             * Returns rule template.
             * 
             * @param args (array): function arguments
             *                      * id (integer): rule ID
             *                      * language (string): rule language
             * 
             * @return rule HTML
             */
            function template($args = array()){
                global $wpdb;
                global $DOPBSP;
                
                $id = $args['id'];
                
                $rule = $wpdb->get_row('SELECT * FROM '.$DOPBSP->tables->rules.' WHERE id='.$id);
?>
                <div class="dopbsp-inputs-wrapper dopbsp-last">
<?php                    
                /*
                 * Name
                 */
                $this->displayTextInput(array('id' => 'name',
                                              'label' => $DOPBSP->text('RULES_RULE_NAME'),
                                              'value' => $rule->name,
                                              'rule_id' => $rule->id,
                                              'help' => $DOPBSP->text('RULES_RULE_NAME_HELP')));
                /*
                 * Time lapse min.
                 */
                $this->displayTextInput(array('id' => 'time_lapse_min',
                                              'label' => $DOPBSP->text('RULES_RULE_TIME_LAPSE_MIN'),
                                              'value' => $rule->time_lapse_min,
                                              'rule_id' => $rule->id,
                                              'help' => $DOPBSP->text('RULES_RULE_TIME_LAPSE_MIN_HELP'),
                                              'container_class' => '',
                                              'input_class' => 'dopbsp-small'));
                /*
                 * Time lapse max.
                 */
                $this->displayTextInput(array('id' => 'time_lapse_max',
                                              'label' => $DOPBSP->text('RULES_RULE_TIME_LAPSE_MAX'),
                                              'value' => $rule->time_lapse_max,
                                              'rule_id' => $rule->id,
                                              'help' => $DOPBSP->text('RULES_RULE_TIME_LAPSE_MAX_HELP'),
                                              'container_class' => 'dopbsp-last',
                                              'input_class' => 'dopbsp-small'));
?>
                </div>
<?php 
            }

/*
 * Inputs.
 */         
            /*
             * Create a text input for rules.
             * 
             * @param args (array): function arguments
             *                      * id (integer): rule field ID
             *                      * label (string): rule label
             *                      * value (string): rule current value
             *                      * rule_id (integer): rule ID
             *                      * help (string): rule help
             *                      * container_class (string): container class
             *                      * input_class (string): input class
             * 
             * @return text input HTML
             */
            function displayTextInput($args = array()){
                global $DOPBSP;
                
                $id = $args['id'];
                $label = $args['label'];
                $value = $args['value'];
                $rule_id = $args['rule_id'];
                $help = $args['help'];
                $container_class = isset($args['container_class']) ? $args['container_class']:'';
                $input_class = isset($args['input_class']) ? $args['input_class']:'';
                    
                $html = array();

                array_push($html, ' <div class="dopbsp-input-wrapper '.$container_class.'">');
                array_push($html, '     <label for="DOPBSP-rule-'.$id.'">'.$label.'</label>');
                array_push($html, '     <input type="text" name="DOPBSP-rule-'.$id.'" id="DOPBSP-rule-'.$id.'" class="'.$input_class.'" value="'.$value.'" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPRule.edit('.$rule_id.', \'text\', \''.$id.'\', this.value);}" onpaste="DOPBSPRule.edit('.$rule_id.', \'text\', \''.$id.'\', this.value)" onblur="DOPBSPRule.edit('.$rule_id.', \'text\', \''.$id.'\', this.value, true)" />');
                array_push($html, '     <a href="'.DOPBSP_CONFIG_HELP_DOCUMENTATION_URL.'" target="_blank" class="dopbsp-button dopbsp-help"><span class="dopbsp-info dopbsp-help">'.$help.'<br /><br />'.$DOPBSP->text('HELP_VIEW_DOCUMENTATION').'</span></a>');
                array_push($html, ' </div>');

                echo implode('', $html);
            }
        }
    }