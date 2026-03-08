<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\ImageWithText;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\ImageWithText\ImageWithText;
use Vendor\Shared\Components\Block\ImageWithText\ImageWithTextAlignment;
use Vendor\Shared\Components\Block\ImageWithText\ImageWithTextLayout;
use Vendor\WheelInventor\Integration\ContentContainerFactory;
use Vendor\WheelInventor\Integration\FigureFactory;
use Vendor\WheelInventor\Integration\LinkedButtonFactory;

final class ImageWithTextRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly LinkedButtonFactory $linkedButtonFactory,
        private readonly FigureFactory $figureFactory
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $alignment = $context->nodes->getObjectValue(
            $context->node,
            'alignment',
            ImageWithTextAlignment::class
        ) ?? ImageWithTextAlignment::VARIANT_IMAGEFIRST;
        $layout = $context->nodes->getObjectValue(
            $context->node,
            'layout',
            ImageWithTextLayout::class
        ) ?? ImageWithTextLayout::VARIANT_50_50;

        return ContentContainerFactory::create(
            $context,
            ImageWithText::create(
                headline: $context->neos->getEditable(
                    $context->node,
                    'headline',
                    true
                ),
                content: $context->neos->getEditable(
                    $context->node,
                    'text',
                    true
                ),
                figure: $this->figureFactory->tryForMixin($context),
                button: $this->linkedButtonFactory->tryForMixin($context) ?: '',
                alignment: $alignment,
                layout: $layout
            )
        );
    }
}
