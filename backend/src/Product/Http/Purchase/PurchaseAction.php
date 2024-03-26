<?php

declare(strict_types=1);

namespace App\Product\Http\Purchase;

use App\Infrastructure\ApiRequestValueResolver;
use App\Infrastructure\Response\ApiObjectResponse;
use App\Infrastructure\Response\SuccessResponse;
use App\Product\Command\CalculatePrice;
use App\Product\Command\CalculatePriceCommand;
use App\Product\Command\Purchase\Purchase;
use App\Product\Command\Purchase\PurchaseCommand;
use App\Product\Http\CalculatePrice\PriceData;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Метод покупки
 */
#[Route('/purchase', methods: [Request::METHOD_POST])]
#[AsController]
final readonly class PurchaseAction
{
    public function __construct(
        private Purchase $purchase,
    ) {}

    public function __invoke(
        #[ValueResolver(ApiRequestValueResolver::class)]
        PurchaseCommand $purchaseCommand
    ): ApiObjectResponse {
        ($this->purchase)($purchaseCommand);

        return new ApiObjectResponse(
            data: new SuccessResponse(),
        );
    }
}
