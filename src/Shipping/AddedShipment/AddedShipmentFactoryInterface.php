<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Shipping\AddedShipment;

interface AddedShipmentFactoryInterface
{
    /**
     * @return array<AddedShipmentInterface>
     */
    public function create(array $data): array;
}
