<?php

declare(strict_types=1);

namespace Elcuro\Test\QdlPhpClient\Functional;

use Elcuro\QdlPhpClient\Document\HandoverProtocol\HandoverProtocolInterface;
use Elcuro\QdlPhpClient\Document\Label\LabelInterface;
use Elcuro\QdlPhpClient\Document\Label\LabelType;
use Elcuro\QdlPhpClient\Shipping\Shipment\ShipmentPackage;

class DocumentFetcherTest extends TestCase
{
    public function testShipmentLabel(): void
    {
        $shipment = $this->createShipment();
        $shipment->addPackage(new ShipmentPackage());
        $addedShipment = $this->createManager()->addShipment($shipment);

        $label = $this->createDocumentFetcher()->fetchLabel(
            [$addedShipment->getId()],
            LabelType::A4,
        );

        $this->assertInstanceOf(LabelInterface::class, $label);
        $this->assertNotEmpty($label->getPDF());
    }

    public function testHandoverProtocol(): void
    {
        $shipment = $this->createShipment();
        $shipment->addPackage(new ShipmentPackage());
        $addedShipment = $this->createManager()->addShipment($shipment);

        $protocol = $this->createDocumentFetcher()->fetchHandoverProtocol(
            [$addedShipment->getId()],
        );

        $this->assertInstanceOf(HandoverProtocolInterface::class, $protocol);
        $this->assertNotEmpty($protocol->getPDF());
    }
}
