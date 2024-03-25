<?php

declare(strict_types=1);

namespace App\Product\Domain;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Uid\UuidV7;

/**
 * Product
 */
#[ORM\Entity]
/** @final */
class Product
{
    #[ORM\Id, ORM\Column(type: 'uuid', unique: true)]
    private readonly Uuid $id;

    #[ORM\Column]
    private string $name;

    #[ORM\Column]
    private int $price;

    /**
     * @param non-empty-string $name
     * @param positive-int $price
     */
    public function __construct(string $name, int $price)
    {
        $this->id = new UuidV7();
        $this->name = $name;
        $this->price = $price;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): int
    {
        return $this->price;
    }
}
