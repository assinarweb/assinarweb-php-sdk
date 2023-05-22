<?php

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Service\FileService;
use AssinarWeb\Models\Files\FilesListItem;
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

$filters = new Collection();
$filters->put('page', 1);
$filters->put('length', 3);
/* Set Order Filter */
$sortingItem = new Collection();
$sortingItem->put('column', 'status')->put('dir', 'desc');
$sortingList = new Collection();
$sortingList->add($sortingItem->all());
$sortingItem->put('column', 'id')->put('dir', 'desc');
$sortingList->add($sortingItem->all());
$filters->put('order', $sortingList->all());
/* Set Filters */
$file = new FilesListItem();
$file->setFilters($filters->all());

dump(FileService::list($apiContext, $file));