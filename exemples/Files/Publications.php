<?php

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Service\FileService;
use AssinarWeb\Models\Files\FilePublishingItem;
use AssinarWeb\Models\Subscriber\Subscriber;
use AssinarWeb\Models\Signature\FileSignatureType;
use Illuminate\Support\Collection;

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
$type->setType(FileSignatureType::DIGITAL_PDF);

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

// Create second participant
$subscriber = new Subscriber(); // Clean or create new Subscriber
$subscriber->setName('VICTOR DE SOUSA OLIVEIRA');
$subscriber->setDocument('101.387.716-00');
$subscriber->setCellphone('(31) 9 9391-7917');
$subscriber->setEmail('svictor@linkcertificacao.com.br ');
$subscriber->setSignature($type);
$sendEmailsCollection->add($subscriber->getEmail());
$subscriberCollection->add($subscriber);

// Creates a publishing item
$publishing = new FilePublishingItem(); // Clean or create new FilePublishingItem
$publishing->setEnvelope('797b94757a8bae45116ed1f1f10afffb');
$publishing->setId(1);
$publishing->setFolder('3569');
$publishing->setTypeFile(FileSignatureType::DIGITAL_PDF);
$publishing->setMethod(FileSignatureType::METHOD_ELETRONIC);
$publishing->setDate('20/01/2021 10:30');
$publishing->setDescription('Teste de publicação via biblioteca AssinarWeb - PDF - 2 Participantes');
$publishing->setGenerateHash(true);

// Add participants to the publication
$publishing->setSubscribers($subscriberCollection->all());

// Add Publication sending emails
$publishing->setSendEmails($sendEmailsCollection->all());

// Creates a publishing item in Collection
$publishingCollection = new Collection();
$publishingCollection->add($publishing);

// Create Signature Type of File
$type->setOrder(1);
$type->setType(FileSignatureType::DIGITAL_OTHERS_FORMARTS);

// Create participant
$subscriber = new Subscriber();// Clean or create new Subscriber
$subscriber->setName('John Wick');
$subscriber->setDocument('099.556.376-41');
$subscriber->setCellphone('(31) 98547-0335');
$subscriber->setEmail('john@wick.com.br');
$subscriber->setSignature($type);
$subscriberCollection = new Collection();
$subscriberCollection->add($subscriber);

// Create a new item publishing
$publishing = new FilePublishingItem(); // Clean or create new FilePublishingItem
$publishing->setEnvelope('934f5152ba2f8c397bc69df3f04b0187');
$publishing->setId(1);
$publishing->setFolder('3569');
$publishing->setTypeFile(FileSignatureType::DIGITAL_OTHERS_FORMARTS);
$publishing->setMethod(FileSignatureType::METHOD_ELETRONIC);
$publishing->setDate('20/01/2021 10:30');
$publishing->setDescription('Teste de publicação via biblioteca AssinarWeb - PNG - 1 Participante');
$publishing->setGenerateHash(true);

// Add participants to the publication
$publishing->setSubscribers($subscriberCollection->all());

// Send Emails
$sendEmailsCollection = new Collection(); // Clean or create new collection
$sendEmailsCollection->add($subscriber->getEmail());
$publishing->setSendEmails($sendEmailsCollection->all());

// Creates a publishing item in Collection
$publishingCollection->add($publishing);

dump(FileService::publication($apiContext , $publishingCollection));