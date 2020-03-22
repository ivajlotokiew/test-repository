<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 19.4.2019 г.
 * Time: 17:14
 */

require_once(dirname(__FILE__) . '/combat_api.php');

//add_shortcode('combat_home_page', 'combat_home_page');
function combat_home_page()
{
    $view_path = dirname(__FILE__) . '/../views/home_page.phtml';
    return combat_render_view($view_path, null);
}

//add_shortcode('combat_products_page', 'combat_products_page');
function combat_products_page()
{
    $products = combat_call_api("product/allProducts", ['offset' => 0, 'length' => 8]);
    $params['products'] = $products['body'];

    $categories = combat_call_api("category/allCategories");
    $params['categories'] = $categories['body'];

    $view_path = dirname(__FILE__) . '/../views/products_page.phtml';

    return combat_render_view($view_path, $params);
}