<h1 align="center">elcuro/qdl-php-client</h1>


<!--
TODO: Make sure the following URLs are correct and working for your project.
      Then, remove these comments to display the badges, giving users a quick
      overview of your package.

<p align="center">
    <a href="https://github.com/elcuro/app"><img src="https://img.shields.io/badge/source-elcuro/qdl--php--client-blue.svg?style=flat-square" alt="Source Code"></a>
    <a href="https://packagist.org/packages/elcuro/qdl-php-client"><img src="https://img.shields.io/packagist/v/elcuro/qdl-php-client.svg?style=flat-square&label=release" alt="Download Package"></a>
    <a href="https://php.net"><img src="https://img.shields.io/packagist/php-v/elcuro/qdl-php-client.svg?style=flat-square&colorB=%238892BF" alt="PHP Programming Language"></a>
    <a href="https://github.com/elcuro/app/blob/main/LICENSE"><img src="https://img.shields.io/packagist/l/elcuro/qdl-php-client.svg?style=flat-square&colorB=darkcyan" alt="Read License"></a>
    <a href="https://github.com/elcuro/app/actions/workflows/continuous-integration.yml"><img src="https://img.shields.io/github/actions/workflow/status/elcuro/app/continuous-integration.yml?branch=main&style=flat-square&logo=github" alt="Build Status"></a>
    <a href="https://codecov.io/gh/elcuro/app"><img src="https://img.shields.io/codecov/c/gh/elcuro/app?label=codecov&logo=codecov&style=flat-square" alt="Codecov Code Coverage"></a>
    <a href="https://shepherd.dev/github/elcuro/app"><img src="https://img.shields.io/endpoint?style=flat-square&url=https%3A%2F%2Fshepherd.dev%2Fgithub%2Felcuro%2Fapp%2Fcoverage" alt="Psalm Type Coverage"></a>
</p>
-->


## About

A simple PHP client for the [QDL](https://www.qdl.sk/) (Slovak logistics company)




## Installation

Install this package as a dependency using [Composer](https://getcomposer.org).

``` bash
composer require elcuro/qdl-php-client
```

## Usage

### Create QDL client
The client is not dependent on any specific HTTP client. It supports any PSR-18 compatible client.
E.g.: [Buzz client](https://github.com/kriswallsmith/Buzz)

You do also need to install a PSR-17 request/response factory. It uses that factory to create PSR-7 requests and responses.
E.g.: [nyholm/psr7](https://github.com/Nyholm/psr7)

``` php
use Elcuro\QdlPhpClient\Client\Client;
use Nyholm\Psr7\Factory\Psr17Factory;
use Buzz\Client\Curl;

// We will use Buzz client and nyholm/psr7 factories
$factory = new Psr17Factory();

$client = new Client(
    new Curl($factory),
    $factory,
    $factory,
    'QDL_USERNAME',
    'QDL_PASSWORD'
);

```

### Add/order/cancel shipments
```php
use Elcuro\QdlPhpClient\Shipping\Shipment\Shipment;
use Elcuro\QdlPhpClient\Shipping\Shipment\ShipmentPackage;
use Elcuro\QdlPhpClient\Shipping\ShipmentManager;

// Create shipment manager
$shipmentManager = new ShipmentManager($client, new AddedShipmentFactory());

// Create shipment
$shipment = new Shipment();
$shipment
    ->setSenderId(1)
    ->setRecipientName('Fake user')
    ...
    ->addPackage(new ShipmentPackage(1))
;

// Add shipment
$addedShipment = $shipmentManager->addShipment($shipment);

// Order unorderd shipments
$shipmentManager->order();

// Cancel shipment
$shipmentManager->cancelShipment($addedShipment->getId());
```

### Labels and handover protocols
```php
use Elcuro\QdlPhpClient\Document\DocumentFactory;
use Elcuro\QdlPhpClient\Document\DocumentFetcher;
use Elcuro\QdlPhpClient\Document\Label\LabelType;


// Create document fetcher
$documentFetcher = new DocumentFethcer($client, new DocumentFetcherFactory());

// Show label PDF
echo $documentFetcher->fetchLabel([30124122200010], LabelType::A4)->getPDF();

// or show handover protocol
echo $documentFetcher->fetchHandoverProtocol($shipmentIds)->getPDF();


```

### Tracking
```php
use Elcuro\QdlPhpClient\Tracking\TrackLog\TrackLogsFactory;
use Elcuro\QdlPhpClient\Tracking\Tracker;

// Create tracker
$tracker = new Tracker($client, new TrackLogsFactory());

// Fetch track logs
$trackLogs = $tracker->trackShipment(30124122200010);

// Show track logs
foreach ($trackLogs as $trackLog) {
    sprintf(
        "Date: %s, Status: %s\n",
        $trackLog->getDate()->format('Y-m-d'),
        $trackLog->getName()
    );
}
```

## Contributing

Contributions are welcome! To contribute, please familiarize yourself with
[CONTRIBUTING.md](CONTRIBUTING.md).







## Copyright and License

elcuro/qdl-php-client is copyright © [Juraj Jancuska](mailto:jjancuska@gmail.com)
and licensed for use under the terms of the
MIT License (MIT). Please see [LICENSE](LICENSE) for more information.


