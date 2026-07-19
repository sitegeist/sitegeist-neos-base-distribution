<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Preset;

use PackageFactory\OPGM\Domain\Property\PropertyPresetInterface;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\FormattingOptions;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\InlineEditor\InlineEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertySearchConfiguration;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_PARAMETER)]
#[InlineEditorConfiguration(
    autoparagraph: false,
    formatting: new FormattingOptions(
        sub: true,
        sup: true,
        removeFormat: true,
    ),
)]
#[PropertySearchConfiguration(fulltextExtractor: '${Indexing.extractInto("p", value)}')]
final class PlainText implements PropertyPresetInterface
{
}
