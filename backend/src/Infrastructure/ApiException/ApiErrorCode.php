<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiException;

/**
 * Список кодов ошибок в АПИ
 */
enum ApiErrorCode: int
{
    case UserAlreadyExist = 1;

    case Exception = 2;
}
