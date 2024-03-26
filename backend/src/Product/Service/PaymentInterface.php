<?php

declare(strict_types=1);

namespace App\Product\Service;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

/**
 * Общий интерфейс
 */
#[AutoconfigureTag]
interface PaymentInterface
{
    public function isSupport(string $paymentType): bool;

    public function pay(int $price): bool;
}
