<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use Neos\Neos\Domain\Link\Link;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use Vendor\Shared\NodeTypes\EditableText;

/**
 * Backing trait for {@see LinkProvider}
 * @phpstan-ignore trait.unused (not yet)
 */
#[NodeTypeDeclaration]
trait LinkProperties
{
    public readonly Link $link;

    public readonly EditableText $linkLabel;
}
