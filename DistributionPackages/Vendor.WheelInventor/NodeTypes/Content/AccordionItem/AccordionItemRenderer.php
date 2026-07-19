<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\AccordionItem;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use PackageFactory\OPGM\Domain\ObjectPropertyGraphMapper;
use Vendor\Shared\Components\Block\Accordion\Item\AccordionItem as AccordionItemComponent;
use Vendor\WheelInventor\Integration\LinkedButtonFactory;

final class AccordionItemRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly LinkedButtonFactory $linkedButtonFactory
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        $accordionItem = ObjectPropertyGraphMapper::map($context->node, $context->subgraph, AccordionItem::class);

        return AccordionItemComponent::create(
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
            initialOpen: $accordionItem->initiallyOpen,
            inBackend: $context->renderingMode->isEdit,
            button: $this->linkedButtonFactory->tryForMixin($context) ?: ''
        );
    }
}
