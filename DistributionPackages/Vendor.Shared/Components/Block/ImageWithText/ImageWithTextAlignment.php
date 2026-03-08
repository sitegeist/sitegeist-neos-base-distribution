<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\ImageWithText;

enum ImageWithTextAlignment : string
{
    case VARIANT_IMAGEFIRST = 'Bild links';
    case VARIANT_IMAGELAST = 'Bild rechts';
}
