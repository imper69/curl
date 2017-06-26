<?php
/**
 * Copyright: IMPER.INFO Adrian Szuszkiewicz
 * Date: 28.05.17
 * Time: 16:06
 */

namespace Imper86\Curl\Exception;


use Imper86\Curl\CurlClientInterface;

class CurlExceptionDispatch extends \Exception
{
    public function __construct(CurlClientInterface $curl)
    {
        switch ($curl->getLastErrorCode()) {
            case 400: throw new BadRequestException($curl);
            case 401: throw new UnauthorizedException($curl);
            case 403: throw new ForbiddenException($curl);
            case 404: throw new NotFoundException($curl);
            case 406: throw new NotAcceptableException($curl);
            case 422: throw new UnprocessableEntityException($curl);
            case 503: throw new ServiceUnavailableException($curl);
            default: throw new OtherException($curl);
        }
    }
}