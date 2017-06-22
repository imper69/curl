<?php
/**
 * Copyright: IMPER.INFO Adrian Szuszkiewicz
 * Date: 22.06.17
 * Time: 16:14
 */

namespace Imper69\Curl\Model;


use Imper69\Curl\CurlClientInterface;

class Response implements ResponseInterface
{
    private $requestUri;

    private $requestArray = [];

    private $rawResponse;

    public function __construct(CurlClientInterface $curlClient)
    {
        $this->requestUri = $curlClient->getLastRequestUrl();
        $this->requestArray = $curlClient->getLastRequestData();
        $this->rawResponse = $curlClient->getLastRawResponse();
    }

    public function getRawResponse()
    {
        return $this->rawResponse;
    }

    public function getRequest(): array
    {
        return $this->requestArray;
    }

    public function getRequestUrl(): string
    {
        return $this->requestUri;
    }

}