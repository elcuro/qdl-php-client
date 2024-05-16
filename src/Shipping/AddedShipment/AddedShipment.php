<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Shipping\AddedShipment;

class AddedShipment implements AddedShipmentInterface
{
    /**
     * @param array<string> $packageIds
     */
    public function __construct(
        private readonly string $reference,
        private readonly string $recipient,
        private readonly int $id,
        private readonly array $packageIds = [],
    ) {
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return array<string>
     */
    public function getPackageIds(): array
    {
        return $this->packageIds;
    }
}
