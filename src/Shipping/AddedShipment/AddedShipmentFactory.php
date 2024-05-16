<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Shipping\AddedShipment;

use function explode;

class AddedShipmentFactory implements AddedShipmentFactoryInterface
{
    public function create(array $data): array
    {
        $addedShipments = [];
        foreach ($data as $identifiers => $shipmentsData) {
            [$clientReference, $recipient] = explode(' | ', $identifiers);
            foreach ($shipmentsData as $shipments) {
                foreach ($shipments as $shipmentId => $packageIds) {
                    $addedShipments[] = new AddedShipment(
                        $clientReference,
                        $recipient,
                        $shipmentId,
                        $packageIds,
                    );
                }
            }
        }

        return $addedShipments;
    }
}
