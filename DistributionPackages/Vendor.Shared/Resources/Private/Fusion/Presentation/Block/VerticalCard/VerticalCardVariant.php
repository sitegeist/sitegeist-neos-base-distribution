<?php

/*
 * This file is part of the Nordmann.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\VerticalCard;

use Neos\Eel\ProtectedContextAwareInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\StringComponentVariant;

enum VerticalCardVariant: string implements ProtectedContextAwareInterface
{
    use StringComponentVariant;

    case VARIANT_REGULAR = 'regular';
}
