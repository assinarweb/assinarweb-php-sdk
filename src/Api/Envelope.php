<?php

namespace AssinarWeb\Api;

use AssinarWeb\Service\EnvelopeService;

class Envelope
{
    private $apiContext;
    private $data;

    public function create(ApiContext $apiContext, $data)
    {
        $envelopeService = new EnvelopeService();
        return $envelopeService::create($apiContext, $data);
    }

    public function delete(ApiContext $apiContext)
    {
        $envelopeService = new EnvelopeService();
        return $envelopeService::delete($apiContext);
    }

    public function import(ApiContext $apiContext)
    {
        $envelopeService = new EnvelopeService();
        return $envelopeService::import($apiContext);
    }

    public function deleteFiles(ApiContext $apiContext)
    {
        $envelopeService = new EnvelopeService();
        return $envelopeService::deleteFiles($apiContext);
    }

}