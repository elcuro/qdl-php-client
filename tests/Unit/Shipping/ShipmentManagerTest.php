<?php

declare(strict_types=1);

namespace Elcuro\Test\QdlPhpClient\Unit\Shipping;

use DateTimeImmutable;
use Elcuro\QdlPhpClient\Client\ClientInterface;
use Elcuro\QdlPhpClient\Shipping\AddedShipment\AddedShipmentFactoryInterface;
use Elcuro\QdlPhpClient\Shipping\AddedShipment\AddedShipmentInterface;
use Elcuro\QdlPhpClient\Shipping\Shipment\Shipment;
use Elcuro\QdlPhpClient\Shipping\Shipment\ShipmentPackage;
use Elcuro\QdlPhpClient\Shipping\ShipmentManager;
use Elcuro\Test\QdlPhpClient\Unit\TestCase;

class ShipmentManagerTest extends TestCase
{
    public function testAddShipment(): void
    {
        $shipment = new Shipment();
        $shipment
            ->setClientReference('client reference')
            ->setPickupDate(new DateTimeImmutable('2024-12-01'))
            ->setCod(12.3)
            ->setVariableSymbol('123456')
            ->setIban('GB33BUKB20201555555555')
            ->setNote('some note')
            ->setSenderId(1)
            ->setSenderName('Odosielateľ s.r.o.')
            ->setSenderStreet('Adámiho ulica 1')
            ->setSenderCity('Bratislava')
            ->setSenderZip('841 05')
            ->setSenderCountry('SK')
            ->setRecipientName('Janko Hraško')
            ->setRecipientStreet('Astronomická ulica 11')
            ->setRecipientCity('Košice')
            ->setRecipientZip('040 01')
            ->setRecipientCountry('sk')
            ->setRecipientPhone('+421 905 123 456')
            ->setRecipientEmail('janko@test.com')
            ->setRecipientContactPerson('Anna Hrašková')
            ->setInsuranceEnabled(true)
            ->setInsuranceValue(987.5)
            ->set24HoursDelivery(true)
            ->setUntil12Delivery(true)
            ->setSmsNotification(true)
            ->setCallNotification(true)
            ->setContainsReturnableDocuments(true)
            ->addPackage(new ShipmentPackage(22, 'ref'));

        $client = $this->createMock(ClientInterface::class);
        $client
            ->expects($this->once())
            ->method('sendCreateShipment')
            ->willReturn(['shipmentNumbers' => []])
            ->with($this->containsArray([
                'shipments' => [[
                    'clientReference' => 'client reference',
                    'pickupdate' => '01.12.2024',
                    'cod' => 12.3 ,
                    'codVarSym' => '123456',
                    'codIban' => 'GB33BUKB20201555555555',
                    'note' => 'some note',
                    'sender' => [
                        'id' => 1,
                        'type' => $shipment->getSenderType()->value,
                        'label' => [
                            'name' => 'Odosielateľ s.r.o.',
                            'street' => 'Adámiho ulica 1',
                            'city' => 'Bratislava',
                            'zip' => '841 05',
                            'country' => 'SK',
                        ],
                    ],
                    'recipient' => [
                        'name' => 'Janko Hraško',
                        'street' => 'Astronomická ulica 11',
                        'city' => 'Košice',
                        'zip' => '040 01',
                        'country' => 'SK',
                        'phone' => '+421 905 123 456',
                        'mail' => 'janko@test.com',
                        'contactPerson' => 'Anna Hrašková',
                    ],
                    'insurance' => [
                        'enabled' => 1,
                        'shipmentValue' => 987.5,
                    ],
                    'services' => [
                        'g24' => true,
                        't12' => true,
                        'sms' => true,
                        'call' => true,
                        'documentsBack' => true,
                    ],
                    'items' => [[
                        'weight' => 22.0 ,
                        'clientReference' => 'ref',
                    ],
                    ],
                ],
                ],
            ]));

        $createdShipmentFactory = $this->createMock(AddedShipmentFactoryInterface::class);
        $createdShipmentFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn([$this->createMock(AddedShipmentInterface::class)]);

        $manager = new ShipmentManager($client, $createdShipmentFactory);
        $manager->addShipment($shipment);
    }
}
