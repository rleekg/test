<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiException\Validation;

use Exception;
use Throwable;

/**
 * Класс исключения для валидации
 */
final class ApiValidationException extends Exception implements ApiValidationExceptionInterface
{
    /**
     * @param array<non-empty-string, ErrorMessage> $errors
     */
    public function __construct(
        private readonly array $errors,
        ?Throwable $previous = null,
    ) {
        parent::__construct(previous: $previous);
    }

    /**
     * @return array<non-empty-string, ErrorMessage>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
