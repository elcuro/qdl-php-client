<?php

declare(strict_types=1);

namespace Elcuro\Test\QdlPhpClient\Unit\Shipping;

use Elcuro\QdlPhpClient\Shipping\Shipment\Shipment;
use Elcuro\QdlPhpClient\Shipping\Shipment\ShipmentInterface;
use Elcuro\Test\QdlPhpClient\Unit\TestCase;

class ShipmentTest extends TestCase
{
    public function testInstance(): void
    {
        $shipment = new Shipment();
        $this->assertInstanceOf(ShipmentInterface::class, $shipment);
    }
}
