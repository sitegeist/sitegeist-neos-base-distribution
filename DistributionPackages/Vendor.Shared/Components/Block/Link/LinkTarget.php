<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Link;

enum LinkTarget : string
{
    case TARGET_BLANK = '_blank';
    case TARGET_SELF = '_self';
}
