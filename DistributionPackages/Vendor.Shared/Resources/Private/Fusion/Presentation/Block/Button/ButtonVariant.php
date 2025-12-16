<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Button;

use Neos\Eel\ProtectedContextAwareInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\StringComponentVariant;

enum ButtonVariant: string implements ProtectedContextAwareInterface
{
    use StringComponentVariant;
    case VARIANT_REGULAR = 'regular';
    case VARIANT_SOLID = 'solid';
    case VARIANT_DOWNLOAD = 'download';
    case VARIANT_PIPE = 'pipe';
}
