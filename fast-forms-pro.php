<?php
/**
 * Plugin Name: Fast Forms Pro
 * Plugin URI: https://fastflow.io/fast-forms-pro
 * Description: Block based form builder
 * Version: 1.0.9.14
 * Author: fastflow.io
 * Author URI: https://fastflow.io
 *
 */

defined('ABSPATH') || exit;

if (!class_exists('FastForms')) {

    class FastForms {
        private $namespace;
        public function __construct() {
          $this->namespace = 'fast-flow/block/v2';
          include_once( plugin_dir_path(__FILE__) . '/includes/block_patterns.php');
          register_activation_hook(__FILE__, array($this, 'fast_forms_activate'));
          register_deactivation_hook(__FILE__, array($this, 'fast_forms_deactivate'));
          add_action( 'admin_init', array($this, 'fast_forms_register_blocks'), 10);
          add_action( 'enqueue_block_editor_assets', array($this, 'fast_forms_gutenberg_scripts'));
          add_action('admin_head', array($this, 'fast_forms_meta_post_type'), 10);
          add_filter( 'block_categories_all', array($this, 'fast_forms_gutenberg_block_category'), 100, 2);
          add_filter( 'allowed_block_types_all', array($this, 'fast_forms_restrict_blocks'), 100, 2);
          add_action( 'after_setup_theme',  array($this,'fast_forms_after_setup_theme'), 10 );
          add_shortcode('fast_forms', array($this, 'fast_forms_shortcode'));
          if (class_exists('BlockPatterns')) {
              $this->BlockPatterns = new BlockPatterns();
          }
        }

        public function fast_forms_activate(){
          global $table_prefix, $wpdb;
          flush_rewrite_rules();
        }

        public function fast_forms_deactivate(){

        }

        public function fast_forms_register_blocks(){
          register_block_type( 'fast-form/ff-text-block');
          register_block_type( 'fast-form/ff-email-block');
          register_block_type( 'fast-form/ff-custom-field-block');
          register_block_type( 'fast-form/ff-button-block');
          register_block_type( 'fast-form/ff-pagebreak-block');
          register_block_type( 'fast-form/ff-paragraph-block');
          register_block_type( 'fast-form/ff-heading-block');
          register_block_type( 'fast-form/ff-textarea-block');
          register_block_type( 'fast-form/ff-radio-block');
          register_block_type( 'fast-form/ff-checkbox-block');
          register_block_type( 'fast-form/ff-select-block');
          register_block_type( 'fast-form/ff-address-block');
          register_block_type( 'fast-form/ff-separator-block');
          register_block_type( 'fast-form/ff-product-block');
          register_block_type( 'fast-form/ff-order-bump-block');
          register_block_type( 'fast-form/ff-password-block');
          register_block_type( 'fast-form/ff-upload-block');
          register_block_type( 'fast-flow/block');
          if ( in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )){
            register_block_type( 'fast-flow/wc-products-block');
            register_block_type( 'fast-flow/wc-credit-products-block');
          }
        }

        public function fast_forms_gutenberg_scripts() {
          global $post;
          //if($post->post_type == 'fast-forms'){
          	$blockPath = '/dist/block.js';
          	$stylePath = '/dist/block.css';

          	// Enqueue the bundled block JS file
          	wp_enqueue_script(
          		'fast-form-gutenberg-js',
          		plugins_url( $blockPath, __FILE__ ),
          		[ 'wp-i18n', 'wp-blocks', 'wp-edit-post', 'wp-element', 'wp-editor', 'wp-components', 'wp-data', 'wp-plugins', 'wp-edit-post', 'wp-api' ],
          		filemtime( plugin_dir_path(__FILE__) . $blockPath ),
              TRUE
          	);

          	// Enqueue frontend and editor block styles
          	wp_enqueue_style(
          		'fast-form-gutenberg-css',
          		plugins_url( $stylePath, __FILE__ ),
          		'',
          		filemtime( plugin_dir_path(__FILE__) . $stylePath )
          	);
          //}
        }

        public function fast_forms_meta_post_type(){
          ?>
          <meta property="fast_forms_post" content="<?php echo get_post_type(); ?>" />
          <?php
        }

        public function fast_forms_gutenberg_block_category( $categories, $post ) {
          if($post->post->post_type == 'fast-forms' || $post->post->post_type == 'page' || $post->post->post_type == 'post'){
            return array_merge(
          		$categories,
          		array(
          			array(
          				'slug' => 'fast-form-blocks',
          				'title' => __( 'Fast Forms', 'fast-form-blocks' )
          			),
                array(
          				'slug' => 'fastflow-block',
          				'title' => __( 'Fast Flow', 'fast-flow-block' )
          			),
          		)
          	);
          }
          return $categories;
        }

        public function fast_forms_restrict_blocks( $allowed_blocks, $post ) {
          if($post->post->post_type == 'fast-forms'){
           $allowed_blocks = [];
           $allowed_blocks = array(
               'fast-form/ff-text-block',
               'fast-form/ff-email-block',
               'fast-form/ff-custom-field-block',
               'fast-form/ff-button-block',
               'fast-form/ff-pagebreak-block',
               'fast-form/ff-paragraph-block',
               'fast-form/ff-heading-block',
               'fast-form/ff-textarea-block',
               'fast-form/ff-radio-block',
               'fast-form/ff-checkbox-block',
               'fast-form/ff-select-block',
               'fast-form/ff-address-block',
               'fast-form/ff-separator-block',
               'fast-form/ff-product-block',
               'fast-form/ff-order-bump-block',
               'fast-form/ff-password-block',
               'fast-form/ff-upload-block',
               'core/columns'
           );
           if (in_array('woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )){
              $allowed_blocks[] = 'fast-flow/wc-products-block';
              $allowed_blocks[] = 'fast-flow/wc-credit-products-block';
           }
           return $allowed_blocks;
         }
         return $allowed_blocks;
       }

       public function fast_forms_after_setup_theme(){
         global $pagenow;
         if ( ('post.php' === $pagenow && isset($_GET['post']) && 'fast-forms' === get_post_type( $_GET['post'] )) || ('post-new.php' === $pagenow && isset($_GET['post_type']) && $_GET['post_type'] == 'fast-forms') ) {
           remove_theme_support( 'core-block-patterns' );
         }
       }

       public function fast_forms_wrap_container( $block_content, $block ) {
         global $post;
         if($post->post_type == 'fast-forms'){
           $ff_background_color = get_post_meta( $post->ID, 'ff_background_color', true );
           $ff_border = get_post_meta( $post->ID, 'ff_border', true );
           $ff_border_radius = get_post_meta( $post->ID, 'ff_border_radius', true );
           $ff_border_radius_px = ($ff_border_radius)?$ff_border_radius."px":"";
           $ff_border_color = get_post_meta( $post->ID, 'ff_border_color', true );
           $ff_box_shadow = (get_post_meta( $post->ID, 'ff_box_shadow', true ))?'0px 0px 15px 0px rgba(0,0,0,.5)':'none';
           if ( 'fast-form/ff-pagebreak-block' === $block['blockName'] ) {
             $block_content = sprintf(
               '%1$s</fieldset><fieldset style="background-color: '.$ff_background_color.'; border: '.$ff_border.'; border-radius: '.$ff_border_radius_px.'; border-color: '.$ff_border_color.'; box-shadow: '.$ff_box_shadow.'">',
               $block_content
             );
          }else if ('fast-form/ff-button-block' === $block['blockName']) {
             $block_content = sprintf(
               '<div>%1$s</div>',
               $block_content
             );
           }else if('fast-form/ff-custom-field-block' === $block['blockName']){
             if(isset($block['attrs']['fieldtype']) && $block['attrs']['fieldtype'] == 'hidden'){
               if($_GET[$block['attrs']['fieldname']]){
                 $block_content = str_replace('value=""', 'value="'.$_GET[$block['attrs']['fieldname']].'"', $block_content);
               }else{
                 $block_content = str_replace('value=""', 'value="'.$block['attrs']['placeholder'].'"', $block_content);
               }
             }
             $block_content = sprintf(
               '%1$s',
               $block_content
             );
          }else if ('fast-form/ff-email-block' === $block['blockName']) {
            if(is_user_logged_in()){
              $block_content = str_replace('required', '', $block_content);
            }
            $block_content = sprintf(
              '<div>%1$s</div>',
              $block_content
            );

          }else{
              $block_content = sprintf(
                '<div>%1$s</div>',
                $block_content
              );
            }
         }
         return $block_content;
       }

       public function fast_forms_gutenberg_filter(){
          add_filter( 'the_content', array($this, 'fast_forms_display_callback'), 99, 1);
       }

       public function fast_forms_shortcode($atts){
         $attr = shortcode_atts( array(
             'id' => 0,
         ), $atts );
         $content = $this->generate_fast_forms($attr);
         return $content;
       }

       public function generate_fast_forms($data){
         $rendered_content = '';
         if($data['id']){
           $post = get_post($data['id']);
           if($post->post_type == 'fast-forms'){
             $blocks = array_filter( parse_blocks( $post->post_content ), array($this, 'fast_forms_filter_parse_blocks') );
             $post_content = '';
             $ff_background_color = get_post_meta( $post->ID, 'ff_background_color', true );
             $ff_border = get_post_meta( $post->ID, 'ff_border', true );
             $ff_border_radius = get_post_meta( $post->ID, 'ff_border_radius', true );
             $ff_border_color = get_post_meta( $post->ID, 'ff_border_color', true );
             $ff_box_shadow = (get_post_meta( $post->ID, 'ff_box_shadow', true ))?'0px 0px 15px 0px rgba(0,0,0,.5)':'none';
             $ff_border_radius_px = ($ff_border_radius)?$ff_border_radius."px":"";
             if($blocks){
               foreach($blocks as $bk => $block){
                 if ( 'fast-form/ff-pagebreak-block' === $block['blockName'] ) {
                   $is_visible = $this->checkVisibility($block);
                   if($is_visible){
                     $post_content .= sprintf(
                       '%1$s</fieldset><fieldset style="background-color: '.$ff_background_color.'; border: '.$ff_border.'; border-radius: '.$ff_border_radius_px.'; border-color: '.$ff_border_color.'; box-shadow: '.$ff_box_shadow.'">',
                       $block['innerHTML']
                     );
                   }
                 }else if('core/columns' === $block['blockName'] ){
                   $core_columns_post_content = '';
                   foreach($block['innerBlocks'] as $inner_block){
                     $core_columns_in_post_content = '';
                     foreach($inner_block['innerBlocks'] as $in_block){
                       if ( 'fast-form/ff-pagebreak-block' === $in_block['blockName'] ) {
                         $is_visible = $this->checkVisibility($in_block);
                         if($is_visible){
                           $core_columns_in_post_content .= sprintf(
                             '%1$s</fieldset><fieldset>',
                             $in_block['innerHTML']
                           );
                         }
                       }else if ('fast-form/ff-button-block' === $in_block['blockName']) {
                         $is_visible = $this->checkVisibility($in_block);
                         if($is_visible){
                           $emails_hidden_input = '';
                           if(array_key_exists('submission_emails', $in_block['attrs']) && !empty($in_block['attrs']['submission_emails'])){
                             $emails_hidden_input = '<input type="hidden" name="submission_mails" value="'.$in_block['attrs']['submission_emails'].'">';
                           }
                           $core_columns_in_post_content .= sprintf(
                             '<div>%1$s %2$s</div>',
                             $in_block['innerHTML'], $emails_hidden_input
                           );
                         }
                       }else if('fast-form/ff-custom-field-block' === $in_block['blockName']){
                         if(isset($in_block['attrs']['fieldtype']) && $in_block['attrs']['fieldtype'] == 'hidden'){
                           if(isset($_GET[$in_block['attrs']['fieldname']]) && !empty($_GET[$in_block['attrs']['fieldname']])){
                             $is_visible = $this->checkVisibility($in_block);
                             if($is_visible){
                               $core_columns_in_post_content .= str_replace('value=""', 'value="'.$_GET[$in_block['attrs']['fieldname']].'"', $in_block['innerHTML']);
                             }
                           }else{
                             if(array_key_exists('placeholder', $in_block['attrs'])){
                               $is_visible = $this->checkVisibility($in_block);
                               if($is_visible){
                                 $core_columns_in_post_content .= str_replace('value=""', 'value="'.$in_block['attrs']['placeholder'].'"', $in_block['innerHTML']);
                               }
                             }
                           }
                         }else{
                           $is_visible = $this->checkVisibility($in_block);
                           if($is_visible){
                             $core_columns_in_post_content .= sprintf(
                               '<div>%1$s</div>',
                               $in_block['innerHTML']
                             );
                           }
                         }
                       }else if('fast-form/ff-textarea-block' === $in_block['blockName']){
                         $is_visible = $this->checkVisibility($in_block);
                         if($is_visible){
                            $core_columns_in_post_content .= sprintf(
                              '<div>%1$s</div>',
                              $in_block['innerHTML'], ($in_block['attrs']['char_limit'])?$in_block['attrs']['char_limit']:50
                            );
                         }
                       }else if('fast-form/ff-email-block' === $in_block['blockName']){
                         $is_visible = $this->checkVisibility($in_block);
                         if($is_visible){
                           $email = '';
                           if(is_user_logged_in()){
                             $current_user = wp_get_current_user();
                             $email = $current_user->user_email;
                             $in_block['innerHTML'] = str_replace('required', '', $in_block['innerHTML']);
                           }
                           $core_columns_in_post_content .= sprintf(
                             '<div>%1$s</div>',
                             str_replace('value=""', 'value="'.$email.'"', $in_block['innerHTML'])
                           );
                         }
                       }else if('fast-form/ff-text-block' === $in_block['blockName']){
                         if($in_block['attrs']['fieldname'] == 'name'){
                           $is_visible = $this->checkVisibility($in_block);
                           if($is_visible){
                             $name = '';
                             if(is_user_logged_in()){
                               $current_user = wp_get_current_user();
                               $name = $current_user->display_name;
                             }
                             $core_columns_in_post_content .= sprintf(
                               '<div>%1$s</div>',
                               str_replace('value=""', 'value="'.$name.'"', $in_block['innerHTML'])
                             );
                           }
                         }else{
                           $is_visible = $this->checkVisibility($in_block);
                           if($is_visible){
                              $core_columns_in_post_content .= sprintf(
                                '<div>%1$s</div>',
                                $in_block['innerHTML']
                              );
                           }
                         }
                       }else {
                         $is_visible = $this->checkVisibility($in_block);
                         if($is_visible){
                            $core_columns_in_post_content .= sprintf(
                              '<div>%1$s</div>',
                              $in_block['innerHTML']
                            );
                         }
                       }
                     }
                     $core_columns_post_content .= sprintf(
                       '<div class="wp-block-column">%1$s</div>',
                       $core_columns_in_post_content
                     );
                   }
                   $post_content .= sprintf(
                     '<div class="wp-block-columns">%1$s</div>',
                     $core_columns_post_content
                   );
                 }else if ('fast-form/ff-button-block' === $block['blockName']) {
                   $is_visible = $this->checkVisibility($block);
                   if($is_visible){
                     $emails_hidden_input = '';
                     if(array_key_exists('submission_emails', $block['attrs']) && !empty($block['attrs']['submission_emails'])){
                       $emails_hidden_input = '<input type="hidden" name="submission_mails" value="'.$block['attrs']['submission_emails'].'">';
                     }
                     $post_content .= sprintf(
                       '<div>%1$s %2$s</div>',
                       $block['innerHTML'], $emails_hidden_input
                     );

                   }
                 }else if('fast-form/ff-custom-field-block' === $block['blockName']){
                   if(isset($block['attrs']['fieldtype']) && $block['attrs']['fieldtype'] == 'hidden'){
                     if(isset($_GET[$block['attrs']['fieldname']]) && !empty($_GET[$block['attrs']['fieldname']])){
                       $is_visible = $this->checkVisibility($block);
                       if($is_visible){
                        $post_content .= str_replace('value=""', 'value="'.$_GET[$block['attrs']['fieldname']].'"', $block['innerHTML']);
                       }
                     }else{
                       if(array_key_exists('placeholder', $block['attrs'])){
                         $is_visible = $this->checkVisibility($block);
                         if($is_visible){
                           $post_content .= str_replace('value=""', 'value="'.$block['attrs']['placeholder'].'"', $block['innerHTML']);
                         }
                       }
                     }
                   }else{
                     $is_visible = $this->checkVisibility($block);
                     if($is_visible){
                       $post_content .= sprintf(
                         '<div>%1$s</div>',
                         $block['innerHTML']
                       );
                     }
                   }
                 }else if('fast-form/ff-textarea-block' === $block['blockName']){
                   $is_visible = $this->checkVisibility($block);
                   if($is_visible){
                     $post_content .= sprintf(
                       '<div>%1$s</div>',
                       $block['innerHTML'], ($block['attrs']['char_limit'])?$block['attrs']['char_limit']:50
                     );
                   }
                 }else if('fast-form/ff-email-block' === $block['blockName']){
                   $is_visible = $this->checkVisibility($block);
                   if($is_visible){
                     $email = '';
                     if(is_user_logged_in()){
                       $current_user = wp_get_current_user();
                       $email = $current_user->user_email;
                       $block['innerHTML'] = str_replace('required', '', $block['innerHTML']);
                     }
                     $post_content .= sprintf(
                       '<div>%1$s</div>',
                       str_replace('value=""', 'value="'.$email.'"', $block['innerHTML'])
                     );
                   }
                 }else if('fast-form/ff-text-block' === $block['blockName']){
                   if(isset($block['attrs']['fieldname']) && ($block['attrs']['fieldname'] == 'name')){
                      $is_visible = $this->checkVisibility($block);
                      if($is_visible){
                        $name = '';
                        if(is_user_logged_in()){
                          $current_user = wp_get_current_user();
                          $name = $current_user->display_name;
                        }
                        $post_content .= sprintf(
                          '<div>%1$s</div>',
                          str_replace('value=""', 'value="'.$name.'"', $block['innerHTML'])
                        );
                      }
                   }else{
                     $is_visible = $this->checkVisibility($block);
                     if($is_visible){
                       $post_content .= sprintf(
                         '<div>%1$s</div>',
                         $block['innerHTML']
                       );
                     }
                   }

                 }else{
                   $is_visible = $this->checkVisibility($block);
                   if($is_visible){
                     $post_content .= sprintf(
                       '<div>%1$s</div>',
                       $block['innerHTML']
                     );
                   }
                 }
               }
             }
             $blockNames = array_column($blocks, 'blockName');
             $ismultistep = false;
             if(in_array('fast-form/ff-pagebreak-block', $blockNames)){
               $ismultistep = true;
             }
             wp_enqueue_style('ff_style');
             wp_localize_script('ff_script', 'myajax', array('ajaxurl' => admin_url('admin-ajax.php'), 'ismultistep' => $ismultistep));
             wp_enqueue_script('ff_script');

             $ff_width = get_post_meta( $post->ID, 'ff_width', true );
             $id = 'fast_form_'.$post->ID;
             $ff_width_px = ($ff_width)?$ff_width."px":"inherit";
             $rendered_content .= '<form class="fast_forms" method="POST" id="'.$id.'" style="max-width: '.$ff_width_px.'" enctype="multipart/form-data">';
             $rendered_content .= '<fieldset style="background-color: '.$ff_background_color.'; border: '.$ff_border.'; border-radius: '.$ff_border_radius_px.'; border-color: '.$ff_border_color.'; box-shadow: '.$ff_box_shadow.'">';
             $rendered_content .= '<input type="hidden" value="'.$post->ID.'" name="ID">';
             $rendered_content .= $post_content;
             if ( ! function_exists( 'is_plugin_active' ) ){
               require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
             }
             if ( is_plugin_active( 'fastmember/fastmember.php' ) || is_plugin_active( 'fastmember-pro/fastmember-pro.php' ) || is_plugin_active( 'woocommerce/woocommerce.php' )) {
               //$ff_product = get_post_meta( $post->ID, 'ff_product', true );
               $ff_payment = get_post_meta( $post->ID, 'ff_payment', true );
               $ff_paymentArr = explode(',', $ff_payment);
               /***********************************Payments ******************************/
               if(in_array('stripe', $ff_paymentArr) || in_array('paypal', $ff_paymentArr)){
                 $cardholder_name = $fast_stripe_sca_email = '';
                 if(is_user_logged_in()){
                   $current_user = wp_get_current_user();
                   $cardholder_name = esc_html($current_user->display_name);
                   $fast_stripe_sca_email = $current_user->user_email;
                 }
                 $rendered_content .= '<div>';
                 $rendered_content .= '<input id="cardholder-name" type="hidden" name="cardholder_name" value="'.$cardholder_name.'">';
                 $rendered_content .= '<input id="cardholder-email" type="hidden" name="fast_stripe_sca_email" value="'.$fast_stripe_sca_email.'">';
                 /*if( strpos($ff_product, ',') !== false ) {
                   $prodArr = explode(',', $ff_product);
                   global $wpdb;
                   foreach($prodArr as $k => $prod){
                     $prod_data = $wpdb->get_row( "SELECT * FROM ".$wpdb->prefix."wpbn_products WHERE id = ".$prod."" );
                     $checked = ($k==0)?'checked="checked"':'';
                     $rendered_content .= '<div class="ff-product-wrap"><input type="radio" name="product_id" id="ff_product_'.$k.'" value="'.$prod.'" '.$checked.'/><label for="ff_product_'.$k.'">'.$prod_data->title.'</label></div>';
                    }
                 }else{
                   $rendered_content .= '<input id="product-id" type="hidden" name="product_id" value="'.$ff_product.'">';
                 }*/
                 $rendered_content .= '</div>';
               }
               /***********************************Stripe SCA******************************/
               if(in_array('stripe', $ff_paymentArr)){
                 $cards_content = do_shortcode('[fast-stripe-sca-user-cards]');
                 $style = ($cards_content)?'display:none':'display:block';
                 $ff_stripe_btn_text = (get_post_meta( $post->ID, 'ff_stripe_btn_text', true ))?get_post_meta( $post->ID, 'ff_stripe_btn_text', true ):'Order Now';
                 $ff_stripe_btn_color = (get_post_meta( $post->ID, 'ff_stripe_btn_color', true ))?get_post_meta( $post->ID, 'ff_stripe_btn_color', true ): '#FF5733';
                 $rendered_content .= '<div class="stripe_sca">';
                 $rendered_content .= '<div class="payment-source">';
                 $rendered_content .= $cards_content;
                 $rendered_content .= '</div>';
                 $rendered_content .= '<div id="card-element" style ="'.$style.'"></div>';
                 $rendered_content .= '<div class="cards_img"><img src="'.plugins_url('assets/public/images/cards.png', __FILE__).'"></div>';
                 $rendered_content .= '<button id="card-button" class="action-button submit" style="background-color:'.$ff_stripe_btn_color.'" data-secret="" type="button" >'.$ff_stripe_btn_text.'</button>';
                 $rendered_content .= '<div id="card-errors" role="alert"></div>';
                 $rendered_content .= '</div>';
               }

               /***********************************PayPal Smart Button Action ******************************/
               if(in_array('paypal', $ff_paymentArr)){
                 $rendered_content .= do_shortcode('[pp_smart_pay product_id=""]');
               }

               /***********************************Credit Purchase Button Action ******************************/
               if(in_array('fwc_fast_credit', $ff_paymentArr)){
                $rendered_content .= '<div><button type="submit" name="fwc_fast_credit" style="background:#000000;color:#ffffff;width:40%" data-blockname="credit-purchase">Credit Purchase</button><div class="initial-errors"></div></div>';
              }

               if(in_array('stripe', $ff_paymentArr) || in_array('paypal', $ff_paymentArr) || in_array('fwc_fast_credit', $ff_paymentArr)){
                 $rendered_content .= $this->fast_forms_order_amount();
               }
               /***********************************Payments ******************************/
             }

             $rendered_content .= '</fieldset>';
             $rendered_content .= '</form>';
           }
         }
         return $rendered_content;
       }

    }

}

new FastForms();
