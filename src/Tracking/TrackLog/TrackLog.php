<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Tracking\TrackLog;

use DateTimeInterface;

class TrackLog implements TrackLogInterface
{
    public function __construct(
        private readonly int $id,
        private readonly DateTimeInterface $date,
        private readonly string $name,
    ) {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDate(): DateTimeInterface
    {
        return $this->date;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
