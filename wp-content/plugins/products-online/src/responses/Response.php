<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 6.4.2019 г.
 * Time: 13:47
 */

namespace Src\Responses;


class Response implements ResponseInterface
{
    public function response_success($responseCode, $data = array())
    {
        return $this->Send($responseCode, $data);
    }

    public function response_error($responseCode, $data = array())
    {
        return $this->Send($responseCode, $data);
    }

    private function Send($responseCode, $data = array())
    {
        http_response_code($responseCode);
        return $data;
    }
}