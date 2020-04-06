<?php
/**
 * Created by PhpStorm.
 * User: ivaylo
 * Date: 6.4.2019 г.
 * Time: 13:39
 */

namespace Src\Responses;


class StatusResponse
{
    const SUCCESS = 200;
    const CREATED = 201;
    const REDIRECTION = 300;
    const CLIENT_ERROR = 400;
    const SERVER_ERROR = 500;
}