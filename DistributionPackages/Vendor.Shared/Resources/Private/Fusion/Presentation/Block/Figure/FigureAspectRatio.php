<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Figure;

use Neos\Eel\ProtectedContextAwareInterface;

enum FigureAspectRatio: string
{
    case RATIO_1X1 = '1x1';
    case RATIO_2X1 = '2x1';
    case RATIO_4X3 = '4x3';
    case RATIO_3X4 = '3x4';
}
