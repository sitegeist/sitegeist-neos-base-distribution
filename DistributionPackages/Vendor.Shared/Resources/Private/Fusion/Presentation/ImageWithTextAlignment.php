<?php

/*
 * This file is part of the Vendor.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation;

enum ImageWithTextAlignment: string
{
    case VARIANT_IMAGEFIRST = 'Bild links';
    case VARIANT_IMAGELAST = 'Bild rechts';
}
