<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Document;

use Elcuro\QdlPhpClient\Document\HandoverProtocol\HandoverProtocolInterface;
use Elcuro\QdlPhpClient\Document\Label\LabelInterface;

interface DocumentFactoryInterface
{
    public function createLabel(array $data): LabelInterface;

    public function createHandoverProtocol(array $data): HandoverProtocolInterface;
}
