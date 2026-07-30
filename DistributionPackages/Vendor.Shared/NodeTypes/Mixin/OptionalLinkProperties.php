<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Neos\Neos\Domain\Link\Link;
use Vendor\Shared\NodeTypes\EditableText;

/**
 * Backing trait for {@see OptionalLinkProvider}
 */
trait OptionalLinkProperties
{
    public readonly ?Link $link;

    public readonly EditableText $linkLabel;
}
