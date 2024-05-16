<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Tracking;

use Elcuro\QdlPhpClient\Tracking\TrackLog\TrackLogsInterface;

interface TrackerInterface
{
    /**
     * @param array<int> $shipmentIds
     *
     * @return array<int, TrackLogsInterface>
     */
    public function trackShipments(array $shipmentIds): array;

    public function trackShipment(int $shipmentId): TrackLogsInterface;
}
