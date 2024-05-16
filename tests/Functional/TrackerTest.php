<?php

declare(strict_types=1);

namespace Elcuro\Test\QdlPhpClient\Functional;

use DateTimeInterface;
use Elcuro\QdlPhpClient\Tracking\TrackLog\TrackLogsInterface;

class TrackerTest extends TestCase
{
    public function testTrack(): void
    {
        $shipment = $this->createShipment();
        $manager = $this->createManager();
        $addedShipment = $manager->addShipment($shipment);

        $trackLogs = $this->createTracker()->trackShipment($addedShipment->getId());
        $this->assertInstanceOf(TrackLogsInterface::class, $trackLogs);
        $this->assertFalse($trackLogs->hasLogs());

        $manager->order();
        $trackLogs = $this->createTracker()->trackShipment($addedShipment->getId());
        $trackLog = $trackLogs->getLogs()[0];

        $this->assertIsInt($trackLog->getId());
        $this->assertNotEmpty($trackLog->getName());
        $this->assertInstanceOf(DateTimeInterface::class, $trackLog->getDate());
    }
}
