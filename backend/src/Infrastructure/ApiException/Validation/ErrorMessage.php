<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiException\Validation;

/**
 * Сообщение ошибки
 */
final readonly class ErrorMessage
{
    /**
     * @param non-empty-string $property
     * @param non-empty-string $value
     * @param non-empty-string $message
     * @param non-empty-string $code
     */
    public function __construct(
        public string $property,
        public string $value,
        public string $message,
        public string $code,
    ) {}
}
