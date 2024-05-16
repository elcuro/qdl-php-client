<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Document\HandoverProtocol;

class HandoverProtocol implements HandoverProtocolInterface
{
    public function __construct(
        private readonly string $pdf,
    ) {
    }

    public function getPDF(): string
    {
        return $this->pdf;
    }
}
