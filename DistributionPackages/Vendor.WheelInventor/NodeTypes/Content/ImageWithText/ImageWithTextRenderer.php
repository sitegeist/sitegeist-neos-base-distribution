<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\ImageWithText;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use Vendor\Shared\Components\Block\ImageWithText\ImageWithText as ImageWithTextComponent;
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
        $imageWithText = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, ImageWithText::class);

        return ContentContainerFactory::create(
            $context,
            ImageWithTextComponent::create(
                headline: $context->neos->getEditableFromProperty($imageWithText->headline, true),
                content: $context->neos->getEditableFromProperty($imageWithText->text, true),
                figure: $this->figureFactory->tryForOptionalImageProvider($imageWithText),
                button: $this->linkedButtonFactory->tryForLinkProvider($imageWithText, $context) ?: '',
                alignment: $imageWithText->alignment,
                layout: $imageWithText->layout,
            )
        );
    }
}
