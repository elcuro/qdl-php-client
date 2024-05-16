<?php

declare(strict_types=1);

namespace Elcuro\Test\QdlPhpClient\Functional;

use Buzz\Client\Curl;
use DateTimeImmutable;
use Elcuro\QdlPhpClient\Client\Client;
use Elcuro\QdlPhpClient\Client\ClientInterface;
use Elcuro\QdlPhpClient\Document\DocumentFactory;
use Elcuro\QdlPhpClient\Document\DocumentFetcher;
use Elcuro\QdlPhpClient\Document\DocumentFetcherInterface;
use Elcuro\QdlPhpClient\Shipping\AddedShipment\AddedShipmentFactory;
use Elcuro\QdlPhpClient\Shipping\Shipment\Shipment;
use Elcuro\QdlPhpClient\Shipping\Shipment\ShipmentPackage;
use Elcuro\QdlPhpClient\Shipping\ShipmentManager;
use Elcuro\QdlPhpClient\Shipping\ShipmentManagerInterface;
use Elcuro\QdlPhpClient\Tracking\TrackLog\TrackLogsFactory;
use Elcuro\QdlPhpClient\Tracking\Tracker;
use Elcuro\QdlPhpClient\Tracking\TrackerInterface;
use Nyholm\Psr7\Factory\Psr17Factory;
use Ramsey\Dev\Tools\TestCase as BaseTestCase;

use function getenv;

class TestCase extends BaseTestCase
{
    protected function createManager(): ShipmentManagerInterface
    {
        return new ShipmentManager(
            $this->createClient(),
            new AddedShipmentFactory(),
        );
    }

    protected function createDocumentFetcher(): DocumentFetcherInterface
    {
        return new DocumentFetcher(
            $this->createClient(),
            new DocumentFactory(),
        );
    }

    protected function createTracker(): TrackerInterface
    {
        return new Tracker(
            $this->createClient(),
            new TrackLogsFactory(),
        );
    }

    protected function createShipment(): Shipment
    {
        return (new Shipment())
            ->setClientReference('REF1')
            ->setPickupDate(new DateTimeImmutable('tomorrow'))
            ->setNote('some note')
            ->setSenderId(1)
            ->setRecipientName('Janko Hraško')
            ->setRecipientStreet('Astronomická ulica 11')
            ->setRecipientCity('Košice')
            ->setRecipientZip('040 01')
            ->setRecipientCountry('sk')
            ->setRecipientPhone('+421 905 123 456')
            ->setRecipientEmail('janko@test.com')
            ->setRecipientContactPerson('Anna Hrašková')
            ->setSmsNotification(true)
            ->setCallNotification(true)
            ->setCod(24.5)
            ->addPackage(new ShipmentPackage(22, 'REF1'));
    }

    protected function createClient(): ClientInterface
    {
        $factory = new Psr17Factory();

        return new Client(
            new Curl($factory),
            $factory,
            $factory,
            getenv('QDL_USER'),
            getenv('QDL_PASSWORD'),
        );
    }
}
