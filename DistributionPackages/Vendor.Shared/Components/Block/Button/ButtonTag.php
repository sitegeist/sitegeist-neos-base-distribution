<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Button;

enum ButtonTag : string
{
    case TAG_H1 = 'button';
    case TAG_H2 = 'span';
    case TAG_H3 = 'link';
}
