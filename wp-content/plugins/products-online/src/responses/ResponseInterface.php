<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 6.4.2019 г.
 * Time: 14:06
 */

namespace Src\Responses;


interface ResponseInterface
{
    public function json_success($responseCode, $data = array());

    public function json_error($responseCode, $data = array());
}