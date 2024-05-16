<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Document;

use Elcuro\QdlPhpClient\Client\ClientInterface;
use Elcuro\QdlPhpClient\Document\HandoverProtocol\HandoverProtocolInterface;
use Elcuro\QdlPhpClient\Document\Label\LabelInterface;
use Elcuro\QdlPhpClient\Document\Label\LabelType;

use function strtoupper;

class DocumentFetcher implements DocumentFetcherInterface
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly DocumentFactoryInterface $documentFactory,
    ) {
    }

    public function fetchLabel(
        array $shipmentIds,
        LabelType $labelType,
        int $position = 1,
    ): LabelInterface {
        $data = $this->client->sendGetLabel([
            'shipments' => $shipmentIds,
            'type' => strtoupper($labelType->name),
            'position' => $position,
        ]);

        return $this->documentFactory->createLabel($data);
    }

    public function fetchHandoverProtocol(array $shipmentIds): HandoverProtocolInterface
    {
        $data = $this->client->sendGetProtocol([
            'shipments' => $shipmentIds,
        ]);

        return $this->documentFactory->createHandoverProtocol($data);
    }
}
