<?php

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Service\LoginService;
use AssinarWeb\Models\Login\Register;
use AssinarWeb\Models\User\Person\Person;

ini_set("display_errors", 1);
ini_set("display_startup_erros", 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$apiContext = new ApiContext();
$apiContext->setDomain(ApiContext::DOMAIN_LINK);
$apiContext->setEnvironment(ApiContext::HOMOLOGATION_ENVIRONMENT);
$apiContext->setPartnerPrefix(ApiContext::PARTNER_PREFIX_LINK);
$apiContext->setApiToken('e427e3a3655223b83249548824f28db2');

$person = new Person();
$person->setName('John Wick2');
$person->setDocument('000.000.000-00');
$person->setEmail('john@wick.com.br');
$person->setCellphone('(31) 99999-8888');
$person->setPassword('654321');

dump(LoginService::register($apiContext, $person));