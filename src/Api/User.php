<?php

namespace AssinarWeb\Api;

use AssinarWeb\Service\UserService as ServiceUser;

class User
{
    private $apiContext;
    private $data;

    public function register(ApiContext $apiContext, $data)
    {
        $serviceUser = new ServiceUser();
        return $serviceUser::register($apiContext, $data);
    }

    public function getFullData(ApiContext $apiContext)
    {
        $serviceUser = new ServiceUser();
        return $serviceUser::getFullData($apiContext);
    }


    public function getPhoto(ApiContext $apiContext)
    {
        $serviceUser = new ServiceUser();
        return $serviceUser::getPhoto($apiContext);
    }
}