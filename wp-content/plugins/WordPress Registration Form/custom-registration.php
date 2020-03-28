<?php
/*
  Plugin Name: WordPress Registration Form
  Description: Custom registration form using shortcode and script as well
  Version: 1.x
  Author: Ivaylo Tokiev
*/

require_once(dirname(__FILE__) . '/cr_init.phtml');
require_once(dirname(__FILE__) . '/cr_register_methods.php');
require_once(dirname(__FILE__) . '/cr_shortcode_methods.php');
require_once(dirname(__FILE__) . '/cr_action_methods.php');


//This loads the custom css file in this plugin
add_action('wp_enqueue_scripts', 'my_custom_register_stylesheet');

add_shortcode('wp_registration_form', 'wp_custom_shortcode_registration');

//Custom Validation Field Method
add_filter('registration_errors', 'custom_validation_error_method', 10, 3);