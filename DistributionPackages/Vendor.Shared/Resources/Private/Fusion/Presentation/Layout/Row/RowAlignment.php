<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Layout\Row;

use Neos\Eel\ProtectedContextAwareInterface;

enum RowAlignment: string
{
    case ALIGN_ITEMS_START = 'start';
    case ALIGN_ITEMS_END = 'end';
    case ALIGN_ITEMS_STRETCH = 'stretch';
    case ALIGN_ITEMS_CENTER = 'center';
}
