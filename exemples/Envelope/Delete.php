<?php

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Service\EnvelopeService;
use AssinarWeb\Models\Envelope\Envelope;

ini_set("display_errors", 1);
ini_set("display_startup_erros", 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$apiContext = new ApiContext();
$apiContext->setDomain(ApiContext::DOMAIN_LINK);
$apiContext->setEnvironment(ApiContext::HOMOLOGATION_ENVIRONMENT);
$apiContext->setPartnerPrefix(ApiContext::PARTNER_PREFIX_LINK);
$apiContext->setApiToken('eyJ0eXAiOiJKV1QiLCJhbGciO...');

$envelope = new Envelope();
$envelope->setEnvelope('b6fb27720626210c4cbdda942e01868d');

dump(EnvelopeService::delete($apiContext, $envelope));