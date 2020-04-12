<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 4.4.2020 г.
 * Time: 15:29
 */

namespace Src;


use Src\Controllers\CategoryController;
use Src\Controllers\ProductController;

class PageShortcodeMethods
{
    //add_shortcode('products_products_page', 'Src\PageShortcodeMethods::products_products_page')
    static function products_products_page()
    {
        $params = [];
        $pController = new ProductController();
        $products = $pController->getAllProductsAction(['offset' => 0, 'length' => 8]);
        $params['products'] = $products;
        $cController = new CategoryController();
        $categories = $cController->getAllCategoriesAction();
        $params['categories'] = $categories;

        $view_path = dirname(__FILE__) . '/views/products_page.phtml';

        return ProductsInit::products_render_view($view_path, $params);
    }

//    add_shortcode('products_search_page', 'Src\PageShortcodeMethods::products_search_page')
    static function products_search_page()
    {
        $params = [];
        $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_STRING);
        $pController = new ProductController();
        $products = $pController->getAllProductsAction(['search' => $search]);
        $params['products'] = $products;

        $view_path = dirname(__FILE__) . '/views/search-page.phtml';

        return ProductsInit::products_render_view($view_path, $params);
    }
}