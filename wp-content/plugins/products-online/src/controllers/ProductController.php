<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 5.4.2020 г.
 * Time: 21:54
 */

namespace Src\Controllers;

use Src\Responses\StatusResponse;
use Src\Services\ProductService;

class ProductController extends BaseController
{
    function getAllProductsAction(array $params)
    {
        if (!isset($params['offset'])) {
            $offset = 0;
        } else {
            $offset = $params['offset'];
        }

        if (!isset($params['length'])) {
            $length = 10;
        } else {
            $length = $params['length'];
        }

        $controller = new ProductService();
        $result = $controller->getAllProducts($offset, $length);

        if (!$result) {
            return $this->getResponse()->json_error(
                StatusResponse::SERVER_ERROR,
                array("message " => "Could not return products!"));
        }

        return $this->getResponse()->json_success(StatusResponse::SUCCESS, $result);
    }

    function getProduct(array $params)
    {
        $id = $params['id'];
        $service = new ProductService();
        $result = $service->getProductById($id);

        if (!$result) {
            return $this->getResponse()->json_error(
                StatusResponse::SERVER_ERROR, array("message " => "Could not return searched product!"));
        }

        return $this->getResponse()->json_success(StatusResponse::SUCCESS, $result);
    }
}