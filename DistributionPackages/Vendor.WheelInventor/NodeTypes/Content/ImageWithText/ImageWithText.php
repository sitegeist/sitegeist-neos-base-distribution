<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\ImageWithText;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\InspectorGroupDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\Editor\SelectBoxEditor\EnumSelectBoxEditorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\InspectorConfiguration;
use PackageFactory\OPGM\NeosAdapter\PropertyDeclaration\PropertyUiConfiguration;
use Sitegeist\Kaleidoscope\ValueObjects\ImageSourceProxy;
use Vendor\Shared\Components\Block\ImageWithText\ImageWithTextAlignment;
use Vendor\Shared\Components\Block\ImageWithText\ImageWithTextLayout;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\Shared\NodeTypes\Mixin\OptionalImageProvider;
use Vendor\Shared\NodeTypes\Mixin\OptionalLinkMixin;
use Vendor\Shared\NodeTypes\Mixin\TextMixin;
use Vendor\Shared\NodeTypes\Preset\FreeCroppingImage;
use Vendor\WheelInventor\NodeTypes\Content\Content;
use Vendor\WheelInventor\NodeTypes\Content\ContentProperties;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'Bild mit Text',
    icon: 'id-card',
)]
#[InspectorGroupDeclaration(
    name: 'layout',
    label: 'Layout',
    icon: 'palette',
    position: '10',
)]
#[Flow\Proxy(false)]
final readonly class ImageWithText implements Content, OptionalImageProvider
{
    use ContentProperties;
    use HeadlineMixin;
    use TextMixin;
    use OptionalLinkMixin;

    public function __construct(
        #[FreeCroppingImage]
        public ?ImageSourceProxy $image,
        #[PropertyUiConfiguration(label: 'Ausrichtung', reloadIfChanged: true)]
        #[InspectorConfiguration(group: 'layout')]
        #[EnumSelectBoxEditorConfiguration]
        public ImageWithTextAlignment $alignment = ImageWithTextAlignment::VARIANT_IMAGEFIRST,
        #[PropertyUiConfiguration(label: 'Breite-Varianten', reloadIfChanged: true)]
        #[InspectorConfiguration(group: 'layout')]
        #[EnumSelectBoxEditorConfiguration]
        public ImageWithTextLayout $layout = ImageWithTextLayout::VARIANT_50_50,
    ) {
    }
}
