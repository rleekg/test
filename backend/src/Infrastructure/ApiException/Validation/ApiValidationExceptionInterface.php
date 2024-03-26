<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiException\Validation;

/**
 * Интерфейс исключений валидации
 */
interface ApiValidationExceptionInterface
{
    /**
     * @return array<non-empty-string, ErrorMessage>
     */
    public function getErrors(): array;
}
