<?php

namespace AssinarWeb\Service\Client;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use AssinarWeb\Api\ApiContext;
use AssinarWeb\Models\Api\Response;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Illuminate\Support\Collection;

class Client
{
    private $method;
    private $endPoint;
    private $client;
    private $apiContext;
    private $response;
    private $url;

    public function __construct(ApiContext $apiContext, string $method, string $endPoint)
    {
        $this->apiContext = $apiContext;
        $this->url = $this->apiContext->getDomain() . '/api/' . $apiContext->getPartnerPrefix();
        if($apiContext->getEnvironment() == ApiContext::HOMOLOGATION_ENVIRONMENT) {
            $this->url = 'http://local.assinatura/api/' . $apiContext->getPartnerPrefix() .  '/';
        }

        $this->method = $method;
        $this->endPoint = $endPoint;
        $this->response = new Response();
    }

    public function handleApiReturn($response) : object
    {
        $return = null;
        $successCode = [200, 201, 204];
        if (in_array($response->getStatusCode(), $successCode)) {
            $return = json_decode($response->getBody());
        }
        return $return;
    }

    public function handleApiError(Exception $e) : object
    {
        $return = false;
        switch ($e->getCode()){
            case 400:
                $return = json_decode($e->getResponse()->getBody());
                $this->response->code = (int) $e->getCode();
                if(isset($this->response->errorCode)) {
                    $this->response->errorCode = (int) $return->errorCode;
                } else {
                    unset($this->response->errorCode);
                }

                $this->response->messages = [$return->message];
                return $this->response;
                break;

            case 401:
                $return = json_decode($e->getResponse()->getBody());
                $this->response->code = (int) $e->getCode();
                //$this->response->errorCode = (int) $return->errorCode;
                $this->response->messages = [$return->message];
                return $this->response;
                break;

            case 403:
                $this->response->code = (int) $e->getCode();
                $this->response->messages = ['Erro: 403'];
                unset($this->response->errorCode);
                return $this->response;
                break;

            case 404:
                $this->response->code = (int) $e->getCode();
                $this->response->messages = ['Erro: 404'];
                unset($this->response->errorCode);
                return $this->response;
                break;

            case 405:
                $this->response->code = (int) $e->getCode();
                $this->response->messages = ['Erro: 405'];
                unset($this->response->errorCode);
                return $this->response;
                break;

            case 422:
                $return = json_decode($e->getResponse()->getBody());
                $this->response->code = (int) $e->getCode();
                $this->response->messages = $return->message;
                unset($this->response->errorCode);
                return $this->response;
                break;

            case 500:
                $this->response->code = (int) $e->getCode();
                $this->response->messages = ['Erro: 500'];
                unset($this->response->errorCode);
                return $this->response;
                break;

            case 503:
                $this->response->code = (int) $e->getCode();
                $this->response->messages = ['Erro: 503'];
                unset($this->response->errorCode);
                return $this->response;
                break;

            default:
                $this->response->code = (int) $e->getCode();
                unset($this->response->errorCode);
                return $this->response;
                break;
        }
    }

    public static function arrayRemoveNull($item)
    {
        if(!is_array($item)) {
            return $item;
        }

        return (new Collection($item))
            ->reject(function($item) {
                return null === $item;
            })
            ->flatMap(function ($item, $key){
                return is_numeric($key)
                    ? [self::arrayRemoveNull($item)]
                    : [$key => self::arrayRemoveNull($item)];
            })
            ->toArray();
    }

    public static function normalize(object $data): array
    {
        $serializer = new Serializer([new ObjectNormalizer()]);
        $data = self::arrayRemoveNull($serializer->normalize($data));

        foreach ($data as $key => $d) {
            if (empty($d)) {
                unset($data[$key]);
            }
        }

        return $data;
    }

    public static function ObjectRemoveNull(object $data)
    {
        foreach ($data as $key => $d) {
            if (is_null($d)) {
                unset($data->$key);
            }
        }
        return $data;
    }

    public function call(object $data = null, bool $containFiles = false)
    {
        try {
            $this->client = new GuzzleClient();
            $options['headers']['Authorization'] = sprintf('%s %s', 'Bearer', trim($this->apiContext->getApiToken()));
            if(!$containFiles) {
                $options['headers']['Content-Type'] = 'application/json';
            }
            $options['headers']['token'] = trim($this->apiContext->getApiToken());
            $options['json'] = null;

            if ($data && $containFiles == false) {
                $options['json'] = $this->normalize($data);
            } else {
                $options['multipart'] = null;
                $options['multipart'] = (array)$data;
                unset($options['json']);
            }

            return $this->handleApiReturn(
                $this->client->request($this->method, $this->url . $this->endPoint, $options)
            );

        } catch (\Exception $e) {
            return $this->handleApiError($e);
        }
    }
}