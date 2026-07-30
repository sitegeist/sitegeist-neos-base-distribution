<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\InlineEditor\InlineEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertySearchConfiguration;
use Vendor\Shared\NodeTypes\EditableText;
use Vendor\Shared\NodeTypes\Preset\RichText;

#[NodeTypeDeclaration]
trait TextMixin
{
    #[RichText]
    #[InlineEditorConfiguration(placeholder: 'Bitte Text eingeben')]
    #[PropertySearchConfiguration(fulltextExtractor: '${Indexing.extractInto("text", value)}')]
    public readonly EditableText $text;
}
