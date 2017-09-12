<?php
/**
 * Copyright: IMPER.INFO Adrian Szuszkiewicz
 * Date: 22.06.17
 * Time: 16:14
 */

namespace Imper86\Curl\Model;


use Imper86\Curl\CurlClientInterface;

class Response implements ResponseInterface
{
    private $requestUri;

    private $requestArray = [];

    private $rawResponse;

    private $unparsedResponse;

    public function __construct(CurlClientInterface $curlClient)
    {
        $this->requestUri = $curlClient->getLastRequestUrl();
        $this->requestArray = $curlClient->getLastRequestData();
        $this->rawResponse = $curlClient->getLastRawResponse();
        $this->unparsedResponse = $curlClient->getLastUnparsedResponse();
    }

    public function getRawResponse()
    {
        return $this->rawResponse;
    }

    public function getUnparsedResponse(): ?string
    {
        return $this->unparsedResponse;
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