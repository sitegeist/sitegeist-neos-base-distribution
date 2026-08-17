<?php

declare(strict_types=1);

namespace Vendor\WheelInventor\NodeTypes\Content\AccordionItem;

use PackageFactory\ComponentEngine\ComponentInterface;
use PackageFactory\Neos\ComponentEngine\Integration\ContentNodeRendererInterface;
use PackageFactory\Neos\ComponentEngine\NeosContext;
use Vendor\Shared\Components\Block\Accordion\Item\AccordionItem as AccordionItemComponent;
use Vendor\WheelInventor\Integration\LinkedButtonFactory;
use Vendor\WheelInventor\NodeTypes\Document\Document;
use Vendor\WheelInventor\NodeTypes\Document\HomePage\HomePage;

/**
 * @implements ContentNodeRendererInterface<AccordionItem,Document,HomePage>
 */
final class AccordionItemRenderer implements ContentNodeRendererInterface
{
    public function __construct(
        private readonly LinkedButtonFactory $linkedButtonFactory
    ) {
    }

    public function renderAsContent(NeosContext $context): ComponentInterface
    {
        return AccordionItemComponent::create(
            headline: $context->neos->getEditableFromProperty($context->current->headline, true),
            content: $context->neos->getEditableFromProperty($context->current->text, true),
            initialOpen: $context->current->initiallyOpen,
            inBackend: $context->renderingMode->isEdit,
            button: $this->linkedButtonFactory->tryForLinkProvider($context->current, $context) ?: ''
        );
    }
}
