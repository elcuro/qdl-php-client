<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Document\Label;

class Label implements LabelInterface
{
    public function __construct(
        private readonly string $pdf,
    ) {
    }

    public function getPDF(): string
    {
        return $this->pdf;
    }
}
