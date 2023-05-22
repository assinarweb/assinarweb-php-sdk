<?php

namespace AssinarWeb\Api;

use AssinarWeb\Service\LoginService as ServiceLogin;

class Login
{
    private $apiContext;
    private $data;

    public function login(ApiContext $apiContext, $data)
    {
        $serviceLogin = new ServiceLogin();
        return $serviceLogin::login($apiContext, $data);
    }
}