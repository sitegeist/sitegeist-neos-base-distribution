<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\InlineEditor\InlineEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertySearchConfiguration;
use Vendor\Shared\NodeTypes\Preset\RteText;

#[NodeTypeDeclaration]
trait TextMixin
{
    #[RteText]
    #[InlineEditorConfiguration(placeholder: 'Bitte Text eingeben')]
    #[PropertySearchConfiguration(fulltextExtractor: '${Indexing.extractInto("text", value)}')]
    public readonly ?string $text;
}
