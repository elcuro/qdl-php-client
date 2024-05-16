<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Tracking\TrackLog;

interface TrackLogsInterface
{
    public function getShipmentId(): int;

    /**
     * @return array<TrackLogInterface>
     */
    public function getLogs(): array;

    public function hasLogs(): bool;
}
