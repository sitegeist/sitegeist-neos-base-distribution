<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Icon;

use Neos\Eel\ProtectedContextAwareInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\StringComponentVariant;

enum IconColor: string implements ProtectedContextAwareInterface
{
    use StringComponentVariant;

    case COLOR_DEFAULT = 'default';
}
