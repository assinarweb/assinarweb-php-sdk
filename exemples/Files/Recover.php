<?php

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Service\FileService;
use AssinarWeb\Models\Files\FilesListItem;

ini_set("display_errors", 1);
ini_set("display_startup_erros", 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';

$apiContext = new ApiContext();
$apiContext->setDomain(ApiContext::DOMAIN_LINK);
$apiContext->setEnvironment(ApiContext::HOMOLOGATION_ENVIRONMENT);
$apiContext->setPartnerPrefix(ApiContext::PARTNER_PREFIX_LINK);
$apiContext->setApiToken('eyJ0eXAiOiJKV1QiLCJhbGciO...');
/* Specifies the id of the file you want to retrieve */
$file = new FilesListItem();
$file->setId(69953);

/* Get the file in base64 */
echo "<strong>File in Base64</strong>: ". FileService::recover($apiContext , $file, FileService::GET_BASE64_FILE);

/* Download the file through the browser */
$linkDownloadFile = FileService::recover($apiContext , $file, FileService::DOWNLOAD_FILE);
echo "<script type='text/javascript''>
    window.open('$linkDownloadFile');
</script>";

/* Specifies a path to save the file */
$path = $_SERVER['DOCUMENT_ROOT'] . "downloads";
FileService::recover($apiContext , $file, FileService::SAVE_FILE, $path);