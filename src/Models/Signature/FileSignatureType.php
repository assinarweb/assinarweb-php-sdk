<?php

namespace AssinarWeb\Models\Signature;

class FileSignatureType
{
    const DIGITAL_PDF =  1;
    const DIGITAL_OTHERS_FORMARTS = 2;
    const ELETRONIC = 3;
    const HYBRID = 4;

    const METHOD_DIGITAL = 1;
    const METHOD_ELETRONIC = 2;
    const METHOD_HYBRID = 3;

    private $id;
    private $name;
    private $order;
    private $type;


    public function format($parameters)
    {
        $this->id = $parameters->id ?? null;
        $this->name =  $parameters->nome ?? null;
        $this->order =  $parameters->ordem ?? null;
        $this->type =  $parameters->tipo ?? null;
        return $this;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setOrder(int $order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type)
    {
        $this->type = $type;
    }

    public function setFileSignatureType($parameters)
    {
        $this->id = $parameters->id ?? null;
        $this->name = $parameters->nome ?? null;
        $this->order = $parameters->ordem ?? null;
        $this->type = $parameters->tipo ?? null;
        return $this;
    }

    public function getFileSignatureType()
    {
        return $this;
    }
}