<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Figure;

use Neos\Eel\ProtectedContextAwareInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\StringComponentVariant;

enum FigureAspectRatio: string implements ProtectedContextAwareInterface
{
    use StringComponentVariant;

    case RATIO_1X1 = '1x1';
    case RATIO_2X1 = '2x1';
    case RATIO_4X3 = '4x3';
    case RATIO_3X4 = '3x4';
}
