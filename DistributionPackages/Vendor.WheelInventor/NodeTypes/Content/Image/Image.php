<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Image;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\Infrastructure\NodeLabelRenderingAccessInterface;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use Sitegeist\Kaleidoscope\ValueObjects\ImageSourceProxy;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\Shared\NodeTypes\Mixin\HeadlineProperties;
use Vendor\Shared\NodeTypes\Mixin\ImageProvider;
use Vendor\Shared\NodeTypes\Preset\FreeCroppingImage;
use Vendor\WheelInventor\NodeTypes\Content\Content;
use Vendor\WheelInventor\NodeTypes\Content\ContentProperties;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'Bild',
    icon: 'image',
)]
#[Flow\Proxy(false)]
final readonly class Image implements Content, HeadlineMixin, ImageProvider
{
    use ContentProperties;
    use HeadlineProperties;

    public function __construct(
        #[FreeCroppingImage]
        public ImageSourceProxy $image,
    ) {
    }

    public function getNeosLabel(NodeLabelRenderingAccessInterface $nodeLabelRenderingAccess): ?string
    {
        return $this->headline->value;
    }
}
