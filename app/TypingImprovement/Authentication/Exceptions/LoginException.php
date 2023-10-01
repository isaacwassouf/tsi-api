<?php

declare(strict_types=1);

namespace App\TypingImprovement\Authentication\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class LoginException extends Exception implements HttpExceptionInterface
{
    public function getStatusCode(): int
    {
        return 422;
    }

    public function getHeaders(): array
    {
        return [];
    }
}
