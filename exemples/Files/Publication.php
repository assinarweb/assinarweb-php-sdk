<?php

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Service\FileService;
use AssinarWeb\Models\Files\FilePublishingItem;
use AssinarWeb\Models\Subscriber\Subscriber;
use AssinarWeb\Models\Signature\FileSignatureType;
use Tightenco\Collect\Support\Collection;

ini_set("display_errors", 1);
ini_set("display_startup_erros", 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$apiContext = new ApiContext();
$apiContext->setDomain(ApiContext::DOMAIN_LINK);
$apiContext->setEnvironment(ApiContext::HOMOLOGATION_ENVIRONMENT);
$apiContext->setPartnerPrefix(ApiContext::PARTNER_PREFIX_LINK);
$apiContext->setApiToken('eyJ0eXAiOiJKV1QiLCJhbGciO...');

// Create Signature Type of File
$type = new FileSignatureType();
$type->setOrder(1);
$type->setType(FileSignatureType::ELETRONIC);
// Create participant
$subscriber = new Subscriber();
$subscriber->setName('John Wick');
$subscriber->setDocument('099.556.376-41');
$subscriber->setCellphone('(31) 9 8547-0335');
$subscriber->setEmail('john@wick.com.br');
$sendEmailsCollection = new Collection();
$sendEmailsCollection->add($subscriber->getEmail());
$subscriber->setSignature($type);
$subscriberCollection = new Collection();
$subscriberCollection->add($subscriber);
// Creates a publishing item
$publishing = new FilePublishingItem();
$publishing->setEnvelope('797b94757a8bae45116ed1f1f10afffb');
$publishing->setId(1);
$publishing->setFolder('3569');
$publishing->setTypeFile(FileSignatureType::DIGITAL_PDF);
$publishing->setMethod(FileSignatureType::ELETRONIC);
$publishing->setDate('20/01/2021 10:30');
$publishing->setDescription('17/09/2020');
$publishing->setGenerateHash(true);
// Add participants to the publication
$publishing->setSubscribers($subscriberCollection->all());
// Add Publication sending emails
$publishing->setSendEmails($sendEmailsCollection->all());
// Add publishing Item in Collection
$publishingCollection = new Collection();
$publishingCollection->add($publishing);
dump(FileService::publication($apiContext , $publishingCollection));