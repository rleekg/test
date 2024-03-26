<?php

declare(strict_types=1);

namespace App\Product\Domain;

use App\Infrastructure\AsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

/**
 * Репозиторий Продукта
 */
#[AsService]
final readonly class Products
{
    public function __construct(private EntityManagerInterface $entityManager) {}

    public function add(Product $product): void
    {
        $this->entityManager->persist($product);
    }

    public function remove(Product $product): void
    {
        $this->entityManager->remove($product);
    }

    public function findById(Uuid $id): ?Product
    {
        return $this->entityManager->getRepository(Product::class)->find($id);
    }
}
