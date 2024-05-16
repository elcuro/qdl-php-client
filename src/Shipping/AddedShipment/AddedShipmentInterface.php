<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Shipping\AddedShipment;

interface AddedShipmentInterface
{
    public function getId(): int;

    public function getReference(): string;

    public function getRecipient(): string;

    /**
     * @return array<string>
     */
    public function getPackageIds(): array;
}
