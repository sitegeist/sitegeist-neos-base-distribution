<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Neos\Neos\Domain\Link\Link;
use Neos\Neos\Domain\Property\EditableText;

/**
 * Backing trait for {@see LinkProvider}
 * @phpstan-ignore trait.unused (not yet)
 */
trait LinkProperties
{
    public readonly Link $link;

    public readonly EditableText $linkLabel;
}
