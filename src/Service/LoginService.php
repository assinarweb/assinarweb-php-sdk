<?php

namespace AssinarWeb\Service;

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Helpers\Util;
use AssinarWeb\Models\Login\Recovery;
use AssinarWeb\Models\User\Person\Person;
use AssinarWeb\Service\Client\Client;
use AssinarWeb\Models\Login\Login;

class LoginService
{
    public static function login(ApiContext $apiContext, $data)
    {
        $login = new Login();
        $translatedLoginObject = $login->translateLoginFieldsName($data);
        $api = new Client($apiContext, 'POST', 'login');
        $responseBody = $api->call($translatedLoginObject);

        if(isset($responseBody->success)){
            $normalizeLoginResponse = Util::ObjectRemovedNull($responseBody->parameters);
            $responseBody->parameters =  $login->formatsResponseLogin($normalizeLoginResponse);
        }
        return  $responseBody;
    }

    public static function  register(ApiContext $apiContext, $data)
    {
        $person = new Person();
        $translatedPersonObject = $person->translateFieldsName($data);
        $api = new Client($apiContext, 'POST', 'register');
        $responseBody = $api->call($translatedPersonObject);
        unset($responseBody->parameters);
        return $responseBody;
    }

    public static function remember(ApiContext $apiContext, $data)
    {
        $person = new Person();
        $translatedPersonObject = $person->translateFieldsName($data);
        $api = new Client($apiContext, 'POST', 'remember');
        $responseBody = $api->call($translatedPersonObject);
        unset($responseBody->parameters);
        return $responseBody;
    }

    public static function recover(ApiContext $apiContext, $data)
    {
        $person = new Recovery();
        $translatedRecoveryObject = $person->translateRecoveryFieldsName($data);
        $api = new Client($apiContext, 'POST', 'recover');
        $responseBody = $api->call($translatedRecoveryObject);
        unset($responseBody->parameters);
        return $responseBody;
    }

    public static function terms(ApiContext $apiContext)
    {
        $api = new Client($apiContext, 'GET', 'terms');
        $responseBody = $api->call();
        return $responseBody;
    }
}