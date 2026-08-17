<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Quotation;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Quotation\Quotation as QuotationComponent;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerTag;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerVariant;
use Vendor\WheelInventor\Integration\FigureFactory;
use Vendor\WheelInventor\NodeTypes\Document\Document;
use Vendor\WheelInventor\NodeTypes\Document\HomePage\HomePage;

/**
 * @implements ContentNodeRendererInterface<Quotation,Document,HomePage>
 */
final class QuotationRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly FigureFactory $figureFactory
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return ContentContainer::create(
            tagName: ContentContainerTag::TAG_SECTION,
            variant: ContentContainerVariant::VARIANT_REGULAR,
            content: QuotationComponent::create(
                figure: $this->figureFactory->tryForImageProvider($context->current),
                content: $context->neos->getEditableFromProperty($context->current->text, true),
                spokenByName: $context->neos->getEditableFromProperty($context->current->spokenByCharacterName, true),
                spokenByJobTitle: $context->neos->getEditableFromProperty($context->current->spokenByCharacterJobTitle, true),
            ),
            anchorId: $context->current->anchorId,
        );
    }
}
