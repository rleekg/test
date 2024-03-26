<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Infrastructure\ApiException\ApiBadRequestException;
use App\Infrastructure\ApiException\BuildMappingErrorMessages;
use App\Infrastructure\ApiException\Validation\ApiValidationException;
use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\Mapper\Source\Exception\InvalidSource;
use CuyZ\Valinor\Mapper\Source\JsonSource;
use CuyZ\Valinor\Mapper\Tree\Message\ErrorMessage;
use CuyZ\Valinor\Mapper\Tree\Message\MessageBuilder;
use CuyZ\Valinor\MapperBuilder;
use Override;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Throwable;
use Webmozart\Assert\InvalidArgumentException;

/**
 * Преобразует Request в объект запроса
 *
 * @template TApiRequest of object
 */
#[AsService]
final readonly class ApiRequestValueResolver implements ValueResolverInterface
{
    public function __construct(
        private BuildMappingErrorMessages $buildMappingErrorMessages,
        private ValidatorInterface $validator,
    ) {}

    /**
     * @return iterable<TApiRequest>
     *
     * @throws ApiBadRequestException
     * @throws ApiValidationException
     */
    #[Override]
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        /** @var class-string<TApiRequest>|null $className */
        $className = $argument->getType();
        if ($className === null) {
            return [];
        }

        try {
            $requestObject = (new MapperBuilder())
                ->filterExceptions(static function (Throwable $exception): ErrorMessage {
                    if ($exception instanceof InvalidArgumentException) {
                        return MessageBuilder::from($exception);
                    }

                    throw $exception;
                })
                ->mapper()
                ->map(
                    signature: $className,
                    source: new JsonSource($request->getContent()),
                );
        } catch (MappingError $e) {
            $errorMessages = ($this->buildMappingErrorMessages)($e);

            throw new ApiBadRequestException($errorMessages, $e);
        } catch (InvalidSource $e) {
            throw new ApiBadRequestException(['Невалидный json'], $e);
        }

        $errors = $this->validator->validate($requestObject);
        if ($errors->count() === 0) {
            return [$requestObject];
        }

        /** @var array<non-empty-string, ApiException\Validation\ErrorMessage> $errors */
        $errors = [];
        foreach ($this->validator->validate($requestObject) as $error) {
            /** @var non-empty-string $property */
            $property = $error->getPropertyPath();

            /** @var non-empty-string $value */
            $value = $error->getInvalidValue();

            /** @var non-empty-string $message */
            $message = $error->getMessage();

            /** @var non-empty-string $code */
            $code = $error->getCode();

            $errors[$property] = new ApiException\Validation\ErrorMessage(
                property: $property,
                value: $value,
                message: $message,
                code: $code,
            );
        }

        throw new ApiValidationException($errors);
    }
}
