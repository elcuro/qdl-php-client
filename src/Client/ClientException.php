<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Client;

use Exception;
use Throwable;

class ClientException extends Exception implements ClientExceptionInterface
{
    public static function fromException(Throwable $exception): self
    {
        return new self($exception->getMessage(), (int) $exception->getCode(), $exception);
    }
}
