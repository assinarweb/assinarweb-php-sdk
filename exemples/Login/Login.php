<?php

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Service\LoginService;
use AssinarWeb\Models\Login\Login;

ini_set("display_errors", 1);
ini_set("display_startup_erros", 1);
error_reporting(E_ALL);

require_once '../../vendor/autoload.php';

$apiContext = new ApiContext();
$apiContext->setDomain(ApiContext::DOMAIN_LINK);
$apiContext->setEnvironment(ApiContext::PRODUCTION_ENVIRONMENT);
$apiContext->setPartnerPrefix(ApiContext::PARTNER_PREFIX_LINK);
$apiContext->setApiToken('e427e3a3655223b83249548824f28db2');

$login = new Login();
$login->setName('00000000000');
$login->setPassword('123456');

dump(LoginService::login($apiContext, $login));