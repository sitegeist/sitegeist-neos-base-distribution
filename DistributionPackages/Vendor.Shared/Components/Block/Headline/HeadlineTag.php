<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Headline;

enum HeadlineTag : string
{
    case TAG_H1 = 'h1';
    case TAG_H2 = 'h2';
    case TAG_H3 = 'h3';
    case TAG_DIV = 'div';
}
