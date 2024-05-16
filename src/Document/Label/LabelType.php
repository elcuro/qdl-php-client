<?php

declare(strict_types=1);

namespace Elcuro\QdlPhpClient\Document\Label;

enum LabelType
{
    case Zebra;
    case ZPL;
    case A4;
}
