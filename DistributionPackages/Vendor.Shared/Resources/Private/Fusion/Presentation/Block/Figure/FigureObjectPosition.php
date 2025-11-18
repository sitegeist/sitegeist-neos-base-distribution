<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Figure;

use Neos\Eel\ProtectedContextAwareInterface;

enum FigureObjectPosition: string
{
    case POSITION_CENTER = 'center';
    case POSITION_LEFT = 'left';
    case POSITION_RIGHT = 'right';
    case POSITION_TOP = 'top';
    case POSITION_BOTTOM = 'bottom';
}
