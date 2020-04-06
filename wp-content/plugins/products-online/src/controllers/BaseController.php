<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 5.4.2020 г.
 * Time: 22:15
 */

namespace Src\Controllers;


use Src\Responses\Response;

abstract class BaseController
{
    private $response;

    /**
     * BaseController constructor.
     */
    public function __construct()
    {
        $this->setResponse(new Response());
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param mixed $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
}