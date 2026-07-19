<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Sitegeist\Kaleidoscope\ValueObjects\ImageSourceProxy;

interface PreviewProvider
{
    public ?ImageSourceProxy $previewImage {get;}

    public ?string $previewHeadline {get;}

    public ?string $previewText {get;}
}
