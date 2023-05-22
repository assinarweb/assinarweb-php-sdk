<?php

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Service\LoginService;
use AssinarWeb\Models\Login\Recovery;

ini_set("display_errors", 1);
ini_set("display_startup_erros", 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$apiContext = new ApiContext();
$apiContext->setDomain(ApiContext::DOMAIN_LINK);
$apiContext->setEnvironment(ApiContext::HOMOLOGATION_ENVIRONMENT);
$apiContext->setPartnerPrefix(ApiContext::PARTNER_PREFIX_LINK);
$apiContext->setApiToken('e427e3a3655223b83249548824f28db2');

$recovery = new Recovery();
$recovery->setCode(535511);
$recovery->setDocument('000.000.000-00');
$recovery->setPassword('123456');
$recovery->setCPassword('123456');

dump(LoginService::recover($apiContext, $recovery));
