<?php

declare(strict_types=1);

namespace App\Product\Domain;

use App\Infrastructure\AsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

/**
 * Репозиторий стран
 */
#[AsService]
final readonly class Countries
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function add(Country $country): void
    {
        $this->entityManager->persist($country);
    }

    public function remove(Country $country): void
    {
        $this->entityManager->remove($country);
    }

    public function findById(Uuid $id): ?Country
    {
        return $this->entityManager->getRepository(Country::class)->find($id);
    }

    public function findByTxNumber(string $taxNumber): Country
    {
        return $this->entityManager->getRepository(Country::class)
            ->createQueryBuilder('c')
            ->where('c.code = :code')
            ->setParameter('code', mb_substr($taxNumber, 0, 2))
            ->getQuery()->getSingleResult();
    }
}
