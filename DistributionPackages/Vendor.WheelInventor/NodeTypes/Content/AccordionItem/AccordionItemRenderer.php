<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\AccordionItem;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Accordion\Item\AccordionItem;
use Vendor\WheelInventor\Integration\LinkedButtonFactory;

final class AccordionItemRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly LinkedButtonFactory $linkedbuttonFactory
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return AccordionItem::create(
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
            initialOpen: $context->nodes->getBoolValue(
                $context->node,
                'initialOpen'
            ) ?? false,
            inBackend: $context->renderingMode->isEdit,
            button: $this->linkedbuttonFactory->tryForMixin($context) ?: ''
        );
    }
}
