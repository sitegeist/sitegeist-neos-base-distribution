<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Figure;

use Neos\Eel\ProtectedContextAwareInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\StringComponentVariant;

enum FigureObjectPosition: string implements ProtectedContextAwareInterface
{
    use StringComponentVariant;

    case POSITION_CENTER = 'center';
    case POSITION_LEFT = 'left';
    case POSITION_RIGHT = 'right';
    case POSITION_TOP = 'top';
    case POSITION_BOTTOM = 'bottom';
}
