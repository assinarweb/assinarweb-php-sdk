<?php

namespace AssinarWeb\Models\Envelope;

use AssinarWeb\Helpers\Util;
use stdClass;

class Envelope
{
    /**
     * @var  string
     */
    private $envelope;
    private $file;
    /**
     * @var array
     */
    private $id_files;

    public function getEnvelope()
    {
        return $this->envelope;
    }

    public function setEnvelope(string $envelope)
    {
        $this->envelope = $envelope;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }

    public function getIdFiles()
    {
        return $this->id_files;
    }

    public function setIdFiles(array $id_files)
    {
        $this->id_files = $id_files;
    }

    public function translateEnvelopeFieldNames(Envelope $envelope)
    {
        $newEnvelope = new stdClass();
        $newEnvelope->envelope = $envelope->getEnvelope();
        $newEnvelope->id_files = $envelope->getIdFiles();
        return Util::ObjectRemovedNull($newEnvelope);
    }
}