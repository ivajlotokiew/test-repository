<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 24.3.2020 г.
 * Time: 13:40
 */

//add_shortcode('wp_registration_form', 'wp_custom_shortcode_registration');
function wp_custom_shortcode_registration()
{
    ob_start();
    wordpress_custom_registration_form_function();
    return ob_get_clean();
}