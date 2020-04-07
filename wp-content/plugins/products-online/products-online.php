<?php
/*
Plugin Name: Online products
Plugin URI: https://test.local
Description: Test site for online products shopping
Version: 0.1
Text Domain: test.local
Author: Ivaylo Tokiev
*/

require plugin_dir_path(__FILE__) . 'vendor/autoload.php';

add_action('wp_enqueue_scripts', 'Src\ProductsInit::init');
add_action('init', 'Src\ProductsInit::my_enqueue');

add_action('wp_ajax_nopriv_get_all_products', 'Src\ProductsAjaxMethods::get_all_products');
add_action('wp_ajax_get_all_products', 'Src\ProductsAjaxMethods::get_all_products');

add_action('wp_ajax_nopriv_get_product', 'Src\ProductsAjaxMethods::get_product');
add_action('wp_ajax_get_product', 'Src\ProductsAjaxMethods::get_product');

add_action('wp_ajax_nopriv_delete_product', 'Src\ProductsAjaxMethods::delete_product');
add_action('wp_ajax_delete_product', 'Src\ProductsAjaxMethods::delete_product');

add_action('wp_ajax_nopriv_edit_product', 'Src\ProductsAjaxMethods::edit_product');
add_action('wp_ajax_edit_product', 'Src\ProductsAjaxMethods::edit_product');

add_shortcode('ADMIN', 'Src\AutorizationShortcodes::showAdminContent');

add_shortcode('products_products_page', 'Src\PageShortcodeMethods::products_products_page');

