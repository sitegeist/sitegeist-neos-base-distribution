<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\Link;

enum LinkVariant : string
{
    case VARIANT_NONE = 'none';
    case VARIANT_MENU_ITEM = 'menuItem';
    case VARIANT_MENU_SUB_ITEM = 'menuSubItem';
}
