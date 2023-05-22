<?php

namespace AssinarWeb\Models\Files;

use AssinarWeb\Models\Subscriber\Subscriber;
use AssinarWeb\Models\Signature\FileSignatureStatus;
use AssinarWeb\Models\Signature\FileSignatureType;
use AssinarWeb\Helpers\Util;
use Carbon\Carbon;

class File
{
    private $creationDate;
    private $folder;
    public $filename;
    private $description;
    private $requestedBy;
    /**
     * @var FileSignatureType
     */
    private $type;
    /**
     * @var FileSignatureStatus
     */
    private $status;
    private $countTotal;
    private $countSigned;
    private $id;
    private $userId;
    private $date;
    /**
     * @var Subscriber
     */

    private $subscribers;

    public function __construct()
    {
        $this->type = new FileSignatureType();
        $this->status = new FileSignatureStatus();
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate(string $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getFolder()
    {
        return $this->folder;
    }

    public function setFolder(string $folder)
    {
        $this->folder = $folder;
    }

    public function getFilename()
    {
        return $this->filename;
    }

    public function setFilename(string  $filename)
    {
        $this->filename = $filename;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getRequestedBy()
    {
        return $this->requestedBy;
    }

    public function setRequestedBy(string $requestedBy)
    {
        $this->requestedBy = $requestedBy;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType(object $type)
    {
        $newType = new FileSignatureType();
        return $this->type =  $newType->setFileSignatureType($type);
    }

    public function getStatus(): FileSignatureStatus
    {
        return $this->status;
    }

    public function setStatus(object $status)
    {
        $newStatus = new FileSignatureStatus();
        return $this->status =  $newStatus->setFileSignatureStatus($status);
    }

    public function getCountTotal()
    {
        return $this->countTotal;
    }

    public function setCountTotal(int $countTotal)
    {
        $this->countTotal = $countTotal;
    }

    public function getCountSigned()
    {
        return $this->countSigned;
    }

    public function setCountSigned(int $countSigned)
    {
        $this->countSigned = $countSigned;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId(int $userId)
    {
        $this->userId = $userId;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate(string $date)
    {
        $this->date = $date;
    }

    public function getSubscribers()
    {
        return $this->subscribers;
    }
    
    public function setSubscribers(array $subscribers, $fieldNamesWasTranslated = false)
    {
        if ($fieldNamesWasTranslated) {
            $this->subscribers = $subscribers;
        } else {
            $this->subscribers = [];
            foreach ($subscribers as $subscriber) {
                $newSubscriber = new Subscriber();
                $newSubscriber->setSubscriber($subscriber);
                $this->subscribers[] = $newSubscriber;
            }
        }
        return $this->subscribers;
    }

    public function getFile()
    {
        return $this;
    }

    public function setFile(object $parameters)
    {
        $this->creationDate = $parameters->data_criacao ?? null;
        $this->folder = $parameters->folder ?? null;
        $this->filename = $parameters->arquivo ?? null;
        $this->description = $parameters->descricao ?? null;
        $this->requestedBy = $parameters->requisitado_por ?? null;

        $type = $this->type->setFileSignatureType($parameters->tipo) ?? null;
        $this->type = Util::ObjectRemovedNull($type);

        $status = $this->status->setFileSignatureStatus($parameters->status) ?? null;
        $this->status = Util::ObjectRemovedNull($status);

        $this->countTotal = $parameters->qtd_total ?? null;
        $this->countSigned = $parameters->qtd_assinado ?? null;
        $this->id = $parameters->id ?? null;
        $this->userId = $parameters->id_usuario ?? null;
        $this->date = $parameters->data ?? null;
        $subscribers = $this->setSubscribers($parameters->assinantes) ?? null;
        // Clear Subscribers
        $this->subscribers = Util::ObjectRemovedNull($subscribers);
        return Util::ObjectRemovedNull($this);
    }

    public function format(object $parameters)
    {
        $this->setFile($parameters);
        $this->creationDate = Carbon::parse($parameters->data_criacao)->format("d/m/Y H:i") ?? null;
        return $this;
    }
}