<?php

/*
 * This file is part of the Nordmann.Shared package.
 */

declare(strict_types=1);

namespace Vendor\Shared\Presentation;

enum ImageWithTextLayout: string
{
    case VARIANT_50_50 = '50-50';
    case VARIANT_66_33 = '66-33';
    case VARIANT_33_66 = '33-66';
}
