<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Mixin;

use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\InlineEditor\InlineEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertySearchConfiguration;
use Vendor\Shared\NodeTypes\Preset\PlainText;

#[NodeTypeDeclaration]
trait HeadlineMixin
{
    #[PlainText]
    #[InlineEditorConfiguration(placeholder: 'Bitte Überschrift eingeben')]
    #[PropertySearchConfiguration(fulltextExtractor: '${Indexing.extractInto("h2", value)}')]
    public readonly ?string $headline;
}
