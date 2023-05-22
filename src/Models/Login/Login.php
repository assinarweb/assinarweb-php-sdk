<?php

namespace AssinarWeb\Models\Login;

use AssinarWeb\Models\User\Person\Person;
use AssinarWeb\Helpers\Util;
use stdClass;

class Login extends Person
{
    /**
     * @var string
     */
    private $token;
    /**
     * @var int
     */
    private $id_group;
    private $secretKey;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return int
     */
    public function getIdGroup(): int
    {
        return $this->id_group;
    }

    /**
     * @param int $id_group
     */
    public function setIdGroup(int $id_group)
    {
        $this->id_group = $id_group;
    }

    public function getSecretKey()
    {
        return $this->secretKey;
    }

    public function setSecretKey($secretKey)
    {
        $this->secretKey = $secretKey;
    }

    public function translateLoginFieldsName(Login $login){
        $newLogin = new stdClass();
        $newLogin->nome = $login->getName() ?? null;
            $newLogin->password = $login->getPassword() ?? null;
        $verifyAddress = Util::clearArray((array)$login->getAddress());
        if(!empty($verifyAddress)) {
            $newLogin->endereco = $login->getAddress() ?? null;
        }
        return $newLogin;
    }

    public function formatsResponseLogin(object $parameters)
    {
        $loginResponse = new Login();
        $loginResponse->setToken($parameters->token ?? null);
        $loginResponse->setId($parameters->id ?? null);
        $loginResponse->setName($parameters->nome ?? null);
        $loginResponse->setEmail($parameters->email ?? null);
        $loginResponse->setDocument(Util::setMaskCpfCnpj($parameters->documento) ?? null);
        $loginResponse->setIdGroup($parameters->id_grupo ?? null);
        if(!isset($parameters->chave_secreta)) {
            unset($loginResponse->secretKey);
        }
        unset($loginResponse->address);
        unset($loginResponse->phone);
        unset($loginResponse->cellphone);
        unset($loginResponse->password);
        unset($loginResponse->signature);
        unset($loginResponse->photo);
        return $loginResponse;
    }
}