<?php

declare(strict_types=1);

namespace Vendor\Shared\Components\Block\ImageWithText;

enum ImageWithTextAlignment : string
{
    case VARIANT_IMAGEFIRST = 'Bild zuerst';
    case VARIANT_IMAGELAST = 'Text zuerst';
}
