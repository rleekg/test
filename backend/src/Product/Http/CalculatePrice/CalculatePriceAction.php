<?php

declare(strict_types=1);

namespace App\Product\Http\CalculatePrice;

use App\Infrastructure\ApiRequestValueResolver;
use App\Infrastructure\Response\ApiObjectResponse;
use App\Product\Command\CalculatePrice;
use App\Product\Command\CalculatePriceCommand;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Метод расчёта цены
 */
#[Route('/calculate-price', methods: [Request::METHOD_POST])]
#[AsController]
final readonly class CalculatePriceAction
{
    public function __construct(
        private CalculatePrice $calculatePrice,
    ) {}

    public function __invoke(
        #[ValueResolver(ApiRequestValueResolver::class)]
        CalculatePriceCommand $calculatePriceCommand
    ): ApiObjectResponse {
        $price = ($this->calculatePrice)($calculatePriceCommand);

        return new ApiObjectResponse(
            data: new PriceData($price),
        );
    }
}
