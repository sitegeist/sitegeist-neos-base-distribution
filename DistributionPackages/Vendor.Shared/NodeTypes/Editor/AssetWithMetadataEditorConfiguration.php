<?php

declare(strict_types=1);

namespace Vendor\Shared\NodeTypes\Editor;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\Property\PropertyConfigurationInterface;

/**
 * Switches an ImageSourceProxy property to the Kaleidoscope ValueObjects editor (image + alt + title).
 * Declare it after the ImageEditorConfiguration, whose editor options (crop, features, ...) it keeps.
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_PARAMETER | \Attribute::TARGET_CLASS)]
#[Flow\Proxy(false)]
final readonly class AssetWithMetadataEditorConfiguration implements PropertyConfigurationInterface
{
    /**
     * @return array<string,mixed>
     */
    public function getPropertyConfiguration(\ReflectionNamedType $propertyType): array
    {
        return [
            'ui' => [
                'inspector' => [
                    'editor' => 'Sitegeist.Kaleidoscope.ValueObjects/Inspector/Editors/AssetWithMetadataEditor',
                ],
            ],
        ];
    }
}
