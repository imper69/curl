<?php
/**
 * Copyright: IMPER.INFO Adrian Szuszkiewicz
 * Date: 28.05.17
 * Time: 16:10
 */

namespace Imper69\Curl\Exception;


use Imper69\Curl\CurlClientInterface;

abstract class AbstractCurlException extends \Exception
{
    private $curl;

    public function __construct(CurlClientInterface $curl)
    {
        parent::__construct($curl->getLastErrorMessage(), $curl->getLastErrorCode());
        $this->curl = $curl;
    }

    public function getCurlResponse()
    {
        return $this->curl->getLastResponse();
    }

    public function getCurlRequest()
    {
        return $this->curl->getLastRequestData();
    }
}