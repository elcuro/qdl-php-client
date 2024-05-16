<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Tracking;

use Elcuro\QdlPhpClient\Client\ClientInterface;
use Elcuro\QdlPhpClient\Tracking\TrackLog\TrackLogsFactoryInterface;
use Elcuro\QdlPhpClient\Tracking\TrackLog\TrackLogsInterface;

use function reset;

class Tracker implements TrackerInterface
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly TrackLogsFactoryInterface $trackLogsFactory,
    ) {
    }

    public function trackShipment(int $shipmentId): TrackLogsInterface
    {
        $trackLogs = $this->trackShipments([$shipmentId]);

        return reset($trackLogs);
    }

    public function trackShipments(array $shipmentIds): array
    {
        $data = $this->client->sendGetStatusHistory([
            'shipmentNumbers' => $shipmentIds,
        ]);

        $shipmentsTrackLogs = [];
        foreach ($data as $shipmentId => $shipmentTrackData) {
            $shipmentsTrackLogs[] = $this->trackLogsFactory->createTrackLogs(
                (int) $shipmentId,
                $shipmentTrackData['history'],
            );
        }

        return $shipmentsTrackLogs;
    }
}
