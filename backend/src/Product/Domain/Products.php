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

    public function add(Product $article): void
    {
        $this->entityManager->persist($article);
    }

    public function remove(Product $article): void
    {
        $this->entityManager->remove($article);
    }

    public function findById(Uuid $id): ?Product
    {
        return $this->entityManager->getRepository(Product::class)->find($id);
    }
}
