<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\Quotation;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use Vendor\Shared\Components\Block\Quotation\Quotation as QuotationComponent;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainer;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerTag;
use Vendor\Shared\Components\Layout\ContentContainer\ContentContainerVariant;
use Vendor\WheelInventor\Integration\FigureFactory;

final class QuotationRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly FigureFactory $figureFactory
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $quotation = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, Quotation::class);

        return ContentContainer::create(
            tagName: ContentContainerTag::TAG_SECTION,
            variant: ContentContainerVariant::VARIANT_REGULAR,
            content: QuotationComponent::create(
                figure: $this->figureFactory->tryForImageProvider($quotation),
                content: $context->neos->getEditable(
                    $context->node,
                    'text',
                    true
                ),
                spokenByName: $context->neos->getEditable(
                    $context->node,
                    'spokenByCharacterName',
                    true
                ),
                spokenByJobTitle: $context->neos->getEditable(
                    $context->node,
                    'spokenByCharacterJobTitle',
                    true
                )
            ),
            anchorId: $quotation->anchorId,
        );
    }
}
