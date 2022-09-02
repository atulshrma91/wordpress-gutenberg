<?php

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('BlockPatterns')) {

  class BlockPatterns {

    public function __construct() {
      add_action( 'admin_init', array($this, 'fast_forms_block_patterns' ));
    }

    public function fast_forms_block_patterns() {
      global $pagenow;

      if ( ('post.php' === $pagenow && isset($_GET['post']) && 'fast-forms' === get_post_type( $_GET['post'] )) || ('post-new.php' === $pagenow && isset($_GET['post_type']) && $_GET['post_type'] == 'fast-forms') ) {
        register_block_pattern_category(
            'fast-forms',
            array( 'label' => __( 'Fast forms', 'fast-forms-pro' ) )
        );
        register_block_pattern_category(
            'optin-fast-forms',
            array( 'label' => __( 'Optin forms', 'fast-forms-pro' ) )
        );

        register_block_pattern(
          'fast-forms/ff-opt-in-form',
          array(
              'title'       => __( 'Opt In Form', 'fast-forms-pro' ),
              'description' => _x( 'Opt In Form', 'Block pattern description', 'fast-forms-pro' ),
              'content'     => '<!-- wp:fast-form/ff-text-block {"required":true,"label":"","placeholder":"Enter Your Name"} -->
                                <div class="wp-block-fast-form-ff-text-block"><label></label><input type="text" name="name" placeholder="Enter Your Name" required/></div>
                                <!-- /wp:fast-form/ff-text-block -->

                                <!-- wp:fast-form/ff-email-block {"required":true,"label":"","placeholder":"Enter Your Email"} -->
                                <div class="wp-block-fast-form-ff-email-block"><label></label><input type="text" name="email" placeholder="Enter Your Email" required data-rule-email="true"/></div>
                                <!-- /wp:fast-form/ff-email-block -->

                                <!-- wp:fast-form/ff-button-block {"buttonname":"optin","blockname":"optin_form","width":100,"value":"Sign Me Up!","action":"#","color":"#ff0000"} -->
                                <div style="text-align:none" class="wp-block-fast-form-ff-button-block"><button type="submit" name="optin" style="background:#ff0000;color:#ffffff;width:100%" data-action="#" data-blockname="optin_form">Sign Me Up!</button><div class="initial-errors"></div></div>
                                <!-- /wp:fast-form/ff-button-block -->',
              'categories' => array('optin-fast-forms')
          )
        );

        register_block_pattern(
          'fast-forms/ff-inline-opt-in-form',
          array(
              'title'       => __( 'Inline Opt In Form', 'fast-forms-pro' ),
              'description' => _x( 'Inline Opt In Form', 'Block pattern description', 'fast-forms-pro' ),
              'content'     => '<!-- wp:fast-form/ff-heading-block {"alignment":"center","heading":"h2"} -->
                                <div class="wp-block-fast-form-ff-heading-block"><h2 style="text-align:center;color:#000000">Super Simple Opt In Form</h2></div>
                                <!-- /wp:fast-form/ff-heading-block -->

                                <!-- wp:fast-form/ff-paragraph-block {"alignment":"center"} -->
                                <div class="wp-block-fast-form-ff-paragraph-block"><p style="text-align:center;color:#000000">Change the heading and this text to suit your offer</p></div>
                                <!-- /wp:fast-form/ff-paragraph-block -->

                                <!-- wp:columns -->
								<div class="wp-block-columns"><!-- wp:column -->
								<div class="wp-block-column"><!-- wp:fast-form/ff-email-block {"required":true,"label":"","placeholder":"Enter Your Email"} -->
								<div class="wp-block-fast-form-ff-email-block"><label></label><input type="text" name="email" placeholder="Enter Your Email" required data-rule-email="true" value=""/>									</div>
								<!-- /wp:fast-form/ff-email-block --></div>
								<!-- /wp:column -->

                                <!-- wp:column -->
                                <div class="wp-block-column"><!-- wp:fast-form/ff-button-block {"buttonname":"optin","blockname":"optin_form","width":100,"value":"Sign Me Up!","action":"#","color":"#25b800"} -->
                                <div style="text-align:none" class="wp-block-fast-form-ff-button-block"><button type="submit" name="optin" style="background:#25b800;color:#ffffff;width:100%" data-action="#" data-blockname="optin_form">Sign Me Up!</button><div class="initial-errors"></div></div>
                                <!-- /wp:fast-form/ff-button-block --></div>
                                <!-- /wp:column --></div>
                                <!-- /wp:columns -->',
              'categories' => array('optin-fast-forms')
          )
        );



        register_block_pattern(
          'fast-forms/ff-contact-us-form',
          array(
              'title'       => __( 'Contact Us Form', 'fast-forms-pro' ),
              'description' => _x( 'Contact Us Form', 'Block pattern description', 'fast-forms-pro' ),
              'content'     => '<!-- wp:columns -->
                                <div class="wp-block-columns"><!-- wp:column -->
                                <div class="wp-block-column"><!-- wp:fast-form/ff-text-block {"required":true,"label":"","placeholder":"Enter your name"} -->
                                <div class="wp-block-fast-form-ff-text-block"><label></label><input type="text" name="name" placeholder="Enter your name" required/></div>
                                <!-- /wp:fast-form/ff-text-block --></div>
                                <!-- /wp:column -->

                                <!-- wp:column -->
                                <div class="wp-block-column"><!-- wp:fast-form/ff-email-block {"required":true,"label":"","placeholder":"Enter your email"} -->
                                <div class="wp-block-fast-form-ff-email-block"><label></label><input type="text" name="email" placeholder="Enter your email" required data-rule-email="true"/></div>
                                <!-- /wp:fast-form/ff-email-block --></div>
                                <!-- /wp:column --></div>
                                <!-- /wp:columns -->

                                <!-- wp:fast-form/ff-textarea-block {"label":"","required":true,"placeholder":"Enter your message","char_limit":"500"} -->
                                <div class="wp-block-fast-form-ff-textarea-block"><label></label><textarea name="text" placeholder="Enter your message" maxlength="500" class="components-text-control__input" required></textarea><span class="textarea_count">500 characters remaining</span></div>
                                <!-- /wp:fast-form/ff-textarea-block -->

                                <!-- wp:fast-form/ff-button-block {"alignment":"right","width":45,"value":"Send Your Message","action":"#","color":"#ff4800"} -->
                                <div style="text-align:right" class="wp-block-fast-form-ff-button-block"><button type="submit" name="buttonname" style="background:#ff4800;color:#ffffff;width:45%" data-action="#" data-blockname="submit">Send Your Message</button><div class="initial-errors"></div></div>
                                <!-- /wp:fast-form/ff-button-block -->',
              'categories' => array('fast-forms')
          )
        );

        register_block_pattern(
          'fast-forms/ff-opt-in-form-with-terms',
          array(
              'title'       => __( 'Opt In Form with Simple Terms', 'fast-forms-pro' ),
              'description' => _x( 'Opt In Form with Simple Terms', 'Block pattern description', 'fast-forms-pro' ),
              'content'     => '<!-- wp:fast-form/ff-text-block {"required":true,"label":"","placeholder":"Enter Your Name"} -->
                                <div class="wp-block-fast-form-ff-text-block"><label></label><input type="text" name="name" placeholder="Enter Your Name" required/></div>
                                <!-- /wp:fast-form/ff-text-block -->

                                <!-- wp:fast-form/ff-email-block {"required":true,"label":"","placeholder":"Enter Your Email"} -->
                                <div class="wp-block-fast-form-ff-email-block"><label></label><input type="text" name="email" placeholder="Enter Your Email" required data-rule-email="true"/></div>
                                <!-- /wp:fast-form/ff-email-block -->

                                <!-- wp:fast-form/ff-checkbox-block {"label":"","required":true,"fieldname":"terms","checkbox_options":"Yes! I agree to the terms and conditions and understand I can unsubscribe at any time"} -->
                                <div class="wp-block-fast-form-ff-checkbox-block"><label></label><div class="components-radio-control__option"><input type="checkbox" name="terms[]" value="Yes! I agree to the terms and conditions and understand I can unsubscribe at any time" class="components-checkbox-control__input" required id="terms_0"/><label for="terms_0">Yes! I agree to the terms and conditions and understand I can unsubscribe at any time</label></div></div>
                                <!-- /wp:fast-form/ff-checkbox-block -->

                                <!-- wp:fast-form/ff-button-block {"buttonname":"optin","blockname":"optin_form","width":100,"value":"Sign Me Up!","action":"#","color":"#ff0000"} -->
                                <div style="text-align:none" class="wp-block-fast-form-ff-button-block"><button type="submit" name="optin" style="background:#ff0000;color:#ffffff;width:100%" data-action="#" data-blockname="optin_form">Sign Me Up!</button><div class="initial-errors"></div></div>
                                <!-- /wp:fast-form/ff-button-block -->',
              'categories' => array('optin-fast-forms')
          )
        );

        register_block_pattern(
          'fast-forms/ff-opt-in-form-with-terms-tracking',
          array(
              'title'       => __( 'Opt In Form with Terms and Tracking', 'fast-forms-pro' ),
              'description' => _x( 'Opt In Form with Terms and Tracking', 'Block pattern description', 'fast-forms-pro' ),
              'content'     => '<!-- wp:fast-form/ff-custom-field-block {"label":"","fieldtype":"hidden","fieldname":"optin_form","placeholder":"optin_form"} -->
                                <div class="wp-block-fast-form-ff-custom-field-block"><input type="hidden" name="optin_form" placeholder="optin_form" value=""/></div>
                                <!-- /wp:fast-form/ff-custom-field-block -->

                                <!-- wp:fast-form/ff-custom-field-block {"label":"","fieldtype":"hidden","fieldname":"utm_source","placeholder":""} -->
                                <div class="wp-block-fast-form-ff-custom-field-block"><input type="hidden" name="utm_source" placeholder="" value=""/></div>
                                <!-- /wp:fast-form/ff-custom-field-block -->

                                <!-- wp:fast-form/ff-custom-field-block {"label":"","fieldtype":"hidden","fieldname":"utm_medium","placeholder":""} -->
                                <div class="wp-block-fast-form-ff-custom-field-block"><input type="hidden" name="utm_medium" placeholder="" value=""/></div>
                                <!-- /wp:fast-form/ff-custom-field-block -->

                                <!-- wp:fast-form/ff-custom-field-block {"label":"","fieldtype":"hidden","fieldname":"utm_campaign","placeholder":""} -->
                                <div class="wp-block-fast-form-ff-custom-field-block"><input type="hidden" name="utm_campaign" placeholder="" value=""/></div>
                                <!-- /wp:fast-form/ff-custom-field-block -->

                                <!-- wp:fast-form/ff-text-block {"required":true,"label":"","placeholder":"Enter Your Name"} -->
                                <div class="wp-block-fast-form-ff-text-block"><label></label><input type="text" name="name" placeholder="Enter Your Name" required/></div>
                                <!-- /wp:fast-form/ff-text-block -->

                                <!-- wp:fast-form/ff-email-block {"required":true,"label":"","placeholder":"Enter Your Email"} -->
                                <div class="wp-block-fast-form-ff-email-block"><label></label><input type="text" name="email" placeholder="Enter Your Email" required data-rule-email="true"/></div>
                                <!-- /wp:fast-form/ff-email-block -->

                                <!-- wp:fast-form/ff-checkbox-block {"label":"Do you agree to the site terms and conditions?","required":true,"fieldname":"terms","checkbox_options":"Yes! I agree to the terms and conditions and understand I can unsubscribe at any time"} -->
                                <div class="wp-block-fast-form-ff-checkbox-block"><label>Do you agree to the site terms and conditions?</label><div class="components-radio-control__option"><input type="checkbox" name="terms[]" value="Yes! I agree to the terms and conditions and understand I can unsubscribe at any time" class="components-checkbox-control__input" required id="terms_0"/><label for="terms_0">Yes! I agree to the terms and conditions and understand I can unsubscribe at any time</label></div></div>
                                <!-- /wp:fast-form/ff-checkbox-block -->

                                <!-- wp:fast-form/ff-button-block {"buttonname":"optin","blockname":"optin_form","width":100,"value":"Sign Me Up!","action":"#","color":"#ff0000"} -->
                                <div style="text-align:none" class="wp-block-fast-form-ff-button-block"><button type="submit" name="optin" style="background:#ff0000;color:#ffffff;width:100%" data-action="#" data-blockname="optin_form">Sign Me Up!</button><div class="initial-errors"></div></div>
                                <!-- /wp:fast-form/ff-button-block -->',
              'categories' => array('optin-fast-forms')
          )
        );

        register_block_pattern(
          'fast-forms/ff-simple-one-page-survey',
          array(
              'title'       => __( 'Simple One Page Survey', 'fast-forms-pro' ),
              'description' => _x( 'Simple One Page Survey', 'Block pattern description', 'fast-forms-pro' ),
              'content'     => '<!-- wp:fast-form/ff-heading-block -->
                                <div class="wp-block-fast-form-ff-heading-block"><h3 style="text-align:none;color:#000000">Question 1</h3></div>
                                <!-- /wp:fast-form/ff-heading-block -->

                                <!-- wp:fast-form/ff-separator-block {"color":"#dfdfdf"} -->
                                <div class="wp-block-fast-form-ff-separator-block"><hr style="background-color:#dfdfdf;height:1px"/></div>
                                <!-- /wp:fast-form/ff-separator-block -->

                                <!-- wp:fast-form/ff-paragraph-block -->
                                <div class="wp-block-fast-form-ff-paragraph-block"><p style="text-align:none;color:#000000">Enter your answer below</p></div>
                                <!-- /wp:fast-form/ff-paragraph-block -->

                                <!-- wp:fast-form/ff-select-block {"label":"Select from the dropdown","select_options":"Dropdown Option 1,Dropdown Option 2,Dropdown Option 3"} -->
                                <div class="wp-block-fast-form-ff-select-block"><label class="components-base-control__label">Select from the dropdown</label><select name="dropdown" class="components-select-control__input"><option value="Dropdown Option 1">Dropdown Option 1</option><option value="Dropdown Option 2">Dropdown Option 2</option><option value="Dropdown Option 3">Dropdown Option 3</option></select></div>
                                <!-- /wp:fast-form/ff-select-block -->

                                <!-- wp:fast-form/ff-paragraph-block -->
                                <div class="wp-block-fast-form-ff-paragraph-block"><p style="text-align:none;color:#000000"><br/></p></div>
                                <!-- /wp:fast-form/ff-paragraph-block -->

                                <!-- wp:fast-form/ff-heading-block -->
                                <div class="wp-block-fast-form-ff-heading-block"><h3 style="text-align:none;color:#000000">Question 2</h3></div>
                                <!-- /wp:fast-form/ff-heading-block -->

                                <!-- wp:fast-form/ff-separator-block {"color":"#dfdfdf"} -->
                                <div class="wp-block-fast-form-ff-separator-block"><hr style="background-color:#dfdfdf;height:1px"/></div>
                                <!-- /wp:fast-form/ff-separator-block -->

                                <!-- wp:fast-form/ff-paragraph-block -->
                                <div class="wp-block-fast-form-ff-paragraph-block"><p style="text-align:none;color:#000000">Enter your answer below</p></div>
                                <!-- /wp:fast-form/ff-paragraph-block -->

                                <!-- wp:fast-form/ff-checkbox-block {"label":"Pick a box","checkbox_options":"Checkbox Option 1,Checkbox Option 2,Checkbox Option 3"} -->
                                <div class="wp-block-fast-form-ff-checkbox-block"><label>Pick a box</label><div class="components-radio-control__option"><input type="checkbox" name="checkbox[]" value="Checkbox Option 1" class="components-checkbox-control__input" id="checkbox_0"/><label for="checkbox_0">Checkbox Option 1</label></div><div class="components-radio-control__option"><input type="checkbox" name="checkbox[]" value="Checkbox Option 2" class="components-checkbox-control__input" id="checkbox_1"/><label for="checkbox_1">Checkbox Option 2</label></div><div class="components-radio-control__option"><input type="checkbox" name="checkbox[]" value="Checkbox Option 3" class="components-checkbox-control__input" id="checkbox_2"/><label for="checkbox_2">Checkbox Option 3</label></div></div>
                                <!-- /wp:fast-form/ff-checkbox-block -->

                                <!-- wp:fast-form/ff-paragraph-block -->
                                <div class="wp-block-fast-form-ff-paragraph-block"><p style="text-align:none;color:#000000"><br/></p></div>
                                <!-- /wp:fast-form/ff-paragraph-block -->

                                <!-- wp:fast-form/ff-heading-block -->
                                <div class="wp-block-fast-form-ff-heading-block"><h3 style="text-align:none;color:#000000">Question 3</h3></div>
                                <!-- /wp:fast-form/ff-heading-block -->

                                <!-- wp:fast-form/ff-separator-block {"color":"#dfdfdf"} -->
                                <div class="wp-block-fast-form-ff-separator-block"><hr style="background-color:#dfdfdf;height:1px"/></div>
                                <!-- /wp:fast-form/ff-separator-block -->

                                <!-- wp:fast-form/ff-paragraph-block -->
                                <div class="wp-block-fast-form-ff-paragraph-block"><p style="text-align:none;color:#000000">Enter your answer below</p></div>
                                <!-- /wp:fast-form/ff-paragraph-block -->

                                <!-- wp:fast-form/ff-radio-block {"label":"Choose an option","radio_options":"Radio Option 1,Radio Option 2,Radio Option 3"} -->
                                <div class="wp-block-fast-form-ff-radio-block"><label>Choose an option</label><div class="components-radio-control__option"><input type="radio" name="radio" value="Radio Option 1" class="components-radio-control__input" id="radio_0"/><label for="radio_0">Radio Option 1</label></div><div class="components-radio-control__option"><input type="radio" name="radio" value="Radio Option 2" class="components-radio-control__input" id="radio_1"/><label for="radio_1">Radio Option 2</label></div><div class="components-radio-control__option"><input type="radio" name="radio" value="Radio Option 3" class="components-radio-control__input" id="radio_2"/><label for="radio_2">Radio Option 3</label></div></div>
                                <!-- /wp:fast-form/ff-radio-block -->

                                <!-- wp:fast-form/ff-paragraph-block -->
                                <div class="wp-block-fast-form-ff-paragraph-block"><p style="text-align:none;color:#000000"><br/></p></div>
                                <!-- /wp:fast-form/ff-paragraph-block -->

                                <!-- wp:fast-form/ff-heading-block -->
                                <div class="wp-block-fast-form-ff-heading-block"><h3 style="text-align:none;color:#000000">Send Your Results</h3></div>
                                <!-- /wp:fast-form/ff-heading-block -->

                                <!-- wp:fast-form/ff-separator-block {"color":"#dfdfdf"} -->
                                <div class="wp-block-fast-form-ff-separator-block"><hr style="background-color:#dfdfdf;height:1px"/></div>
                                <!-- /wp:fast-form/ff-separator-block -->

                                <!-- wp:fast-form/ff-text-block {"required":true,"label":"","placeholder":"Enter Your Name"} -->
<div class="wp-block-fast-form-ff-text-block"><label></label><input type="text" name="name" placeholder="Enter Your Name" required/></div>
<!-- /wp:fast-form/ff-text-block -->

<!-- wp:fast-form/ff-email-block {"required":true,"label":"","placeholder":"Enter Your Email"} -->
<div class="wp-block-fast-form-ff-email-block"><label></label><input type="text" name="email" placeholder="Enter Your Email" required data-rule-email="true" value=""/></div>
<!-- /wp:fast-form/ff-email-block -->



                                <!-- wp:fast-form/ff-button-block {"width":100,"value":"Send Your Results","color":"#2d8700"} -->
                                <div style="text-align:none" class="wp-block-fast-form-ff-button-block"><button type="submit" name="buttonname" style="background:#2d8700;color:#ffffff;width:100%" data-action="" data-blockname="submit">Send Your Results</button><div class="initial-errors"></div></div>
                                <!-- /wp:fast-form/ff-button-block -->',
              'categories' => array('fast-forms')
          )
        );



        register_block_pattern(
          'fast-forms/ff-multi-step-survey',
          array(
              'title'       => __( 'Multi Step Survey', 'fast-forms-pro' ),
              'description' => _x( 'Multi Step Survey', 'Block pattern description', 'fast-forms-pro' ),
              'content'     => '<!-- wp:fast-form/ff-heading-block -->
                                <div class="wp-block-fast-form-ff-heading-block"><h3 style="text-align:none;color:#000000">Question 1</h3></div>
                                <!-- /wp:fast-form/ff-heading-block -->

                                <!-- wp:fast-form/ff-separator-block {"color":"#dfdfdf"} -->
                                <div class="wp-block-fast-form-ff-separator-block"><hr style="background-color:#dfdfdf;height:1px"/></div>
                                <!-- /wp:fast-form/ff-separator-block -->

                                <!-- wp:fast-form/ff-paragraph-block -->
                                <div class="wp-block-fast-form-ff-paragraph-block"><p style="text-align:none;color:#000000">Enter your answer below</p></div>
                                <!-- /wp:fast-form/ff-paragraph-block -->

                                <!-- wp:fast-form/ff-select-block {"label":"Select from the dropdown","select_options":"Dropdown Option 1,Dropdown Option 2,Dropdown Option 3"} -->
                                <div class="wp-block-fast-form-ff-select-block"><label class="components-base-control__label">Select from the dropdown</label><select name="dropdown" class="components-select-control__input"><option value="Dropdown Option 1">Dropdown Option 1</option><option value="Dropdown Option 2">Dropdown Option 2</option><option value="Dropdown Option 3">Dropdown Option 3</option></select></div>
                                <!-- /wp:fast-form/ff-select-block -->

                                <!-- wp:fast-form/ff-paragraph-block -->
                                <div class="wp-block-fast-form-ff-paragraph-block"><p style="text-align:none;color:#000000"><br/></p></div>
                                <!-- /wp:fast-form/ff-paragraph-block -->

                                <!-- wp:fast-form/ff-pagebreak-block {"width":35,"color":"#2d8700"} -->
                                <div style="text-align:right;clear:both" class="wp-block-fast-form-ff-pagebreak-block"><button type="button" class="ff-next action-button" style="background:#2d8700;color:#ffffff;width:35%" data-blockname="pagebreak">Next step</button><a href="javascript:;" class="ff-previous" style="float:left">Previous step</a><div class="initial-errors"></div></div>
                                <!-- /wp:fast-form/ff-pagebreak-block -->

                                <!-- wp:fast-form/ff-heading-block -->
                                <div class="wp-block-fast-form-ff-heading-block"><h3 style="text-align:none;color:#000000">Question 2</h3></div>
                                <!-- /wp:fast-form/ff-heading-block -->

                                <!-- wp:fast-form/ff-separator-block {"color":"#dfdfdf"} -->
                                <div class="wp-block-fast-form-ff-separator-block"><hr style="background-color:#dfdfdf;height:1px"/></div>
                                <!-- /wp:fast-form/ff-separator-block -->

                                <!-- wp:fast-form/ff-paragraph-block -->
                                <div class="wp-block-fast-form-ff-paragraph-block"><p style="text-align:none;color:#000000">Enter your answer below</p></div>
                                <!-- /wp:fast-form/ff-paragraph-block -->

                                <!-- wp:fast-form/ff-checkbox-block {"label":"Pick a box","checkbox_options":"Checkbox Option 1,Checkbox Option 2,Checkbox Option 3"} -->
                                <div class="wp-block-fast-form-ff-checkbox-block"><label>Pick a box</label><div class="components-radio-control__option"><input type="checkbox" name="checkbox[]" value="Checkbox Option 1" class="components-checkbox-control__input" id="checkbox_0"/><label for="checkbox_0">Checkbox Option 1</label></div><div class="components-radio-control__option"><input type="checkbox" name="checkbox[]" value="Checkbox Option 2" class="components-checkbox-control__input" id="checkbox_1"/><label for="checkbox_1">Checkbox Option 2</label></div><div class="components-radio-control__option"><input type="checkbox" name="checkbox[]" value="Checkbox Option 3" class="components-checkbox-control__input" id="checkbox_2"/><label for="checkbox_2">Checkbox Option 3</label></div></div>
                                <!-- /wp:fast-form/ff-checkbox-block -->

                                <!-- wp:fast-form/ff-paragraph-block -->
                                <div class="wp-block-fast-form-ff-paragraph-block"><p style="text-align:none;color:#000000"><br/></p></div>
                                <!-- /wp:fast-form/ff-paragraph-block -->

                                <!-- wp:fast-form/ff-pagebreak-block {"width":35,"color":"#2d8700"} -->
                                <div style="text-align:right;clear:both" class="wp-block-fast-form-ff-pagebreak-block"><button type="button" class="ff-next action-button" style="background:#2d8700;color:#ffffff;width:35%" data-blockname="pagebreak">Next step</button><a href="javascript:;" class="ff-previous" style="float:left">Previous step</a><div class="initial-errors"></div></div>
                                <!-- /wp:fast-form/ff-pagebreak-block -->

                                <!-- wp:fast-form/ff-heading-block -->
                                <div class="wp-block-fast-form-ff-heading-block"><h3 style="text-align:none;color:#000000">Question 3</h3></div>
                                <!-- /wp:fast-form/ff-heading-block -->

                                <!-- wp:fast-form/ff-separator-block {"color":"#dfdfdf"} -->
                                <div class="wp-block-fast-form-ff-separator-block"><hr style="background-color:#dfdfdf;height:1px"/></div>
                                <!-- /wp:fast-form/ff-separator-block -->

                                <!-- wp:fast-form/ff-paragraph-block -->
                                <div class="wp-block-fast-form-ff-paragraph-block"><p style="text-align:none;color:#000000">Enter your answer below</p></div>
                                <!-- /wp:fast-form/ff-paragraph-block -->

                                <!-- wp:fast-form/ff-radio-block {"label":"Choose an option","radio_options":"Radio Option 1,Radio Option 2,Radio Option 3"} -->
                                <div class="wp-block-fast-form-ff-radio-block"><label>Choose an option</label><div class="components-radio-control__option"><input type="radio" name="radio" value="Radio Option 1" class="components-radio-control__input" id="radio_0"/><label for="radio_0">Radio Option 1</label></div><div class="components-radio-control__option"><input type="radio" name="radio" value="Radio Option 2" class="components-radio-control__input" id="radio_1"/><label for="radio_1">Radio Option 2</label></div><div class="components-radio-control__option"><input type="radio" name="radio" value="Radio Option 3" class="components-radio-control__input" id="radio_2"/><label for="radio_2">Radio Option 3</label></div></div>
                                <!-- /wp:fast-form/ff-radio-block -->

                                <!-- wp:fast-form/ff-paragraph-block -->
                                <div class="wp-block-fast-form-ff-paragraph-block"><p style="text-align:none;color:#000000"><br/></p></div>
                                <!-- /wp:fast-form/ff-paragraph-block -->

                                <!-- wp:fast-form/ff-pagebreak-block {"width":35,"color":"#2d8700"} -->
                                <div style="text-align:right;clear:both" class="wp-block-fast-form-ff-pagebreak-block"><button type="button" class="ff-next action-button" style="background:#2d8700;color:#ffffff;width:35%" data-blockname="pagebreak">Next step</button><a href="javascript:;" class="ff-previous" style="float:left">Previous step</a><div class="initial-errors"></div></div>
                                <!-- /wp:fast-form/ff-pagebreak-block -->

                                <!-- wp:fast-form/ff-heading-block -->
                                <div class="wp-block-fast-form-ff-heading-block"><h3 style="text-align:none;color:#000000">Send Your Results</h3></div>
                                <!-- /wp:fast-form/ff-heading-block -->

                                <!-- wp:fast-form/ff-separator-block {"color":"#dfdfdf"} -->
                                <div class="wp-block-fast-form-ff-separator-block"><hr style="background-color:#dfdfdf;height:1px"/></div>
                                <!-- /wp:fast-form/ff-separator-block -->

                                <!-- wp:fast-form/ff-text-block {"required":true,"label":"","placeholder":"Enter Your Name"} -->
<div class="wp-block-fast-form-ff-text-block"><label></label><input type="text" name="name" placeholder="Enter Your Name" required/></div>
<!-- /wp:fast-form/ff-text-block -->

<!-- wp:fast-form/ff-email-block {"required":true,"label":"","placeholder":"Enter Your Email"} -->
<div class="wp-block-fast-form-ff-email-block"><label></label><input type="text" name="email" placeholder="Enter Your Email" required data-rule-email="true" value=""/></div>
<!-- /wp:fast-form/ff-email-block -->


                                <!-- wp:fast-form/ff-button-block {"width":100,"value":"Send Your Results","color":"#2d8700"} -->
                                <div style="text-align:none" class="wp-block-fast-form-ff-button-block"><button type="submit" name="buttonname" style="background:#2d8700;color:#ffffff;width:100%" data-action="" data-blockname="submit">Send Your Results</button><div class="initial-errors"></div></div>
                                <!-- /wp:fast-form/ff-button-block -->',
              'categories' => array('fast-forms')
          )
        );


    register_block_pattern(
          'fast-forms/ff-long-payment-form-with-shipping-and-terms',
          array(
              'title'       => __( 'Long Payment Form With Shipping and Terms', 'fast-forms-pro' ),
              'description' => _x( 'Long Payment Form With Shipping and Terms', 'Block pattern description', 'fast-forms-pro' ),
              'content'     => '<!-- wp:fast-form/ff-product-block -->
<div class="wp-block-fast-form-ff-product-block"><div>Please select products</div></div>
<!-- /wp:fast-form/ff-product-block -->

<!-- wp:fast-form/ff-separator-block {"thickness":3,"color":"#f4f4f4"} -->
<div class="wp-block-fast-form-ff-separator-block"><hr style="background-color:#f4f4f4;height:3px"/></div>
<!-- /wp:fast-form/ff-separator-block -->

<!-- wp:fast-form/ff-heading-block -->
<div class="wp-block-fast-form-ff-heading-block"><h3 style="text-align:none;color:#000000">Contact</h3></div>
<!-- /wp:fast-form/ff-heading-block -->

<!-- wp:fast-form/ff-separator-block {"color":"#f4f4f4"} -->
<div class="wp-block-fast-form-ff-separator-block"><hr style="background-color:#f4f4f4;height:1px"/></div>
<!-- /wp:fast-form/ff-separator-block -->

<!-- wp:fast-form/ff-text-block {"required":true,"label":"","placeholder":"Enter Your Name"} -->
<div class="wp-block-fast-form-ff-text-block"><label></label><input type="text" name="name" placeholder="Enter Your Name" required/></div>
<!-- /wp:fast-form/ff-text-block -->

<!-- wp:fast-form/ff-email-block {"required":true,"label":"","placeholder":"Enter Your Email"} -->
<div class="wp-block-fast-form-ff-email-block"><label></label><input type="text" name="email" placeholder="Enter Your Email" required data-rule-email="true" value=""/></div>
<!-- /wp:fast-form/ff-email-block -->

<!-- wp:fast-form/ff-separator-block {"thickness":3,"color":"#f4f4f4"} -->
<div class="wp-block-fast-form-ff-separator-block"><hr style="background-color:#f4f4f4;height:3px"/></div>
<!-- /wp:fast-form/ff-separator-block -->

<!-- wp:fast-form/ff-heading-block -->
<div class="wp-block-fast-form-ff-heading-block"><h3 style="text-align:none;color:#000000">Shipping</h3></div>
<!-- /wp:fast-form/ff-heading-block -->

<!-- wp:fast-form/ff-separator-block {"color":"#f4f4f4"} -->
<div class="wp-block-fast-form-ff-separator-block"><hr style="background-color:#f4f4f4;height:1px"/></div>
<!-- /wp:fast-form/ff-separator-block -->

<!-- wp:fast-form/ff-address-block {"address_line_1_required":true,"town_required":true,"state_required":true,"zip_required":true,"country_required":true} -->
<div class="wp-block-fast-form-ff-address-block"><div><label>Address line 1</label><input type="text" name="address[address_line_1]" placeholder="Address line 1" required/></div><div><label>Address line 2</label><input type="text" name="address[address_line_2]" placeholder="Address line 2"/></div><div class="town"><label>Town</label><input type="text" name="address[town]" placeholder="Town" required/></div><div class="state"><label>State</label><input type="text" name="address[state]" placeholder="State" required/></div><div class="zip"><label>Zip</label><input type="text" name="address[zip]" placeholder="Zip" required/></div><div class="country"><label>Country</label><select name="address[country]" class="components-select-control__input" required><option value="AF">Afghanistan</option><option value="AX">Åland Islands</option><option value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option value="AD">AndorrA</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antarctica</option><option value="AG">Antigua and Barbuda</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaijan</option><option value="BS">Bahamas</option><option value="BH">Bahrain</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BY">Belarus</option><option value="BE">Belgium</option><option value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option value="BT">Bhutan</option><option value="BO">Bolivia</option><option value="BA">Bosnia and Herzegovina</option><option value="BW">Botswana</option><option value="BV">Bouvet Island</option><option value="BR">Brazil</option><option value="IO">British Indian Ocean Territory</option><option value="BN">Brunei Darussalam</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option value="CA">Canada</option><option value="CV">Cape Verde</option><option value="KY">Cayman Islands</option><option value="CF">Central African Republic</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CX">Christmas Island</option><option value="CC">Cocos (Keeling) Islands</option><option value="CO">Colombia</option><option value="KM">Comoros</option><option value="CG">Congo</option><option value="CD">Congo, The Democratic Republic of the</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="CI">Cote D"Ivoire</option><option value="HR">Croatia</option><option value="CU">Cuba</option><option value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option value="ER">Eritrea</option><option value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands (Malvinas)</option><option value="FO">Faroe Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="FR">France</option><option value="GF">French Guiana</option><option value="PF">French Polynesia</option><option value="TF">French Southern Territories</option><option value="GA">Gabon</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadeloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GG">Guernsey</option><option value="GN">Guinea</option><option value="GW">Guinea-Bissau</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HM">Heard Island and Mcdonald Islands</option><option value="VA">Holy See (Vatican City State)</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IR">Iran, Islamic Republic Of</option><option value="IQ">Iraq</option><option value="IE">Ireland</option><option value="IM">Isle of Man</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JE">Jersey</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="KP">Korea, Democratic People"S Republic of</option><option value="KR">Korea, Republic of</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option value="LA">Lao People"S Democratic Republic</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libyan Arab Jamahiriya</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macao</option><option value="MK">Macedonia, The Former Yugoslav Republic of</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="YT">Mayotte</option><option value="MX">Mexico</option><option value="FM">Micronesia, Federated States of</option><option value="MD">Moldova, Republic of</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="ME">Montenegro</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="MM">Myanmar</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NL">Netherlands</option><option value="AN">Netherlands Antilles</option><option value="NC">New Caledonia</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option value="MP">Northern Mariana Islands</option><option value="NO">Norway</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PW">Palau</option><option value="PS">Palestinian Territory, Occupied</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PN">Pitcairn</option><option value="PL">Poland</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="RE">Reunion</option><option value="RO">Romania</option><option value="RU">Russian Federation</option><option value="RW">RWANDA</option><option value="SH">Saint Helena</option><option value="KN">Saint Kitts and Nevis</option><option value="LC">Saint Lucia</option><option value="PM">Saint Pierre and Miquelon</option><option value="VC">Saint Vincent and the Grenadines</option><option value="WS">Samoa</option><option value="SM">San Marino</option><option value="ST">Sao Tome and Principe</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="RS">Serbia</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SK">Slovakia</option><option value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option value="SO">Somalia</option><option value="ZA">South Africa</option><option value="GS">South Georgia and the South Sandwich Islands</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="SD">Sudan</option><option value="SR">Surilabel</option><option value="SJ">Svalbard and Jan Mayen</option><option value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="SY">Syrian Arab Republic</option><option value="TW">Taiwan, Province of China</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania, United Republic of</option><option value="TH">Thailand</option><option value="TL">Timor-Leste</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad and Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option value="TC">Turks and Caicos Islands</option><option value="TV">Tuvalu</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option value="GB">United Kingdom</option><option value="US">United States</option><option value="UM">United States Minor Outlying Islands</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option value="VE">Venezuela</option><option value="VN">Viet Nam</option><option value="VG">Virgin Islands, British</option><option value="VI">Virgin Islands, U.S.</option><option value="WF">Wallis and Futuna</option><option value="EH">Western Sahara</option><option value="YE">Yemen</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option>;</select></div></div>
<!-- /wp:fast-form/ff-address-block -->

<!-- wp:fast-form/ff-separator-block {"thickness":3,"color":"#f4f4f4"} -->
<div class="wp-block-fast-form-ff-separator-block"><hr style="background-color:#f4f4f4;height:3px"/></div>
<!-- /wp:fast-form/ff-separator-block -->

<!-- wp:fast-form/ff-heading-block -->
<div class="wp-block-fast-form-ff-heading-block"><h3 style="text-align:none;color:#000000">Billing</h3></div>
<!-- /wp:fast-form/ff-heading-block -->

<!-- wp:fast-form/ff-separator-block {"color":"#f4f4f4"} -->
<div class="wp-block-fast-form-ff-separator-block"><hr style="background-color:#f4f4f4;height:1px"/></div>
<!-- /wp:fast-form/ff-separator-block -->

<!-- wp:fast-form/ff-checkbox-block {"label":"","alignment":"right","required":true,"fieldname":"terms","checkbox_options":"Yes! I am ready to get started. I agree to the terms of purchase"} -->
<div class="wp-block-fast-form-ff-checkbox-block"><label></label><div class="components-radio-control__option"><input type="checkbox" name="terms[]" value="Yes! I am ready to get started. I agree to the terms of purchase" class="components-checkbox-control__input" required id="terms_0"/><label for="terms_0">Yes! I am ready to get started. I agree to the terms of purchase</label></div></div>
<!-- /wp:fast-form/ff-checkbox-block -->',
              'categories' => array('fast-forms')
          )
        );


    register_block_pattern(
          'fast-forms/ff-multi-step-payment-form-with-add-to-cart-order-bump',
          array(
              'title'       => __( 'Multi Step Payment Form With Add To Cart, Order Bump and Tracking', 'fast-forms-pro' ),
              'description' => _x( 'Multi Step Payment Form With Add To Cart, Order Bump and Tracking', 'Block pattern description', 'fast-forms-pro' ),
              'content'     => '<!-- wp:fast-form/ff-custom-field-block
                                {"label":"","fieldtype":"hidden","fieldname":"payment_form","placeholder":"payment_form"} -->
                                <div class="wp-block-fast-form-ff-custom-field-block"><input type="hidden" name="payment_form" placeholder="payment_form" value=""/></div>
                                <!-- /wp:fast-form/ff-custom-field-block -->

                                <!-- wp:fast-form/ff-custom-field-block {"label":"","fieldtype":"hidden","fieldname":"utm_source","placeholder":""} -->
                                <div class="wp-block-fast-form-ff-custom-field-block"><input type="hidden" name="utm_source" placeholder="" value=""/></div>
                                <!-- /wp:fast-form/ff-custom-field-block -->

                                <!-- wp:fast-form/ff-custom-field-block {"label":"","fieldtype":"hidden","fieldname":"utm_medium","placeholder":""} -->
                                <div class="wp-block-fast-form-ff-custom-field-block"><input type="hidden" name="utm_medium" placeholder="" value=""/></div>
                                <!-- /wp:fast-form/ff-custom-field-block -->

                                <!-- wp:fast-form/ff-custom-field-block {"label":"","fieldtype":"hidden","fieldname":"utm_campaign","placeholder":""} -->
                                <div class="wp-block-fast-form-ff-custom-field-block"><input type="hidden" name="utm_campaign" placeholder="" value=""/></div>
                                <!-- /wp:fast-form/ff-custom-field-block -->

                                <!-- wp:fast-form/ff-product-block {"products":null,"vdisplay":"always","urlparamshow":"pid=gold"} -->
                                <div class="wp-block-fast-form-ff-product-block"><div>Please select products</div></div>
                                <!-- /wp:fast-form/ff-product-block -->

                                <!-- wp:fast-form/ff-pagebreak-block {"buttonname":"Add To Cart","prevbuttonname":"","width":100,"blockname":"Add_To_Cart","color":"#ff0000"} -->
                                <div style="text-align:right;clear:both" class="wp-block-fast-form-ff-pagebreak-block"><button type="button" class="ff-next action-button" style="background:#ff0000;color:#ffffff;width:100%" data-blockname="Add_To_Cart">Add To Cart</button><a href="javascript:;" class="ff-previous" style="float:left"></a><div class="initial-errors"></div></div>
                                <!-- /wp:fast-form/ff-pagebreak-block -->

                                <!-- wp:fast-form/ff-text-block {"required":true,"label":"","placeholder":"Enter Your Name"} -->
                                <div class="wp-block-fast-form-ff-text-block"><label></label><input type="text" name="name" placeholder="Enter Your Name" required/></div>
                                <!-- /wp:fast-form/ff-text-block -->

                                <!-- wp:fast-form/ff-email-block {"required":true,"label":"","placeholder":"Enter Your Email"} -->
                                <div class="wp-block-fast-form-ff-email-block"><label></label><input type="text" name="email" placeholder="Enter Your Email" required data-rule-email="true" value=""/></div>
                                <!-- /wp:fast-form/ff-email-block -->

                                <!-- wp:fast-form/ff-pagebreak-block {"buttonname":"Go To Step 2","prevbuttonname":"","width":100,"blockname":"Step_2","color":"#ff0000"} -->
                                <div style="text-align:right;clear:both" class="wp-block-fast-form-ff-pagebreak-block"><button type="button" class="ff-next action-button" style="background:#ff0000;color:#ffffff;width:100%" data-blockname="Step_2">Go To Step 2</button><a href="javascript:;" class="ff-previous" style="float:left"></a><div class="initial-errors"></div></div>
                                <!-- /wp:fast-form/ff-pagebreak-block -->

                                <!-- wp:fast-form/ff-order-bump-block {"product_label":"Please select","cta_head":"Yes I\'ll take the offer","cta_color":"#bd0505","background_color":"#f7f7f7","border":"dashed","border_color":"#ff3b2e"} -->
                                <div class="wp-block-fast-form-ff-order-bump-block"></div>
                                <!-- /wp:fast-form/ff-order-bump-block -->',
              'categories' => array('fast-forms')
          )
        );


        /* NEW BLOCK PATTERN

        register_block_pattern(
          'fast-forms/ff-payment-form-with-order-bump',
          array(
              'title'       => __( 'Payment Form With Order Bump', 'fast-forms-pro' ),
              'description' => _x( 'Payment Form With Order Bump', 'Block pattern description', 'fast-forms-pro' ),
              'content'     => '[REPLACE WITH FORM CODE]',
              'categories' => array('fast-forms')
          )
        );

        */


      }
     }

  }
}
