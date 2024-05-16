<?php

declare(strict_types=1);

namespace Elcuro\Test\QdlPhpClient\Unit;

use DMS\PHPUnitExtensions\ArraySubset\ArraySubsetAsserts;
use DMS\PHPUnitExtensions\ArraySubset\Constraint\ArraySubset;
use Ramsey\Dev\Tools\TestCase as BaseTestCase;

/**
 * A base test case for common test functionality
 */
class TestCase extends BaseTestCase
{
    use ArraySubsetAsserts;

    public function containsArray(array $needles): ArraySubset
    {
        return new ArraySubset($needles);
    }
}
