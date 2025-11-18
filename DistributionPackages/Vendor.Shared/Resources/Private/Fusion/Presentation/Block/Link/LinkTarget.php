<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Link;

use Neos\Eel\ProtectedContextAwareInterface;

enum LinkTarget: string
{
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
