<?php

namespace AssinarWeb\Service;

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Models\User\Person\Person;
use AssinarWeb\Models\User\Person\PersonPhysical;
use AssinarWeb\Models\User\Person\PersonLegal;
use AssinarWeb\Service\Client\Client;
use AssinarWeb\Models\Photo\Photo;
use AssinarWeb\Helpers\Util;

class UserService
{
    public static function register(ApiContext $apiContext, $data)
    {
        $api = new Client($apiContext, 'POST', 'user/register');

        $document = Util::removerMaskCpfCnpj($data->getDocument());
        $registerPerson = null;
        if(strlen($document) == 11) {
            $physicalPerson = new PersonPhysical();
            $registerPerson = $physicalPerson->translatePhysicalPersonFieldNames($data);
        } else {
            $legalPerson = new PersonLegal();
            $registerPerson = $legalPerson->translateLegalPersonFieldNames($data);
        }

        $responseBody = $api->call($registerPerson);
        unset($responseBody->parameters);
        return $responseBody;
    }

    public static function getPhoto(ApiContext $apiContext)
    {
        $api = new Client($apiContext, 'GET', 'user/photo');
        $responseBody = $api->call();

        if(isset($responseBody->success)){
            $photo = new Photo();
            $responseBody->parameters =  $photo = $photo->translatePhotoFieldNames($responseBody->parameters);
        }
        return  $responseBody;
    }

    public static function changePhoto(ApiContext $apiContext, $data)
    {
        $api = new Client($apiContext, 'POST', 'user/photo');
        $photo = new Photo();
        $translatedPhoto = $photo->translatePhotoFieldNames($data);
        $responseBody = $api->call($translatedPhoto);
        unset($responseBody->parameters);
        return $responseBody;
    }

    public static function getFullData(ApiContext $apiContext)
    {
        $api = new Client($apiContext, 'GET', 'user/data');
        $responseBody = $api->call();
        if(isset($responseBody->success)){
            $person = new Person();
            $responseBody->parameters = $person->format($responseBody->parameters);
            return $responseBody;
        }
        return  $responseBody;
    }
}