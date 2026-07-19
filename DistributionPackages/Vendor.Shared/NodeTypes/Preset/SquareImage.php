<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Preset;

use PackageFactory\OPGM\Domain\Property\PropertyPresetInterface;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\ImageEditor\AspectRatioConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\ImageEditor\ImageEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\ImageEditor\ImageEditorCroppingConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\ImageEditor\ImageEditorFeatures;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\ImageEditor\LockedAspectRatio;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_PARAMETER)]
#[PropertyUiConfiguration(
    label: 'Bild',
    reloadIfChanged: true
)]
#[InspectorConfiguration(
    group: 'image'
)]
#[ImageEditorConfiguration(
    features: new ImageEditorFeatures(
        crop: true,
    ),
    crop: new ImageEditorCroppingConfiguration(
        aspectRatio: new AspectRatioConfiguration(
            forceCrop: true,
            locked: new LockedAspectRatio(
                width: 1,
                height: 1,
            )
        ),
    )
)]
final class SquareImage implements PropertyPresetInterface
{
}
