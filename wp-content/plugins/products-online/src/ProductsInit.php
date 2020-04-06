<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 4.4.2020 г.
 * Time: 14:44
 */

namespace Src;


class ProductsInit
{
    static function init()
    {
        wp_enqueue_style('products_custom_css', plugin_dir_url(__FILE__) . '../assets/css/products-custom.css');
        wp_enqueue_style('bootbox_css', plugin_dir_url(__FILE__) . '../assets/css/bootstrap.min.css');
        wp_enqueue_script('jquery_script', plugin_dir_url(__FILE__) . '../assets/js/jquery-3.4.1.min.js', array('jquery'), '3.4.1', true);
        wp_enqueue_script('bootstrap_script', plugin_dir_url(__FILE__) . '../assets/js/bootstrap.min.js', array(), 'v4.1.3', true);
        wp_enqueue_script('bootbox-min_script', plugin_dir_url(__FILE__) . '../assets/js/bootbox.min.js', array(), '5.1.1', true);
    }

    static function my_enqueue()
    {
        wp_enqueue_script( 'ajax-script',
            plugins_url( '../assets/js/products-custom.js', __FILE__ ),
            array('jquery')
        );

        $title_nonce = wp_create_nonce('title_example');
        wp_localize_script('ajax-script', 'ajax_object', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce'    => $title_nonce,
        ));

        wp_localize_script('ajax-script', 'siteUrl', array('pluginDir' => plugin_dir_url(__FILE__)));
    }

    static function products_render_view($path, $params = [])
    {
        ob_start();
        include($path);
        $view = ob_get_contents();
        ob_end_clean();
        return $view;
    }

}