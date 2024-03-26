<?php

declare(strict_types=1);

namespace App\Product\Service\PayPal;

use App\Infrastructure\AsService;
use App\Product\Service\PaymentInterface;
use Systemeio\TestForCandidates\PaymentProcessor\PaypalPaymentProcessor;

/**
 * Сервис по работе с PaypalPaymentProcessor
 */
#[AsService]
final readonly class PayPal implements PaymentInterface
{
    private PaypalPaymentProcessor $paymentProcessor;

    public function __construct()
    {
        $this->paymentProcessor = new PaypalPaymentProcessor();
    }

    public const string PAYMENT_TYPE = 'paypal';

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
            $this->paymentProcessor->pay($price);

            return true;
        } catch (\Throwable) {
            // обработка ошибок
            return false;
        }
    }
}
