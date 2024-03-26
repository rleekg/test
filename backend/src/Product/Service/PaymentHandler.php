<?php

declare(strict_types=1);

namespace App\Product\Service;

use App\Infrastructure\AsService;
use DomainException;

use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;


/**
 * Хендрелер оплаты
 */
#[AsService]
final readonly class PaymentHandler
{
    /**
     * @param PaymentInterface[] $payments
     */
    public function __construct(
        #[TaggedIterator(PaymentInterface::class)]
        private iterable $payments,
    ) {
    }

    public function pay(int $price, string $paymentType): bool
    {
        foreach ($this->payments as $payment) {
            if ($payment->isSupport($paymentType) === false) {
                continue;
            }

            $result = $payment->pay($price);

            if ($result === false) {
                throw new DomainException('Оплата не прошла');
            }

            /// обработка результатов (ошибки и т.д.)

            return $result;
        }

        throw new DomainException('Метод оплаты не поддерживается');
    }
}
