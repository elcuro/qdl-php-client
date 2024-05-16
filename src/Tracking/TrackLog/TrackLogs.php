<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Tracking\TrackLog;

use function count;

class TrackLogs implements TrackLogsInterface
{
    /**
     * @param array<TrackLogInterface> $trackLogs
     */
    public function __construct(
        private readonly int $shipmentId,
        private readonly array $trackLogs,
    ) {
    }

    public function getShipmentId(): int
    {
        return $this->shipmentId;
    }

    public function getLogs(): array
    {
        return $this->trackLogs;
    }

    public function hasLogs(): bool
    {
        return 0 < count($this->trackLogs);
    }
}
