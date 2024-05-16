<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Document\Label;

interface LabelInterface
{
    public function getPDF(): string;
}
