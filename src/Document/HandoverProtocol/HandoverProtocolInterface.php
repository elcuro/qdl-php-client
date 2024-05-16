<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Document\HandoverProtocol;

interface HandoverProtocolInterface
{
    public function getPDF(): string;
}
