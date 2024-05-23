<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Shipping;

use Elcuro\QdlPhpClient\Client\ClientInterface;
use Elcuro\QdlPhpClient\Shipping\AddedShipment\AddedShipmentFactoryInterface;
use Elcuro\QdlPhpClient\Shipping\AddedShipment\AddedShipmentInterface;
use Elcuro\QdlPhpClient\Shipping\Shipment\ShipmentInterface;
use Elcuro\QdlPhpClient\Shipping\Shipment\ShipmentPackageInterface;

use function array_map;
use function array_merge;
use function is_array;
use function reset;
use function strtoupper;

class ShipmentManager implements ShipmentManagerInterface
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly AddedShipmentFactoryInterface $createdShipmentFactory,
    ) {
    }

    public function addShipment(ShipmentInterface $shipment): AddedShipmentInterface
    {
        $addedShipments = $this->addShipments([$shipment]);

        return reset($addedShipments);
    }

    public function addShipments(array $shipments): array
    {
        $shipmentsData = array_map(
            fn (ShipmentInterface $shipment) => $this->createShipmentData($shipment),
            $shipments,
        );
        $responseData = $this->client->sendCreateShipment(['shipments' => $shipmentsData]);

        return $this->createdShipmentFactory->create($responseData['shipmentNumbers']);
    }

    public function order(): void
    {
        $this->client->sendOrder();
    }

    public function cancelShipment(int $shipmentId): void
    {
        $this->client->sendStorno([
            'shipmentNumber' => $shipmentId,
        ]);
    }

    private function createShipmentData(ShipmentInterface $shipment): array
    {
        $shipmentData = [
            'clientReference' => $shipment->getClientReference(),
            'pickupdate' => $shipment->getPickupDate()?->format('d.m.Y'),
            'cod' => $shipment->getCod(),
            'codVarSym' => $shipment->getVariableSymbol(),
            'codIban' => $shipment->getIban(),
            'note' => $shipment->getNote(),
            'sender' => [
                'id' => $shipment->getSenderId(),
                'type' => $shipment->getSenderType()->value,
            ],
            'recipient' => [
                'name' => $shipment->getRecipientName(),
                'street' => $shipment->getRecipientStreet(),
                'zip' => $shipment->getRecipientZip(),
                'city' => $shipment->getRecipientCity(),
                'country' => strtoupper($shipment->getRecipientCountry()),
                'phone' => $shipment->getRecipientPhone(),
                'contactPerson' => $shipment->getRecipientContactPerson(),
                'mail' => $shipment->getRecipientEmail(),
            ],
            'items' => array_map(
                fn (ShipmentPackageInterface $item): array => [
                    'weight' => $item->getWeight(),
                    'clientReference' => $item->getReference(),
                ],
                $shipment->getPackages(),
            ),
            'insurance' => [
                'enabled' => (int) $shipment->isInsuranceEnabled(),
                'shipmentValue' => $shipment->getInsuranceValue(),
            ],
            'services' => [
                'g24' => $shipment->is24HoursDelivery(),
                't12' => $shipment->isUntil12Delivery(),
                'sms' => $shipment->isSMSNotification(),
                'call' => $shipment->isCallNotification(),
                'documentsBack' => $shipment->itContainsReturnableDocuments(),
            ],
        ];

        $sender = [
            'name' => $shipment->getSenderName(),
            'street' => $shipment->getSenderStreet(),
            'zip' => $shipment->getSenderZip(),
            'city' => $shipment->getSenderCity(),
            'country' => strtoupper($shipment->getSenderCountry() ?? ''),
        ];

        // If sender ID is null it is B2A, or B2C shipment type
        if ($shipment->getSenderId() === null) {
            $shipmentData['sender'] = array_merge($shipmentData['sender'], $sender);
        } else {
            $shipmentData['sender']['label'] = $sender;
        }

        return $this->cleanData($shipmentData);
    }

    private function cleanData(array $data): array
    {
        foreach ($data as $key => &$value) {
            if (is_array($value)) {
                $value = $this->cleanData($value);
            }

            if (empty($value) && $value !== 0 && $value !== '0') {
                unset($data[$key]);
            }
        }

        return $data;
    }
}
