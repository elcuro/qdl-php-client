<?php

declare(strict_types=1);

namespace Elcuro\Test\QdlPhpClient\Functional;

use Elcuro\QdlPhpClient\Client\ClientException;
use Elcuro\QdlPhpClient\Shipping\AddedShipment\AddedShipmentInterface;

class ShipmentManagerTest extends TestCase
{
    public function testAddShipment(): void
    {
        $shipment = $this->createShipment();
        $addedShipment = $this->createManager()->addShipment($shipment);

        $this->assertInstanceOf(AddedShipmentInterface::class, $addedShipment);
        $this->assertEquals('REF1', $addedShipment->getReference());
        $this->assertEquals('Janko Hraško', $addedShipment->getRecipient());
        $this->assertNotEmpty($addedShipment->getId());
        $this->assertIsArray($addedShipment->getPackageIds());
    }

    public function testAddShipmentWithoutReference(): void
    {
        $shipment = $this->createShipment();
        $shipment->setClientReference(null);

        $addedShipment = $this->createManager()->addShipment($shipment);
        $this->assertInstanceOf(AddedShipmentInterface::class, $addedShipment);
        $this->assertEquals('Janko Hraško', $addedShipment->getRecipient());
        $this->assertEmpty($addedShipment->getReference());
    }

    public function testAddShipmentWithoutRecipient(): void
    {
        $shipment = $this->createShipment();
        $shipment->setRecipientName('');

        $this->expectException(ClientException::class);
        $this->expectExceptionCode(400);
        $this->createManager()->addShipment($shipment);
    }

    public function testAddShipmentWithoutSenderId(): void
    {
        $shipment = $this->createShipment();
        $shipment->setSenderId(null);
        $shipment->setNote('without sender ID');

        $this->expectException(ClientException::class);
        $this->createManager()->addShipment($shipment);
    }

    public function testOrderShipment(): void
    {
        $this->expectNotToPerformAssertions();
        $this->createManager()->order();
    }

    public function testCancelShipment(): void
    {
        $shipment = $this->createShipment();
        $manager = $this->createManager();

        $addedShipment = $manager->addShipment($shipment);

        $this->expectNotToPerformAssertions();
        $manager->cancelShipment($addedShipment->getId());
    }
}
