<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Preset;

use PackageFactory\OPGM\Domain\Property\PropertyPresetInterface;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\FormattingOptions;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\InlineEditor\InlineEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\LinkingOptions;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_PARAMETER)]
#[InlineEditorConfiguration(
    autoparagraph: true,
    linking: new LinkingOptions(
        anchor: true,
        title: true,
        relNofollow: true,
        targetBlank: true,
    ),
    formatting: new FormattingOptions(
        strong: true,
        em: true,
        sub: true,
        sup: true,
        p: true,
        h1: false,
        h2: false,
        h3: true,
        h4: true,
        h5: false,
        h6: false,
        underline: true,
        removeFormat: true,
        table: false,
        ol: true,
        ul: true,
        a: true,
    ),
)]
final class RteText implements PropertyPresetInterface
{
}
