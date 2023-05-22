<?php

namespace AssinarWeb\Models\Subscriber;

use AssinarWeb\Models\Signature\FileSignatureType;
Use stdClass;

class Subscriber
{
    public $name;
    public $document;
    public $cellphone;
    public $email;
    /**
     * @var FileSignatureType
     */
    private $signature;

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function setDocument(string $document)
    {
        $this->document = $document;
    }

    public function getCellphone()
    {
        return $this->cellphone;
    }

    public function setCellphone(string $cellphone)
    {
        $this->cellphone = $cellphone;
    }

    /**
     * @return FileSignatureType
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * @param FileSignatureType $signature
     */
    public function setSignature(FileSignatureType $signature)
    {
        $this->signature = $signature;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setSubscriber(object $subscriber)
    {
        if(isset($subscriber->nome)) {
            $this->name = $subscriber->nome;
        } else {
            $this->name = $subscriber->name ?? null;
        }

        if(isset($subscriber->documento)) {
            $this->document = $subscriber->documento;
        } else {
            $this->document = $subscriber->document ?? null;
        }

        if(isset($subscriber->celular)) {
            $this->cellphone = $subscriber->celular;
        } else {
            $this->cellphone = $subscriber->cellphone ?? null;
        }
        
        $this->email = $subscriber->email ?? null;
        if(isset($subscriber->signature) || isset($subscriber->assinantes)) {
            $this->signature = $subscriber->getSignature() ?? null;
        }
        return $this;
    }

    public function getSubscriber() : Subscriber
    {
        return $this;
    }

    public function format(object $subscriber) : Subscriber
    {
        return $this->setSubscriber($subscriber);
    }

    public function translateSubscriberFieldNames(Subscriber $subscriber)
    {
        //dd($subscriber);
        $newSubscriber = new stdClass();
        $newSubscriber->nome = $subscriber->getName();
        $newSubscriber->documento = $subscriber->getDocument();
        $newSubscriber->celular = $subscriber->getCellphone();
        $newSubscriber->email = $subscriber->getEmail();
        $newSubscriber->assinatura = new stdClass();
        $newSubscriber->assinatura->ordem = $subscriber->getSignature()->getOrder();
        $newSubscriber->assinatura->tipo = $subscriber->getSignature()->getType();
        return $newSubscriber;
    }
}
