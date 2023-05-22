<?php

namespace AssinarWeb\Models\Files;

use AssinarWeb\Models\Subscriber\Subscriber;
use AssinarWeb\Helpers\Util;
use stdClass;

class FilePublishingItem extends File
{
    private $envelope;
    private $method;
    private $typeFile;
    private $sendEmails;
    private $generateHash;
    /**
     * @var Subscriber
     */
    private $subscribers;

    public function getEnvelope()
    {
        return $this->envelope;
    }

    public function setEnvelope(string $envelope)
    {
        $this->envelope = $envelope;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setMethod(string $method)
    {
        $this->method = $method;
    }

    public function getTypeFile()
    {
        return $this->typeFile;
    }

    public function setTypeFile(int $type)
    {
        $this->typeFile = $type;
    }

    public function getSendEmails()
    {
        return $this->sendEmails;
    }

    public function setSendEmails(array $sendEmails)
    {
        $this->sendEmails = $sendEmails;
    }

    public function getGenerateHash()
    {
        return $this->generateHash;
    }

    public function setGenerateHash(bool $generateHash)
    {
        $this->generateHash = $generateHash;
    }

    public function translateFieldNamesFilePublishing(FilePublishingItem $filePublishingItem)
    {
        $newFilePublishing = new stdClass();
        $newFilePublishing->envelope = $filePublishingItem->getEnvelope();
        $newFilePublishing->arquivo = $filePublishingItem->getId();
        $newFilePublishing->pasta = $filePublishingItem->getFolder();
        $newFilePublishing->tipo = $filePublishingItem->getTypeFile();
        $newFilePublishing->metodo = $filePublishingItem->getMethod();
        $newFilePublishing->data_prazo = $filePublishingItem->getDate();
        $newFilePublishing->descricao = $filePublishingItem->getDescription();
        $newFilePublishing->participantes = $filePublishingItem->getSubscribers();

        if(count($newFilePublishing->participantes) > 0) {
            $listSubscribers = [];
            $subscriber = new Subscriber();
            for($i = 0; $i < count($newFilePublishing->participantes); $i++) {
                $listSubscribers[] = $subscriber->translateSubscriberFieldNames($newFilePublishing->participantes[$i]);
            }
            $newFilePublishing->participantes = $listSubscribers;
        }
        $newFilePublishing->enviar_emails = $filePublishingItem->getSendEmails();
        $newFilePublishing->gerar_hash = $filePublishingItem->getGenerateHash();
        $newFilePublishing = Util::ObjectRemovedNull($newFilePublishing);
        return $newFilePublishing;
    }
}