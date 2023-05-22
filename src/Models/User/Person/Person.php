<?php

namespace AssinarWeb\Models\User\Person;

use AssinarWeb\Helpers\Util;
use stdClass;

class Person
{
    private $id;
    private $name;
    private $email;
    private $document;
    protected $phone;
    protected $cellphone;
    protected $password;
    /**
     * @var Address
     */
    public $address;
    protected $signature;
    protected $photo;

    public function __construct()
    {
        $this->address = new Address();
    }

    public function normalize(array $data) : array
    {
        $serializer = new Serializer([new ObjectNormalizer()]);
        $data = self::arrayRemoveNull($serializer->normalize($data));

        foreach ($data as $key => $d) {
            if(empty($d)) {
                unset($data[$key]);
            }
        }

        return $data;
    }

    public function format(object $parameters)
    {
        $this->id = $parameters->id ?? null;
        $this->name = $parameters->nome ?? null;
        $this->email = $parameters->email ?? null;
        $this->document = Util::setMaskCpfCnpj($parameters->documento) ?? null;
        $this->phone = Util::addPhoneMask($parameters->telefone) ?? null;
        $this->cellphone = $parameters->celular ?? null;
        $this->signature = $parameters->assinatura ?? null;
        $this->photo = $parameters->photo ?? null;
        $this->address->format($parameters->endereco);
        if(isset($parameters->senha)) {
            $this->password->format($parameters->senha);
        }
        return Util::ObjectRemovedNull($this);
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setDocument(string $document)
    {
        $this->document = $document;
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setCellphone(string $cellphone)
    {
        $this->cellphone = $cellphone;
    }

    public function getCellphone()
    {
        return $this->cellphone;
    }

    public function setSignature(string $signature)
    {
        $this->signature = $signature;
    }

    public function getSignature()
    {
        return $this->signature;
    }

    public function setPhoto(string $photo)
    {
        $this->photo = $photo;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setAddress(object $address)
    {
        $this->address = $address;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setPerson(object $parameters)
    {
        $this->id = $parameters->id ?? null;
        $this->name = $parameters->nome ?? null;
        $this->email = $parameters->email ?? null;
        $this->document = $parameters->documento ?? null;
        $this->phone = $parameters->telefone ?? null;
        $this->cellphone = $parameters->celular ?? null;
        $this->signature = $parameters->assinatura ?? null;
        $this->photo = $parameters->photo ?? null;
        $this->address->setAddress($parameters->endereco);
        $this->password = $parameters->senha ?? null;
        return $this;
    }

    public function getPerson()
    {
        $person = new Person();
        $person->id = $this->getId();
        $person->name = $this->getName();
        $person->email = $this->getEmail();
        $person->password = $this->getPassword();
        $person->document = $this->getDocument();
        $person->phone = $this->getPhone();
        $person->cellphone = $this->getCellphone();
        $person->address = $this->getAddress();
        $person->signature = $this->getSignature();
        $person->photo = $this->getPhoto();
        return $person;
    }

    public function  translateFieldsName(Person $person)
    {
        $newPerson = new stdClass();
        $newPerson->documento = $person->document ?? null;
        $newPerson->nome = $person->name ?? null;
        $newPerson->email = $person->email ?? null;
        $newPerson->senha = $person->password ?? null;
        $newPerson->telefone = $person->phone ?? null;
        $newPerson->celular = $person->cellphone ?? null;
        $verifyAddress = Util::clearArray((array)$person->address);
        if(!empty($verifyAddress)) {
            $newPerson->endereco = $person->address ?? null;
        }
        $newPerson->assinatura = $person->signature ?? null;
        $newPerson->photo = $person->photo ?? null;
        return Util::ObjectRemovedNull($newPerson);
    }
}