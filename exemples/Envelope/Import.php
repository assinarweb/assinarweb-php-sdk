<?php

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Service\EnvelopeService;
use AssinarWeb\Models\Envelope\Import;

ini_set("display_errors", 1);
ini_set("display_startup_erros", 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$apiContext = new ApiContext();
$apiContext->setDomain(ApiContext::DOMAIN_LINK);
$apiContext->setEnvironment(ApiContext::HOMOLOGATION_ENVIRONMENT);
$apiContext->setPartnerPrefix(ApiContext::PARTNER_PREFIX_LINK);
$apiContext->setApiToken('eyJ0eXAiOiJKV1QiLCJhbGciO...');

$dirFile = $_SERVER['DOCUMENT_ROOT'] . "images/Link.png";
$envelopeImportFile = new Import();
$envelopeImportFile->setEnvelope('934f5152ba2f8c397bc69df3f04b0187');
$envelopeImportFile->setFile($dirFile);

dump(EnvelopeService::import($apiContext , $envelopeImportFile));