<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Preset;

use PackageFactory\OPGM\Domain\Property\PropertyPresetInterface;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\FormattingOptions;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\InlineEditor\InlineEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\LinkingOptions;

/**
 * Single line of text with links, e.g. the label of a consent checkbox
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_PARAMETER)]
#[InlineEditorConfiguration(
    autoparagraph: false,
    linking: new LinkingOptions(
        anchor: true,
        title: true,
        relNofollow: true,
        targetBlank: true,
    ),
    formatting: new FormattingOptions(
        strong: true,
        em: true,
        a: true,
        removeFormat: true,
    ),
)]
final class InlineRichText implements PropertyPresetInterface
{
}
