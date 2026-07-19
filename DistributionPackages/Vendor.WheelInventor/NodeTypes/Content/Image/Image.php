<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Image;

use Neos\Flow\Annotations as Flow;
use PackageFactory\OPGM\Domain\NodeType\NodeTypeDeclaration;
use PackageFactory\OPGM\NeosAdapter\NodeTypeDeclaration\NodeTypeUiConfiguration;
use Sitegeist\Kaleidoscope\ValueObjects\ImageSourceProxy;
use Vendor\Shared\NodeTypes\Mixin\HeadlineMixin;
use Vendor\Shared\NodeTypes\Mixin\ImageProvider;
use Vendor\Shared\NodeTypes\Preset\FreeCroppingImage;
use Vendor\WheelInventor\NodeTypes\Content\Content;

#[NodeTypeDeclaration]
#[NodeTypeUiConfiguration(
    label: 'Bild',
    icon: 'image',
)]
#[Flow\Proxy(false)]
final readonly class Image implements ImageProvider
{
    use Content;
    use HeadlineMixin;

    public function __construct(
        #[FreeCroppingImage]
        public ImageSourceProxy $image,
    ) {
    }
}
