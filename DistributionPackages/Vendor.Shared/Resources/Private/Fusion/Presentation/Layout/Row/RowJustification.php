<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Layout\Row;

use Neos\Eel\ProtectedContextAwareInterface;

enum RowJustification: string
{
    case JUSTIFY_START = 'start';
    case JUSTIFY_START_END = 'end';
    case JUSTIFY_CENTER = 'center';
    case JUSTIFY_BETWEEN = 'between';
    case JUSTIFY_AROUND = 'around';
    case JUSTIFY_EVENLY = 'evenly';
}
