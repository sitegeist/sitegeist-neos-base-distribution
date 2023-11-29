<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Button;

use Neos\Eel\ProtectedContextAwareInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\StringComponentVariant;

enum ButtonType: string implements ProtectedContextAwareInterface
{
    use StringComponentVariant;
    case TYPE_REGULAR = 'regular';
    case TYPE_SUBMIT = 'submit';
}
