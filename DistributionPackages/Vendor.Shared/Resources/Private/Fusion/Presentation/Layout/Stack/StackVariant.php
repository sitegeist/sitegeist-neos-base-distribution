<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Layout\Stack;

use Neos\Eel\ProtectedContextAwareInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\StringComponentVariant;

enum StackVariant: string implements ProtectedContextAwareInterface
{
    use StringComponentVariant;
    case VARIANT_REGULAR = 'regular';
}
