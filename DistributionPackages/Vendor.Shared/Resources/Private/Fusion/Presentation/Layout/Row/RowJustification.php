<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Layout\Row;

use Neos\Eel\ProtectedContextAwareInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\StringComponentVariant;

enum RowJustification: string implements ProtectedContextAwareInterface
{
    use StringComponentVariant;

    case JUSTIFY_START = 'start';
    case JUSTIFY_START_END = 'end';
    case JUSTIFY_CENTER = 'center';
    case JUSTIFY_BETWEEN = 'between';
    case JUSTIFY_AROUND = 'around';
    case JUSTIFY_EVENLY = 'evenly';
}
