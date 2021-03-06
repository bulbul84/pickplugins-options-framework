<?php
/*
Plugin Name: PickPlugins Options Framework
Plugin URI: https://www.pickplugins.com/
Description: Less work to build options page for settings page, meta box, taxonomy edit, user profile edit,
customizer fields.
Version: 1.0.0
Text Domain: pickplugins-options-framework
Domain Path: /languages
Author: PickPlugins
Author URI: http://pickplugins.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 



class pickpluginsOptionsFramework{

    public function __construct(){

        $this->define_constants();
        $this->declare_classes();
        $this->load_script();
        $this->load_functions();

        //register_activation_hook( __FILE__, array( $this, 'activation' ) );
        //add_action( 'plugins_loaded', array( $this, 'textdomain' ));

    }

    public function activation() {



    }

    public function textdomain() {

        $locale = apply_filters( 'plugin_locale', get_locale(), 'pickplugins-options-framework' );
        load_textdomain('pickplugins-options-framework', WP_LANG_DIR .'/pickplugins-options-framework/form-fields-generator-'. $locale .'.mo' );
        load_plugin_textdomain( 'pickplugins-options-framework', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
    }



    public function load_functions() {

        require_once( FFG_PLUGIN_DIR . 'functions/functions-customizer-edit.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-basic-form.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-menu-page.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-meta-box.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-taxonomy-edit.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-user-profile-edit.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-theme-page.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-tools.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-create-user-form.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-create-post-type.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-create-taxonomy.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-create-user.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-media-upload-by-url.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-conditional-fields.php');

        require_once( FFG_PLUGIN_DIR . 'functions/functions-create-sidebars.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-create-post-status.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-create-nav-menus.php');
        require_once( FFG_PLUGIN_DIR . 'functions/functions-insert-post.php');

        require_once( FFG_PLUGIN_DIR . 'functions/functions-create-dashboard-widget.php');


    }


    public function load_script() {

        add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
        add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
    }



    public function declare_classes() {

        require_once( FFG_PLUGIN_DIR . 'classes/class-customizer-custom-control.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-form-fields-generator.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-menu-page.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-meta-box.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-taxonomy-edit.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-user-profile-edit.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-theme-page.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-customizer-edit.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-create-user-form.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-create-post-type.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-create-taxonomy.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-create-taxonomy.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-create-user.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-media-upload-by-url.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-create-sidebars.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-create-post-status.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-create-nav-menus.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-insert-post.php');
        require_once( FFG_PLUGIN_DIR . 'classes/class-create-dashboard-widget.php');



    }

    public function define_constants() {

        $this->define('FFG_PLUGIN_URL', plugins_url('/', __FILE__)  );
        $this->define('FFG_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
        $this->define('FFG_PLUGIN_NAME', __('PickPlugins Options Framework', 'pickplugins-options-framework') );
        $this->define('FFG_PLUGIN_SUPPORT', 'http://www.pickplugins.com/questions/'  );

    }

    private function define( $name, $value ) {
        if( $name && $value )
            if ( ! defined( $name ) ) {
                define( $name, $value );
            }
    }





    public function front_scripts(){

        wp_enqueue_script('jquery');
        wp_enqueue_script( 'jquery-ui-core' );
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );

        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style('fontawesome', FFG_PLUGIN_URL.'css/fontawesome.min.css');
        wp_enqueue_style('fieldsGenerator', FFG_PLUGIN_URL.'css/fieldsGenerator.css');
        wp_enqueue_style('codemirror.min', FFG_PLUGIN_URL.'css/codemirror.css');

        wp_enqueue_style('select2.min', FFG_PLUGIN_URL.'css/select2.min.css');
        wp_enqueue_script('select2.min', plugins_url( 'js/select2.min.js' , __FILE__ ) , array( 'jquery' ));

        wp_enqueue_script('codemirror.min', plugins_url( 'js/codemirror.min.js' , __FILE__ ) , array( 'jquery' ),null, false);
        wp_enqueue_script('form-field-dependency', plugins_url( 'js/form-field-dependency.js' , __FILE__ ) , array( 'jquery' ),null, false);


        wp_enqueue_script('FormFieldsGenerator', plugins_url( 'js/FormFieldsGenerator.js' , __FILE__ ) , array( 'jquery' ));
        wp_localize_script( 'FormFieldsGenerator', 'FormFieldsGenerator_ajax', array( 'FormFieldsGenerator_ajaxurl' => admin_url( 'admin-ajax.php')));

    }

    public function admin_scripts(){

        wp_enqueue_script('jquery');
        wp_enqueue_script( 'jquery-ui-core' );
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script( 'wp-color-picker' );
        wp_enqueue_script('jquery-ui-datepicker');
        wp_enqueue_style('fontawesome', FFG_PLUGIN_URL.'css/fontawesome.min.css');

        wp_enqueue_style('menu-page', FFG_PLUGIN_URL.'css/menu-page.css');
        wp_enqueue_style('meta-box', FFG_PLUGIN_URL.'css/meta-box.css');


        wp_enqueue_style('select2.min', FFG_PLUGIN_URL.'css/select2.min.css');
        wp_enqueue_script('select2.min', plugins_url( 'js/select2.min.js' , __FILE__ ) , array( 'jquery' ));

        wp_enqueue_style('fieldsGenerator', FFG_PLUGIN_URL.'css/fieldsGenerator.css');
        wp_enqueue_style('jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css');
        wp_enqueue_script('AdminMenu', plugins_url( 'js/AdminMenu.js' , __FILE__ ) , array( 'jquery' ));

        wp_enqueue_script('form-field-dependency', plugins_url( 'js/form-field-dependency.js' , __FILE__ ) , array( 'jquery' ),null, false);


    }


} new pickpluginsOptionsFramework();