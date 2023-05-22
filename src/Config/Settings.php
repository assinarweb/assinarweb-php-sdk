<?php

namespace AssinarWeb\Config;

class Settings
{
    public $token;
    public $enviroment;
    public $url;

    public function __construct(string $token, string $enviroment)
    {
        $this->token = $token;
        $this->enviroment = $enviroment;
        $this->url = ($this->enviroment == 'P' ? 'https://assinador.linkcertificacao.com.br/' : 'http://local.assinatura/');
    }

}