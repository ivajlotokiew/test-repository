<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 5.4.2020 г.
 * Time: 21:54
 */

namespace Src\Controllers;

use Src\Responses\StatusResponse;
use Src\Services\CategoryService;
use Src\Services\ProductService;

class CategoryController extends BaseController
{
    function getAllCategoriesAction()
    {
        $controller = new CategoryService();
        $result = $controller->getAllCategories();

        if (!$result) {
            return $this->getResponse()->response_error(
                StatusResponse::SERVER_ERROR,
                array("message " => "Could not return categories!"));
        }

        return $this->getResponse()->response_success(StatusResponse::SUCCESS, $result);
    }

    function getProduct(array $params)
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
}