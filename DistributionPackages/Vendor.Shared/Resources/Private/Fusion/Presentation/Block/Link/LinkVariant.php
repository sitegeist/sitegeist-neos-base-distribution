<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Link;

use Neos\Eel\ProtectedContextAwareInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\StringComponentVariant;

enum LinkVariant: string implements ProtectedContextAwareInterface
{
    use StringComponentVariant;

    case VARIANT_REGULAR = 'regular';
}
