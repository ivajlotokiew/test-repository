<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 4.4.2020 г.
 * Time: 23:28
 */

namespace Src;


use Src\Controllers\ProductController;

class ProductsAjaxMethods
{
    static function ajax_error_response($message = 'Invalid or missing parameters.', $errorStatusCode = 400)
    {
        http_response_code($errorStatusCode);
        echo json_encode(array('status' => 'error', 'message' => $message));
        die();
    }

    //add_action('wp_ajax_get_all_products', 'Src\ProductsAjaxMethods::get_all_products');
    static function get_all_products()
    {
        check_ajax_referer('title_example');

        if (!isset($_REQUEST['offset'])) {
           ProductsAjaxMethods::ajax_error_response('Missing offset parameter!');
        }

        if (!isset($_REQUEST['length'])) {
            ProductsAjaxMethods::ajax_error_response('Missing length parameter!');
        }

        $params = [];
        $params['offset'] = $_REQUEST['offset'];
        $params['length'] = $_REQUEST['length'];
        $controller = new ProductController();
        $result = $controller->getAllProductsAction($params);

        echo json_encode($result);

        wp_die();
    }

    //add_action('wp_ajax_get_product', 'Src\ProductsAjaxMethods::get_product');
    static function get_product() {
        check_ajax_referer('title_example');

        if (!isset($_REQUEST['id'])) {
            ProductsAjaxMethods::ajax_error_response('Product id is not provided');
        }

        $params = [];
        $params['id'] = $_REQUEST['id'];
        $controller = new ProductController();
        $result = $controller->getProduct($params);

        echo json_encode($result);

        wp_die();
    }

}




