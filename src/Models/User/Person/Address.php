<?php

namespace AssinarWeb\Models\User\Person;

use AssinarWeb\Helpers\Util;

class Address
{
    protected $street;
    protected $number;
    protected $complement;
    protected $neighborhood;
    protected $zipCode;
    protected $state;
    protected $cityCode;

    public function format(object $parameters)
    {
        $this->street = $parameters->logradouro ?? null;
        $this->number = $parameters->numero ?? null;
        $this->complement = $parameters->complemento ?? null;
        $this->neighborhood = $parameters->bairro ?? null;
        $this->zipCode = isset($parameters->cep) ? Util::addCepMask($parameters->cep) : null;

        if(isset($parameters->estado)) {
            $this->state = ($parameters->estado) ?? null;
        }
        if(isset($parameters->uf)) {
            $this->state = ($parameters->uf) ?? null;
        }

        $this->city = $parameters->municipio ?? null;
        $this->cityCode = $parameters->codigo_municipio ?? null;
        return $this;
    }

    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setNumber(int $number)
    {
        $this->number = $number;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setComplement(string $complement)
    {
        $this->complement = $complement;
    }

    public function getComplement()
    {
        return $this->complement;
    }

    public function setNeighborhood(string $neighborhood)
    {
        $this->neighborhood = $neighborhood;
    }

    public function getNeighborhood()
    {
        return $this->neighborhood;
    }

    public function setZipCode(string $zipCode)
    {
        $this->zipCode = $zipCode;
    }

    public function getZipCode()
    {
        return $this->zipCode;
    }

    public function setState(string $state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setCityCode(int $cityCode)
    {
        $this->cityCode = $cityCode;
    }

    public function getCityCode()
    {
        return $this->cityCode;
    }

    public function setAddress(object $parameters)
    {
        $this->street = $parameters->logradouro ?? null;
        $this->number = $parameters->numero ?? null;
        $this->complement = $parameters->complemento ?? null;
        $this->neighborhood = $parameters->bairro ?? null;
        $this->zipCode = $parameters->cep ?? null;
        if(isset($parameters->estado)) {
            $this->state = ($parameters->estado) ?? null;
        }
        if(isset($parameters->uf)) {
            $this->state = ($parameters->uf) ?? null;
        }
        $this->cityCode = $parameters->municipio ?? null;
        return $this;
    }

    public function getAddress()
    {
        $address = new Address();
        $address->street = $this->getStreet();
        $address->number = $this->getNumber();
        $address->complement = $this->getComplement();
        $address->neighborhood = $this->getNeighborhood();
        $address->zipCode = $this->getZipCode();
        $address->state = $this->getState();
        $address->cityCode = $this->getCityCode();
        return $address;
    }

    public function  translateFieldsName(Address $address)
    {
        $newAddress = (object)[];
        $newAddress->logradouro = $address->street ?? null;
        $newAddress->numero = $address->number ?? null;
        $newAddress->complemento = $address->complement ?? null;
        $newAddress->bairro = $address->neighborhood ?? null;
        $newAddress->cep = $address->zipCode ?? null;
        $newAddress->estado = ($address->state) ?? null;
        $newAddress->municipio = $address->cityCode ?? null;
        return $newAddress;
    }

    public function mergeAddressDataWithPerson(object $person, object $address)
    {
        $mergedAddressWithPerson = (object) array_merge((array)$person, (array)$address);
        unset($mergedAddressWithPerson->endereco);
        return $mergedAddressWithPerson;
    }
}