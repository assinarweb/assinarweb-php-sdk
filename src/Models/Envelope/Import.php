<?php

namespace AssinarWeb\Models\Envelope;

class Import extends Envelope
{
    public function setFileImported(object $file)
    {
        $this->setFile($file ?? null);
    }

    public function formatsResponseImportedFile(array $parameters)
    {
        $newFile = new Envelope();
        $newFile->setEnvelope($parameters[0]->envelope ?? null);
        $newFile->setFile($parameters[0]->file ?? null);
        return $newFile;
    }
}