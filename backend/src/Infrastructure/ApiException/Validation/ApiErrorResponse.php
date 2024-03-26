<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiException\Validation;

/**
 * Сообщение ошибки
 */
final readonly class ApiErrorResponse
{
    /**
     * @param array<non-empty-string, ErrorMessage> $errors
     */
    public function __construct(
        public string $errorMessage,
        public array $errors,
    ) {}
}
