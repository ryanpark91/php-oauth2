<?php declare(strict_types=1);
namespace Ridibooks\OAuth2\Symfony\Exception;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class InsufficientScopeException extends HttpException
{
    public function __construct()
    {
        parent::__construct(Response::HTTP_FORBIDDEN);
    }
}
