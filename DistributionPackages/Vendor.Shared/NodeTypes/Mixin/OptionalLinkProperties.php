<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Neos\Neos\Domain\Link\Link;
use Neos\Neos\Domain\Property\EditableText;

/**
 * Backing trait for {@see OptionalLinkProvider}
 */
trait OptionalLinkProperties
{
    public readonly ?Link $link;

    public readonly EditableText $linkLabel;
}
