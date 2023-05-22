<?php

namespace AssinarWeb\Models\Files;

class FilesList
{
    /**
     * @param array $parameters
     * @return array FilesListItem
     */
    public function format(array $parameters) : array
    {
        $files = [];
        foreach ($parameters as $file) {
            $newFilesListItem = new FilesListItem();
            $files[] = $newFilesListItem->setFilesListItem($file);
        }
        return $files;
    }
}