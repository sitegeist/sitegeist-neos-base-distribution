<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Preset;

use PackageFactory\OPGM\Domain\Property\PropertyPresetInterface;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\ImageEditor\ImageEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\ImageEditor\ImageEditorFeatures;
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
)]
final class FreeCroppingImage implements PropertyPresetInterface
{
}
