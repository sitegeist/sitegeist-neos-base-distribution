<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Button;

enum ButtonVariant : string
{
    case VARIANT_REGULAR = 'regular';
    case VARIANT_SOLID = 'solid';
    case VARIANT_GHOST = 'ghost';
}
