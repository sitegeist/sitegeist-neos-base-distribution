<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Figure;

enum FigureSize : string
{
    case SIZE_DEFAULT = 'default';
    case SIZE_FIFTH_HALF_FULL = 'fifthHalfFull';
    case SIZE_THIRD_HALF_FULL = 'thirdHalfFull';
    case SIZE_FULL_FULL_FULL = 'fullFullFull';
    case SIZE_HALF_FULL_FULL = 'halfFullFull';
}
