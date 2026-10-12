<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Preset;

use PackageFactory\OPGM\Domain\Property\PropertyPresetInterface;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\FormattingOptions;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\InlineEditor\InlineEditorConfiguration;

/**
 * A plain bullet list, e.g. the highlights of a journey chapter
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_PARAMETER)]
#[InlineEditorConfiguration(
    autoparagraph: true,
    formatting: new FormattingOptions(
        p: true,
        ul: true,
        removeFormat: true,
    ),
)]
final class BulletList implements PropertyPresetInterface
{
}
