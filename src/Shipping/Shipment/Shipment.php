<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Shipping\Shipment;

use DateTimeInterface;

class Shipment implements ShipmentInterface
{
    private ?string $clientReference = null;
    private ?DateTimeInterface $pickupDate = null;
    private ?float $cod = null;
    private ?string $variableSymbol = null;
    private ?string $iban = null;
    private ?string $note = null;
    private ShipmentSenderType $senderType = ShipmentSenderType::ID;
    private ?int $senderId = null;
    private ?string $senderName = null;
    private ?string $senderStreet = null;
    private ?string $senderCity = null;
    private ?string $senderZip = null;
    private ?string $senderCountry = null;
    private string $recipientName = '';
    private string $recipientStreet = '';
    private string $recipientCity = '';
    private string $recipientZip = '';
    private string $recipientCountry = '';
    private ?string $recipientPhone = null;
    private ?string $recipientEmail = null;
    private ?string $recipientContactPerson = null;
    private array $packages = [];
    private bool $insuranceEnabled = false;
    private ?float $insuranceValue = 0;
    private bool $is24HoursDelivery = false;
    private bool $until12Delivery = false;
    private bool $smsNotification = true;
    private bool $callNotification = true;
    private bool $containsReturnableDocs = false;

    public function getClientReference(): ?string
    {
        return $this->clientReference;
    }

    public function setClientReference(?string $clientReference): Shipment
    {
        $this->clientReference = $clientReference;

        return $this;
    }

    public function getPickupDate(): ?DateTimeInterface
    {
        return $this->pickupDate;
    }

    public function setPickupDate(?DateTimeInterface $pickupDate): Shipment
    {
        $this->pickupDate = $pickupDate;

        return $this;
    }

    public function getCod(): ?float
    {
        return $this->cod;
    }

    public function setCod(?float $cod): Shipment
    {
        $this->cod = $cod;

        return $this;
    }

    public function getVariableSymbol(): ?string
    {
        return $this->variableSymbol;
    }

    public function setVariableSymbol(?string $variableSymbol): Shipment
    {
        $this->variableSymbol = $variableSymbol;

        return $this;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(?string $iban): Shipment
    {
        $this->iban = $iban;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): Shipment
    {
        $this->note = $note;

        return $this;
    }

    public function getSenderType(): ShipmentSenderType
    {
        return $this->senderType;
    }

    public function setSenderType(ShipmentSenderType $senderType): Shipment
    {
        $this->senderType = $senderType;

        return $this;
    }

    public function getSenderId(): ?int
    {
        return $this->senderId;
    }

    public function setSenderId(?int $senderId): Shipment
    {
        $this->senderId = $senderId;

        return $this;
    }

    public function getSenderName(): ?string
    {
        return $this->senderName;
    }

    public function setSenderName(?string $senderName): Shipment
    {
        $this->senderName = $senderName;

        return $this;
    }

    public function getSenderStreet(): ?string
    {
        return $this->senderStreet;
    }

    public function setSenderStreet(?string $senderStreet): Shipment
    {
        $this->senderStreet = $senderStreet;

        return $this;
    }

    public function getSenderCity(): ?string
    {
        return $this->senderCity;
    }

    public function setSenderCity(?string $senderCity): Shipment
    {
        $this->senderCity = $senderCity;

        return $this;
    }

    public function getSenderZip(): ?string
    {
        return $this->senderZip;
    }

    public function setSenderZip(?string $senderZip): Shipment
    {
        $this->senderZip = $senderZip;

        return $this;
    }

    public function getSenderCountry(): ?string
    {
        return $this->senderCountry;
    }

    public function setSenderCountry(?string $senderCountry): Shipment
    {
        $this->senderCountry = $senderCountry;

        return $this;
    }

    public function getRecipientName(): string
    {
        return $this->recipientName;
    }

    public function setRecipientName(string $recipientName): Shipment
    {
        $this->recipientName = $recipientName;

        return $this;
    }

    public function getRecipientStreet(): string
    {
        return $this->recipientStreet;
    }

    public function setRecipientStreet(string $recipientStreet): Shipment
    {
        $this->recipientStreet = $recipientStreet;

        return $this;
    }

    public function getRecipientCity(): string
    {
        return $this->recipientCity;
    }

    public function setRecipientCity(string $recipientCity): Shipment
    {
        $this->recipientCity = $recipientCity;

        return $this;
    }

    public function getRecipientZip(): string
    {
        return $this->recipientZip;
    }

    public function setRecipientZip(string $recipientZip): Shipment
    {
        $this->recipientZip = $recipientZip;

        return $this;
    }

    public function getRecipientCountry(): string
    {
        return $this->recipientCountry;
    }

    public function setRecipientCountry(string $recipientCountry): Shipment
    {
        $this->recipientCountry = $recipientCountry;

        return $this;
    }

    public function getRecipientPhone(): ?string
    {
        return $this->recipientPhone;
    }

    public function setRecipientPhone(?string $recipientPhone): Shipment
    {
        $this->recipientPhone = $recipientPhone;

        return $this;
    }

    public function getRecipientEmail(): ?string
    {
        return $this->recipientEmail;
    }

    public function setRecipientEmail(?string $recipientEmail): Shipment
    {
        $this->recipientEmail = $recipientEmail;

        return $this;
    }

    public function getRecipientContactPerson(): ?string
    {
        return $this->recipientContactPerson;
    }

    public function setRecipientContactPerson(?string $recipientContactPerson): Shipment
    {
        $this->recipientContactPerson = $recipientContactPerson;

        return $this;
    }

    public function getPackages(): array
    {
        return $this->packages;
    }

    public function setPackages(array $packages): Shipment
    {
        $this->packages = $packages;

        return $this;
    }

    public function addPackage(ShipmentPackage $shipmentPackage): Shipment
    {
        $this->packages[] = $shipmentPackage;

        return $this;
    }

    public function isInsuranceEnabled(): bool
    {
        return $this->insuranceEnabled;
    }

    public function setInsuranceEnabled(bool $insuranceEnabled): Shipment
    {
        $this->insuranceEnabled = $insuranceEnabled;

        return $this;
    }

    public function getInsuranceValue(): ?float
    {
        return $this->insuranceValue;
    }

    public function setInsuranceValue(?float $insuranceValue): Shipment
    {
        $this->insuranceValue = $insuranceValue;

        return $this;
    }

    public function is24HoursDelivery(): bool
    {
        return $this->is24HoursDelivery;
    }

    public function set24HoursDelivery(bool $is24HoursDelivery): Shipment
    {
        $this->is24HoursDelivery = $is24HoursDelivery;

        return $this;
    }

    public function isUntil12Delivery(): bool
    {
        return $this->until12Delivery;
    }

    public function setUntil12Delivery(bool $until12Delivery): Shipment
    {
        $this->until12Delivery = $until12Delivery;

        return $this;
    }

    public function isSmsNotification(): bool
    {
        return $this->smsNotification;
    }

    public function setSmsNotification(bool $smsNotification): Shipment
    {
        $this->smsNotification = $smsNotification;

        return $this;
    }

    public function isCallNotification(): bool
    {
        return $this->callNotification;
    }

    public function setCallNotification(bool $callNotification): Shipment
    {
        $this->callNotification = $callNotification;

        return $this;
    }

    public function itContainsReturnableDocuments(): bool
    {
        return $this->containsReturnableDocs;
    }

    public function setContainsReturnableDocuments(bool $containsReturnableDocs): Shipment
    {
        $this->containsReturnableDocs = $containsReturnableDocs;

        return $this;
    }
}
