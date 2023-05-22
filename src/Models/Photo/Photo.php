<?php

namespace AssinarWeb\Models\Photo;

use AssinarWeb\Helpers\Util;
use stdClass;

class Photo
{
    private $image;
    private $path;

    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage(string $image)
    {
        $this->image = $image;
    }

    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path)
    {
        $this->path = $path;
    }

    public function translatePhotoFieldNames($parameters)
    {
        $newPhoto = new stdClass();
        if(isset($parameters->foto)) {
            $newPhoto->image = $parameters->foto ?? null;
        }
        if(isset($parameters->photo)) {
            $newPhoto->image = $parameters->photo ?? null;
        }
        if(isset($parameters->image)) {
            $newPhoto->image = $parameters->image ?? null;
        }

        if(isset($parameters->url)) {
            $newPhoto->path = $parameters->url ?? null;
        }
        if(isset($parameters->path)) {
            $newPhoto->path = $parameters->path ?? null;
        }
        return Util::ObjectRemovedNull($newPhoto);
    }
}