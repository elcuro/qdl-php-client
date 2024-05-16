<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Shipping\Shipment;

enum ShipmentSenderType: int
{
    case ID = 0;
    case CoverAddress = 1;
    case BlankLabel = 3;
}
