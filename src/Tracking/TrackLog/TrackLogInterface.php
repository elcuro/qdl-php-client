<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Tracking\TrackLog;

use DateTimeInterface;

interface TrackLogInterface
{
    public function getId(): int;

    public function getName(): string;

    public function getDate(): DateTimeInterface;
}
