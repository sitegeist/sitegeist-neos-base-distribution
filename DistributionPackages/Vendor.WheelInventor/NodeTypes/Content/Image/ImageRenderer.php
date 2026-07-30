<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Image;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use Vendor\Shared\Components\Block\Image\Image as ImageComponent;
use Vendor\WheelInventor\Integration\ContentContainerFactory;
use Vendor\WheelInventor\Integration\FigureFactory;

final class ImageRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly FigureFactory $figureFactory
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $image = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, Image::class);

        return ContentContainerFactory::create(
            $context,
            ImageComponent::create(
                headline: $context->neos->getEditableFromProperty($image->headline, true),
                figure: $this->figureFactory->tryForImageProvider($image),
            )
        );
    }
}
