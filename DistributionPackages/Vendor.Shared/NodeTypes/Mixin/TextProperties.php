<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Neos\Neos\Domain\Property\EditableText;

/**
 * Backing trait for {@see TextMixin}
 */
trait TextProperties
{
    public readonly EditableText $text;
}
