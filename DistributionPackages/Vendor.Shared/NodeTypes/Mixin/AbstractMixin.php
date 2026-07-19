<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\InlineEditor\InlineEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertySearchConfiguration;
use Vendor\Shared\NodeTypes\Preset\RteText;

/** @phpstan-ignore trait.unused (not yet) */
#[NodeTypeDeclaration]
trait AbstractMixin
{
    #[RteText]
    #[InlineEditorConfiguration(placeholder: 'Bitte Abstract eingeben')]
    #[PropertySearchConfiguration(fulltextExtractor: '${Indexing.extractInto("p", value)}')]
    public readonly ?string $abstract;
}
