<?php

declare(strict_types=1);

namespace Vendor\Site\NodeTypes\Content\ImageWithText;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\ImageWithText\ImageWithText as ImageWithTextComponent;
use Vendor\Site\Integration\ContentContainerFactory;
use Vendor\Site\Integration\FigureFactory;
use Vendor\Site\Integration\LinkedButtonFactory;
use Vendor\Site\NodeTypes\Document\Document;
use Vendor\Site\NodeTypes\Document\HomePage\HomePage;

/**
 * @implements ContentNodeRendererInterface<ImageWithText,Document,HomePage>
 */
final class ImageWithTextRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly LinkedButtonFactory $linkedButtonFactory,
        private readonly FigureFactory $figureFactory
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return ContentContainerFactory::create(
            $context->current,
            ImageWithTextComponent::create(
                headline: $context->neos->getEditableFromProperty($context->current->headline, true),
                content: $context->neos->getEditableFromProperty($context->current->text, true),
                figure: $this->figureFactory->tryForOptionalImageProvider($context->current),
                button: $this->linkedButtonFactory->tryForLinkProvider($context->current, $context) ?: '',
                alignment: $context->current->alignment,
                layout: $context->current->layout,
            )
        );
    }
}
