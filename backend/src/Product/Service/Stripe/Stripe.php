<?php

declare(strict_types=1);

namespace App\Product\Service\Stripe;

use App\Infrastructure\AsService;
use App\Product\Service\PaymentInterface;
use Systemeio\TestForCandidates\PaymentProcessor\StripePaymentProcessor;

/**
 * Сервис по работе с StripePaymentProcessor
 */
#[AsService]
final readonly class Stripe implements PaymentInterface
{
    private StripePaymentProcessor $paymentProcessor;

    public function __construct()
    {
        $this->paymentProcessor = new StripePaymentProcessor();
    }

    public const string PAYMENT_TYPE = 'stripe';

    public function isSupport(string $paymentType): bool
    {
        return $paymentType === self::PAYMENT_TYPE;
    }

    /**
     * @param int $price
     */
    public function pay(int $price): bool
    {
        try {
            // предполагаем что мы храним цены в (в минимальном значении валюты копейки/центы)
            return $this->paymentProcessor->processPayment($price / 1000);
        } catch (\Throwable) {
            // обработка ошибок
            return false;
        }
    }
}
