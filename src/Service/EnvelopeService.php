<?php

namespace AssinarWeb\Service;

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Models\Envelope\Envelope;
use AssinarWeb\Helpers\Util;
use AssinarWeb\Models\Envelope\Import;
use AssinarWeb\Service\Client\Client;

class EnvelopeService
{
    public static function create(ApiContext $apiContext)
    {
        $api = new Client($apiContext, 'GET', 'envelope/create');
        return $api->call();
    }

    public static function delete(ApiContext $apiContext, $data)
    {
        $envelope = new Envelope();
        $translatedEnvelopeObject = $envelope->translateEnvelopeFieldNames($data);
        $api = new Client($apiContext, 'delete', 'envelope/delete');
        $responseBody = $api->call($translatedEnvelopeObject);
        unset($responseBody->parameters);
        return $responseBody;
    }

    public static function deleteFiles(ApiContext $apiContext, object $data)
    {
        $api = new Client($apiContext, 'delete', 'envelope/delete/files');
        $envelope = new Envelope();
        $translatedEnvelopeObject = $envelope->translateEnvelopeFieldNames($data);
        $responseBody = $api->call($translatedEnvelopeObject);
        unset($responseBody->parameters);
        return $responseBody;
    }

    public static function import(ApiContext $apiContext, Import $data)
    {
        $api = new Client($apiContext, 'POST', 'envelope/import');
        $multipart = [];
        $multipart[] = ['name' => 'envelope', 'contents' => $data->getEnvelope()];
        $multipart[] = ['name' => 'file', 'contents' => fopen($data->getFile(), "r")];
        $multipart = (object)$multipart;
        $responseBody = $api->call($multipart, true);

        if(isset($responseBody->success)){
            $envelopeImportFile = new Import();
            $responseBody->parameters =  Client::normalize($envelopeImportFile->formatsResponseImportedFile($responseBody->parameters));
        }

        return $responseBody;
    }
}