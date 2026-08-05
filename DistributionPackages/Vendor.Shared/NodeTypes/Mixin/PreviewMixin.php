<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Sitegeist\Kaleidoscope\ValueObjects\ImageSourceProxy;

/**
 * Backing trait for {@see PreviewProvider}
 */
trait PreviewMixin
{
    public readonly ?ImageSourceProxy $previewImage;

    public readonly ?string $previewHeadline;

    public readonly ?string $previewText;
}
