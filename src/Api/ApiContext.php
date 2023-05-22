<?php

namespace AssinarWeb\Api;

use AssinarWeb\Models\DefaultModel;

class ApiContext extends DefaultModel
{
    const HOMOLOGATION_ENVIRONMENT = false;
    const PRODUCTION_ENVIRONMENT = true;
    const DOMAIN_LINK = 'https://assinador.linkcertificacao.com.br';
    const PARTNER_PREFIX_LINK = 'aclink/';

    /**
     * @var string token
     */
    private $token;
    /**
     * @var bool environment  0:  homologation - 1: Production
     */
    private $environment;
    /**
     * @var string partnerPrefix
     */
    private $partnerPrefix;
    /**
     * @var string domain
     */
    private  $domain;

    public function __construct($domain=null, $partnerPrefix = null)
    {
        $this->domain = (!$domain) ? $this::DOMAIN_LINK . DIRECTORY_SEPARATOR . 'api' : $domain;
        $this->partnerPrefix = (!$partnerPrefix) ? $this::PARTNER_PREFIX_LINK : $partnerPrefix;
    }

    public function setApiToken(string $token)
    {
        $this->token = $token;
    }

    public function setEnvironment(bool $environment)
    {
        $this->environment = $environment;
    }

    public function getApiToken()
    {
        return $this->token;
    }

    public function getEnvironment()
    {
        return $this->environment;
    }

    public function setPartnerPrefix(string $partnerPrefix)
    {
        $this->partnerPrefix = $partnerPrefix;
    }

    public function getPartnerPrefix()
    {
        return $this->partnerPrefix;
    }

    public function setDomain(string $domain)
    {
        $this->domain = $domain;
    }

    public function getDomain()
    {
        return $this->domain;
    }
}