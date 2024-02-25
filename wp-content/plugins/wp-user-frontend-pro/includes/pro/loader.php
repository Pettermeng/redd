<?php

class WPUF_Pro_Loader {

    public function __construct() {

        $this->includes();
        $this->instantiate();

        add_action( 'wpuf_form_buttons_custom', array( $this, 'wpuf_form_buttons_custom_runner' ) );
        add_action( 'wpuf_form_buttons_other', array( $this, 'wpuf_form_buttons_other_runner') );
        add_action( 'wpuf_form_post_expiration', array( $this, 'wpuf_form_post_expiration_runner') );
        add_action( 'wpuf_form_setting', array( $this, 'form_setting_runner' ),10,2 );
        add_action( 'wpuf_form_settings_post_notification', array( $this, 'post_notification_hook_runner') );
        add_action( 'wpuf_edit_form_area_profile', array( $this, 'wpuf_edit_form_area_profile_runner' ) );
        add_action( 'wpuf_add_profile_form_top', array( $this, 'wpuf_add_profile_form_top_runner' ), 10, 2 );
        add_action( 'registration_setting' , array($this,'registration_setting_runner') );
        add_action( 'wpuf_check_post_type' , array( $this, 'wpuf_check_post_type_runner' ),10,2 );
        add_action( 'wpuf_form_custom_taxonomies', array( $this, 'wpuf_form_custom_taxonomies_runner' ) );
        add_action( 'wpuf_conditional_field_render_hook', array( $this, 'wpuf_conditional_field_render_hook_runner' ), 10, 3 );

        //subscription
        add_action( 'wpuf_admin_subscription_detail', array($this, 'wpuf_admin_subscription_detail_runner'), 10, 4 );
        add_action( 'wpuf_update_subscription_pack', array( $this, 'wpuf_update_subscription_pack_runner' ), 10, 2 );
        add_filter( 'wpuf_get_subscription_meta' , array( $this, 'wpuf_get_subscription_meta_runner' ),10, 2 ) ;

        add_filter( 'wpuf_new_subscription', array( $this, 'wpuf_new_subscription_runner' ), 10, 4 );

        //coupon
        add_action( 'wpuf_coupon_settings_form', array($this, 'wpuf_coupon_settings_form_runner'),10,1 );
        add_action( 'wpuf_check_save_permission', array($this, 'wpuf_check_save_permission_runner'),10,2 );

        //render_form
        add_action( 'wpuf_render_pro_repeat', array( $this, 'wpuf_render_pro_repeat_runner' ),10,7 );
        add_action( 'wpuf_render_pro_date', array( $this, 'wpuf_render_pro_date_runner' ),10,7 );
        add_action( 'wpuf_render_pro_file_upload', array( $this, 'wpuf_render_pro_file_upload_runner' ),10,7 );
        add_action( 'wpuf_render_pro_map', array( $this, 'wpuf_render_pro_map_runner' ),10,7 );
        add_action( 'wpuf_render_pro_country_list', array( $this, 'wpuf_render_pro_country_list_runner' ),10,7 );
        add_action( 'wpuf_render_pro_numeric_text', array( $this, 'wpuf_render_pro_numeric_text_runner' ),10,7 );
        add_action( 'wpuf_render_pro_address', array( $this, 'wpuf_render_pro_address_runner' ),10,7 );
        add_action( 'wpuf_render_pro_step_start', array( $this, 'wpuf_render_pro_step_start_runner' ),10,9 );
        add_action( 'wpuf_render_pro_recaptcha', array( $this, 'wpuf_render_pro_recaptcha_runner' ),10,9 );
        add_action( 'wpuf_render_pro_really_simple_captcha', array( $this, 'wpuf_render_pro_really_simple_captcha_runner' ),10,9 );
        add_action( 'wpuf_render_pro_action_hook', array( $this, 'wpuf_render_pro_action_hook_runner' ),10,9 );
        add_action( 'wpuf_render_pro_toc', array( $this, 'wpuf_render_pro_toc_runner' ),10,9 );

        //render element form in backend form builder
        add_action('wpuf_admin_field_custom_repeater',array($this,'wpuf_admin_field_custom_repeater_runner'),10,4);
        add_action('wpuf_admin_template_post_repeat_field',array($this,'wpuf_admin_template_post_repeat_field_runner'),10,5);
        add_action('wpuf_admin_field_custom_date',array($this,'wpuf_admin_field_custom_date_runner'),10,4);
        add_action('wpuf_admin_template_post_date_field',array($this,'wpuf_admin_template_post_date_field_runner'),10,5);
        // add_action('wpuf_admin_template_post_image_upload',array($this,'wpuf_admin_template_post_image_upload_runner'),10,5);
        add_action('wpuf_admin_field_custom_file',array($this,'wpuf_admin_field_custom_file_runner'),10,4);
        add_action('wpuf_admin_template_post_file_upload',array($this,'wpuf_admin_template_post_file_upload_runner'),10,5);
        add_action('wpuf_admin_field_custom_map',array($this,'wpuf_admin_field_custom_map_runner'),10,4);
        add_action('wpuf_admin_template_post_google_map',array($this,'wpuf_admin_template_post_google_map_runner'),10,5);
        add_action('wpuf_admin_field_country_select',array($this,'wpuf_admin_field_country_select_runner'),10,4);
        add_action('wpuf_admin_template_post_country_list_field',array($this,'wpuf_admin_template_post_country_list_field_runner'),10,5);
        add_action('wpuf_admin_field_numeric_field',array($this,'wpuf_admin_field_numeric_field_runner'),10,4);
        add_action('wpuf_admin_template_post_numeric_text_field',array($this,'wpuf_admin_template_post_numeric_text_field_runner'),10,5);
        add_action('wpuf_admin_field_address_field',array($this,'wpuf_admin_field_address_field_runner'),10,4);
        add_action('wpuf_admin_template_post_address_field',array($this,'wpuf_admin_template_post_address_field_runner'),10,5);
        add_action('wpuf_admin_field_step_start',array($this,'wpuf_admin_field_step_start_runner'),10,4);
        add_action('wpuf_admin_template_post_step_start',array($this,'wpuf_admin_template_post_step_start_runner'),10,5);
        add_action('wpuf_admin_field_recaptcha',array($this,'wpuf_admin_field_recaptcha_runner'),10,4);
        add_action('wpuf_admin_template_post_recaptcha',array($this,'wpuf_admin_template_post_recaptcha_runner'),10,5);
        add_action('wpuf_admin_field_really_simple_captcha',array($this,'wpuf_admin_field_really_simple_captcha_runner'),10,4);
        add_action('wpuf_admin_template_post_really_simple_captcha',array($this,'wpuf_admin_template_post_really_simple_captcha_runner'),10,5);
        add_action('wpuf_admin_field_action_hook',array($this,'wpuf_admin_field_action_hook_runner'),10,4);
        add_action('wpuf_admin_template_post_action_hook',array($this,'wpuf_admin_template_post_action_hook_runner'),10,5);
        add_action('wpuf_admin_field_toc',array($this,'wpuf_admin_field_toc_runner'),10,4);
        add_action('wpuf_admin_template_post_toc',array($this,'wpuf_admin_template_post_toc_runner'),10,5);

        // admin menu
        add_action( 'wpuf_admin_menu_top', array($this, 'admin_menu_top') );
        add_action( 'wpuf_admin_menu', array($this, 'admin_menu') );

        //render_form
        add_action( 'wpuf_add_post_form_top', array($this, 'wpuf_add_post_form_top_runner'),10,2 );
        add_action( 'wpuf_edit_post_form_top', array($this, 'wpuf_edit_post_form_top_runner'),10,3 );

        //page install
        add_filter( 'wpuf_pro_page_install' , array( $this, 'install_pro_pages' ), 10, 1 );

        //delete post
        add_action( 'trash_post', array( $this, 'delete_post_function' ) );
    }

    public function includes() {
        require_once dirname( __FILE__ ) . '/login.php';
        require_once dirname( __FILE__ ) . '/frontend-form-profile.php';
        require_once dirname( __FILE__ ) . '/updates.php';

        if ( is_admin() ) {
            require_once dirname( __FILE__ ) . '/admin/coupon.php';
            require_once dirname( __FILE__ ) . '/admin/coupon-element.php';
            require_once dirname( __FILE__ ) . '/admin/posting-profile.php';
            require_once dirname( __FILE__ ) . '/admin/template-profile.php';
            require_once dirname( __FILE__ ) . '/admin/pro-page-installer.php';
        }

        //class files to include pro elements
        require_once dirname( __FILE__ ) . '/form.php';
        require_once dirname( __FILE__ ) . '/subscription.php';
        require_once dirname( __FILE__ ) . '/coupons.php';
        require_once dirname( __FILE__ ) . '/render-form.php';
    }

    public function instantiate(){
        WPUF_Login::init();
        new WPUF_Frontend_Form_Profile();

        if ( is_admin() ) {
            new WPUF_Updates();
            new WPUF_Admin_Posting_Profile();
            new WPUF_Admin_Coupon();
            WPUF_Coupons::init();
        }
    }

    function admin_menu_top() {
        $capability = wpuf_admin_role();

        add_submenu_page( 'wpuf-admin-opt', __( 'Registration Forms', 'wpuf' ), __( 'Registration Forms', 'wpuf' ), $capability, 'edit.php?post_type=wpuf_profile' );
    }

    function admin_menu() {
        $capability = wpuf_admin_role();

        add_submenu_page( 'wpuf-admin-opt', __( 'Coupons', 'wpuf' ), __( 'Coupons', 'wpuf' ), $capability, 'edit.php?post_type=wpuf_coupon' );
    }

    public function wpuf_form_buttons_custom_runner() {
        //add formbuilder widget pro buttons
        WPUF_form_element::add_form_custom_buttons();
    }

    public function wpuf_form_buttons_other_runner() {
        WPUF_form_element::add_form_other_buttons();
    }

    public function wpuf_form_post_expiration_runner(){
        WPUF_form_element::render_form_expiration_tab();
    }

    public function form_setting_runner( $form_settings, $post ) {
        WPUF_form_element::add_form_settings_content( $form_settings, $post );
    }

    public function post_notification_hook_runner() {
        WPUF_form_element::add_post_notification_content();
    }

    public function wpuf_edit_form_area_profile_runner() {
        WPUF_form_element::render_registration_form();
    }

    public function registration_setting_runner() {
        WPUF_form_element::render_registration_settings();
    }

    public function wpuf_check_post_type_runner( $post, $update ) {
        WPUF_form_element::check_post_type( $post, $update );
    }

    public function wpuf_form_custom_taxonomies_runner() {
        WPUF_form_element::render_custom_taxonomies_element();
    }

    public function wpuf_conditional_field_render_hook_runner( $field_id, $con_fields, $obj ) {
        WPUF_form_element::render_conditional_field( $field_id, $con_fields, $obj );
    }

    //subscription
    public function wpuf_admin_subscription_detail_runner( $sub_meta, $hidden_recurring_class, $hidden_trial_class, $obj ) {
        WPUF_subscription_element::add_subscription_element( $sub_meta, $hidden_recurring_class, $hidden_trial_class, $obj );
    }

    //coupon
    public function wpuf_coupon_settings_form_runner( $obj ) {
        WPUF_Coupon_Elements::add_coupon_elements( $obj );
    }

    public function wpuf_check_save_permission_runner( $post, $update ) {
        WPUF_Coupon_Elements::check_saving_capability( $post, $update );
    }

    //render_form
    public function wpuf_render_pro_repeat_runner( $form_field, $post_id, $type, $form_id, $form_settings, $classname, $obj ) {
        WPUF_render_form_element::repeat( $form_field, $post_id, $type, $form_id, $classname, $obj );
        $obj->conditional_logic( $form_field, $form_id );
    }
    public function wpuf_render_pro_date_runner( $form_field, $post_id, $type, $form_id, $form_settings, $classname, $obj ){
        WPUF_render_form_element::date( $form_field, $post_id, $type, $form_id, $obj );
        $obj->conditional_logic( $form_field, $form_id );
    }

    public function wpuf_render_pro_file_upload_runner( $form_field, $post_id, $type, $form_id, $form_settings, $classname, $obj ){
        WPUF_render_form_element::file_upload( $form_field, $post_id, $type, $form_id, $obj );
        $obj->conditional_logic( $form_field, $form_id );
    }

    public function wpuf_render_pro_map_runner( $form_field, $post_id, $type, $form_id, $form_settings, $classname, $obj ) {
        WPUF_render_form_element::map( $form_field, $post_id, $type, $form_id, $classname, $obj );
        $obj->conditional_logic( $form_field, $form_id );
    }
    public function wpuf_render_pro_country_list_runner( $form_field, $post_id, $type, $form_id, $form_settings, $classname, $obj ){
        WPUF_render_form_element::country_list( $form_field, $post_id, $type, $form_id, $classname, $obj );
        $obj->conditional_logic( $form_field, $form_id );
    }
    public function wpuf_render_pro_numeric_text_runner( $form_field, $post_id, $type, $form_id, $form_settings, $classname, $obj ){
        WPUF_render_form_element::numeric_text( $form_field, $post_id, $type, $form_id, $classname, $obj );
        $obj->conditional_logic( $form_field, $form_id );
    }
    public function wpuf_render_pro_address_runner( $form_field, $post_id, $type, $form_id, $form_settings, $classname, $obj ){
        WPUF_render_form_element::address_field( $form_field, $post_id, $type, $form_id, $classname, $obj );
        $obj->conditional_logic( $form_field, $form_id );
    }
    public function wpuf_render_pro_step_start_runner( $form_field, $post_id, $type, $form_id, $form_settings, $classname, $obj, $multiform_start, $enable_multistep ) {
        WPUF_render_form_element::step_start( $form_field, $post_id, $type, $form_id, $multiform_start, $enable_multistep, $obj );
        $obj->conditional_logic( $form_field, $form_id );
    }
    public function wpuf_render_pro_recaptcha_runner( $form_field, $post_id, $type, $form_id, $multiform_start, $enable_multistep, $obj ){
        $form_field['name'] = 'recaptcha';
        WPUF_render_form_element::recaptcha( $form_field, $post_id, $form_id);
        $obj->conditional_logic( $form_field, $form_id );
    }
    public function wpuf_render_pro_really_simple_captcha_runner( $form_field, $post_id, $type, $form_id, $multiform_start, $enable_multistep, $obj ){
        $form_field['name'] = 'really_simple_captcha';
        WPUF_render_form_element::really_simple_captcha( $form_field, $post_id, $form_id );
        $obj->conditional_logic( $form_field, $form_id );
    }
    public function wpuf_render_pro_action_hook_runner( $form_field, $post_id, $type, $form_id, $form_settings, $classname, $obj ){
        WPUF_render_form_element::action_hook( $form_field, $form_id, $post_id,  $form_settings );
        $obj->conditional_logic( $form_field, $form_id );
    }
    public function wpuf_render_pro_toc_runner( $form_field, $post_id, $type, $form_id, $multiform_start, $enable_multistep, $obj ){
        WPUF_render_form_element::toc( $form_field, $post_id, $form_id );
        $obj->conditional_logic( $form_field, $form_id );
    }

    //form element's rendering form in backend form builder
    public function wpuf_admin_field_custom_repeater_runner( $type, $field_id, $classname, $obj ) {
       WPUF_form_element::repeat_field( $field_id, 'Custom field: Repeat Field',$classname );
    }
    public function wpuf_admin_template_post_repeat_field_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_form_element::repeat_field( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_custom_date_runner( $type, $field_id, $classname, $obj ){
        WPUF_form_element::date_field( $field_id, 'Custom Field: Date',$classname );
    }
    public function wpuf_admin_template_post_date_field_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_form_element::date_field( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_template_post_image_upload_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_form_element::image_upload( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_custom_file_runner( $type, $field_id, $classname, $obj ){
        WPUF_form_element::file_upload( $field_id, 'Custom field: File Upload', $classname);
    }
    public function wpuf_admin_template_post_file_upload_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_form_element::file_upload( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_custom_map_runner( $type, $field_id, $classname, $obj ){
        WPUF_form_element::google_map( $field_id, 'Custom Field: Google Map',$classname );
    }
    public function wpuf_admin_template_post_google_map_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_form_element::google_map( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_country_select_runner( $type, $field_id, $classname, $obj ){
        WPUF_form_element::country_list_field( $field_id, 'Custom field: Select', $classname );
    }
    public function wpuf_admin_template_post_country_list_field_runner( $name, $count, $input_field, $classname, $obj ) {
        WPUF_form_element::country_list_field( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_numeric_field_runner( $type, $field_id, $classname, $obj ){
        WPUF_form_element::numeric_text_field( $field_id, 'Custom field: Numeric Text', $classname);
    }
    public function wpuf_admin_template_post_numeric_text_field_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_form_element::numeric_text_field( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_address_field_runner( $type, $field_id, $classname, $obj ){
        WPUF_form_element::address_field( $field_id, 'Custom field: Address',$classname);
    }
    public function wpuf_admin_template_post_address_field_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_form_element::address_field( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_step_start_runner( $type, $field_id, $classname, $obj ){
        WPUF_form_element::step_start( $field_id, 'Step Starts', $classname);
    }
    public function wpuf_admin_template_post_step_start_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_form_element::step_start( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_recaptcha_runner( $type, $field_id, $classname, $obj ){
        WPUF_form_element::recaptcha( $field_id, 'reCaptcha', $classname );
    }
    public function wpuf_admin_template_post_recaptcha_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_form_element::recaptcha( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_really_simple_captcha_runner( $type, $field_id, $classname, $obj ){
        WPUF_form_element::really_simple_captcha( $field_id, 'Really Simple Captcha',$classname );
    }
    public function wpuf_admin_template_post_really_simple_captcha_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_form_element::really_simple_captcha( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_action_hook_runner( $type, $field_id, $classname, $obj ){
        WPUF_form_element::action_hook( $field_id, 'Action Hook', $classname );
    }
    public function wpuf_admin_template_post_action_hook_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_form_element::action_hook( $count, $name, $classname, $input_field );
    }

    public function wpuf_admin_field_toc_runner( $type, $field_id, $classname, $obj ){
        WPUF_form_element::toc( $field_id, 'TOC', $classname );
    }
    public function wpuf_admin_template_post_toc_runner( $name, $count, $input_field, $classname, $obj ){
        WPUF_form_element::toc( $count, $name, $classname, $input_field );
    }

    public function wpuf_add_profile_form_top_runner( $form_id, $form_settings ) {
        if ( $form_settings['multistep_progressbar_type'] == 'progressive' ) {
            wp_enqueue_script('jquery-ui-progressbar');
        }
    }

    //render_form
    public function wpuf_add_post_form_top_runner( $form_id, $form_settings ) {
        if ( ! isset( $form_settings['enable_multistep'] ) || $form_settings['enable_multistep'] != 'yes' ) {
            return;
        }

        if ( $form_settings['multistep_progressbar_type'] == 'progressive' ) {
            wp_enqueue_script('jquery-ui-progressbar');
        }
    }

    public function wpuf_edit_post_form_top_runner( $form_id, $post_id, $form_settings ) {

        if ( ! isset( $form_settings['enable_multistep'] ) || $form_settings['enable_multistep'] != 'yes' ) {
            return;
        }

        if ( isset( $form_settings['multistep_progressbar_type'] ) && $form_settings['multistep_progressbar_type'] == 'progressive' ) {
            wp_enqueue_script('jquery-ui-progressbar');
        }
    }

    //install pro version page
    function install_pro_pages( $profile_options ) {
        $wpuf_pro_page_installer = new wpuf_pro_page_installer();
        return $wpuf_pro_page_installer->install_pro_version_pages( $profile_options );
    }


    //update data of pro feature of subscription
    function wpuf_update_subscription_pack_runner( $subscription_id, $post ) {
        WPUF_subscription_element::update_subcription_data( $subscription_id, $post );
    }

    //get subscription meta data
    function wpuf_get_subscription_meta_runner( $meta, $subscription_id ) {
        return WPUF_subscription_element::get_subscription_metadata( $meta, $subscription_id );
    }


    /**
     * update meta of user from the data of pack he has been assigned to
     *
     * @param $subscription_id
     * @param $post
     *
     * @return string
     */
    function wpuf_new_subscription_runner( $user_meta, $user_id, $pack_id, $recurring ) {
        return WPUF_subscription_element::set_subscription_meta_to_user( $user_meta, $user_id, $pack_id, $recurring );
    }

    function delete_post_function( $post_id ) {
        WPUF_subscription_element::restore_post_numbers( $post_id );
    }
}

new WPUF_Pro_Loader();