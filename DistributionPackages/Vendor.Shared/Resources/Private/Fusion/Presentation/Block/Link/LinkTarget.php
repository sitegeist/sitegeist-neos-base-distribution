<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Link;

use Neos\Eel\ProtectedContextAwareInterface;
use PackageFactory\AtomicFusion\PresentationObjects\Fusion\StringComponentVariant;

enum LinkTarget: string implements ProtectedContextAwareInterface
{
    use StringComponentVariant;

    case TARGET_SELF = '_self';
    case TARGET_BLANK = '_blank';

    public function getRel(): ?string
    {
        return match ($this) {
            self::TARGET_SELF => null,
            self::TARGET_BLANK => 'noopener nofollow'
        };
    }
}
