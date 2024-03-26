<?php

declare(strict_types=1);

namespace App\Product\Command\Purchase;

use App\Infrastructure\ApiException\ApiBadResponseException;
use App\Infrastructure\ApiException\ApiErrorCode;
use App\Infrastructure\AsService;
use App\Product\Command\CalculatePrice;
use App\Product\Command\CalculatePriceCommand;
use App\Product\Service\PaymentHandler;

/**
 * Хендлер покупки
 */
#[AsService]
final readonly class Purchase
{
    public function __construct(
        private CalculatePrice $calculatePrice,
        private PaymentHandler $paymentHandler,
    ) {
    }

    public function __invoke(PurchaseCommand $command): void
    {
        $price = ($this->calculatePrice)(new CalculatePriceCommand(
            product: $command->product,
            taxNumber: $command->taxNumber,
            couponCode: $command->couponCode,
        ));

        try {
            $this->paymentHandler->pay($price, $command->paymentProcessor);
        } catch (\Throwable $exception) {
            // обработка ошибок ....

            throw new ApiBadResponseException([$exception->getMessage()], ApiErrorCode::Exception);
        }
    }
}
