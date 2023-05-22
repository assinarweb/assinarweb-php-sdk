<?php

namespace AssinarWeb\Models\User\Person;
use AssinarWeb\Helpers\Util;
use stdClass;

class PersonLegal extends Person
{
    protected $fantasyName;
    protected $stateRegistration;
    protected $municipalRegistration;
    protected $taxSubstitution;
    protected $website;
    protected $contactName;
    protected $contactPhone;
    protected $contactEmail;

    public function getFantasyName()
    {
        return $this->fantasyName;
    }

    public function setFantasyName(string $fantasyName)
    {
        $this->fantasyName = $fantasyName;
    }

    public function getStateRegistration()
    {
        return $this->stateRegistration;
    }

    public function setStateRegistration(string $stateRegistration)
    {
        $this->stateRegistration = $stateRegistration;
    }

    public function getMunicipalRegistration()
    {
        return $this->municipalRegistration;
    }

    public function setMunicipalRegistration(string $municipalRegistration)
    {
        $this->municipalRegistration = $municipalRegistration;
    }

    public function getTaxSubstitution()
    {
        return $this->taxSubstitution;
    }

    public function setTaxSubstitution(string $taxSubstitution)
    {
        $this->taxSubstitution = $taxSubstitution;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function setWebsite(string $website)
    {
        $this->website = $website;
    }

    public function getContactName()
    {
        return $this->contactName;
    }

    public function setContactName(string $contactName)
    {
        $this->contactName = $contactName;
    }

    public function getContactPhone()
    {
        return $this->contactPhone;
    }

    public function setContactPhone(string $contactPhone)
    {
        $this->contactPhone = $contactPhone;
    }

    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    public function setContactEmail(string $contactEmail)
    {
        $this->contactEmail = $contactEmail;
    }

    public function translateLegalPersonFieldNames(PersonLegal $legalPerson)
    {
        $newLegalPerson = new stdClass();
        /* Attributes of Person */
        $newLegalPerson = parent::translateFieldsName($legalPerson);
        /* Attributes of Address */
        $address = new Address();
        $newAddress = $address->translateFieldsName($legalPerson->address);
        $newLegalPerson->endereco = $newAddress;
        $newLegalPerson = $address->mergeAddressDataWithPerson($newLegalPerson, $newAddress);
        /* Attributes of Legal Person */
        $newLegalPerson->nome_fantasia = $legalPerson->fantasyName ?? null;
        $newLegalPerson->inscricao_estadual = $legalPerson->stateRegistration ?? null;
        $newLegalPerson->inscricao_municipal = $legalPerson->municipalRegistration ?? null;
        $newLegalPerson->substituicao_tributaria = $legalPerson->taxSubstitution ?? null;
        $newLegalPerson->website = $legalPerson->website ?? null;
        $newLegalPerson->nome_contato = $legalPerson->contactName ?? null;
        $newLegalPerson->telefone_contato = $legalPerson->contactPhone ?? null;
        $newLegalPerson->email_contato = $legalPerson->contactEmail ?? null;
        return Util::ObjectRemovedNull($newLegalPerson);
    }
}