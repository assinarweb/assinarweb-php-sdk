<?php

namespace AssinarWeb\Models\Files;
use AssinarWeb\Helpers\Util;
use AssinarWeb\Service\Client\Client;
use AssinarWeb\Models\Api\Response;
use phpDocumentor\Reflection\DocBlock\Tags\Throws;
use stdClass;
use Exception;
;

class FilesListItem
{
    const STATUS_PENDING = 1;
    const STATUS_PARTIALLY_SIGNED = 2;
    const STATUS_SIGNED = 3;
    const STATUS_REJECTED = 4;

    const FILTERS =  [
        'page',
        'id',
        'descricao',
        'arquivo',
        'pasta',
        'projeto',
        'folder',
        'requisitado_por',
        'assinado_por',
        'status',
        'padrao',
        'publicado_de',
        'publicado_ate',
        'order',
        'column',
        'dir',
        'tipo',
        'length',
    ];

    protected $id;
    protected $file;
    protected $status;
    /**
     * @var array
     */
    protected $filters;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getFilesListItem()
    {
        return $this;
    }

    public function validateFilters(array $filters)
    {
        try {
            $messages = [];
            foreach ($filters as $key => $filter) {
                if (!in_array($key, self::FILTERS)) {
                    $messages[] = "O filtro '$key' informado não existe.";
                }

                if($key == 'order') {
                    if(!is_array($filters['order'])) {
                        $messages[] = "O filtro 'order' deve ser um array de items de chave e valor, com os campos 'column' e 'dir'.";
                    } else {
                        for ($i = 0; $i < count($filters['order']); $i++) {
                            $this->validateFilters($filters['order'][$i]);
                        }
                    }
                }
            }
            if(!empty($messages)) {
                throw new Exception(json_encode($messages));
            }
            return true;

        } catch (Exception $e) {
            $responseError = new Response();
            $responseError->setResponse(400,0, json_decode($e->getMessage()));
            return dd($responseError);
        }
    }

    public function getFilters()
    {
        return $this->filters;
    }

    public function insertSortingFilter($filters)
    {
        if(!isset($filters['order'])) {
            return $filters;
        }

        foreach ($filters['order'] as $order) {
            $this->validateFilters($order);
        }
        return $filters;
    }

    public function setFilters(array $filters)
    {
        if($this->validateFilters($filters)) {
            $this->filters = $this->insertSortingFilter($filters);
        }
    }

    public function setFilesListItem(object $fileItem)
    {
        $this->id = $fileItem->id ?? null;
        $this->file = $fileItem->arquivo ?? null;
        $this->status = $fileItem->status ?? null;
        if($fileItem) {
            $this->filters = $fileItem->filters ?? null;
        }
        unset($this->filters);
        return $this;
    }
    public function translateFileListItemFieldNames($file)
    {
        $newFile = new stdClass();
        $newFile->id = $file->id ?? null;
        $newFile->arquivo = $file->file ?? null;
        $newFile->status = $file->status ?? null;
        if(isset($file->filters) && !is_null($file->filters)) {
            $newFile = (object) array_merge((array) $newFile, (array)$file->filters);
        }
        return Util::ObjectRemovedNull($newFile);
    }

    public static function arrayRemoveNull($data)
    {
        return Client::arrayRemoveNull($data);
    }
}