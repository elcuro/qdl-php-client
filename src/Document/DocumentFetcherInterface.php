<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Document;

use Elcuro\QdlPhpClient\Document\HandoverProtocol\HandoverProtocolInterface;
use Elcuro\QdlPhpClient\Document\Label\LabelInterface;
use Elcuro\QdlPhpClient\Document\Label\LabelType;

interface DocumentFetcherInterface
{
    public function fetchLabel(
        array $shipmentIds,
        LabelType $labelType,
        int $position = 1,
    ): LabelInterface;

    public function fetchHandoverProtocol(array $shipmentIds): HandoverProtocolInterface;
}
