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


    if (!class_exists('DOPBSPViewsBackEndFormFieldSelectOption')){
        class DOPBSPViewsBackEndFormFieldSelectOption extends DOPBSPViewsBackEndFormField{
            /*
             * Constructor
             */
            function DOPBSPViewsBackEndFormFieldSelectOption(){
            }
            
            /*
             * Returns select field option template.
             * 
             * @param args (array): function arguments
             *                      * select_option (integer): select data
             *                      * language (string): field language
             * 
             * @return select field HTML
             */
            function template($args = array()){
                global $DOPBSP;
                
                $select_option = $args['select_option'];
                $language = isset($args['language']) && $args['language'] != '' ? $args['language']:$DOPBSP->classes->backend_language->get();
?>
                <li id="DOPBSP-form-field-select-option-<?php echo $select_option->id; ?>">
                    <div class="dopbsp-input-wrapper">
                        <input type="text" name="DOPBSP-form-field-select-option-label-<?php echo $select_option->id; ?>" id="DOPBSP-form-field-select-option-label-<?php echo $select_option->id; ?>" value="<?php echo $DOPBSP->classes->translation->decodeJSON($select_option->translation, $language); ?>" onkeyup="if ((event.keyCode||event.which) !== 9){DOPBSPFormFieldSelectOption.edit(<?php echo $select_option->id; ?>, 'text', 'label', this.value);}" onpaste="DOPBSPFormFieldSelectOption.edit(<?php echo $select_option->id; ?>, 'text', 'label', this.value)" onblur="DOPBSPFormFieldSelectOption.edit(<?php echo $select_option->id; ?>, 'text', 'label', this.value, true)" />
                        <a href="javascript:DOPBSP.confirmation('FORMS_FORM_FIELD_SELECT_DELETE_OPTION_CONFIRMATION', 'DOPBSPFormFieldSelectOption.delete(<?php echo $select_option->id; ?>)')" class="dopbsp-button dopbsp-small dopbsp-delete"><span class="dopbsp-info"><?php echo $DOPBSP->text('FORMS_FORM_FIELD_SELECT_DELETE_OPTION_SUBMIT'); ?></span></a>
                        <a href="javascript:void(0)" class="dopbsp-button dopbsp-small dopbsp-handle"><span class="dopbsp-info"><?php echo $DOPBSP->text('FORMS_FORM_FIELD_SELECT_OPTION_SORT'); ?></span></a>
                    </div>
                </li>
<?php
            }
        }
    }