<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Layout\ContentContainer;

use Neos\Eel\ProtectedContextAwareInterface;

enum ContentContainerVariant: string
{
    case VARIANT_NONE = 'none';
    case VARIANT_REGULAR = 'regular';
    case VARIANT_REVERSE_ORDER = 'reverseOrder';
}
