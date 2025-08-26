<?php

namespace AssinarWeb\Models\Signature;

class FileSignatureStatus
{
    public $id;
    public $name;

    public function format($parameters) : FileSignatureStatus
    {
        $this->id = $parameters->id ?? null;
        $this->name =  $parameters->nome ?? null;
        return $this;
    }

    public function setId(int $id) : int
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name) : string
    {
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setFileSignatureStatus(object $status) : FileSignatureStatus
    {
        $this->id = $status->id ?? null;
        $this->name = $status->nome ?? null;
        return $this;
    }

    public function getFileSignatureStatus() : FileSignatureStatus
    {
        return $this;
    }

}
