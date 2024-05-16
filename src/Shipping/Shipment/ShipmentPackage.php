<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Shipping\Shipment;

class ShipmentPackage implements ShipmentPackageInterface
{
    public function __construct(
        private readonly float $weight = 1,
        private readonly ?string $reference = null,
    ) {
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }
}
