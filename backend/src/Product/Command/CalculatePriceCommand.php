<?php

declare(strict_types=1);

namespace App\Product\Command;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Команда сохранения настройки
 */
final readonly class CalculatePriceCommand
{
    public function __construct(
        #[NotBlank]
        public string $product,
        #[NotBlank]
        #[Assert\Regex('/^(DE|IT|GR|FR[A-Z]{2})\d{9}$/')]
        public string $taxNumber,
        #[Assert\Choice(['D15', 'D20', null])]
        public ?string $couponCode,
    ) {}
}
