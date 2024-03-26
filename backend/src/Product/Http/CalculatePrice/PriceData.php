<?php

declare(strict_types=1);

namespace App\Product\Http\CalculatePrice;

/**
 * Информация
 */
final readonly class PriceData
{
    public function __construct(
        public int $price,
    ) {}
}
