<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Client;

interface ClientInterface
{
    public function sendCreateShipment(array $data): array;

    public function sendGetLabel(array $data): array;

    public function sendGetProtocol(array $data): array;

    public function sendOrder(): void;

    public function sendStorno(array $data): array;

    public function sendGetStatusHistory(array $data): array;
}
