<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Document;

use Elcuro\QdlPhpClient\Document\HandoverProtocol\HandoverProtocol;
use Elcuro\QdlPhpClient\Document\HandoverProtocol\HandoverProtocolInterface;
use Elcuro\QdlPhpClient\Document\Label\Label;
use Elcuro\QdlPhpClient\Document\Label\LabelInterface;

use function base64_decode;

class DocumentFactory implements DocumentFactoryInterface
{
    public function createLabel(array $data): LabelInterface
    {
        return new Label(base64_decode($data['data']));
    }

    public function createHandoverProtocol(array $data): HandoverProtocolInterface
    {
        return new HandoverProtocol(base64_decode($data['pdf']));
    }
}
