<?php
/**
 * Copyright: IMPER.INFO Adrian Szuszkiewicz
 * Date: 09.06.17
 * Time: 17:54
 */

namespace Imper69\Curl\Exception;


use Imper69\Curl\CurlClientInterface;

class EmptyResponseException extends AbstractCurlException
{
    public function __construct(CurlClientInterface $curl, string $message = 'Odpowiedź jest pusta, sprawdź czy wywołano request')
    {
        parent::__construct($curl);
        $this->message = $message;
    }
}