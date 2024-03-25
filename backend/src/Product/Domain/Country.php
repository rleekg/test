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
class Country
{
    #[ORM\Id, ORM\Column(type: 'uuid', unique: true)]
    private readonly Uuid $id;

    #[ORM\Column]
    private string $name;

    #[ORM\Column]
    private string $code;

    #[ORM\Column]
    private int $tax;

    /**
     * @param non-empty-string $name
     * @param non-empty-string $code
     * @param positive-int $tax
     */
    public function __construct(string $name, string $code, int $tax)
    {
        $this->id = new UuidV7();
        $this->name = $name;
        $this->code = $code;
        $this->tax = $tax;
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getTax(): int
    {
        return $this->tax;
    }
}
