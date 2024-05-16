<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Tracking\TrackLog;

use DateTimeImmutable;
use DateTimeZone;
use Throwable;

class TrackLogsFactory implements TrackLogsFactoryInterface
{
    public function createTrackLogs(int $shipmentId, array $data): TrackLogsInterface
    {
        $trackLogs = [];
        foreach ($data as $logData) {
            $trackLogs[] = $this->createTrackLog($logData);
        }

        return new TrackLogs($shipmentId, $trackLogs);
    }

    private function createTrackLog(array $data): TrackLogInterface
    {
        try {
            $date = new DateTimeImmutable(
                $data['created']['date'],
                new DateTimeZone($data['created']['timezone']),
            );
        } catch (Throwable $e) {
            $date = new DateTimeImmutable('now');
        }

        return new TrackLog($data['id'], $date, $data['name']);
    }
}
