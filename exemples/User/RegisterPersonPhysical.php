<?php

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Service\UserService;
use AssinarWeb\Models\User\Person\PersonPhysical;

ini_set("display_errors", 1);
ini_set("display_startup_erros", 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$apiContext = new ApiContext();
$apiContext->setDomain(ApiContext::DOMAIN_LINK);
$apiContext->setEnvironment(ApiContext::HOMOLOGATION_ENVIRONMENT);
$apiContext->setPartnerPrefix(ApiContext::PARTNER_PREFIX_LINK);
$apiContext->setApiToken('eyJ0eXAiOiJKV1QiLCJhbGciO...');

$physicalPerson = new PersonPhysical();

/* Attributes required/ specifics of User */
$physicalPerson->setName('Felipe Bourdon');
$physicalPerson->setDocument('009.442.210-92');
$physicalPerson->setEmail('john@wick.com.br');
$physicalPerson->setPhone('(31) 9 9999-9999');
$physicalPerson->setPassword('654321');

/* Attributes specifics of Physical Person */
$physicalPerson->setBirthDate('20/10/1990');
$physicalPerson->setRg('MG-12-999-125');
$physicalPerson->setExpeditDate('01/01/2015');
$physicalPerson->setExpeditorOrgan('SSP/MG');
$physicalPerson->setCei('0000001');
$physicalPerson->setOffice('Agente de Segurança Nacional');

/* Attributes specifics of Address */
$physicalPerson->address->setStreet('Rua Camões');
$physicalPerson->address->setNumber('1');
$physicalPerson->address->setComplement('Casa');
$physicalPerson->address->setNeighborhood('São Lucas');
$physicalPerson->address->setZipCode('30240-270');
$physicalPerson->address->setCityCode(3106200);
$physicalPerson->address->setState('MG');

dump(UserService::register($apiContext, $physicalPerson));