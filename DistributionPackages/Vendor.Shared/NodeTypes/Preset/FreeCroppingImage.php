<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Preset;

use PackageFactory\OPGM\Domain\Property\PropertyPresetInterface;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\ImageEditor\AspectRatioConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\ImageEditor\AspectRatioPreset;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\ImageEditor\ImageEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\ImageEditor\ImageEditorCroppingConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\ImageEditor\ImageEditorFeatures;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;
use Vendor\Shared\NodeTypes\Editor\AssetWithMetadataEditorConfiguration;

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
            options: [
                new AspectRatioPreset(identifier: '1-1', width: 1, height: 1, label: '1:1'),
                new AspectRatioPreset(identifier: '4-3', width: 4, height: 3, label: '4:3'),
                new AspectRatioPreset(identifier: '3-2', width: 3, height: 2, label: '3:2'),
                new AspectRatioPreset(identifier: '16-9', width: 16, height: 9, label: '16:9'),
                new AspectRatioPreset(identifier: '21-9', width: 21, height: 9, label: '21:9'),
                new AspectRatioPreset(identifier: '3-1', width: 3, height: 1, label: '3:1'),
                new AspectRatioPreset(identifier: '2-1', width: 2, height: 1, label: '2:1'),
                new AspectRatioPreset(identifier: '2-3', width: 2, height: 3, label: '2:3'),
                new AspectRatioPreset(identifier: '3-4', width: 3, height: 4, label: '3:4'),
            ],
            allowCustom: false,
        ),
    )
)]
#[AssetWithMetadataEditorConfiguration]
final class FreeCroppingImage implements PropertyPresetInterface
{
}
