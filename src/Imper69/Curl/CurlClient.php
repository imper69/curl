<?php
/**
 * Copyright: IMPER.INFO Adrian Szuszkiewicz
 * Date: 22.06.17
 * Time: 16:35
 * ver1
 */

namespace Imper69\Curl;


use Curl\Curl;
use Imper69\Curl\Exception\CurlExceptionDispatch;
use Imper69\Curl\Model\Response;
use Imper69\Curl\Model\ResponseInterface;

class CurlClient implements CurlClientInterface
{
    /**
     * @var string
     */
    private $baseUrlExt;

    /**
     * @var array
     */
    private $lastRequest = [];

    /**
     * @var string
     */
    private $lastRequestUrl;

    /**
     * @var ResponseInterface
     */
    private $lastResponse;

    /**
     * @var Curl
     */
    private $curlExtLib;


    public function __construct($base_url = null)
    {
        $this->baseUrlExt = $base_url;
        $this->curlExtLib = new Curl();
    }

    private function prepareUrl(string $url): string
    {
        if (empty($this->baseUrlExt)) return $url;
        if (substr($url, 0, 4) == 'http') return $url;

        if ('/' != substr($url, 0, 1)) {
            $url = '/' . $url;
        }

        $this->lastRequestUrl = $this->baseUrlExt . $url;

        return $this->lastRequestUrl;
    }

    private function parseResponse()
    {
        $this->lastResponse = new Response($this);
        return $this->lastResponse;
    }

    public function setBaseUrl(string $baseUrl = null): void
    {
        if (!empty($baseUrl)) {
            if ('/' == substr($baseUrl, -1)) {
                $baseUrl = substr($baseUrl, 0, strlen($baseUrl) - 1);
            }
            $this->baseUrlExt = $baseUrl;
        } else {
            $this->baseUrlExt = null;
        }
    }

    public function setHeader(string $key, string $value): void
    {
        $this->curlExtLib->setHeader($key, $value);
    }

    public function setBasicAuthentication(string $username, string $password = ''): void
    {
        $this->curlExtLib->setBasicAuthentication($username, $password);
    }

    public function post(string $url, array $data = array(), bool $follow_303_with_post = false): ?ResponseInterface
    {
        $this->curlExtLib->post($this->prepareUrl($url), $data, $follow_303_with_post);
        $this->lastRequest = $data;

        if (!empty($this->getLastErrorCode())) throw new CurlExceptionDispatch($this);

        return $this->parseResponse();
    }

    public function put(string $url, array $data = array()): ?ResponseInterface
    {
        $this->curlExtLib->put($this->prepareUrl($url), $data);
        $this->lastRequest = $data;

        if (!empty($this->getLastErrorCode())) throw new CurlExceptionDispatch($this);

        return $this->parseResponse();
    }

    public function get(string $url, $data = array()): ?ResponseInterface
    {
        $this->curlExtLib->get($this->prepareUrl($url), $data);
        $this->lastRequest = $data;

        if (!empty($this->getLastErrorCode())) throw new CurlExceptionDispatch($this);

        return $this->parseResponse();
    }

    public function delete(string $url, array $query_parameters = array(), array $data = array()): ?ResponseInterface
    {
        $this->curlExtLib->delete($url, $query_parameters, $data);
        $this->lastRequest = $data;

        if (!empty($this->getLastErrorCode())) throw new CurlExceptionDispatch($this);

        return $this->parseResponse();
    }

    public function getLastErrorCode(): ?int
    {
        return $this->curlExtLib->errorCode;
    }

    public function getLastErrorMessage(): ?string
    {
        return $this->curlExtLib->errorMessage;
    }

    public function getLastResponse(): ?ResponseInterface
    {
        return $this->lastResponse;
    }

    public function getLastRawResponse()
    {
        return $this->curlExtLib->response;
    }


    public function getLastRequestData()
    {
        return $this->lastRequest;
    }

    public function getLastRequestUrl(): string
    {
        return $this->lastRequestUrl;
    }


}