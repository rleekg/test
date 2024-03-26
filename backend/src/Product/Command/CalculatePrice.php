<?php

declare(strict_types=1);

namespace App\Product\Command;

use App\Infrastructure\AsService;
use App\Product\Domain\Countries;
use App\Product\Domain\Products;
use Symfony\Component\Uid\Uuid;

/**
 * Хендлер калькулятора
 */
#[AsService]
final readonly class CalculatePrice
{
    public function __construct(
        private Products $products,
        private Countries $countries,
    ) {}

    public function __invoke(CalculatePriceCommand $command): int
    {
        $product = $this->products->findById(Uuid::fromString($command->product));
        $country = $this->countries->findByTxNumber($command->taxNumber);
        $discounts = ['D15' => 15, 'D20' => 20]; // Купоны

        // проверки сущностей.... и доп логика при необходимости

        $discount = 0;
        if ($command->couponCode !== null) {
            $discount = $product->getPrice() * $discounts[$command->couponCode] / 100;
        }

        $priceDiscount = $product->getPrice() - $discount;
        $tax = (int) ($priceDiscount * $country->getTax() / 100);

        return $priceDiscount + $tax;
    }
}
