<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Shipping\Shipment;

interface ShipmentPackageInterface
{
    public function getWeight(): float;

    public function getReference(): ?string;
}
