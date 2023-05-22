<?php

namespace AssinarWeb\Models\User\Person;

use AssinarWeb\Helpers\Util;

class PersonPhysical extends Person
{
    protected $rg;
    protected $expeditorOrgan;
    protected $expeditDate;
    protected $birthDate;
    protected $cei;
    protected $office;

    public function getRg()
    {
        return $this->rg;
    }

    public function setRg(string $rg)
    {
        $this->rg = $rg;
    }

    public function getExpeditorOrgan()
    {
        return $this->expeditorOrgan;
    }

    public function setExpeditorOrgan(string $expeditorOrgan)
    {
        $this->expeditorOrgan = $expeditorOrgan;
    }

    public function getExpeditDate()
    {
        return $this->expeditDate;
    }

    public function setExpeditDate(string $expeditDate)
    {
        $this->expeditDate = $expeditDate;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function getCei()
    {
        return $this->cei;
    }

    public function setCei(string $cei)
    {
        $this->cei = $cei;
    }

    public function getOffice()
    {
        return $this->office;
    }

    public function setOffice(string $office)
    {
        $this->office = $office;
    }

    public function translatePhysicalPersonFieldNames(PersonPhysical $physicalPerson)
    {
        $newPhysicalPerson = null;
        /* Attributes of Person */
        $newPhysicalPerson = parent::translateFieldsName($physicalPerson);
        /* Attributes of Address */
        $address = new Address();
        $newAddress = $address->translateFieldsName($physicalPerson->address);
        $newPhysicalPerson->endereco = $newAddress;
        $newPhysicalPerson = $address->mergeAddressDataWithPerson($newPhysicalPerson, $newAddress);
        /* Attributes of Physical Person */
        $newPhysicalPerson->rg = $physicalPerson->rg ?? null;
        $newPhysicalPerson->orgao_expedidor = $physicalPerson->expeditorOrgan ?? null;
        $newPhysicalPerson->data_expedicao = $physicalPerson->expeditDate ?? null;
        $newPhysicalPerson->data_nascimento = $physicalPerson->birthDate ?? null;
        $newPhysicalPerson->cei = $physicalPerson->cei ?? null;
        $newPhysicalPerson->cargo = $physicalPerson->office ?? null;
        return Util::ObjectRemovedNull($newPhysicalPerson);
    }
}