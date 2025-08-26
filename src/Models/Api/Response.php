<?php

namespace AssinarWeb\Models\Api;

use AssinarWeb\Models\DefaultModel;


class Response extends DefaultModel
{
    /**
     * @var int code HTTP
     */
    public $code;

    /**
     * @var int errorCode
     */
    public $errorCode;

    /**
     * @var array messages
     */
    public $messages;

    public function setResponse(int $code, int $errorCode = 0, array $messages = [])
    {
        $this->code = $code ?? null;
        $this->messages = $messages ?? null;
        if($errorCode != 0) {
            $this->errorCode = $errorCode ?? null;
        } else {
            unset($this->errorCode);
        }
        return $this;
    }

}
