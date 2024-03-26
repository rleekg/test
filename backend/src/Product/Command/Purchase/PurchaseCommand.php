<?php

declare(strict_types=1);

namespace App\Product\Command\Purchase;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Команда
 */
final readonly class PurchaseCommand
{
    public function __construct(
        #[NotBlank]
        public string $product,
        #[NotBlank]
        #[Assert\Regex('/^(DE|IT|GR|FR[A-Z]{2})\d{9}$/')]
        public string $taxNumber,
        #[Assert\Choice(['D15', 'D20', null])]
        public ?string $couponCode,
        #[NotBlank]
        public string $paymentProcessor,
    ) {}
}
