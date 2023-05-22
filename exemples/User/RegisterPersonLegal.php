<?php

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Service\UserService;
use AssinarWeb\Models\User\Person\PersonLegal;

ini_set("display_errors", 1);
ini_set("display_startup_erros", 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$apiContext = new ApiContext();
$apiContext->setDomain(ApiContext::DOMAIN_LINK);
$apiContext->setEnvironment(ApiContext::HOMOLOGATION_ENVIRONMENT);
$apiContext->setPartnerPrefix(ApiContext::PARTNER_PREFIX_LINK);
$apiContext->setApiToken('eyJ0eXAiOiJKV1QiLCJhbGciO...');

$legalPerson = new  PersonLegal();
/* Attributes required/ specifics of User */
$legalPerson->setName('AssinadorWeb Legal Person (Teste)');
$legalPerson->setDocument('97.573.544/0001-84');
$legalPerson->setEmail('john@wick.com.br');
$legalPerson->setPhone('(31) 9 9999-9999');
$legalPerson->setPassword('654321');

/* Attributes specifics of Legal Person */
$legalPerson->setFantasyName('AssinadorWeb Legal Person');
$legalPerson->setWebsite('www.assinadorweblegalperson.com.br');
$legalPerson->setStateRegistration('120000385');
$legalPerson->setMunicipalRegistration('1200003851');
$legalPerson->setContactName('John Wick');
$legalPerson->setContactEmail('john@wick.com.br');
$legalPerson->setContactPhone('(31) 9 9999-9999');

/* Attributes specifics of Address */
$legalPerson->address->setStreet('Avenida Francisco Sales');
$legalPerson->address->setNumber('1009');
$legalPerson->address->setComplement('Edifício Santa Louis - AP201');
$legalPerson->address->setNeighborhood('Santa Efigênia');
$legalPerson->address->setZipCode('30150-221');
$legalPerson->address->setCityCode(3106200);
$legalPerson->address->setState('MG');

dump(UserService::register($apiContext, $legalPerson));