<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Link;

use Neos\Eel\ProtectedContextAwareInterface;

enum LinkVariant: string
{
    case VARIANT_REGULAR = 'regular';
}
