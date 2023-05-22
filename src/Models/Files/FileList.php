<?php

namespace AssinarWeb\Models\Files;

class FileList
{
    /**
     * @var File
     */
    private $file;

    public function format($parameters)
    {
        $this->file->format($parameters);
        return $this;
    }
}