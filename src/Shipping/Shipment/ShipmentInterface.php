<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Shipping\Shipment;

use DateTimeInterface;

interface ShipmentInterface
{
    /**
     * @return string|null Max 25 chars
     */
    public function getClientReference(): ?string;

    public function getPickupDate(): ?DateTimeInterface;

    public function getCod(): ?float;

    /**
     * @return string|null Max 10 chars
     */
    public function getVariableSymbol(): ?string;

    public function getIban(): ?string;

    /**
     * @return string|null Max 25 chars
     */
    public function getNote(): ?string;

    public function getSenderType(): ShipmentSenderType;

    public function getSenderId(): ?int;

    public function getSenderName(): ?string;

    public function getSenderStreet(): ?string;

    /**
     * @return string|null Max 5 chars
     */
    public function getSenderCity(): ?string;

    public function getSenderZip(): ?string;

    /**
     * @return string|null 3166-1 alpha-2 code
     */
    public function getSenderCountry(): ?string;

    public function getRecipientName(): string;

    public function getRecipientStreet(): string;

    public function getRecipientCity(): string;

    /**
     * @return string Max 5 chars
     */
    public function getRecipientZip(): string;

    /**
     * @return string 3166-1 alpha-2 code
     */
    public function getRecipientCountry(): string;

    public function getRecipientPhone(): ?string;

    public function getRecipientEmail(): ?string;

    public function getRecipientContactPerson(): ?string;

    /**
     * @return array<ShipmentPackageInterface>
     */
    public function getPackages(): array;

    public function isInsuranceEnabled(): bool;

    public function getInsuranceValue(): ?float;

    public function is24HoursDelivery(): bool;

    public function isUntil12Delivery(): bool;

    public function isSMSNotification(): bool;

    public function isCallNotification(): bool;

    public function itContainsReturnableDocuments(): bool;
}
