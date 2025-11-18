<?php

declare(strict_types=1);

namespace Vendor\Shared\Presentation\Block\Figure;

use Neos\Eel\ProtectedContextAwareInterface;

enum FigureObjectFit: string
{
    case FIT_COVER = 'cover';
    case FIT_CONTAIN = 'contain';
}
