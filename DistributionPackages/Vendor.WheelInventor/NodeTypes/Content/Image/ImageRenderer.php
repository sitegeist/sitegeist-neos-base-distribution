<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Image;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Image\Image as ImageComponent;
use Vendor\WheelInventor\Integration\ContentContainerFactory;
use Vendor\WheelInventor\Integration\FigureFactory;
use Vendor\WheelInventor\NodeTypes\Document\Document;
use Vendor\WheelInventor\NodeTypes\Document\HomePage\HomePage;

/**
 * @implements ContentNodeRendererInterface<Image,Document,HomePage>
 */
final class ImageRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly FigureFactory $figureFactory
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return ContentContainerFactory::create(
            $context->current,
            ImageComponent::create(
                headline: $context->neos->getEditableFromProperty($context->current->headline, true),
                figure: $this->figureFactory->tryForImageProvider($context->current),
            )
        );
    }
}
