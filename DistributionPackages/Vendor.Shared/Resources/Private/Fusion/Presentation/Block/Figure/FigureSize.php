<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Figure;

use Neos\Eel\ProtectedContextAwareInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\StringComponentVariant;

enum FigureSize: string implements ProtectedContextAwareInterface
{
    use StringComponentVariant;

    case SIZE_FULL_FULL_FULL = 'fullFullFull';
    case SIZE_HALF_FULL_FULL = 'halfFullFull';
    case SIZE_THIRD_HALF_FULL = 'thirdHalfFull';
    case SIZE_FIFTH_HALF_FULL = 'fifthHalfFull';
}
