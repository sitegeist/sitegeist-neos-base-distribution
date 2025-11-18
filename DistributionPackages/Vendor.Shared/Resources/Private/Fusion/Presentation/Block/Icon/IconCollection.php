<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Icon;

use Neos\Eel\ProtectedContextAwareInterface;

enum IconCollection: string
{
    case COLLECTION_SHARED = 'shared';
}
