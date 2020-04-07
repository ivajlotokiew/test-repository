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
//        check_ajax_referer('title_example');

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
    static function get_product()
    {
//        check_ajax_referer('title_example');

        if (!isset($_REQUEST['id'])) {
            ProductsAjaxMethods::ajax_error_response('Product id is not provided');
        }

        $params = [];
        $params['id'] = $_REQUEST['id'];
        $controller = new ProductController();
        $result = $controller->getProductAction($params);

        echo json_encode($result);

        wp_die();
    }

    //add_action('wp_ajax_delete_product', 'Src\ProductsAjaxMethods::delete_product');
    static function delete_product()
    {
//        check_ajax_referer('title_example');

        $params = [];
        isset($_REQUEST['id']) ?
            $params['id'] = $_REQUEST['id'] :
            ProductsAjaxMethods::ajax_error_response('Missing id!');

        $controller = new ProductController();
        $result = $controller->deleteProductAction($params);

        echo json_encode($result);

        wp_die();
    }


    //add_action('wp_ajax_edit_product', 'Src\ProductsAjaxMethods::edit_product');
    static function edit_product()
    {
        $params = [];
        isset($_REQUEST['id']) ?
            $params['id'] = $_REQUEST['id'] :
            ProductsAjaxMethods::ajax_error_response('Missing id!');

        isset($_REQUEST['name']) ?
            $params['name'] = $_REQUEST['name'] :
            ProductsAjaxMethods::ajax_error_response('Missing name!');

        isset($_REQUEST['price']) ?
            $params['price'] = $_REQUEST['price'] :
            ProductsAjaxMethods::ajax_error_response('Missing price!');

        isset($_REQUEST['category_id']) ?
            $params['category_id'] = $_REQUEST['category_id'] :
            ProductsAjaxMethods::ajax_error_response('Missing category id!');

        $controller = new ProductController();
        $result = $controller->editProductAction($params);

        echo json_encode($result);

        die();
    }
}




