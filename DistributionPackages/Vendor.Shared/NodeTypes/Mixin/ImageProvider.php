<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Sitegeist\Kaleidoscope\ValueObjects\ImageSourceProxy;

interface ImageProvider
{
    public ImageSourceProxy $image {get;}
}
