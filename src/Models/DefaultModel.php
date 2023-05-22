<?php

namespace AssinarWeb\Models;

use Exception;

class DefaultModel
{
    public function __set($name, $value)
    {
        if(!is_string($name)){
            throw new Exception(sprintf('Classe "%s" não possui propriedade "%s"', get_class($this), $name));
        }
        $this->name = $value;
    }

    public function __get($name)
    {
        if(!is_string($name)){
            throw new Exception(sprintf('Não foi possível capturar a propriedade "%s" da Classe "%s"', $name, get_class($this)));
        }
        echo $this->name;
    }
    
    public function displayParams($responseParams)
    {
        $object = (object)[];
        $object = $responseParams;
        foreach ($responseParams->parameters as $idx =>  $responseParam) {
            $object->$idx = $responseParam;
        }
        unset($object->parameters);

        return $object;
    }
}