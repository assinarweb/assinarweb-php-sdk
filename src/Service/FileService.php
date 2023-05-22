<?php

namespace AssinarWeb\Service;

use AssinarWeb\Api\ApiContext;
use AssinarWeb\Models\Files\File;
use AssinarWeb\Models\Files\FilePublishingItem;
use AssinarWeb\Models\Files\FilesList;
use AssinarWeb\Models\Files\FilesListItem;
use AssinarWeb\Service\Client\Client;
use AssinarWeb\Models\Api\Response;
use Exception;

class FileService
{
    const GET_BASE64_FILE = "getBase64File";
    const SAVE_FILE = "saveFile";
    const DOWNLOAD_FILE = "downloadFile";
    
    public static function list(ApiContext $apiContext, $data = null)
    {
        $api = new Client($apiContext, 'GET', 'files/list');
        $fileListItem = new FilesListItem();
        $translatedFileListItem = $fileListItem->translateFileListItemFieldNames($data);
        $responseBody = $api->call($translatedFileListItem);
        if(isset($responseBody->success)) {
            if(empty($responseBody->parameters)) {
                unset($responseBody->parameters);
                return  $responseBody;
            }
            if (property_exists($responseBody->parameters[0], 'data_criacao')) {
                $fileSingle = new File();
                $responseBody->parameters = $fileSingle->format($responseBody->parameters[0]);
            } else {
                $listFiles = new FilesList();
                $responseBody->parameters = $listFiles->format($responseBody->parameters);
            }
        }
        return  $responseBody;
    }

    public static function pdf(ApiContext $apiContext, $data)
    {
        $api = new Client($apiContext, 'GET', 'files/view/pdf');
        $file = new FilesListItem();
        $translatedFileListItem = $file->translateFileListItemFieldNames($data);
        return $api->call($translatedFileListItem);
    }

    public static function runDownloadFile(string $linkFile)
    {
        $urldecode = urldecode($linkFile);
        return substr($urldecode, strripos($urldecode, 'viewer.php?file=') + strlen('viewer.php?file='),strlen($urldecode)) ?? null;
    }

    public static function verifyDirectory(string $path)
    {
            try {
                $dirExist = is_dir($path);
                if($dirExist == false) {
                    $mkdir = mkdir($path);
                    if($mkdir == false) {
                        throw new \Exception('Não foi possível criar o caminho especificado para o arquivo.');
                    }
                }
                return true;

            } catch (\Exception $e) {
                throw new \Exception('Não foi possível ler ou criar o caminho especificado para o arquivo.');
            }
    }

    public static function saveFile(string $file, string $path, string $filename)
    {
        try {
            self::verifyDirectory($path);
            $savedFile = file_put_contents($path . DIRECTORY_SEPARATOR .  $filename,base64_decode($file));
            if($savedFile){
                return true;
            } else {
                throw new Exception('Não foi possível salvar o arquivo no local especificado.');
            }
        } catch (Exception $e) {
            $response = new Response();
            $response->setResponse(400,0, [$e->getMessage()]);
            return dd($response);
        }
    }

    public static function recover(ApiContext $apiContext, $data, $operation, $path = false)
    {
        $api = new Client($apiContext, 'GET', 'files/recover');
        $file = new FilesListItem();
        $translatedFileListItem  = $file->translateFileListItemFieldNames($data);
        $responseBody = $api->call($translatedFileListItem);

        if(isset($responseBody->success)) {
            switch ($operation) {
                Case self::GET_BASE64_FILE:
                    return $responseBody->parameters->file;
                    break;
                Case self::DOWNLOAD_FILE:
                    $linkFile = self::pdf($apiContext, $translatedFileListItem);
                    return self::runDownloadFile($linkFile->parameters);
                    break;
                Case self::SAVE_FILE:
                    try {
                        $infoFile = self::list($apiContext, $translatedFileListItem);
                        $filename = strpos($infoFile->parameters->getDescription(), 'pdf') ? $infoFile->parameters->getDescription() : 'DocumentoP7S.zip';
                        $responseBody->parameters->file = str_replace($filename, '', $responseBody->parameters->file);
                        $saveFile = self::saveFile($responseBody->parameters->file, $path, $infoFile->parameters->getId() . " - " . $filename);
                        if($saveFile) {
                            $responseBody = json_encode(['success' => true, 'message' => 'Arquivo salvo com sucesso.']);
                            return json_decode($responseBody);
                        }

                    } catch (\Exception $e) {
                        $responseError = new Response();
                        $responseError->setResponse(400,0, [$e->getMessage()]);
                        return dd($responseError);
                    }
                    break;
            }
        }
        return $responseBody;
    }

    public static function publication(ApiContext $apiContext, $data)
    {
        $api = new Client($apiContext, 'POST', 'files/publication');
        $filePublishingItem = new FilePublishingItem();
        $translatedFilePublishingItemList = [];
        foreach ($data as $item) {
            $translatedFilePublishingItemList[] = $filePublishingItem->translateFieldNamesFilePublishing($item);
        }
        $responseBody = $api->call((object)$translatedFilePublishingItemList, false);
        return $responseBody;
    }
}