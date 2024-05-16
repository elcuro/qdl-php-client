<?php

declare(strict_types=1);

namespace Elcuro\Test\QdlPhpClient\Functional;

class ClientTest extends TestCase
{
    public function testConnection(): void
    {
        $data = [];
        $client = $this->createClient();
        $response = $client->sendCreateShipment($data);

        $this->assertIsArray($response);
    }
}
