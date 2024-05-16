<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Tracking\TrackLog;

interface TrackLogsFactoryInterface
{
    public function createTrackLogs(int $shipmentId, array $data): TrackLogsInterface;
}
