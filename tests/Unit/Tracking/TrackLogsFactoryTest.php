<?php

declare(strict_types=1);

namespace Elcuro\Test\QdlPhpClient\Unit\Tracking;

use Elcuro\QdlPhpClient\Tracking\TrackLog\TrackLogsFactory;
use Elcuro\Test\QdlPhpClient\Unit\TestCase;

class TrackLogsFactoryTest extends TestCase
{
    public function testCorrectLogDate(): void
    {
        $data = [[
            'id' => 19,
            'name' => 'test',
            'created' => [
                'date' => '2023-12-22 19:16:17.000000',
                'timezone_type' => 3,
                'timezone' => 'Europe/Moscow',
            ],
            'itemId' => 0,
            'orderItemNumber' => '',
        ],
        ];

        $trackLogsFactory = new TrackLogsFactory();
        $trackLogs = $trackLogsFactory->createTrackLogs(123, $data);
        $trackLog = $trackLogs->getLogs()[0];

        $this->assertEquals(
            '2023-12-22 19:16:17',
            $trackLog->getDate()->format('Y-m-d H:i:s'),
        );
        $this->assertEquals(
            'Europe/Moscow',
            $trackLog->getDate()->getTimezone()->getName(),
        );
    }
}
