<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Shipping;

use Elcuro\QdlPhpClient\Shipping\AddedShipment\AddedShipmentInterface;
use Elcuro\QdlPhpClient\Shipping\Shipment\ShipmentInterface;

interface ShipmentManagerInterface
{
    public function addShipment(ShipmentInterface $shipment): AddedShipmentInterface;

    /**
     * @param array<ShipmentInterface> $shipments
     *
     * @return array<AddedShipmentInterface>
     */
    public function addShipments(array $shipments): array;

    public function order(): void;

    public function cancelShipment(int $shipmentId): void;
}
