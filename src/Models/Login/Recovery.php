<?php

namespace AssinarWeb\Models\Login;

use AssinarWeb\Models\User\Person\Person;
use AssinarWeb\Helpers\Util;
use stdClass;

class Recovery extends Person
{
    /**
     * @var int
     */
    private $code;
    /**
     * @var string
     */
    private $cPassword;

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCPassword(): string
    {
        return $this->cPassword;
    }

    /**
     * @param string $cPassword
     */
    public function setCPassword(string $cPassword)
    {
        $this->cPassword = $cPassword;
    }

    public function  translateRecoveryFieldsName(Recovery $recovery)
    {
        $newRecovery = new stdClass();
        $newRecovery->code = $recovery->getCode() ?? null;
        $newRecovery->documento = $recovery->getDocument() ?? null;
        $newRecovery->senha = $recovery->getPassword() ?? null;
        $newRecovery->csenha = $recovery->getCPassword() ?? null;
        $verifyAddress = Util::clearArray((array)$recovery->getAddress());
        if(!empty($verifyAddress)) {
            $newRecovery->endereco = $recovery->getAddress() ?? null;
        }
        return Util::ObjectRemovedNull($newRecovery);
    }
}