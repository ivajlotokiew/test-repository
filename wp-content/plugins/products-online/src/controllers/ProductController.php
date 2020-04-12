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
    /**
     * @param array $params
     * @return mixed
     */
    function getAllProductsAction(array $params)
    {
        if (!isset($params['offset'])) {
            $params['offset'] = 0;
        }

        if (!isset($params['length'])) {
            $params['length'] = PHP_INT_MAX;
        }

        if (!isset($params['search'])) {
            $params['search'] = NULL;
        }

        $controller = new ProductService();
        $result = $controller->getAllProducts($params);

        if ($result === false) {
            return $this->getResponse()->response_error(
                StatusResponse::SERVER_ERROR,
                array("message " => "Could not return products!"));
        }

        return $this->getResponse()->response_success(StatusResponse::SUCCESS, $result);
    }

    function getProductAction(array $params)
    {
        $id = $params['id'];
        $service = new ProductService();
        $result = $service->getProductById($id);

        if (!$result) {
            return $this->getResponse()->response_error(
                StatusResponse::SERVER_ERROR, array("message " => "Could not return searched product!"));
        }

        return $this->getResponse()->response_success(StatusResponse::SUCCESS, $result);
    }

    function deleteProductAction(array $params)
    {
        $id = $params['id'];

        $service = new ProductService();
        $result = $service->deleteProductById($id);

        if (!$result) {
            return $this->getResponse()->response_error(
                StatusResponse::SERVER_ERROR, array("message " => "Failed to delete or there is no product with this id!"));
        }

        return $this->getResponse()->response_success(StatusResponse::SUCCESS, ['message' => 'Successfully deleted product!']);
    }

    function editProductAction(array $params)
    {
        $service = new ProductService();
        $result = $service->editProduct($params);

        if (!$result) {
            return $this->getResponse()->response_error(
                StatusResponse::SERVER_ERROR, array("message " => "Failed edit product!"));
        }

        return $this->getResponse()->response_success(StatusResponse::SUCCESS, ['message' => 'Successfully edited product!']);
    }
}