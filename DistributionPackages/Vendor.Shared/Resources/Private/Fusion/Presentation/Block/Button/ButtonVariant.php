<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Button;

use Neos\Eel\ProtectedContextAwareInterface;

enum ButtonVariant: string
{
    case VARIANT_REGULAR = 'regular';
    case VARIANT_SOLID = 'solid';
    case VARIANT_DOWNLOAD = 'download';
    case VARIANT_PIPE = 'pipe';
}
