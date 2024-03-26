<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiException\Validation;

use App\Infrastructure\AsService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Сериализует объект ошибки валидации в JsonResponse
 */
#[AsService]
final readonly class CreateValidationExceptionJsonResponse
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {}

    public function __invoke(ApiValidationExceptionInterface $e): JsonResponse
    {
        $content = $this->serializer->serialize(
            data: new ApiErrorResponse(
                errorMessage: 'Ошибка валидации',
                errors: $e->getErrors()
            ),
            format: JsonEncoder::FORMAT,
        );

        return new JsonResponse($content, Response::HTTP_BAD_REQUEST, [], true);
    }
}
