<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Layout\Row;

use Neos\Eel\ProtectedContextAwareInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\StringComponentVariant;

enum RowAlignment: string implements ProtectedContextAwareInterface
{
    use StringComponentVariant;

    case ALIGN_ITEMS_START = 'start';
    case ALIGN_ITEMS_END = 'end';
    case ALIGN_ITEMS_STRETCH = 'stretch';
    case ALIGN_ITEMS_CENTER = 'center';
}
