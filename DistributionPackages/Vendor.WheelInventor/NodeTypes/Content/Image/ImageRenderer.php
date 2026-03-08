<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Image;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Image\Image;
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
        return ContentContainerFactory::create(
            $context,
            Image::create(
                headline: $context->neos->getEditable(
                    $context->node,
                    'headline',
                    true
                ),
                figure: $this->figureFactory->tryForMixin($context)
            )
        );
    }
}
