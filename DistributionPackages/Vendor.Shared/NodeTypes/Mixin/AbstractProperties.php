<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Neos\Neos\Domain\Property\EditableText;

/**
 * Backing trait for {@see AbstractMixin}
 * @phpstan-ignore trait.unused (not yet)
 */
trait AbstractProperties
{
    public readonly EditableText $abstract;
}
