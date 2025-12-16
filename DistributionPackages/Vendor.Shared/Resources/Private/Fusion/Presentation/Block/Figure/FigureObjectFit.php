<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Figure;

use Neos\Eel\ProtectedContextAwareInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\StringComponentVariant;

enum FigureObjectFit: string implements ProtectedContextAwareInterface
{
    use StringComponentVariant;

    case FIT_COVER = 'cover';
    case FIT_CONTAIN = 'contain';
}
